<?php
	class Manga
	{
		public function __construct(private int $idmanga = 0, private string $titulo = "", private string $data_publicacao = "", private string $sinopse = "", private string $imagem = "", private $genero = null, private $mangaka = null){}
		
	
		public function getIdmanga()
		{
			return $this->idmanga;
		}
		
		public function getTitulo()
		{
			return $this->titulo;
		}
		
		public function getSinopse()
		{
			return $this->sinopse;
		}
		
		public function getData_publicacao()
		{
			return $this->data_publicacao;
		}
		
		public function getImagem()
		{
			return $this->imagem;
		}
		
		public function getGenero()
		{
			return $this->genero;
		}
		public function getMangaka()
		{
			return $this->mangaka;
		}
		
	}
?>