<?php

namespace App\Controllers;

use Shared\Controllers\BaseController;
use Shared\Entities\User;
use Shared\Models\UserModel;

class Home extends BaseController
{
	public function index()
	{
		if ($this->user->id) {
			return view($this->session->type . '/index', [
				'user' => $this->user,
				'page' => 'index',
			]);
		} else
			return $this->response->redirect('/login');
	}

	public function profile()
	{
		if ($this->user->id) {
			$unlocks = array_flip($this->site->master->{$this->user->type . '_editable_columns'} ?: []);
			$free = is_profile_free_edit($this->user, $this->site->master->{$this->user->type . '_editable_filters'});
			if ($this->request->getMethod() === 'post' && $free) {
				$data = array_filter(array_intersect_key($this->request->getPost(), $unlocks));
				if (isset($unlocks['avatar'])) {
					try_set_file($data, 'avatar', 'master/avatar');
				}
				$this->user->getEntity()->fill($data);
				$this->user->save();
				$this->session->setFlashdata('message', 'Data berhasil disimpan');
			}
			if (($p = $this->request->getPost('password')) && ($login = $this->user->getUser())) {
				$login->password = password_hash($p, PASSWORD_BCRYPT);
				(new UserModel())->save($login);
				$this->session->setFlashdata('message', 'Data berhasil disimpan');
			}
			if ($this->request->getMethod() === 'post') {
				return $this->response->redirect(previous_url());
			}
			return view($this->session->type . '/profile', [
				'unlocked' => $unlocks,
				'user' => $this->user->getEntity(),
				'free' => $free,
				'page' => 'profile',
			]);
		} else
			return $this->response->redirect('/login');
	}

	public function go($site)
	{
		if ($this->user->id) {
			/** @var User */
			$u = $this->user->getUser();
			$u->otp = random_int(111111, 9999999);
			(new UserModel())->save($u);
			$token = urlencode(base64_encode($u->username . ':' . $u->otp));
			return $this->response->redirect("//$site.$_SERVER[HOST_URL]/login?token=$token");
		} else
			return $this->response->redirect('/login');
	}

	public function logout()
	{
		$this->user->logout();
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
		return view('login');
	}

	//--------------------------------------------------------------------

}
