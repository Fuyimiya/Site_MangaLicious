<?php
	class Avaliacao
	{
		public function __construct(private int $idavaliacao = 0, private int $estrela = 0, private string $comentario = "", private $usuario = null, private $manga = null){}
		
		public function getIdavaliacao()
		{
			return $this->idavaliacao;
		}
		public function getEstrela()
		{
			return $this->estrela;
		}
		public function getComentario()
		{
			return $this->comentario;
		}
		public function getUsuario()
		{
			return $this->usuario;
		}
		public function getManga()
		{
			return $this->manga;
		}
	}
?>