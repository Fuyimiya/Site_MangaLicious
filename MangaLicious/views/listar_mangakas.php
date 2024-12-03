<?php
	require_once "header_administrador.html";
?>
<main>
		<div class="favorites-header">
			<?php
				if(isset($_GET["msg"]))
				{
					echo "<div id='alert' class='alert alert-danger' role='alert'>
						  <strong>{$_GET['msg']}</strong></div>";
							
				}
			?>
		</div>
		<div class="favorites-grid">
	<br><h1>Mangakas</h1><br>
	<a href="form_mangaka.php" class="btn botao">Novo Mangaka</a><br><br>
	<table class="table table-streped">
		<tr>
			<th>Nome</th>
			<th>Nacionalidade</th>
			<th>Ação</th>
		</tr>
		<?php
			//buscar no BD as generos
			require_once "../models/Conexao.class.php";
			require_once "../models/MangakaDAO.class.php";
			$mangakaDAO = new MangakaDAO();
			
			$retorno = $mangakaDAO->buscar_todos();
			foreach($retorno as $dado)
			{
				echo "<tr>
					  <td>{$dado->nome}</td>
					  <td>{$dado->nacionalidade}</td>
					  <td>
						<a href='edit_mangaka.php?id={$dado->idmangaka}' class='btn btn-warning'>Alterar</a></td></tr>";
						
			}
		?>
		
	</table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script>
		
		$(document).ready(function(){			
			setTimeout(function() {
				$("#alert").fadeOut("slow", function(){
					$(this).alert('close');
				});				
			}, 5000);			
		});
	</script>
</body>
</html>