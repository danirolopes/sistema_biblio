<?php

class Index_Model extends Model
{
	
	public function __construct()
	{
		parent::__construct();	
	}
	public function livros($nome)
	{
		$nome = strtoupper($nome);

		$sth = $this->db->prepare("SELECT id, name, alugado, reservado FROM books WHERE name = :name");
		$sth->execute(array(':name' => $nome));

		$livro = $sth->fetchAll();

		return $livro;
	}

	public function users()
	{
		$sth = $this->db->prepare("SELECT id, name FROM user");
		$sth->execute();
		$vetor = $sth->fetchAll();

		return $vetor;
	}

	public function reserva($livro, $id)
	{
		$sth = $this->db->prepare("SELECT name, reservado FROM books WHERE id = :livro");
		$sth->execute(array(':livro' => $livro));
		$vetor = $sth->fetch();

		if($vetor['reservado'] == NULL)
		{
			$sth = $this->db->prepare("UPDATE books SET reservado = :id WHERE id = :livro");
			$sth->execute(array(':id' => $id, ':livro' => $livro));

			$sth = $this->db->prepare("INSERT INTO notification (user, type, message) VALUES (:userId, :type, :message)");
			$sth->execute(array(':userId' => $id, ':type' => 'Reserva', ':message' => $vetor['name']));	
		}


	}


	public function undoReserva($idLivro)
	{
		$sth = $this->db->prepare("UPDATE books SET reservado = NULL WHERE id = :id");
		$sth->execute(array(':id' => $idLivro));

		$sth = $this->db->prepare("SELECT name FROM books WHERE id = :idLivro");
		$sth->execute(array(':idLivro' => $idLivro));
		$vetor = $sth->fetch();

		$sth = $this->db->prepare("INSERT INTO notification (user, type, message) VALUES (:userId, :type, :message)");
		$sth->execute(array(':userId' => $id, ':type' => 'Reserva Desfeita', ':message' => $vetor['name']));	
	}

	public function alugarLivro($idLivro, $idUser)
	{
		$sth = $this->db->prepare("SELECT name, alugado, reservado FROM books WHERE id = :livro");
		$sth->execute(array(':livro' => $idLivro));
		$vetor = $sth->fetch();

		if($vetor['alugado'] == NULL && $vetor['reservado']==NULL)
		{
			$sth = $this->db->prepare("UPDATE books SET alugado = :id WHERE id = :livro");
			$sth->execute(array(':id' => $idUser, ':livro' => $idLivro));

			$sth = $this->db->prepare("INSERT INTO notification (user, type, message) VALUES (:userId, :type, :message)");
			$sth->execute(array(':userId' => $id, ':type' => 'Aluguel', ':message' => $vetor['name']));	

			return;
		}
		if($vetor['reservado'] == $idUser)
		{
			$sth = $this->db->prepare("UPDATE books SET alugado = :id, reservado = NULL WHERE id = :livro");
			$sth->execute(array(':id' => $idUser, ':livro' => $idLivro));

			$sth = $this->db->prepare("INSERT INTO notification (user, type, message) VALUES (:userId, :type, :message)");
			$sth->execute(array(':userId' => $id, ':type' => 'Aluguel', ':message' => $vetor['name']));	
		}
	}

	public function devolverLivro($idLivro)
	{
		$sth = $this->db->prepare("UPDATE books SET alugado = NULL WHERE id = :id");
		$sth->execute(array(':id' => $idLivro));


		$sth = $this->db->prepare("SELECT name FROM books WHERE id = :idLivro");
		$sth->execute(array(':idLivro' => $idLivro));
		$vetor = $sth->fetch();

		$sth = $this->db->prepare("INSERT INTO notification (user, type, message) VALUES (:userId, :type, :message)");
		$sth->execute(array(':userId' => $id, ':type' => 'Devolução', ':message' => $vetor['name']));	
	}

	public function getNotification($idUser)
	{
		$sth = $this->db->prepare("SELECT id, type, message, time FROM notification WHERE user = :idUser ORDER BY time DESC LIMIT 6");
		$sth->execute(array('idUser' => $idUser));
		$vetor = $sth->fetchAll();

		return $vetor;
	}


}

?>