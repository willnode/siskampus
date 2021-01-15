<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Config\Services;
use Shared\Controllers\BaseController;

class Home extends BaseController
{
	public function index()
	{
		return $this->response->redirect('/login');
	}

	public function go($site)
	{
		if ($u = Services::user()) {
			if (!$u->otp || !$this->session->get('TOKEN_SECURED')) {
				$this->session->set('TOKEN_SECURED', 1);
				$u->otp = random_int(111111, 9999999);
				(new UserModel())->save($u);
			}
			$token = urlencode(base64_encode($u->username . ':' . $u->otp));
			return $this->response->redirect("//$site.$_SERVER[HOST_URL]/login?token=$token");
		} else
			return $this->response->redirect('/login');
	}

	public function check_login()
	{
		if ($this->session->id) {
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
				$login = (new UserModel())->atEmail($post['username']);
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
			$m = lang('Interface.wrongLogin');
		}
		return view('login', [
			'message' => $m ?? (($_GET['msg'] ?? '') === 'emailsent' ? lang('Interface.emailSent') : null)
		]);
	}

	//--------------------------------------------------------------------

}
