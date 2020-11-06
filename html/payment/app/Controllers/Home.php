<?php

namespace App\Controllers;

use App\Entities\Minute;
use App\Models\MinuteModel;
use Shared\Controllers\BaseController;

class Home extends BaseController
{
	public function postMinute($id)
	{
		// if (!$this->validate([
		// 	'title' => 'required',
		// 	'note' => 'required',
		// 	'time' => 'required',
		// 	'duration' => 'required',
		// 	'room_id' => 'required',
		// ])) {
		// 	$this->session->setFlashdata('error', $this->validator->listErrors());
		// 	return $this->response->redirect("/minute/$id");
		// }
		$minute = (new Minute($_POST));
		$id = (new MinuteModel())->insert($minute);
		return $this->response->redirect("/minute/$id");
	}

	public function minute($id = null)
	{
		if ($this->user->id) {
			if ($id === null) {
				return view('minute/index', [
					'user' => $this->user,
					'page' => 'index',
					'list' => (new MinuteModel())->findAll(),
				]);
			} else if ($id === 'new') {
				if ($this->request->getMethod() === 'post') {
					return $this->postMinute($id);
				} else {
					return view('minute/edit', [
						'user' => $this->user,
						'page' => 'edit',
						'item' => new Minute(),
					]);
				}
			}
		} else
			return $this->response->redirect('/login');
	}

	public function index()
	{
		if ($this->user->id) {
			return view('index', [
				'page' => 'index',
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
			return $this->response->redirect("//master.$_SERVER[HOST_URL]/check_login?r=/go/meeting");
		}
	}

	public function logout()
	{
		$this->session->destroy();
		return $this->response->redirect("//master.$_SERVER[HOST_URL]/");
	}
}
