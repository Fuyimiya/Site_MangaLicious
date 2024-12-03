<?php
	class GeneroDAO extends Conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function buscar_todos()
		{
			$sql = "SELECT * FROM genero";
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
		public function inserir($genero)
		{
			$sql = "INSERT INTO genero (descritivo) VALUES(?)";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $genero->getDescritivo());
				
				$stm->execute();
				$this->db = null;
				return "Gênero inserido com sucesso";
			}
			catch(PDOException $e)
			{
				$this->db = null;
				echo $e->getMessage();
				echo $e->getCode();
				die();
			}
		}
		public function alterar($genero)
		{
			$sql = "UPDATE genero SET descritivo = ? WHERE idgenero = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $genero->getDescritivo());
				$stm->bindValue(2, $genero->getIdgenero());
				$stm->execute();
				$this->db = null;
				return "genero alterada com sucesso";
			}
			catch(PDOException $e)
			{
				$this->db = null;
				echo $e->getMessage();
				echo $e->getCode();
				die();
			}
		}
		
		public function buscar_um_genero($genero)
		{
			$sql = "SELECT * FROM genero WHERE idgenero = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1,$genero->getIdgenero());
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
		public function buscar_todos_com_manga()
		{
			$sql = "SELECT genero.* FROM genero, manga WHERE genero.idgenero = manga.idgenero";
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
		
	}//fim da classe
?>