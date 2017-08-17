<?php


class Login extends Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->view->render('login/index', true);
	}

	function run()
	{
		$this->refreshDB();
		$this->model->run();
	}

	function refreshDB()
	{
		$this->model->refreshDB();
	}
}

?>