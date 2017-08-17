<?php

class Alugados_Model extends Model
{
	
	public function __construct()
	{
		parent::__construct();	
	}
	public function alugados($id)
	{
		$sth = $this->db->prepare("SELECT id, name, time FROM books WHERE alugado = :id");
		$sth->execute(array(':id' => $id));

		$user = $sth->fetchAll();

		return $user;
	}
}

?>