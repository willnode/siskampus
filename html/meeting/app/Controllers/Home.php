<?php

namespace App\Controllers;

use App\Entities\Proposal;
use App\Models\ProposalModel;
use App\Models\SeminarModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Shared\Controllers\BaseController;
use Shared\Entities\User;
use Shared\Models\SiteModel;

class Home extends BaseController
{

	protected function getProposal()
	{
		switch ($this->user->type) {
			case 'student':
				return (new ProposalModel())->findWithStudent($this->user->id);
			case 'lecturer':
				return (new ProposalModel())->findWithLecturer($this->user->id);
			default:
				return;
		}
	}

	protected function getSeminar()
	{
		switch ($this->user->type) {
			case 'student':
				return (new SeminarModel())->findWithStudent($this->user->id);
			case 'lecturer':
				return (new SeminarModel())->findWithLecturer($this->user->id);
			default:
				return;
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

	/** @param User $user */
	protected function proposalPostStudent($id)
	{
		if (!$this->validate([
			'lecturer_id.0' => 'required',
			'lecturer_id.1' => 'required',
			'title' => 'required',
			'abstract' => 'required',
			'expertise_id' => 'required',
		])) {
			$this->session->setFlashdata('error', $this->validator->listErrors());
			return $this->response->redirect("/proposal/$id");
		}
		/** @var Proposal */
		$item = $id === 'new' ? new Proposal() : (new ProposalModel())->find($id);
		$post = $this->request->getPost();
		if ($id === 'new') {
			unset($item->id);
			$item->student_id = $this->user->id;
			$item->status = 'pending';
			try_set_file($item, 'file', 'research/proposal');
		} else {
			if (!$item) return;
			unset($post->id);
			unset($post->file);
			try_set_file($item, 'file', 'research/proposal');
			unset($item->lecturer_id);
			if ($item->status != 'pending')
				return;
		}
		$item->fill($post);
		(new ProposalModel())->save($item);
		$this->session->setFlashdata('message', 'Data berhasil disimpan');
		return $this->response->redirect('/proposal');
	}
	/** @param User $user */
	protected function proposalPostLecturer($id)
	{
		/** @var Proposal */
		if (!($item = (new ProposalModel())->find($id))) return;
		switch ($this->request->getPost('action')) {
			case 'accept':
				$item->status = str_replace('-' . $this->user->id, '', $item->status) . '-' . $this->user->id;
				if (count(explode('-', $item->status)) > count($item->lecturer_id)) {
					$item->status = 'review';
				}
				break;
			case 'reject':
				$item->status = 'rejected';
				break;
		}
		(new ProposalModel())->save($item);
		$this->session->setFlashdata('message', 'Data berhasil disimpan');
		return $this->response->redirect('/proposal');
	}
	/** @param User $user */
	protected function proposalPostOperator($id)
	{
		$model = (new ProposalModel());
		/** @var Proposal */
		if (!($item = $model->find($id))) return;
		switch ($action = $this->request->getPost('action')) {
			case 'choose':
				// reject other from student
				$all = $model->findWithStudent($item->student_id);
				foreach ($all as $a) {
					if ($a->status !== 'rejected') {
						$a->status = 'rejected';
						$model->save($a);
					}
				}
				$item->status = 'final';
				$model->save($item);
				break;
			case 'delete':
				$model->delete($item->id);
				break;
		}
		if (!$action) {
			$item->fill($this->request->getPost());
			$model->save($item);
		}
		$this->session->setFlashdata('message', 'Data berhasil disimpan');
		return $this->response->redirect('/proposal');
	}
	public function proposal($id = null)
	{
		if ($this->user->id) {
			if ($this->request->getMethod() === 'post') {
				switch ($this->user->type) {
					case 'student':
						return $this->proposalPostStudent($id);
					case 'lecturer':
						return $this->proposalPostLecturer($id);
					case 'operator':
						return $this->proposalPostOperator($id);
					default:
						throw new PageNotFoundException();
				}
			} else if ($this->request->getMethod() === 'get') {
				if ($id === null) {
					if (empty($_GET['mode'])) {
						switch ($this->user->type) {
							case 'lecturer':
								return $this->response->redirect('?mode=pending');
							case 'operator':
								return $this->response->redirect('?mode=review');
						}
					}
					return view('proposal/index', [
						'page' => 'proposal',
						'site' => (new SiteModel())->get(),
						'list' => $this->getProposal(),
						'user' => $this->user,
					]);
				} else if ($id === 'new' && $this->user->type !== 'lecturer') {
					return view('proposal/edit', [
						'site' => (new SiteModel())->get(),
						'item' => new Proposal(),
						'user' => $this->user,
					]);
				} else if (($item = (new ProposalModel())->find($id))) {
					return view($this->user->type === 'lecturer' || ($this->user->type === 'student' &&
						$item->status !== 'review' && $item->status !== 'rejected') || ($this->user->type === 'operator' && !check_access($this->user, 'research/proposal')) ?
						'proposal/detail'  : 'proposal/edit', [
						'site' => (new SiteModel())->get(),
						'item' => $item,
						'user' => $this->user,
					]);
				} else
					throw new PageNotFoundException();
			}
		} else
			return $this->response->redirect('/login');
	}

	public function seminar($id = null)
	{
		if ($this->user->id) {
			if ($this->request->getPost()) {
				if (check_access($this->user, 'skripsi/seminar')) {
					$post = $this->request->getPost();
					if ($id === 'new') {
						$post->status = 'scheduled';
						unset($post->id);
					} else {
						$post->id = $id;
					}
					(new SeminarModel())->save($post);
					return $this->response->redirect('/seminar');
				}
				return;
			} else {
				if ($id === null) {
					return view('seminar/index', [
						'page' => 'seminar',
						'site' => (new SiteModel())->get(),
						'user' => $this->user,
						'list' => $this->getSeminar(),
					]);
				}
				if ($id === 'new') {
					return view('seminar/edit', [
						'page' => 'seminar',
						'site' => (new SiteModel())->get(),
						'proposal' => (new ProposalModel())->find($_GET['from']),
						'user' => $this->user,
					]);
				} else if (($item = (new SeminarModel())->find($id))) {
					return view('seminar/edit', [
						'site' => (new SiteModel())->get(),
						'item' => $item,
						'user' => $this->user,
					]);
				} else {
					throw new PageNotFoundException();
				}
			}
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
			return $this->response->redirect("//master.$_SERVER[HOST_URL]/check_login?r=/go/research");
		}
	}

	public function logout()
	{
		$this->session->destroy();
		return $this->response->redirect("//master.$_SERVER[HOST_URL]/");
	}
}
