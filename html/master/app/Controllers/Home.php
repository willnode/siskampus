<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return $this->response->redirect('/login');
	}

	public function login()
	{
		return view('login');
	}

	//--------------------------------------------------------------------

}
