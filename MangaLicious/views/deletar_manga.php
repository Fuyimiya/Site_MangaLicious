<?php
	if($_GET)
	{
		require_once "../models/Conexao.class.php";
		require_once "../models/Manga.class.php";
		require_once "../models/MangaDAO.class.php";
		
		$manga = new Manga($_GET["id"]);
		$mangaDAO = new MangaDAO();
		$retorno = $mangaDAO->excluir($manga);
		
		header("location:listar_mangas.php?mensagem=$retorno");
		die();
	}
?>