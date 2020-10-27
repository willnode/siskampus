<?php

namespace App\Controllers;

use App\Entities\Minute;
use App\Entities\Proposal;
use App\Models\MinuteModel;
use App\Models\ProposalModel;
use App\Models\SeminarModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Shared\Controllers\BaseController;
use Shared\Entities\User;
use Shared\Models\LecturerModel;
use Shared\Models\SiteModel;

class Home extends BaseController
{

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
				return view('minute/edit', [
					'user' => $this->user,
					'page' => 'edit',
					'item' => new Minute(),
					'lecturers' => (new LecturerModel())->findAll(),
				]);
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
			return $this->response->redirect("//master.$_SERVER[HOST_URL]/check_login?r=/go/minute");
		}
	}

	public function logout()
	{
		$this->session->destroy();
		return $this->response->redirect("//master.$_SERVER[HOST_URL]/");
	}
}
