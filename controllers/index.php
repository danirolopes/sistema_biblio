<?php


class Index extends Controller
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
		if(isset($_POST['livro']))
		{
			$this->view->livros = $this->model->livros($_POST['livro']);
		}
		if(Session::get('role'))
		{
			$this->view->users = $this->model->users();
		}

		$this->getNotification();
		
		$this->view->render('index/index');
	}

	function logout()
	{
		Session::destroy();
		header("location: ".URL."login");
		exit;
	}

	function reserva()
	{
		$this->model->reserva($_POST['idLivro'], $_POST['idUser']);
		header("location: ".URL."index");
	}

	function undoReserva()
	{
		$this->model->undoReserva($_POST['idLivro']);
		header("location: ".URL."index");	
	}

	function alugarLivro()
	{
		$this->model->alugarLivro($_POST['idLivro'], $_POST['idUser']);
		header("location: ".URL."index");	
	}

	function devolverLivro()
	{
		$this->model->devolverLivro($_POST['idLivro']);
		header("location: ".URL."index");	
	}

	function getNotification()
	{
		$this->view->notification = $this->model->getNotification(Session::get('id'));
	}

}

?>