<?php
	class usuarioDAO extends Conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function login($usuario)
		{
			$sql = "SELECT * FROM usuario WHERE email = ? ";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $usuario->getEmail());
				
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
		public function inserir($usuario)
		{
			var_dump($usuario);
			$sql = "INSERT INTO usuario (nome, email,senha, perfil) VALUES(?,?,?,?)";
			try
			{
			//preparar frase
			$stm = $this->db->prepare($sql);
			//substituir o ponto de interrogação
			$stm->bindValue(1, $usuario->getNome());
			$stm->bindValue(2, $usuario->getEmail());
			$stm->bindValue(3, $usuario->getSenha());
			$stm->bindValue(4, $usuario->getPerfil());
			
			
			//executar a frase sql
			$stm->execute();
			//fechar a conexão
			$this->db = null;
			return "Usuário inserido com sucesso";
			}
			catch(PDOException $e)
			{
				echo $e->getCode();
				echo $e->getMessage();
				die();
			}
			
		}
		
	}
?>