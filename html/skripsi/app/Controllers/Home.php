<?php

namespace App\Controllers;

use App\Entities\Proposal;
use App\Models\ProposalModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Shared\Models\LecturerModel;
use Shared\Models\SiteModel;
use Shared\Models\StudentModel;

class Home extends BaseController
{
	protected function getUser()
	{
		if ($this->session->id) {
			switch ($this->session->type) {
				case 'student':
					return (new StudentModel())->find($this->session->id);
				case 'lecturer':
					return (new LecturerModel())->find($this->session->id);
			}
		}
		return null;
	}

	protected function getProposal()
	{
		switch ($this->session->type) {
			case 'student':
				return (new ProposalModel())->findWithStudent($this->session->id);
			case 'lecturer':
				return (new ProposalModel())->findWithLecturer($this->session->id);
			default:
				return;
		}
	}

	public function index()
	{
		if ($user = $this->getUser()) {
			return view('index', [
				'site' => (new SiteModel())->get(),
				'user' => $user,
			]);
		} else
			return $this->response->redirect('/login');
	}

	public function proposal($id = null)
	{
		if ($user = $this->getUser()) {
			if ($id === null) {
				return view('proposal/index', [
					'site' => (new SiteModel())->get(),
					'list' => $this->getProposal(),
					'user' => $user,
				]);
			} else if ($id === 'new') {
				return view('proposal/edit', [
					'site' => (new SiteModel())->get(),
					'item' => new Proposal(),
					'user' => $user,
				]);
			} else if ($item = (new ProposalModel())->find($id)) {
				return view('proposal/edit', [
					'site' => (new SiteModel())->get(),
					'item' => $item,
					'user' => $user,
				]);
			} else
				throw new PageNotFoundException();
		} else
			return $this->response->redirect('/login');
	}

	public function seminar()
	{
		if ($user = $this->getUser()) {
			return view('seminar/index', [
				'site' => (new SiteModel())->get(),
				'user' => $user,
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
			return $this->response->redirect("//master.$_SERVER[HOST_URL]/check_login?r=/go/skripsi");
		}
	}
}
