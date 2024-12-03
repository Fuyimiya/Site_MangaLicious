<?php
$msg = "";
	require_once "iniciar_session.php";
	
	//var_dump($_SESSION);
	if(!isset($_SESSION["idusuario"]))
	{
		$_SESSION["idmanga"] = $_GET["id"];
		header("location:login.php");
		die();
	}
	$idmanga = 0;
	if(isset($_GET["id"]))
	{
		$idmanga = $_GET["id"];
	}
	else if(isset($_SESSION["idmanga"]))
	{
		$idmanga = $_SESSION["idmanga"];
		unset($_SESSION["idmanga"]);
	}
	else
	{
		header("location:home.php");
		die();
	}
	require_once "../models/Conexao.class.php";
	require_once "../models/Manga.class.php";
	require_once "../models/MangaDAO.class.php";
	require_once "../models/Avaliacao.class.php";
	require_once "../models/AvaliacaoDAO.class.php";
	require_once "../models/Usuario.class.php";
	
	$manga = new Manga($idmanga);
	$mangaDAO = new MangaDAO();
	$ret = $mangaDAO->buscar_um($manga);
	$msg = "";
	if($_POST)
	{
		if($_POST["rating"] == 0)
		{
			$msg = "A avaliação deve ter pelo menos uma estrela";
		}
		else
		{
			$usuario = new Usuario($_SESSION["idusuario"]);
			$manga = new Manga($_POST["manga"]);
			$avaliacao = new Avaliacao(0, $_POST["rating"], $_POST["comentario"], $usuario, $manga);
			$avaliacaoDAO = new avaliacaoDAO();
			$mensagem = $avaliacaoDAO->inserir($avaliacao);
			
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
.rating {
            display: flex;
            direction: row;
            justify-content: center;
            margin-bottom: 20px;
        }

        .star {
            font-size: 40px;
            cursor: pointer;
            color: #ccc;
            transition: color 0.2s;
        }

        .star:hover, .star.selected {
            color: #FFD700;
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
    margin-top: 20px;
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
	flex-direction: row;
	
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
        grid-template-columns: 0.5fr;
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
				if($mensagem != "")
				{
					echo "<div id='alert' class='alert alert-danger' role='alert'>
							<strong>{$mensagem}</strong>
							
						 </div>";
							
				}
			?>
		</div>
		<h1 class="row d-flex justify-content-center">Avaliação</h1>
		   <br>
        <div class="favorites-grid">
		   
		   <div>
			<img src="../imagens/<?php echo $ret[0]->imagem?>">
		   </div>
		   <br><div style="font-size:20px;text-align:justify;padding:20px;"><?php echo $ret[0]->sinopse?></div>
		</div>
		   <br><p style="font-size:22px;" class="row d-flex justify-content-center">Selecione o número de estrelas que você acha que o mangá merece</p>
		   <div class="rating" id="stars">
            <span class="star" data-value="1">&#9733;</span>
            <span class="star" data-value="2">&#9733;</span>
            <span class="star" data-value="3">&#9733;</span>
            <span class="star" data-value="4">&#9733;</span>
            <span class="star" data-value="5">&#9733;</span>
        </div>
			<div class="row d-flex justify-content-center" style="color:red;" id="erro"><?php echo $msg?></div>
           <form action="#" method="post" id="rating-form">
			 <input type="hidden" name="rating" id="rating-input" value="0">
			 <input type="hidden" name="manga" value="<?php echo $ret[0]->idmanga;?>">
			 <div class="row d-flex justify-content-center">
				 <label  style="text-align:center;font-size:18px;">Comentário</label><br>
				 <textarea style="width:500px;height:300px" name="comentario"></textarea>
			 </div>
			 <br>
			 <div class="row d-flex justify-content-center">
			 <input type="submit" value="Enviar">
			 </div>
			 
		   </form>
		  
        </div>
    </main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script>
		
		$(document).ready(function(){			
			setTimeout(function() {
				$("#alert").fadeOut("slow", function(){
					$(this).alert('close');
					location.href = "mangas.php";
					
				});				
			}, 5000);			
		});
	</script>
	<script>
		// Selecionar todas as estrelas
        const stars = document.querySelectorAll('.star');
		const ratingInput = document.getElementById('rating-input');
		// Adicionar evento de clique para cada estrela
        stars.forEach(star => {
            star.addEventListener('click', () => {
                // Obter o valor da estrela clicada
                const rating = star.getAttribute('data-value');

                // Atualizar as estrelas visualmente
                stars.forEach(s => s.classList.remove('selected'));
                for (let i = 0; i < rating; i++) {
                    stars[i].classList.add('selected');
                }
				// Atualizar o valor do campo oculto do formulário
                ratingInput.value = rating;
            });
        });
		// Prevenir envio do formulário sem avaliação
        document.getElementById('rating-form').addEventListener('submit', (e) => {
            if (ratingInput.value === "0") {
                e.preventDefault();
                document.getElementById("erro").innerHTML = "A avaliação deve ter pelo menos uma estrela";
            }
        });
	</script>
</body>
</html>