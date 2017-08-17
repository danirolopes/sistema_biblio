<?php

class Reservas_Model extends Model
{
	
	public function __construct()
	{
		parent::__construct();	
	}
	public function reservas($id)
	{
		$sth = $this->db->prepare("SELECT id, name, time FROM books WHERE reservado = :id");
		$sth->execute(array(':id' => $id));

		$user = $sth->fetchAll();

		return $user;
	}
}

?>