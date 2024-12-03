<?php
	class MangakaDAO extends Conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function buscar_todos()
		{
			$sql = "SELECT * FROM mangaka";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->execute();
				$this->db = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
				echo $e->getCode();
				die();
			}
		}
		public function inserir($mangaka)
		{
			$sql = "INSERT INTO mangaka (nome, nacionalidade) VALUES(?, ?)";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $mangaka->getNome());
				$stm->bindValue(2, $mangaka->getNacionalidade());
				$stm->execute();
				$this->db = null;
				return "Mangaka inserido com sucesso";
			}
			catch(PDOException $e)
			{
				$this->db = null;
				echo $e->getMessage();
				echo $e->getCode();
				die();
			}
		}
		public function alterar($mangaka)
		{
			$sql = "UPDATE mangaka SET nome = ?, nacionalidade = ? WHERE idmangaka = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $mangaka->getNome());
				$stm->bindValue(2, $mangaka->getNacionalidade());
				$stm->bindValue(3, $mangaka->getIdmangaka());
				$stm->execute();
				$this->db = null;
				return "Mangaka alterado com sucesso";
			}
			catch(PDOException $e)
			{
				$this->db = null;
				echo $e->getMessage();
				echo $e->getCode();
				die();
			}
		}
		
		public function buscar_um($mangaka)
		{
			$sql = "SELECT * FROM mangaka WHERE idmangaka = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1,$mangaka->getIdmangaka());
				$stm->execute();
				$this->db = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				$this->db = null;
				echo $e->getMessage();
				echo $e->getCode();
				die();
			}
		}
		
	}//fim da classe
?>