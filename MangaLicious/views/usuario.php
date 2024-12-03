<?php
	require_once "../models/Conexao.class.php";
	require_once "../models/Usuario.class.php";
	require_once "../models/UsuarioDAO.class.php";
	$msg = array("","","","","");
	$erro = false;
	if($_POST)
	{
		if(empty($_POST["nome"]))
		{
			$msg[0] = "Preencha o seu nome";
			$erro = true;
		}
		if(empty($_POST["email"]))
		{
			$msg[1] = "Preencha o seu e-mail";
			$erro = true;
		}
		else
		{
			$usuario = new Usuario(email:$_POST["email"]);
			$usuarioDAO = new UsuarioDAO();
			$retorno = $usuarioDAO->login($usuario);
			
			if(count($retorno) > 0)
			{
				$msg[1] = "E-mail já cadastrado";
				$erro = true;
			}
		}
		if(empty($_POST["senha"]))
		{
			$msg[2] = "Preencha a senha";
			$erro = true;
		}
		if(empty($_POST["confirma"]))
		{
			$msg[3] = "Confirme a senha";
			$erro = true;
		}
		if($_POST["senha"]!= "" && $_POST["confirma"] != "")
		{
			if($_POST["senha"] != $_POST["confirma"])
			{
				$msg[3] = "Senhas não conferem";
				$erro = true;
			}
		}
		if(!$erro)
		{
			
			$usuario = new Usuario(nome:$_POST["nome"], email:$_POST["email"], senha:password_hash($_POST["senha"], PASSWORD_DEFAULT), perfil:"Usuario");
			$usuarioDAO = new UsuarioDAO();
			$usuarioDAO->inserir($usuario);
			$msg[4] = "Inserido com sucesso";
		}
	}
	
?>
<html><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Meus Favoritos - MangaLicious</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<style>
:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --accent-color: #e74c3c;
    --text-color: #333;
    --background-color: #f5f6fa;
    --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
input[type='submit']{background-color:#2c3e50;color:white;width:6rem;height:2rem;} 
label{color:#2c3e50; font-weight:bold;}
body {
    font-family: 'Roboto', sans-serif;
    background-color: var(--background-color);
    color: var(--text-color);
    line-height: 1.6;
}

header {
    background-color: var(--primary-color);
    padding: 1rem;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
}

.header-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
    text-decoration: none;
}

nav ul {
    display: flex;
    gap: 2rem;
    list-style: none;
}

nav a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

nav a:hover {
    color: var(--secondary-color);
}

main {
    margin-top: 80px;
    padding: 2rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.favorites-header {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 2rem;
}

.view-toggle {
    display: flex;
    gap: 0.5rem;
}

.view-toggle button {
    background: white;
    border: 2px solid var(--secondary-color);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.view-toggle button.active {
    background: var(--secondary-color);
    color: white;
}

.favorites-grid {
    display: flex;
	flex-direction: column;
	
	align-items:center;
    
}

.favorite-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: var(--card-shadow);
    transition: transform 0.3s ease;
    position: relative;
}

.favorite-card:hover {
    transform: translateY(-5px);
}

.favorite-cover {
    position: relative;
    padding-top: 140%;
    background-size: cover;
    background-position: center;
}

.favorite-info {
    padding: 1.5rem;
}

.manga-title {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    color: var(--primary-color);
}

.progress-bar {
    width: 100%;
    height: 6px;
    background: #eee;
    border-radius: 3px;
    margin: 0.5rem 0;
}

.progress-fill {
    height: 100%;
    background: var(--secondary-color);
    border-radius: 3px;
    transition: width 0.3s ease;
}

.chapter-info {
    display: flex;
    justify-content: space-between;
    font-size: 0.9rem;
    color: #666;
}

.favorite-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
}

.action-button {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.continue-reading {
    background: var(--secondary-color);
    color: white;
}

.remove-favorite {
    background: transparent;
    color: var(--accent-color);
    border: 1px solid var(--accent-color);
}

.action-button:hover {
    transform: translateY(-2px);
}

.favorite-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: var(--accent-color);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: bold;
}

.empty-state {
    text-align: center;
    padding: 4rem;
    display: none;
}

.empty-state svg {
    width: 100px;
    height: 100px;
    color: var(--secondary-color);
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    nav ul {
        display: none;
    }
    
    .favorites-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .favorites-grid {
        grid-template-columns: 1fr;
    }
}

</style>
</head>
<body>
    <header>
        <div class="header-content">
            <?php
				require_once "nav.php";
				
			?>
        </div>
    </header>

    <main>
		<div class="favorites-header">
			<?php
				if($msg[4] != "")
				{
					echo "<div id='alert' class='alert alert-danger' role='alert'>
							<strong>{$msg[4]}</strong>
							
						 </div>";
							
				}
			?>
		</div>
        <div class="favorites-grid">
		   <h1>Usuário</h1>
		   <br>
           <form action="#" method="post">
		   <label style="color:#2c3e50;">Nome:</label>
			 <input type="text" name="nome" style="height:30px;width:250px;" value="<?php echo isset($_POST['nome'])?$_POST['nome']:''?>">
			 <div style='color:red;font-size:11px'><?php echo $msg[0]?></div>
			 <br><br>
			 <label style="color:#2c3e50;">E-mail:</label>
			 <input type="email" name="email" style="height:30px;width:250px;" value="<?php echo isset($_POST['email'])?$_POST['email']:''?>">
			 <div style='color:red;font-size:11px'><?php echo $msg[1]?></div>
			 <br><br>
			 <label>Senha:</label>
			 <input type="password" name="senha" style="height:30px;width:250px;">
			 <div style='color:red;font-size:11px'><?php echo $msg[2]?></div>
			 <br><br>
			 <label>Confirma a Senha:</label>
			 <input type="password" name="confirma" style="height:30px;width:250px;">
			 <div style='color:red;font-size:11px'><?php echo $msg[3]?></div>
			 <br><br>
			 <input type="submit" value="Enviar">
		   </form>
		  
        </div>
    </main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script>
		
		$(document).ready(function(){			
			setTimeout(function() {
				$("#alert").fadeOut("slow", function(){
					$(this).alert('close');
					location.href = "login.php";
				});				
			}, 5000);			
		});
	</script>

</body>
</html>