<?php

namespace App\Controllers;

use App\Entities\Dosen;
use App\Entities\Mahasiswa;
use App\Entities\Pembimbing;
use App\Entities\Pendaftar;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Models\PembimbingModel;
use App\Models\PendaftarModel;
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

	public function pembimbing($page = 'list', $id = null)
	{
		$model = new PembimbingModel();
		if ($this->request->getMethod() === 'post') {
			if ($page === 'delete' && $model->delete($id)) {
				return $this->response->redirect('/admin/pembimbing/');
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/admin/pembimbing/');
			}
		}
		switch ($page) {
			case 'list':
				return view('admin/pembimbing/list', [
					'data' => $model->allAngkatan(),
					'page' => 'pembimbing',
				]);
			case 'detail':
				return $this->response->redirect('../?angkatan=' . $id);
			case 'add':
				return view('admin/pembimbing/edit', [
					'item' => new Pembimbing()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('admin/pembimbing/edit', [
					'item' => $item
				]);
		}
		throw new PageNotFoundException();
	}

	public function pendaftar($page = 'list', $id = null)
	{
		$model = new PendaftarModel();
		if ($this->request->getMethod() === 'post') {
			if ($page === 'delete' && $model->delete($id)) {
				return $this->response->redirect('/admin/pendaftar/');
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/admin/pendaftar/');
			}
		}
		switch ($page) {
            case 'list':
				if ($a = $this->request->getGet('angkatan')) {
					return view('admin/pendaftar/detail', [
						'data' => find_with_filter($model->withAngkatan($a)),
						'page' => 'pendaftar',
					]);
				}
				return view('admin/pendaftar/list', [
					'data' => find_with_filter($model),
					'page' => 'pendaftar',
				]);
			case 'add':
				return view('admin/pendaftar/edit', [
					'item' => new Pendaftar()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('admin/pendaftar/edit', [
					'item' => $item
				]);
		}
		throw new PageNotFoundException();
	}
}
