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
			'page' => 'profile',
			'item' => Services::user(),
		]);
	}

	public function go($site)
	{
		$u = Services::user();
		if (!$u->otp || !$this->session->get('TOKEN_SECURED')) {
			$this->session->set('TOKEN_SECURED', 1);
			$u->otp = random_int(111111, 9999999);
			(new UserModel())->save($u);
		}
		$token = urlencode(base64_encode($u->username . ':' . $u->otp));
		return $this->response->redirect("//$site.$_SERVER[HOST_URL]/login?token=$token");
	}
}
