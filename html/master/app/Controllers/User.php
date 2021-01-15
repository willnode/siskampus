<?php

namespace App\Controllers;

use App\Models\UserModel;
use Config\Services;
use Shared\Controllers\BaseController;

class User extends BaseController
{

	public function index()
	{
		return view('page/dashboard', [
			'page' => 'dashboard'
		]);
	}

	public function logout()
	{
		$this->session->destroy();
		return $this->response->redirect('/');
    }

	public function profile()
	{
		if ($this->request->getMethod() === 'post') {
			if ((new UserModel())->processWeb(Services::user()->id)) {
				return $this->response->redirect('/user/profile/');
			}
		}
		return view('page/profile', [
			'item' => Services::user(),
		]);
	}
}