<?php

namespace App\Controllers;

use App\Entities\Minute;
use App\Models\MinuteModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Shared\Controllers\BaseController;

class Home extends BaseController
{

	public function minute($page = 'list', $id = null)
	{
		if (!$this->user->id) {
			return $this->response->redirect('/login');
		}
		if ($this->request->getMethod() === 'post') {
			if ($page === 'delete') {
				(new MinuteModel())->delete($id);
				return $this->response->redirect('/minute/');
			} else {
				$id = (new MinuteModel())->processWeb($id);
				return $this->response->redirect('/minute/detail/'.$id);
			}
		}
		switch ($page) {
			case 'list':
				return view('minute/index', [
					'user' => $this->user,
					'page' => 'minute',
					'list' => find_with_filter(new MinuteModel()),
				]);
			case 'add':
				if ($this->request->getMethod() === 'post') {
				} else {
					return view('minute/edit', [
						'user' => $this->user,
						'page' => 'edit',
						'item' => new Minute(),
					]);
				}
			case 'detail':
			case 'edit':
				if (!($item = (new MinuteModel())->find($id))) {
					throw new PageNotFoundException();
				}
				return view('minute/' . $page, [
					'user' => $this->user,
					'page' => $page,
					'item' => $item,
				]);
			default:
				throw new PageNotFoundException();
		}
	}

	public function index()
	{
		return $this->response->redirect($this->user->id ? '/minute/' : '/login');
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
