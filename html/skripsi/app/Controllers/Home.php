<?php

namespace App\Controllers;

use Shared\Models\LecturerModel;
use Shared\Models\SiteModel;
use Shared\Models\StudentModel;

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
			return view($this->session->type, [
				'site' => (new SiteModel())->get(),
				'user' => $user,
			]);
		} else
			return $this->response->redirect('/login');
	}

	public function login()
	{
		if ($user = tokenBasedLogin($_GET['token'] ?? '')) {
			$this->session->id = $user->username;
			$this->session->type = $user->type;
			return $this->response->redirect(parse_url($_GET['r'] ?? '/', PHP_URL_PATH));
		} else {
			return $this->response->redirect("//master.$_SERVER[HOST_URL]/check_login?r=/go/skripsi");
		}
	}
}
