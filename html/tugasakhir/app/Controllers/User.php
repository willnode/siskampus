<?php

namespace App\Controllers;

use App\Entities\Pendaftar;
use App\Models\PembimbingModel;
use App\Models\PendaftarModel;
use CodeIgniter\Entity;
use Shared\Models\UserModel;
use Config\Services;
use Shared\Controllers\BaseController;
use Shared\Entities\User as EntitiesUser;

class User extends BaseController
{

	/** @var EntitiesUser  */
	public $login;

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		if (!($this->login = Services::user())) {
			$this->logout();
			$this->response->redirect('/login/')->send();
			exit;
		}
	}
	public function api_checkseats()
	{
		if (!empty($_GET['tema'])) {
			return $this->response->setJSON(array_filter(array_map(function ($x) {
				return $x->toArray();
			}, (new PembimbingModel)->withAvailableSeats($_GET['tema'])), function ($x) {
				return $x['seats'] > 0;
			}));
		}
	}
	public function index()
	{
		return $this->login->role == 'operator' ? view('page/dashboard') :  $this->response->redirect('/user/info/');
	}
	public function info($page = 'view', $id = null)
	{
		if ($this->login->role == 'mahasiswa') {
			$m = (new PendaftarModel());
			$p = $m->atNim($this->login->username);
		} else if ($this->login->role == 'dosen') {
			$m = (new PembimbingModel());
			$p = $m->atNid($this->login->username);
			$k = find_with_filter((new PendaftarModel())->withPembimbing($this->login->username, !($_GET['arsip'] ?? '')));
		} else {
			return;
		}
		switch ($page) {
			case 'view':
				if ($_GET['arsip'] ?? '') {
					return view("info/{$this->login->role}/arsip", [
						'profile' => $p,
						'user' => $this->login,
						'page' => 'arsip',
						'bimbingan' => $k ?? [],
					]);
				}
				return view("info/{$this->login->role}/view", [
					'profile' => $p,
					'user' => $this->login,
					'page' => 'info',
					'bimbingan' => $k ?? [],
				]);
			case 'arsip':
				return $this->response->redirect('/user/info/?arsip=1');
			case 'edit':
				if (isset($k) && $id) {
					if ($_POST) {
						(new PendaftarModel())->processWeb($id ?? null);
						return $this->response->redirect('/user/info/');
					}
					return view("info/dosen/edit_bimbingan", [
						'item' => (new PendaftarModel())->find($id),
					]);
				}
				if ($_POST) {
					$m->processWeb($p->id ?? null);
					return $this->response->redirect('/user/info/');
				}
				return view("info/{$this->login->role}/edit", [
					'profile' => $p ?? new Entity(),
					'user' => $this->login,
				]);
		}
	}

	public function logout()
	{
		$this->session->destroy();
		return $this->response->redirect("//master.$_SERVER[HOST_URL]");
	}

	public function profile()
	{
		if ($this->request->getMethod() === 'post') {
			if ((new UserModel())->processWeb(Services::user()->id)) {
				return $this->response->redirect('/user/profile/');
			}
		}
		return view('page/profile', [
			'page' => 'profile',
			'item' => Services::user(),
		]);
	}
}
