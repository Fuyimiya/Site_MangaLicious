<?php
	$msg = "";
	if($_POST)
	{
		if(empty($_POST["descritivo"]))
		{
			$msg = "Preencha o descritivo";
		}
		else
		{
			//inserir no banco de dados
			require_once "../models/Conexao.class.php";
			require_once "../models/Genero.class.php";
			require_once "../models/GeneroDAO.class.php";
			
			$genero = new Genero(descritivo:$_POST["descritivo"]);
			$generoDAO = new GeneroDAO();
			$retorno = $generoDAO->inserir($genero);
			header("location:listar_generos.php?msg=$retorno");
			die();
		}
	}
	require_once "header_administrador.html";
?>
	<main>
	<div class="favorites-grid">
		<h1>Gênero</h1><br><br>
		<form action="#" method="post">
			<label>Descritivo:</label>
			<input type="text" name="descritivo">
			<div><?php echo $msg;?></div>
			<br><br>
			<input type="submit" class="btn btn-primary"> 
		</form>
	</div>
	</main>
</body>
</html>