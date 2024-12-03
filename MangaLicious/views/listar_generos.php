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
	<br><h1>Gêneros</h1><br>
	<a href="form_genero.php" class="btn botao">Novo Gênero</a><br><br>
	<table class="table table-streped">
		<tr>
			<th>Gênero</th>
			<th>Ação</th>
		</tr>
		<?php
			//buscar no BD as generos
			require_once "../models/Conexao.class.php";
			require_once "../models/GeneroDAO.class.php";
			$generoDAO = new GeneroDAO();
			
			$retorno = $generoDAO->buscar_todos();
			foreach($retorno as $dado)
			{
				echo "<tr>
					  <td>{$dado->descritivo}</td>
					  
					  <td>
						<a href='edit_genero.php?id={$dado->idgenero}' class='btn btn-warning'>Alterar</a></td></tr>";
						
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