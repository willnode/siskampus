<?php

namespace App\Controllers;

use App\Entities\Bio;
use App\Entities\User;
use App\Models\SiteModel;
use App\Models\UserModel;

class Home extends BaseController
{
	public function index()
	{
		if ($this->session->id) {
			$site = (new SiteModel())->get();
			$user = $this->db->table($this->session->type)
				->where('id', $this->session->id)
				->get()->getRow();
			if ($user)
				return view('bio', [
					'site' => $site,
					'bio' => new Bio(json_decode(
						$user->bio,
						true
					)),
					'type' => $this->session->type,
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
		if ($this->request->getMethod() === 'post') {
			if ($this->validate([
				'username' => 'required',
				'password' => 'required',
			])) {
				/** @var User */
				$user = (new UserModel())->find($this->request->getPost('username'));
				if ($user && password_verify($_POST['password'], $user->password)) {
					$this->session->id = $user->id;
					$this->session->type = $user->type;
					return $this->response->redirect('/');
				}
			}
		}
		$site = (new SiteModel())->get();
		return view('login', [
			'site' => $site
		]);
	}

	//--------------------------------------------------------------------

}
