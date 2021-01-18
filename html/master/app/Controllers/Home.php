<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use Shared\Models\UserModel;
use Shared\Controllers\BaseController;
use Shared\Entities\User;

class Home extends BaseController
{
	public function index()
	{
		return $this->response->redirect('/login');
	}

	public function get_login()
	{
		if (isset($_GET['u'], $_GET['o'])) {
			$login = (new UserModel())->atUsername($_GET['u']);
			if ($login && $login->otp == $_GET['o']) {
				return $this->response->setJSON([
					'username' => $login->username,
					'role' => $login->role,
					'name' => $login->name,
					'avatar' => $login->avatar,
				]);
			}
		} else {
			return $this->response->setJSON(0);
		}
	}

	public function check_login()
	{
		if ($this->session->has('login')) {
			return $this->response->redirect(parse_url($_GET['r'] ?? '/', PHP_URL_PATH));
		} else {
			return $this->response->redirect('/login?r=' . urlencode($_GET['r'] ?? '/'));
		}
	}

	public function login()
	{
		if ($this->session->has('login')) {
			return $this->response->redirect('/user/');
		}
		if ($r = $this->request->getGet('r')) {
			return $this->response->setCookie('r', $r, 0)->redirect('/login/');
		}
		if ($this->request->getMethod() === 'post') {
			$post = $this->request->getPost();
			if (isset($post['username'], $post['password'])) {
				$login = (new UserModel())->atUsername($post['username']);
				if ($login && password_verify(
					$post['password'],
					$login->password
				)) {
					(new UserModel())->login($login);
					if ($r = $this->request->getCookie('r')) {
						$this->response->deleteCookie('r');
					}
					return $this->response->redirect(base_url($r ?: 'user'));
				}
			}
			$m = "Salah username atau password, mohon coba lagi.";
		}
		return view('login', [
			'message' => $m ?? (($_GET['msg'] ?? '') === 'registered' ? "Berhasil didaftarkan, silahkan masuk." : null)
		]);
	}

	public function register()
	{
		if ($this->request->getMethod() === 'post' && isset($_POST['username'], $_POST['password'])) {
			$um = new UserModel();
			if ($u = $um->atUsername($_POST['username'])) {
				$m = "Akun dengan NIM tersebut sudah didaftarkan";
			} else if (!($m = (new MahasiswaModel())->atNim($_POST['username']))) {
				$m = "Tidak ada data dengan NIM tersebut";
			} else if (!isset($_POST['confirmed'])) {
				return view('register_confirm', [
					'item' => $m,
				]);
			}else {
				$u = new User($_POST);
				unset($u->id);
				$u->password = password_hash($u->password, PASSWORD_BCRYPT);
				$u->name = $m->nama;
				$u->role = 'mahasiswa';
				$um->save($u);
				return $this->response->redirect('/login?msg=registered');
			}
		}
		return view('register', [
			'message' => $m ?? null
		]);
	}

	//--------------------------------------------------------------------

}
