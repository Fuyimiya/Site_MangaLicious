<?php
	/*require_once "verificar.php";
	if(!verificar())
	{
		header("location:index.php");
	}*/
	require_once "../models/Conexao.class.php";
	require_once "../models/mangaDAO.class.php";
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
	  
		<br><br><h1>Mangás</h1><br><br>
		<a  class="btn botao" href="form_manga.php">Novo Mangá</a><br><br>
		<table class="table table-striped">
			<tr>
				<th>Título</th>
				<th>Gênero</th>
				<th>Mangaka</th>
				<th>Data da Publicação</th>
				<th>Ação</th>
			</tr>
			<?php
				$mangaDAO = new mangaDAO();
				$retorno = $mangaDAO->buscar_todos();
				
				foreach($retorno as $dados)
				{
					$data = explode("-", $dados->data_publicacao);
					$data_edit = $data[2] . "/" . $data[1] . "/" . $data[0];
					echo "<tr>
					      <td>{$dados->titulo}</td>
						  <td>{$dados->descritivo}</td>
						  <td>{$dados->nome}</td>
						  <td>{$data_edit}</td>
						  <td><a href='edit_manga.php?id={$dados->idmanga}' class='btn btn-warning'>Alterar</a>&nbsp;&nbsp;
						  "; 
				
			?>
			
			<a href="deletar_manga.php?id=<?php echo $dados->idmanga?>" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
			</td>
				</tr>
			<?php
				}
			?>
		</table>
		
		
		
	</div>
</main>
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