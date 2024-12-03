<?php
	$msg = "";
	require_once "../models/Conexao.class.php";
	require_once "../models/Genero.class.php";
	require_once "../models/GeneroDAO.class.php";
	
	if($_GET)
	{
		$genero = new genero($_GET["id"]);
		$generoDAO = new generoDAO();
		$ret = $generoDAO->buscar_um_genero($genero);
	}
	if($_POST)
	{
		if(empty($_POST["descritivo"]))
		{
			$msg = "Preencha o descritivo";
		}
		else
		{
			//alterar no banco de dados

			$genero = new genero($_POST["idgenero"],$_POST["descritivo"]);
			$generoDAO = new generoDAO();
			$retorno = $generoDAO->alterar($genero);
			header("location:listar_generos.php?mensagem=$retorno");
			die();
		}
	}
	require_once "header_administrador.html";
?>
	<main>
		<div class="favorites-grid">
		<h1>Gênero</h1><br><br>
		<form action="#" method="post">
			<input type="hidden" name="idgenero" value="<?php echo $ret[0]->idgenero;?>">
			<label>Descritivo:</label>
			<input type="text" name="descritivo" value="<?php echo $ret[0]->descritivo;?>">
			<div><?php echo $msg;?></div>
			<br><br>
			<input type="submit" class="btn botao">
			
		</form>
	</div>
	</main>
</body>
</html>