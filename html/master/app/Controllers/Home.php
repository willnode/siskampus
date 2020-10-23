<?php

namespace App\Controllers;

use CodeIgniter\Entity;
use Config\Services;
use Shared\Entities\User;
use Shared\Models\SiteModel;
use Shared\Models\LecturerModel;
use Shared\Models\OperatorModel;
use Shared\Models\StudentModel;
use Shared\Models\UserModel;

class Home extends BaseController
{
	/** @return Entity */
	protected function getUser()
	{
		if ($this->session->id) {
			switch ($this->session->type) {
				case 'student':
					return (new StudentModel())->find($this->session->id);
				case 'lecturer':
					return (new LecturerModel())->find($this->session->id);
				case 'operator':
					return (new OperatorModel())->find($this->session->id);
			}
		}
		return null;
	}

	public function index()
	{
		if ($user = $this->getUser()) {
			return view($this->session->type . '/index', [
				'user' => $user,
			]);
		} else
			return $this->response->redirect('/login');
	}

	public function profile()
	{
		if ($user = $this->getUser()) {
			$unlocks = array_flip(Services::site()->master->{$user->type . '_editable_columns'} ?: []);
			$free = is_profile_free_edit($user, Services::site()->master->{$user->type . '_editable_filters'});
			if ($this->request->getMethod() === 'post' && $free) {
				$data = array_filter(array_intersect_key($this->request->getPost(), $unlocks));
				if (isset($unlocks['avatar'])) {
					try_set_file($data, 'avatar', 'master/avatar');
				}
				$user->fill($data);
				switch ($user->type) {
					case 'student':
						(new StudentModel())->save($user);
						break;
					case 'lecturer':
						(new LecturerModel())->save($user);
						break;
					case 'operator':
						(new OperatorModel())->save($user);
						break;
				}
				$this->session->setFlashdata('message', 'Data berhasil disimpan');
			}
			if (($p = $this->request->getPost('password')) && ($login = (new UserModel())->find($user->id))) {
				$login->password = password_hash($p, PASSWORD_BCRYPT);
				(new UserModel())->save($login);
				$this->session->setFlashdata('message', 'Data berhasil disimpan');
			}
			return view($this->session->type . '/profile', [
				'unlocked' => $unlocks,
				'free' => $free,
				'user' => $user,
			]);
		} else
			return $this->response->redirect('/login');
	}

	public function go($site)
	{
		if ($user = $this->getUser()) {
			/** @var User */
			$u = (new UserModel())->find($user->id);
			$u->otp = random_int(111111, 9999999);
			(new UserModel())->save($u);
			$token = urlencode(base64_encode($u->username . ':' . $u->otp));
			return $this->response->redirect("//$site.$_SERVER[HOST_URL]/login?token=$token");
		} else
			return $this->response->redirect('/login');
	}

	public function logout()
	{
		$this->session->destroy();
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
		if ($this->request->getMethod() === 'post' && isset($_POST['username'])) {
			/** @var User */
			$user = (new UserModel())->find($_POST['username']);
			if ($user && !empty($_POST['password']) && password_verify($_POST['password'], $user->password)) {
				$this->session->id = $user->username;
				$this->session->type = $user->type;
				return $this->response->redirect(parse_url($_GET['r'] ?? '/', PHP_URL_PATH));
			}
		}
		$site = (new SiteModel())->get();
		return view('login', [
			'site' => $site
		]);
	}

	//--------------------------------------------------------------------

}
