<?php

namespace App\Controllers;

use Shared\Models\UserModel;
use Config\Services;
use Shared\Controllers\BaseController;

class User extends BaseController
{

	/** @var EntitiesUser  */
	public $login;

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		if (!($this->login = Services::user())) {
			$this->logout();
			$this->response->redirect('/login/')->send();
			exit;
		}
	}

	public function index()
	{
		return view('page/dashboard', [
			'page' => 'dashboard'
		]);
	}

	public function logout()
	{
		$this->session->destroy();
		return $this->response->redirect("//master.$_SERVER[HOST_URL]");
	}

	public function profile()
	{
		if ($this->request->getMethod() === 'post') {
			if ((new UserModel())->processWeb(Services::user()->id)) {
				return $this->response->redirect('/user/profile/');
			}
		}
		return view('page/profile', [
			'page' => 'profile',
			'item' => Services::user(),
		]);
	}
}
