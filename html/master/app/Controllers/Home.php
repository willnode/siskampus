<?php

namespace App\Controllers;

use Shared\Entities\User;
use App\Models\SiteModel;
use Shared\Models\LecturerModel;
use Shared\Models\StudentModel;
use Shared\Models\UserModel;

class Home extends BaseController
{
	public function index()
	{
		if ($this->session->id) {
			$site = (new SiteModel())->get();
			switch ($this->session->type) {
				case 'student':
					$user = (new StudentModel())->find($this->session->id);
					break;
				case 'lecturer':
					$user = (new LecturerModel())->find($this->session->id);
					break;
			}
			if ($user)
				return view($this->session->type, [
					'site' => $site,
					'user' => $user,
				]);
			else
				return $this->logout();
		} else
			return $this->response->redirect('/login');
	}

	public function logout()
	{
		$this->session->destroy();
		return $this->response->redirect('/login');
	}

	public function login()
	{
		if ($this->request->getMethod() === 'post' && isset($_POST['username'])) {
			/** @var User */
			$user = (new UserModel())->find($_POST['username']);
			if ($user && !empty($_POST['password']) && password_verify($_POST['password'], $user->password)) {
				$this->session->id = $user->username;
				$this->session->type = $user->type;
				return $this->response->redirect($_GET['r'] ?? '/');
			} elseif ($user && $user->otp && !empty($_POST['otp']) && $_POST['otp'] === $user->otp) {
				$this->session->id = $user->username;
				$this->session->type = $user->type;
				$user->otp = null;
				(new UserModel())->save($user);
				return $this->response->redirect($_GET['r'] ?? '/');
			}
		}
		$site = (new SiteModel())->get();
		return view('login', [
			'site' => $site
		]);
	}

	//--------------------------------------------------------------------

}
