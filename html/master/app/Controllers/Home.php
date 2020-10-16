<?php

namespace App\Controllers;

use Shared\Entities\User;
use Shared\Models\SiteModel;
use Shared\Models\LecturerModel;
use Shared\Models\StudentModel;
use Shared\Models\UserModel;

class Home extends BaseController
{
	protected function getUser()
	{
		if ($this->session->id) {
			switch ($this->session->type) {
				case 'student':
					$user = (new StudentModel())->find($this->session->id);
					break;
				case 'lecturer':
					$user = (new LecturerModel())->find($this->session->id);
					break;
			}
			return $user ?? null;
		}
		return null;
	}

	public function index()
	{
		if ($user = $this->getUser()) {
			return view($this->session->type.'/index', [
				'site' => (new SiteModel())->get(),
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
