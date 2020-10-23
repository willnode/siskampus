<?php

namespace App\Controllers;

use App\Entities\Proposal;
use App\Models\ProposalModel;
use App\Models\SeminarModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Shared\Entities\User;
use Shared\Models\LecturerModel;
use Shared\Models\OperatorModel;
use Shared\Models\SiteModel;
use Shared\Models\StudentModel;

class Home extends BaseController
{
	/** @return Entity */
	protected function getUser()
	{
		if ($this->session->id) {
			switch ($this->session->type) {
				case 'student':
					return (new StudentModel())->find($this->session->id);
				case 'lecturer':
					return (new LecturerModel())->find($this->session->id);
				case 'operator':
					return (new OperatorModel())->find($this->session->id);
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

	protected function getSeminar()
	{
		switch ($this->session->type) {
			case 'student':
				return (new SeminarModel())->findWithStudent($this->session->id);
			case 'lecturer':
				return (new SeminarModel())->findWithLecturer($this->session->id);
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
				'page' => 'index',
			]);
		} else
			return $this->response->redirect('/login');
	}

	/** @param User $user */
	protected function proposalPostStudent($user, $id)
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
			$item->student_id = $user->id;
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
	protected function proposalPostLecturer($user, $id)
	{
		/** @var Proposal */
		if (!($item = (new ProposalModel())->find($id))) return;
		switch ($this->request->getPost('action')) {
			case 'accept':
				$item->status = str_replace('-' . $user->id, '', $item->status) . '-' . $user->id;
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
	protected function proposalPostOperator($user, $id)
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
		if (($user = $this->getUser()) && ($type = $this->session->type)) {
			if ($this->request->getMethod() === 'post') {
				switch ($type) {
					case 'student':
						return $this->proposalPostStudent($user, $id);
					case 'lecturer':
						return $this->proposalPostLecturer($user, $id);
					case 'operator':
						return $this->proposalPostOperator($user, $id);
					default:
						throw new PageNotFoundException();
				}
			} else if ($this->request->getMethod() === 'get') {
				if ($id === null) {
					if (empty($_GET['mode'])) {
						switch ($type) {
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
						'user' => $user,
						'type' => $type,
					]);
				} else if ($id === 'new' && $type !== 'lecturer') {
					return view('proposal/edit', [
						'site' => (new SiteModel())->get(),
						'item' => new Proposal(),
						'user' => $user,
						'type' => $type,
					]);
				} else if (($item = (new ProposalModel())->find($id))) {
					return view($type === 'lecturer' || ($type === 'student' &&
						$item->status !== 'review' && $item->status !== 'rejected') || ($type === 'operator' && !check_access($user, 'research/proposal')) ?
						'proposal/detail'  : 'proposal/edit', [
						'site' => (new SiteModel())->get(),
						'item' => $item,
						'user' => $user,
						'type' => $type,
					]);
				} else
					throw new PageNotFoundException();
			}
		} else
			return $this->response->redirect('/login');
	}

	public function seminar($id = null)
	{
		if (($user = $this->getUser()) && ($type = $this->session->type)) {
			if ($this->request->getPost()) {
				if (check_access($user, 'skripsi/seminar')) {
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
						'user' => $user,
						'list' => $this->getSeminar(),
						'type' => $type,
					]);
				}
				if ($id === 'new') {
					return view('seminar/edit', [
						'page' => 'seminar',
						'site' => (new SiteModel())->get(),
						'proposal' => (new ProposalModel())->find($_GET['from']),
						'user' => $user,
					]);
				} else if (($item = (new SeminarModel())->find($id))) {
					return view('seminar/edit', [
						'site' => (new SiteModel())->get(),
						'item' => $item,
						'user' => $user,
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
