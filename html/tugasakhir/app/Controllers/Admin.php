<?php

namespace App\Controllers;

use App\Entities\Config;
use App\Entities\Pembimbing;
use App\Entities\Pendaftar;
use App\Libraries\PembimbingProcessor;
use App\Libraries\PendaftarProcessor;
use App\Models\PembimbingModel;
use App\Models\PendaftarModel;
use CodeIgniter\Exceptions\PageNotFoundException;
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
			} else if ($page === 'import' && $file = $this->request->getFile('file')) {
				$c = (new PembimbingProcessor)->import($file);
				return $this->response->redirect("../?success_rows=$c");
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/admin/pembimbing/');
			}
		}
		switch ($page) {
			case 'list':
				return view('admin/pembimbing/list', [
					'data' => find_with_filter($model),
					'page' => 'pembimbing',
				]);
			case 'detail':
				return $this->response->redirect('/admin/pendaftar/?pembimbing=' . $model->find($id)->nid ?? '');
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
			case 'export':
				(new PembimbingProcessor)->exportAndSend($model->findAll());
			case 'import':
				if ($file = $this->request->getFile('file')) {
					$c = (new PembimbingProcessor)->import($file);
					return $this->response->redirect("../?success_rows=$c");
				}
				return shared_view('page/upload', [
					'page' => 'pembimbing'
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
			} else if ($page === 'import' && $file = $this->request->getFile('file')) {
				$c = (new PendaftarProcessor)->import($file);
				return $this->response->redirect("../?success_rows=$c");
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/admin/pendaftar/');
			}
		}
		switch ($page) {
			case 'list':
				$model->withAktif(!($_GET['archived'] ?? ''));
				if ($p = ($_GET['pembimbing'] ?? '')) {
					$model->withPembimbing($p, false);
					$pp = (new PembimbingModel())->find($p);
				}
				return view('admin/pendaftar/list', [
					'pembimbing' => $pp ?? '',
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
			case 'detail':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('admin/pendaftar/detail', [
					'item' => $item
				]);
			case 'export':
				(new PendaftarProcessor)->exportAndSend($model->findAll());
			case 'import':
				return shared_view('page/upload', [
					'page' => 'pendaftar'
				]);
		}
		throw new PageNotFoundException();
	}

	public function config()
	{
		if ($this->request->getMethod() === 'post') {
			$c = Config::get();
			$c->fill($_POST);
			$c->save();
			return $this->response->redirect('/admin/config/');
		}
		return view('admin/config', [
			'item' => Config::get(),
			'page' => 'config',
		]);
	}
}
