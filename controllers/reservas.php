<?php


class Reservas extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		if ($logged == false)
		{
			Session::destroy();
			header("location: ".URL."login");
			exit;
		}
	}

	function index()
	{
		$this->view->reservas = $this->model->reservas(Session::get('id'));
		$this->view->render('reservas/index');
	}

	function logout()
	{
		Session::destroy();
		header("location: ".URL."login");
		exit;
	}
}

?>