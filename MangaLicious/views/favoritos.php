<?php
	require_once "iniciar_session.php";
?>
<html><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Meus Favoritos - MangaLicious</title>
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
    justify-content: space-between;
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
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 2rem;
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
            <h1>Favoritos</h1>
            <div class="view-toggle">
                <button class="active">Grade</button>
                <button>Lista</button>
            </div>
        </div>

        <div class="favorites-grid">
            <!-- Favorite cards will be populated by JavaScript -->
        </div>

        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm4-8c.55 0 1-.45 1-1s-.45-1-1-1-1 .45-1 1 .45 1 1 1zm-8 0c.55 0 1-.45 1-1s-.45-1-1-1-1 .45-1 1 .45 1 1 1zm4 5.5c2.03 0 3.8-1.11 4.75-2.75.19-.33-.05-.75-.44-.75H7.69c-.38 0-.63.42-.44.75.95 1.64 2.72 2.75 4.75 2.75z"/>
            </svg>
            <h2>Nenhum favorito ainda!</h2>
            <p>Explore nossa biblioteca e adicione mangás aos seus favoritos.</p>
        </div>
    </main>

<script>
const favoritesData = [
    {
        title: "One Piece",
        cover: "https://via.placeholder.com/300x420",
        currentChapter: 1089,
        totalChapters: 1090,
        progress: 99.9,
        status: "Em dia"
    },
    {
        title: "Jujutsu Kaisen",
        cover: "https://via.placeholder.com/300x420",
        currentChapter: 220,
        totalChapters: 236,
        progress: 93.2,
        status: "16 capítulos atrás"
    },
    {
        title: "Demon Slayer",
        cover: "https://via.placeholder.com/300x420",
        currentChapter: 205,
        totalChapters: 205,
        progress: 100,
        status: "Concluído"
    },
    {
        title: "My Hero Academia",
        cover: "https://via.placeholder.com/300x420",
        currentChapter: 350,
        totalChapters: 402,
        progress: 87.1,
        status: "52 capítulos atrás"
    }
];

function createFavoriteCard(favorite) {
    return `
        <div class="favorite-card">
            <div class="favorite-cover" style="background-image: url('${favorite.cover}')">
                <span class="favorite-badge">${favorite.status}</span>
            </div>
            <div class="favorite-info">
                <div class="manga-title">${favorite.title}</div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: ${favorite.progress}%"></div>
                </div>
                <div class="chapter-info">
                    <span>Capítulo ${favorite.currentChapter}</span>
                    <span>de ${favorite.totalChapters}</span>
                </div>
                <div class="favorite-actions">
                    <button class="action-button continue-reading">Continuar Lendo</button>
                    <button class="action-button remove-favorite">Remover</button>
                </div>
            </div>
        </div>
    `;
}

// Populate favorites grid
const favoritesGrid = document.querySelector('.favorites-grid');
const emptyState = document.querySelector('.empty-state');

function updateFavorites() {
    if (favoritesData.length === 0) {
        favoritesGrid.style.display = 'none';
        emptyState.style.display = 'block';
    } else {
        favoritesGrid.style.display = 'grid';
        emptyState.style.display = 'none';
        favoritesGrid.innerHTML = favoritesData.map(createFavoriteCard).join('');
    }
}

updateFavorites();

// View toggle functionality
document.querySelectorAll('.view-toggle button').forEach(button => {
    button.addEventListener('click', function() {
        document.querySelector('.view-toggle button.active')?.classList.remove('active');
        this.classList.add('active');
        
        if (this.textContent === 'Lista') {
            favoritesGrid.style.gridTemplateColumns = '1fr';
        } else {
            favoritesGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(250px, 1fr))';
        }
    });
});

// Remove favorite functionality
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-favorite')) {
        const card = e.target.closest('.favorite-card');
        card.style.opacity = '0';
        setTimeout(() => {
            card.remove();
            favoritesData.splice(favoritesData.findIndex(f => 
                f.title === card.querySelector('.manga-title').textContent
            ), 1);
            updateFavorites();
        }, 300);
    }
});

// Continue reading functionality
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('continue-reading')) {
        const title = e.target.closest('.favorite-card').querySelector('.manga-title').textContent;
        // Redirect to reading page
        console.log(`Continuing ${title}`);
    }
});
</script>
</body></html>