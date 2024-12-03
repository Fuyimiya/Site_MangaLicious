<?php
	require_once "verificar.php";
	if(!verificar())
	{
		header("location:index.php");
	}
	require_once "../models/Conexao.class.php";
	require_once "../models/Manga.class.php";
	require_once "../models/MangaDAO.class.php";
	require_once "../models/Genero.class.php";
	require_once "../models/GeneroDAO.class.php";
	require_once "../models/Mangaka.class.php";
	require_once "../models/MangakaDAO.class.php";
	
	$msg = array("","","","","","");
	$id = 0;
	if($_POST)
	{
		
		$id = $_POST["id"];
		$erro = false;
		if(empty($_POST["titulo"]))
		{
			$msg[0] = "Preencha o Título do Mangá";
			$erro = true;
		}
		else if(strlen($_POST["titulo"])< 7)
		{
			$msg[0] = "Título do mangá deve ter no mínimo 7 caracteres";
			$erro = true;
		}
		if(empty($_POST["data_publicacao"]))
		{
			$msg[1] = "Preencha a data da publicação do mangá";
			$erro = true;
		}
		if(empty($_POST["sinopse"]))
		{
			$msg[2] = "Preencha a sinopse do mangá";
			$erro = true;
		}
		
		if($_POST["genero"] == 0)
		{
			$msg[3] = "Preencha o gênero do mangá";
			$erro = true;
		}
		if($_POST["mangaka"] == 0)
		{
			$msg[4] = "Preencha o autor do mangá";
			$erro = true;
		}
		$imagem = $_POST["img_banco"];
		
		if($_FILES["imagem"]["name"] != "")
		{
			$imagem = $_FILES["imagem"]["name"];
			if($_FILES["imagem"]["type"] != "image/png" && $_FILES["imagem"]["type"] != "image/jpg"  && $_FILES["imagem"]["type"] != "image/jpeg")
			{
				$msg[5] = "Tipo de arquivo inválido";
				$erro = true;
			}
		}
		
		if(!$erro)
		{
			
			
			//gravar no banco de dados
			$genero = new Genero($_POST["genero"]);
			$mangaka = new Mangaka($_POST["mangaka"]);
			$manga = new manga($_POST["id"], $_POST["titulo"], $_POST["data_publicacao"], $_POST["sinopse"], $imagem, $genero, $mangaka);
			
			$mangaDAO = new mangaDAO();
			$mangaDAO->alterar($manga);
			//upload
			if($_FILES["imagem"]["name"] != "")
			{
				if(!file_exists("../imagens/{$_FILES["imagem"]["name"]}"))
				{
					$path = '../imagens/';
					$uploadfile = $path . basename($_FILES["imagem"]["name"]);
					move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadfile); //move retorna um bool
				}
				if(file_exists("../imagens/{$_POST['img_banco']}"))
				{
					//apagar imagem antiga
					$caminho = "../imagens/" . $_POST["img_banco"];
					unlink($caminho);
				}
			}
			header("location:listar_mangas.php");
		}
		
	}//fim post
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
	}
	$manga = new Manga($id);
	$mangaDAO = new MangaDAO();
	$ret = $mangaDAO->buscar_um($manga);
	require_once "header_administrador.html";
?>
	<main>
	  <div class="favorites-grid">
		<br><br><h1>Mangá</h1>
		<form class="form-control" action="#" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $ret[0]->idmanga?>">
			<div class="mb-3">
				<label for="titulo" class="form-label">Título</label>
				<input type="text"  id="titulo" name="titulo" value="<?php echo isset($_POST['titulo'])?$_POST['titulo']:$ret[0]->titulo?>" class="form-control">
				<div style="color:red"><?php echo $msg[0] != ""?$msg[0]:'';?></div>
			</div>
			<br><br>
			<div class="mb-3">
				<label for="data_publicacao" class="form-label">Data da Publicação</label>
				<input type="date"  id="data_publicacao" name="data_publicacao" value="<?php echo isset($_POST['data_publicacao'])?$_POST['data_publicacao']:$ret[0]->data_publicacao?>">
				<div style="color:red"><?php echo $msg[0] != ""?$msg[0]:'';?></div>
			</div>
			<br><br>
			<div class="mb-3">
				<label for="sinopse" class="form-label">Sinopse</label><br>
				<textarea name="sinopse" id="sinopse" class="form-control"><?php echo isset($_POST['sinopse'])?$_POST['sinopse']:$ret[0]->sinopse?></textarea>
				<div style="color:red"><?php echo $msg[1] != ""?$msg[1]:'';?></div>
			</div>
			
			<br><br>
			<div class="mb-3">
				<label for="genero" class="form-label">Gênero:</label>
				<select name="genero" id="genero">
					
					<?php
					
				$generoDAO = new generoDAO();
				$retorno = $generoDAO->buscar_todos();
				foreach($retorno as $dado)
				{
					if(isset($_POST["genero"]))
					{						
						if($_POST["genero"] == $dado->idgenero)
						{
							echo "<option value='{$dado->idgenero}' selected>{$dado->descritivo}</option>";
						}
					}
					else if($ret[0]->idgenero == $dado->idgenero)
					{
						echo "<option value='{$dado->idgenero}' selected>{$dado->descritivo}</option>";
					}
					else 
					{
						echo "<option value='{$dado->idgenero}'>{$dado->descritivo}</option>";
					}
				}//fim do foreach
						
					?>
				</select>
				<div style="color:red"><?php echo $msg[3] != ""?$msg[3]:'';?></div>
			</div>
			<br><br>
			<div class="mb-3">
				<label for="mangaka" class="form-label">Mangaka:</label>
				<select name="mangaka" id="mangaka">
					
					<?php
					
				$mangakaDAO = new mangakaDAO();
				$retorno = $mangakaDAO->buscar_todos();
				foreach($retorno as $dado)
				{
					if(isset($_POST["mangaka"]))
					{
						if($_POST["mangaka"] == $dado->idmangaka)
						{
							echo "<option value='{$dado->idmangaka}' selected>{$dado->nome}</option>";
						}
					}
					else if($ret[0]->idmangaka == $dado->idmangaka)
					{
						echo "<option value='{$dado->idmangaka}' selected>{$dado->nome}</option>";
					}
					
					else
					{
						echo "<option value='{$dado->idmangaka}'>{$dado->nome}</option>";
					}
				}//fim do foreach
						
					?>
				</select>
				<div style="color:red"><?php echo $msg[4] != ""?$msg[4]:'';?></div>
			</div>
			<br><br>
			<div class="mb-3">
				<label for="imagem" class="form-label">Imagem</label>
				<input type="file" class="form-control" id="imagem" name="imagem" onchange="mostrar(this)" accept="image/png, image/jpeg">
				<div style="color:red"><?php echo $msg[5] != ""?$msg[5]:'';?></div>
			</div>
			<br><br>
			<input type="hidden" name="img_banco" value="<?php echo $ret[0]->imagem ?>">
			<div class="mb-3">
				<img src="../imagens/<?php echo $ret[0]->imagem ?>" id="img">
			</div>
			<br><br>
			<input class="btn botao" type="submit" value="Alterar">
		</form>
	  </div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script>
		function mostrar(img)
		{
			if(img.files  && img.files[0])
			{
				var reader = new FileReader();
				reader.onload = function(e){
					$('#img')
					.attr('src', e.target.result)
					.width(170)
					.height(100);
				};
				reader.readAsDataURL(img.files[0]);
			}
		}
	</script>
	
</body>
</html>