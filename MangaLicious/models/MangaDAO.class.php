<?php
	class MangaDAO extends Conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function inserir($manga)
		{
			$sql = "INSERT INTO manga (idmangaka, idgenero,titulo, data_publicacao, sinopse, imagem) VALUES(?,?,?,?,?,?)";
			try
			{
			//preparar frase
			$stm = $this->db->prepare($sql);
			//substituir o ponto de interrogação
			$stm->bindValue(1, $manga->getMangaka()->getIdmangaka());
			$stm->bindValue(2, $manga->getGenero()->getIdgenero());
			$stm->bindValue(3, $manga->getTitulo());
			$stm->bindValue(4, $manga->getData_publicacao());
			$stm->bindValue(5, $manga->getSinopse());
			$stm->bindValue(6, $manga->getImagem());
			
			//executar a frase sql
			$stm->execute();
			//fechar a conexão
			$this->db = null;
			return "Mangá inserido com sucesso";
			}
			catch(PDOException $e)
			{
				echo $e->getCode();
				echo $e->getMessage();
				die();
			}
			
		}
		public function alterar($manga)
		{
			
			$sql = "UPDATE manga SET idmangaka = ?, idgenero = ?, titulo = ?, data_publicacao = ?, sinopse = ?, imagem = ? WHERE idmanga = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $manga->getMangaka()->getIdmangaka());
				$stm->bindValue(2, $manga->getGenero()->getIdgenero());
				$stm->bindValue(3, $manga->getTitulo());
				$stm->bindValue(4, $manga->getData_publicacao());
				$stm->bindValue(5, $manga->getSinopse());
				$stm->bindValue(6, $manga->getImagem());
				$stm->bindValue(7, $manga->getIdmanga());
				$stm->execute();
				$this->db = null;
				return "Mangá alterado com sucesso";
			}
			catch(PDOException $e)
			{
				echo $e->getCode();
				echo $e->getMessage();
				die();
			}
		}
		
		public function buscar_todos()
		{
			//frase sql que será executada
			
			$sql = "SELECT m.*, g.descritivo, mk.nome, AVG(estrela) as media FROM manga as m  
			JOIN genero as g ON (m.idgenero = g.idgenero)
			JOIN mangaka as mk ON (m.idmangaka = mk.idmangaka)
			LEFT JOIN avaliacao as a ON (m.idmanga = a.idmanga)
			GROUP BY m.idmanga ORDER BY m.idmanga";
			try
			{
				//preparar frase
				$stm = $this->db->prepare($sql);
				//executar a frase sql
				$stm->execute();
				//fechar a conexão
				$this->db = null;
				//retornar o resultado da execução da frase sql
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				echo $e->getCode();
				echo $e->getMessage();
				die();
			}
		}
		public function buscar_um($manga)
		{
			$sql = "SELECT * FROM manga WHERE idmanga = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1,$manga->getIdmanga());
				$stm->execute();
				$this->db = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				echo $e->getCode();
				echo $e->getMessage();
				die();
			}
		}
		
		public function buscar_por_genero($manga)
		{
			$sql = "SELECT m.*, g.descritivo, mk.nome, AVG(estrela) as media FROM manga as m  
			JOIN genero as g ON (m.idgenero = g.idgenero AND m.idgenero = ?)
			JOIN mangaka as mk ON (m.idmangaka = mk.idmangaka)
			LEFT JOIN avaliacao as a ON (m.idmanga = a.idmanga)
			GROUP BY m.idmanga ORDER BY m.idmanga";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1,$manga->getGenero()->getIdgenero());
				$stm->execute();
				$this->db = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				echo $e->getCode();
				echo $e->getMessage();
				die();
			}
		}
		public function buscar_populares()
		{
			$sql = "SELECT m.*, g.descritivo, mk.nome, AVG(estrela) as media FROM manga as m  
			JOIN genero as g ON (m.idgenero = g.idgenero)
			JOIN mangaka as mk ON (m.idmangaka = mk.idmangaka)
			LEFT JOIN avaliacao as a ON (m.idmanga = a.idmanga)
			GROUP BY m.idmanga 
			HAVING media >= 4
			ORDER BY m.idmanga";
			try
			{
				//preparar frase
				$stm = $this->db->prepare($sql);
				//executar a frase sql
				$stm->execute();
				//fechar a conexão
				$this->db = null;
				//retornar o resultado da execução da frase sql
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				echo $e->getCode();
				echo $e->getMessage();
				die();
			}
		}
		
		public function buscar_lancamentos()
		{
			$sql = "SELECT m.*, g.descritivo, mk.nome FROM manga as m  
			JOIN genero as g ON (m.idgenero = g.idgenero)
			JOIN mangaka as mk ON (m.idmangaka = mk.idmangaka)
			WHERE m.data_publicacao > DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
			
			try
			{
				//preparar frase
				$stm = $this->db->prepare($sql);
				//executar a frase sql
				$stm->execute();
				//fechar a conexão
				$this->db = null;
				//retornar o resultado da execução da frase sql
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				echo $e->getCode();
				echo $e->getMessage();
				die();
			}
		}
		public function excluir($manga)
		{
			$sql = "DELETE FROM manga WHERE idmanga = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				
				$stm->bindValue(1, $manga->getIdmanga());
				$stm->execute();
				$this->db = null;
				return "Mangá excluido com sucesso";
			}
			catch(PDOException $e)
			{
				echo $e->getCode();
				echo $e->getMessage();
				die();
			}
		}
	}//fim da classe mangaDAO
?>