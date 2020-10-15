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
			$user = $this->db->table('master.'.$this->session->type)
				->where('id', $this->session->id)
				->get()->getRow();
			if ($user)
				return view('bio', [
					'site' => $site,
					'bio' => new Bio(json_decode(
						$user->data,
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
