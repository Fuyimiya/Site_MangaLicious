<?php
	$msg = array("","");
	$erro = false;
	if($_POST)
	{
		if(empty($_POST["nome"]))
		{
			$msg[0] = "Preencha o Nome";
			$erro = true;
		}
		if(empty($_POST["nacionalidade"]))
		{
			$msg[1] = "Preencha a Nacionalidade";
			$erro = true;
		}
		if(!$erro)
		{
			//inserir no banco de dados
			require_once "../models/Conexao.class.php";
			require_once "../models/Mangaka.class.php";
			require_once "../models/MangakaDAO.class.php";
			
			$mangaka = new Mangaka(nome:$_POST["nome"], nacionalidade:$_POST["nacionalidade"]);
			$mangakaDAO = new MangakaDAO();
			$retorno = $mangakaDAO->inserir($mangaka);
			header("location:listar_mangakas.php?msg=$retorno");
			die();
		}
	}
	require_once "header_administrador.html";
?>
	<main>
	<div class="favorites-grid">
		<h1>Mangaka</h1><br><br>
		<form action="#" method="post">
			<label>Nome:</label>
			<input type="text" name="nome">
			<div><?php echo $msg[0];?></div>
			<br><br>
			<label>Nacionalidade:</label>
			<input type="text" name="nacionalidade">
			<div><?php echo $msg[1];?></div>
			<br><br>
			<input type="submit" class="btn botao"> 
		</form>
	</div>
	</main>
</body>
</html>