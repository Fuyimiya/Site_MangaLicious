<?php
	class Mangaka
	{
		public function __construct(
		private int $idmangaka = 0, 
		private string $nome = "",
		private string $nacionalidade = ""){}
		
		public function getIdmangaka()
		{
			return $this->idmangaka;
		}
		public function getNome()
		{
			return $this->nome;
		}
		public function getNacionalidade()
		{
			return $this->nacionalidade;
		}
		
	}
?>