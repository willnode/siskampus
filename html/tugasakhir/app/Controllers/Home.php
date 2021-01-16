<?php

namespace App\Controllers;

use CodeIgniter\Config\Services;
use Config\Database;
use Shared\Controllers\BaseController;
use Shared\Entities\User;
use Shared\Models\UserModel;

class Home extends BaseController
{
	public function index()
	{
		return $this->response->redirect('/login');
	}

	public function login()
	{
		if ($this->session->has('login')) {
			return $this->response->redirect('/user/');
		}
		if ($r = $this->request->getGet('r')) {
			return $this->response->setCookie('r', $r, 0)->redirect('/login/');
		}
		if ($this->request->getGet('token')) {
			$token = explode(':', base64_decode($this->request->getGet('token')), 2);
			if (isset($token[0], $token[1])) {
				/** @var User $auth */
				if ($auth = Database::connect('master')->table('user')->where([
					'username' => $token[0],
					'otp' => $token[1],
				])->get()->getRow(0, '\Shared\Entities\User')) {
					$model = (new UserModel);
					if ($user = $model->atUsername($token[0])) {
						if ($user->fill([
							'name' => $auth->name,
							'avatar' => $auth->avatar,
						])->hasChanged()) {
							$model->save($user);
						}
						$model->login($user);
					} else if ($this->request->getMethod() == 'post') {
						unset($auth->password);
						$model->register($auth->toArray());
					} else {
						return shared_view('page/register');
					}
					return $this->response->redirect('/');
				}
			}
		}
		return $this->response->redirect("//master.$_SERVER[HOST_URL]/user/go/tugasakhir");
	}

	//--------------------------------------------------------------------

}
