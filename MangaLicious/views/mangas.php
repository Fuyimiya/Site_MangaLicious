<?php
	require_once "iniciar_session.php";
	require_once "../models/Conexao.class.php";
	require_once "../models/GeneroDAO.class.php";
	require_once "../models/MangaDAO.class.php";
	require_once "../models/Manga.class.php";
	require_once "../models/Genero.class.php";
	$mangaDAO = new MangaDAO();
	$retorno = $mangaDAO->buscar_todos();
	
	if($_GET && $_GET["id"] != 0)
	{
		$mangaDAO = new MangaDAO();
		$genero = new Genero($_GET["id"]);
		$manga = new Manga(genero:$genero);
		$retorno = $mangaDAO->buscar_por_genero($manga);
		
	}
?>
<html><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Biblioteca de Mangás - MangaLicious</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<style>
:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --accent-color: #e74c3c;
    --text-color: #333;
    --background-color: #f5f6fa;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.botao{background-color:#2c3e50;color:white;}
#ul li{display:inline-block;}
#ul li a{text-decoration:none;color:#2c3e50;padding:20px;}
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

.search-bar {
    display: flex;
    gap: 0.5rem;
    padding: 0.5rem;
    background: white;
    border-radius: 25px;
    width: 300px;
}

.search-bar input {
    border: none;
    outline: none;
    width: 100%;
    padding: 0.5rem;
}

.search-bar button {
    background: var(--secondary-color);
    border: none;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    cursor: pointer;
}

main {
    margin-top: 80px;
    padding: 2rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.filters {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    margin-bottom: 2rem;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.filter-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.filter-group label {
    font-weight: bold;
    color: var(--primary-color);
}

.filter-group select {
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    outline: none;
}

.filter-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 1rem;
}

.filter-tag {
    background: var(--secondary-color);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.filter-tag button {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 1.2rem;
}

.manga-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 2rem;
}

.manga-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.manga-card:hover {
    transform: translateY(-5px);
}

.manga-cover {
    position: relative;
    padding-top: 140%;
    background-size: cover;
    background-position: center;
}

.manga-info {
    padding: 1rem;
}

.manga-title {
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.manga-genre {
    font-size: 0.9rem;
    color: #666;
}

.manga-rating {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    margin-top: 0.5rem;
    color: #f1c40f;
}

.pagination {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 2rem;
}

.pagination button {
    padding: 0.5rem 1rem;
    border: 1px solid var(--secondary-color);
    background: white;
    color: var(--secondary-color);
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.pagination button:hover,
.pagination button.active {
    background: var(--secondary-color);
    color: white;
}

@media (max-width: 768px) {
    nav ul {
        display: none;
    }
    
    .search-bar {
        width: 200px;
    }
    
    .filter-grid {
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
        <section class="filters">
            <div class="filter-grid">
                <div class="filter-group">
                    <label for="genero">Gêneros</label>
					
                    <ul id="ul">
                        <li><a href="mangas.php?id=0">Todos</a></li>
						<?php
						$generoDAO = new GeneroDAO();
						$ret = $generoDAO->buscar_todos_com_manga();
						foreach($ret as $dado)
						{
							echo "<li><a href='mangas.php?id={$dado->idgenero}'>{$dado->descritivo}</a></li>";
						}
                        ?>
                    </ul>
                </div>
            </div>    
        </section>
	

        <section class="manga-grid">
            <!-- Manga cards will be populated by JavaScript -->
			<?php
				foreach($retorno as $dado)
				{
					echo "<div class='manga-card'>";
				?>
						  <div class="manga-cover" style="background-image: url('../imagens/<?php echo $dado->imagem;?>')"></div>
				<?php
						  echo "<div class='manga-info'>
						  <div class='manga-title'>{$dado->titulo}</div>
						  <div class='manga-genre'>{$dado->descritivo}</div><br><div class='d-flex justify-content-center'>";
						  if($dado->media == null)
						  {
							  for($x=0; $x < 5; $x++)
							  {
								  echo "<img src='../imagens/estrela_branca.png'>";
							  }
						  }
						  else
						  {
							  for($x=0; $x < round($dado->media); $x++)
							  {
								  echo "<img src = '../imagens/estrela_amarela.png'>";
							  }
							  for($x=0; $x < 5 - round($dado->media); $x++)
							  {
								  echo "<img src = '../imagens/estrela_branca.png'>";
							  }
						  }
						  
						echo "</div><br><div><a class='btn botao d-flex justify-content-center' href='avaliacao.php?id={$dado->idmanga}'>Avaliar</a></div>
					</div>
				</div>";
				}
			?>
        </section>

        
    </main>

</body></html>