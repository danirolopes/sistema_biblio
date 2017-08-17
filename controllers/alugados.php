<?php


class Alugados extends Controller
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
		$this->view->alugados = $this->model->alugados(Session::get('id'));
		$this->view->render('alugados/index');
	}

	function logout()
	{
		Session::destroy();
		header("location: ".URL."login");
		exit;
	}
}

?>