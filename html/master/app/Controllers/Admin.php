<?php

namespace App\Controllers;

use App\Entities\Dosen;
use App\Entities\Mahasiswa;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Shared\Models\UserModel;
use Config\Services;
use Shared\Controllers\BaseController;
use Shared\Entities\User as EntitiesUser;

class Admin extends BaseController
{

	/** @var EntitiesUser  */
	public $login;

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		if (!($this->login = Services::user())) {
			$this->response->redirect('/login/')->send();
			exit;
		}
		if ($this->login->role !== 'operator') {
			$this->response->setBody(shared_view('page/denied'));
			$this->response->send();
			exit;
		}
	}

	public function index()
	{
		return view('admin/dashboard', [
			'page' => 'admin'
		]);
	}

	public function mahasiswa($page = 'list', $id = null)
	{
		$model = new MahasiswaModel();
		if ($this->request->getMethod() === 'post') {
			if ($page === 'delete' && $model->delete($id)) {
				return $this->response->redirect('/admin/mahasiswa/');
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/admin/mahasiswa/');
			}
		}
		switch ($page) {
			case 'list':
				if ($a = $this->request->getGet('angkatan')) {
					return view('admin/mahasiswa/detail', [
						'data' => find_with_filter($model->withAngkatan($a)),
						'page' => 'mahasiswa',
					]);
				}
				return view('admin/mahasiswa/list', [
					'data' => $model->allAngkatan(),
					'page' => 'mahasiswa',
				]);
			case 'detail':
				return $this->response->redirect('../?angkatan=' . $id);
			case 'add':
				return view('admin/mahasiswa/edit', [
					'item' => new Mahasiswa()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('admin/mahasiswa/edit', [
					'item' => $item
				]);
		}
		throw new PageNotFoundException();
	}

	public function dosen($page = 'list', $id = null)
	{
		$model = new DosenModel();
		if ($this->request->getMethod() === 'post') {
			if ($page === 'delete' && $model->delete($id)) {
				return $this->response->redirect('/admin/dosen/');
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/admin/dosen/');
			}
		}
		switch ($page) {
			case 'list':
				return view('admin/dosen/list', [
					'data' => find_with_filter($model),
					'page' => 'dosen',
				]);
			case 'add':
				return view('admin/dosen/edit', [
					'item' => new Dosen()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('admin/dosen/edit', [
					'item' => $item
				]);
		}
		throw new PageNotFoundException();
	}

	public function user($page = 'list', $id = null)
	{
		$model = new UserModel();
		if ($this->request->getMethod() === 'post') {
			if ($page === 'delete' && $model->delete($id)) {
				return $this->response->redirect('/admin/user/');
			} else if ($model->processWeb($id)) {
				if ($_POST['role'] === 'dosen' && !((new DosenModel())->find($_POST['username']))) {
					(new DosenModel())->insert([
						'nid' => $_POST['username'],
						'nama' => $_POST['name'],
						'departemen' => '',
					]);
					return $this->response->redirect('/admin/user/?msg=created');
				}
				if ($_POST['role'] === 'mahasiswa' && !((new MahasiswaModel())->find($_POST['username']))) {
					(new MahasiswaModel())->insert([
						'nim' => $_POST['username'],
						'nama' => $_POST['name'],
						'prodi' => '',
						'angkatan' => date('Y'),
					]);
					return $this->response->redirect('/admin/user/?msg=created');
				}
				return $this->response->redirect('/admin/user/');
			}
		}
		switch ($page) {
			case 'list':
				return view('admin/users/list', [
					'data' => find_with_filter($model),
					'page' => 'users',
				]);
			case 'add':
				return view('admin/users/edit', [
					'item' => new EntitiesUser()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('admin/users/edit', [
					'item' => $item
				]);
		}
		throw new PageNotFoundException();
	}
}
