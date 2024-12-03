<a href="Home.php" class="logo">MangaLicious</a>
<nav>
	<ul>
		<li><a href="home.php">Home</a></li>
		<li><a href="mangas.php">Mangás</a></li>
		<li><a href="sobre.php">Sobre</a></li>
		<?php
		
		if(!isset($_SESSION["idusuario"]))
		{
			echo "<li><a href='login.php'>Entrar</a></li>";
		}
		else
		{
			echo "<li><a href='logout.php'>Sair</a></li>";
		}
		
		?>
	</ul>
</nav>