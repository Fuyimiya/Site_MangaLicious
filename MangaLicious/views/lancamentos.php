<?php
	require_once "iniciar_session.php";
?>
<html><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lançamentos - MangaLicious</title>
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

main {
    margin-top: 80px;
    padding: 2rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.releases-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.release-date-filter {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.date-button {
    padding: 0.5rem 1rem;
    border: 2px solid var(--secondary-color);
    background: white;
    color: var(--secondary-color);
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.date-button.active {
    background: var(--secondary-color);
    color: white;
}

.releases-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
}

.release-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.release-card:hover {
    transform: translateY(-5px);
}

.release-info {
    padding: 1.5rem;
}

.release-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 1rem;
}

.release-title {
    font-size: 1.2rem;
    font-weight: bold;
    color: var(--primary-color);
}

.chapter-number {
    background: var(--accent-color);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.9rem;
    font-weight: bold;
}

.release-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #666;
    font-size: 0.9rem;
}

.release-time {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.release-time svg {
    width: 16px;
    height: 16px;
}

.scanlator {
    color: var(--secondary-color);
    font-weight: 500;
}

.release-preview {
    position: relative;
    padding-top: 56.25%;
    background-size: cover;
    background-position: center;
}

.new-badge {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: var(--accent-color);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: bold;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

.load-more {
    display: block;
    width: 200px;
    margin: 2rem auto;
    padding: 1rem;
    background: var(--secondary-color);
    color: white;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-weight: bold;
    transition: all 0.3s ease;
}

.load-more:hover {
    background: var(--primary-color);
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    nav ul {
        display: none;
    }
    
    .releases-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .release-date-filter {
        width: 100%;
        justify-content: center;
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
        <div class="releases-header">
            <h1>Últimos Lançamentos</h1>
            <div class="release-date-filter">
                <button class="date-button active">Hoje</button>
                <button class="date-button">Ontem</button>
                <button class="date-button">Esta Semana</button>
                <button class="date-button">Este Mês</button>
            </div>
        </div>

        <div class="releases-grid">
            <!-- Release cards will be populated by JavaScript -->
        </div>

        <button class="load-more">Carregar Mais</button>
    </main>

<script>
// Sample releases data
const releasesData = [
    {
        title: "One Piece",
        chapter: 1089,
        timeAgo: "2 horas atrás",
        scanlator: "MangaBR",
        preview: "https://via.placeholder.com/300x169",
        isNew: true
    },
    {
        title: "Jujutsu Kaisen",
        chapter: 236,
        timeAgo: "4 horas atrás",
        scanlator: "MangaPlus",
        preview: "https://via.placeholder.com/300x169",
        isNew: true
    },
    {
        title: "Black Clover",
        chapter: 367,
        timeAgo: "6 horas atrás",
        scanlator: "ScansTeam",
        preview: "https://via.placeholder.com/300x169",
        isNew: false
    },
    {
        title: "My Hero Academia",
        chapter: 402,
        timeAgo: "8 horas atrás",
        scanlator: "Plus Ultra Scans",
        preview: "https://via.placeholder.com/300x169",
        isNew: false
    },
    {
        title: "Chainsaw Man",
        chapter: 145,
        timeAgo: "12 horas atrás",
        scanlator: "MangaPlus",
        preview: "https://via.placeholder.com/300x169",
        isNew: false
    },
    {
        title: "Dr. Stone",
        chapter: 232,
        timeAgo: "1 dia atrás",
        scanlator: "Stone World Scans",
        preview: "https://via.placeholder.com/300x169",
        isNew: false
    }
];

function createReleaseCard(release) {
    return `
        <div class="release-card">
            <div class="release-preview" style="background-image: url('${release.preview}')">
                ${release.isNew ? '<span class="new-badge">NOVO!</span>' : ''}
            </div>
            <div class="release-info">
                <div class="release-header">
                    <div class="release-title">${release.title}</div>
                    <div class="chapter-number">Cap. ${release.chapter}</div>
                </div>
                <div class="release-meta">
                    <div class="release-time">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm0 18c-4.4 0-8-3.6-8-8s3.6-8 8-8 8 3.6 8 8-3.6 8-8 8zm.5-13H11v6l5.2 3.2.8-1.3-4.5-2.7V7z"/>
                        </svg>
                        ${release.timeAgo}
                    </div>
                    <div class="scanlator">${release.scanlator}</div>
                </div>
            </div>
        </div>
    `;
}

// Populate releases grid
const releasesGrid = document.querySelector('.releases-grid');
releasesGrid.innerHTML = releasesData.map(createReleaseCard).join('');

// Date filter functionality
document.querySelectorAll('.date-button').forEach(button => {
    button.addEventListener('click', function() {
        document.querySelector('.date-button.active')?.classList.remove('active');
        this.classList.add('active');
        // Filter logic would go here
    });
});

// Load more functionality
document.querySelector('.load-more').addEventListener('click', function() {
    // Load more logic would go here
    const newReleases = releasesData.slice(0, 3); // Just for demo
    releasesGrid.innerHTML += newReleases.map(createReleaseCard).join('');
});
</script>
</body></html>