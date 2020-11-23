<?php

namespace App\Controllers;

use App\Entities\Minute;
use App\Models\MinuteModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Shared\Controllers\BaseController;

class Home extends BaseController
{
	protected function postMinute($id)
	{
		$minute = (new Minute($_POST));
		$id = (new MinuteModel())->insert($minute);
		return $this->response->redirect("/minute/detail/$id");
	}

	public function minute($page = 'list', $id = null)
	{
		if (!$this->user->id) {
			return $this->response->redirect('/login');
		}
		switch ($page) {
			case 'list':
				return view('minute/index', [
					'user' => $this->user,
					'page' => 'index',
					'list' => find_with_filter(new MinuteModel()),
				]);
			case 'add':
				if ($this->request->getMethod() === 'post') {
					return $this->postMinute($id);
				} else {
					return view('minute/edit', [
						'user' => $this->user,
						'page' => 'edit',
						'item' => new Minute(),
					]);
				}
			case 'detail':
				if (!($item = (new MinuteModel())->find($id))) {
					throw new PageNotFoundException();
				}
				return view('minute/detail', [
					'user' => $this->user,
					'page' => 'detail',
					'item' => $item,
				]);
			case 'edit':
				if (!($item = (new MinuteModel())->find($id))) {
					throw new PageNotFoundException();
				}
				return view('minute/detail', [
					'user' => $this->user,
					'page' => 'detail',
					'item' => $item,
				]);
			default:
				throw new PageNotFoundException();
		}
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
