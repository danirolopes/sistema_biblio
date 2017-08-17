<?php

class Login_Model extends Model
{
	
	public function __construct()
	{
		parent::__construct();	
	}
	public function run()
	{
		$sth = $this->db->prepare("SELECT id, name, role FROM user WHERE username = :username AND password = :password");
		$sth->execute(array(':username' => $_POST['username'], ':password' => $_POST['password']));

		$count = $sth->rowCount();
		$user = $sth->fetch();

		if($count > 0)
		{
			//login
			Session::init();

			Session::set('loggedIn', true);
			Session::set('name', $user['name']);
			Session::set('id', $user['id']);
			Session::set('role', $user['role']);
			header("location: ".URL."index");	
		}
		else
		{
		    Session::destroy();
		    header("location: ".URL."login");
		}
	}

	public function refreshDB()
	{
		return;
	}
}

?>