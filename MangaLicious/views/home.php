<?php
	require_once "iniciar_session.php";
?>
<html><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MangaLicious - Sua Plataforma de Mangás</title>
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

.hero-section {
    position: relative;
    height: 500px;
    margin-bottom: 3rem;
    border-radius: 15px;
    overflow: hidden;
}

.carousel {
    height: 100%;
    position: relative;
}

.carousel-item {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
    display: flex;
    align-items: center;
    padding: 2rem;
    color: white;
    background-size: cover;
    background-position: center;
}

.carousel-item.active {
    opacity: 1;
}

.carousel-content {
    max-width: 600px;
    z-index: 2;
}

.carousel-item::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0) 100%);
}

.section-title {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    color: var(--primary-color);
    border-left: 4px solid var(--secondary-color);
    padding-left: 1rem;
}

.manga-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
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

.categories {
    display: flex;
    gap: 1rem;
    overflow-x: auto;
    padding: 1rem 0;
    margin-bottom: 2rem;
}

.category-tag {
    background: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    white-space: nowrap;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.category-tag:hover {
    background: var(--secondary-color);
    color: white;
}

footer {
    background: var(--primary-color);
    color: white;
    padding: 2rem;
    margin-top: 3rem;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

@media (max-width: 768px) {
    nav ul {
        display: none;
    }
    
    .search-bar {
        width: 200px;
    }
    
    .hero-section {
        height: 300px;
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
        <section class="hero-section">
            <div class="carousel">
                <div class="carousel-item active" style="background-image: url('https://via.placeholder.com/1200x500')">
                    <div class="carousel-content">
                        <h2>One Piece</h2>
                        <p>Acompanhe a jornada épica de Luffy em busca do tesouro mais valioso do mundo!</p>
                        
                    </div>
                </div>
                <!-- More carousel items would be added dynamically -->
            </div>
        </section>

        <section>
            <h2 class="section-title">Categorias</h2>
            <div class="categories">
			<?php
						require_once "../models/Conexao.class.php";
						require_once "../models/GeneroDAO.class.php";
						$generoDAO = new GeneroDAO();
						$ret = $generoDAO->buscar_todos_com_manga();
						foreach($ret as $dado)
						{
							echo "<div class='category-tag'>{$dado->descritivo}</div>";
						}
			?>
                
            </div>
        </section>

        <section>
		<?php
			require_once "../models/MangaDAO.class.php";
			$mangaDAO = new MangaDAO();
			$lancamentos = $mangaDAO->buscar_lancamentos();
			if(is_array($lancamentos) && count($lancamentos) > 0)
			{
		?>
            <h2 class="section-title">Lançamentos</h2>
            <div class="manga-grid">
                
                
                             
					<?php
						foreach($lancamentos as $dado)
						{
					      echo "<div class='manga-card'>";
					?>
						  <div class="manga-cover" style="background-image: url('../imagens/<?php echo $dado->imagem;?>')"></div>
					<?php
							echo "<div class='manga-info'><div class='manga-title'>{$dado->titulo}</div>
							<div class='manga-genre'>{$dado->descritivo}</div></div></div>";
						}
					?>
                  
                </div>
                
            </div>
		<?php
			}
		?>
        </section>

        <section>
		<?php
			
			$mangaDAO = new MangaDAO();
			$populares = $mangaDAO->buscar_populares();
			if(count($populares) > 0)
			{
		?>
            <h2 class="section-title">Mais Populares</h2>
            <div class="manga-grid">
            
                    
					<?php
						foreach($populares as $dado)
						{
							echo "<div class='manga-card'>";
					?>
						  <div class="manga-cover" style="background-image: url('../imagens/<?php echo $dado->imagem;?>')"></div>
					<?php
							echo "<div class='manga-info'><div class='manga-title'>{$dado->titulo}</div>
							<div class='manga-genre'>{$dado->descritivo}</div></div></div>";
						}
					?>
                   
                </div>
                
            </div>   
            </div>
		<?php
			}
		?>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div>
                <h3>MangaLicious</h3>
                <p>Sua plataforma definitiva de mangás</p>
            </div>
            <div>
                <h3>Links Úteis</h3>
                <ul>
                    <li><a href="sobre.php">Sobre Nós</a></li>
                    <li><a href="#">Contato</a></li>
                    <li><a href="#">Termos de Uso</a></li>
                    <li><a href="#">Privacidade</a></li>
                </ul>
            </div>
            <div>
                <h3>Redes Sociais</h3>
                <ul>
                    <li><a href="https://twitter.com/mangalicious">Twitter</a></li>
                    <li><a href="https://instagram.com/mangalicious">Instagram</a></li>
                    <li><a href="https://facebook.com/mangalicious">Facebook</a></li>
                </ul>
            </div>
        </div>
    </footer>

<script>
// Carousel functionality
const carouselItems = [
    {
        title: "One Piece",
        description: "Acompanhe a jornada épica de Luffy em busca do tesouro mais valioso do mundo!",
        image: "../imagens/onpiece.jfif"
    },
    {
        title: "Demon Slayer",
        description: "Uma história emocionante de demônios e caçadores no Japão feudal",
        image: "../imagens/DemonSlayer.jfif"
    },
    {
        title: "Attack on Titan",
        description: "A humanidade luta pela sobrevivência contra os gigantes",
        image: "../imagens/AttackonTitan.jfif"
    }
];

let currentSlide = 0;

function createCarouselItem(item) {
    return `
        <div class="carousel-item" style="background-image: url('${item.image}')">
            <div class="carousel-content">
                <h2>${item.title}</h2>
                <p>${item.description}</p>
                
            </div>
        </div>
    `;
}

function updateCarousel() {
    const carousel = document.querySelector('.carousel');
    carousel.innerHTML = carouselItems.map(createCarouselItem).join('');
    carousel.children[currentSlide].classList.add('active');
}

function nextSlide() {
    const carousel = document.querySelector('.carousel');
    carousel.children[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % carouselItems.length;
    carousel.children[currentSlide].classList.add('active');
}

// Initialize carousel
updateCarousel();
setInterval(nextSlide, 5000);

// Populate manga grids with sample data
const sampleManga = [
    {
        title: "My Hero Academia",
        genre: "Ação, Super Poderes",
        cover: "https://via.placeholder.com/200x280"
    },
    // Add more sample manga data as needed
];




</script>
</body></html>