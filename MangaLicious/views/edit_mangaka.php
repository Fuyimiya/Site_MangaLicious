<?php
	require_once "verificar.php";
	if(!verificar())
	{
		header("location:index.php");	
		die();
	}		
	
	require_once "../models/Conexao.class.php";
	require_once "../models/Mangaka.class.php";
	require_once "../models/MangakaDAO.class.php";
	
	$msg = array("","");
	$erro = false;
	$id = 0;
	if($_POST)
	{
		$id = $_POST["id"];
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
			
			$mangaka = new Mangaka($_POST["id"], $_POST["nome"], $_POST["nacionalidade"]);
			$mangakaDAO = new MangakaDAO();
			$retorno = $mangakaDAO->alterar($mangaka);
			header("location:listar_mangakas.php?msg=$retorno");
			die();
		}
		
		
		
	}
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
	}
	
	$mangaka = new Mangaka($id);
	$mangakaDAO = new MangakaDAO();
	$ret = $mangakaDAO->buscar_um($mangaka);
	
	require_once "header_administrador.html";
?>
	<main>
	<div class="favorites-grid">
		<h1>Mangaka</h1><br><br>
		<form action="#" method="post">
			<input type="hidden" name="id" value="<?php echo $ret[0]->idmangaka ?>">
			<label>Nome:</label>
			<input type="text" name="nome" value="<?php echo isset($_POST['nome'])?$_POST['nome']:$ret[0]->nome?>">
			<div><?php echo $msg[0];?></div>
			<br><br>
			<label>Nacionalidade:</label>
			<input type="text" name="nacionalidade" value="<?php echo isset($_POST['nacionalidade'])?$_POST['nacionalidade']:$ret[0]->nacionalidade?>">
			<div><?php echo $msg[1];?></div>
			<br><br>
			<input type="submit" class="btn botao"> 
		</form>
	</div>
	</main>
</body>
</html>