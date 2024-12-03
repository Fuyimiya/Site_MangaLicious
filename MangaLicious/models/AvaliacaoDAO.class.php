<?php
	class AvaliacaoDAO extends Conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function buscar_todas()
		{
			$sql = "SELECT * FROM avaliacao";
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
		public function inserir($avaliacao)
		{
			$sql = "INSERT INTO avaliacao (idmanga, idusuario, estrela, comentario) VALUES(?,?,?,?)";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $avaliacao->getManga()->getIdmanga());
				$stm->bindValue(2, $avaliacao->getUsuario()->getIdusuario());
				$stm->bindValue(3, $avaliacao->getEstrela());
				$stm->bindValue(4, $avaliacao->getComentario());
				$stm->execute();
				$this->db = null;
				return "Sua avaliação foi cadastrada com sucesso";
			}
			catch(PDOException $e)
			{
				$this->db = null;
				echo $e->getMessage();
				echo $e->getCode();
				die();
			}
		}
		
		
		public function buscar_uma_avaliacao($avaliacao)
		{
			$sql = "SELECT * FROM avaliacao WHERE idavaliacao = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1,$avaliacao->getIdavaliacao());
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
		public function buscar_todas_por_manga($avaliacao)
		{
			$sql = "SELECT avaliacao.*, manga.* FROM avaliacao, manga WHERE avaliacao.idmanga = manga.idmanga WHERE avaliacao.idmanga = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $avaliacao->getManga()->getIdmanga());
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