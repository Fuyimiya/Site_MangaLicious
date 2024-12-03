<?php
	require_once "iniciar_session.php";
?>
<html><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sobre Nós - MangaLicious</title>
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

.hero {
    height: 400px;
    background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://via.placeholder.com/1920x1080') center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
    margin-top: 60px;
}

.hero-content h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.hero-content p {
    font-size: 1.2rem;
    max-width: 600px;
    margin: 0 auto;
}

main {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 2rem;
}

.about-section {
    background: white;
    border-radius: 10px;
    padding: 3rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.mission-values {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
}

.value-card {
    padding: 2rem;
    background: var(--background-color);
    border-radius: 10px;
    text-align: center;
}

.value-card svg {
    width: 50px;
    height: 50px;
    margin-bottom: 1rem;
    color: var(--secondary-color);
}

.team-section {
    margin-top: 4rem;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.team-member {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.member-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin: 2rem auto;
    overflow: hidden;
    background: var(--background-color);
}

.member-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.member-info {
    padding: 1.5rem;
}

.member-info h3 {
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.member-info p {
    color: #666;
    font-size: 0.9rem;
}

.statistics {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-top: 4rem;
    text-align: center;
}

.stat-card {
    background: var(--primary-color);
    color: white;
    padding: 2rem;
    border-radius: 10px;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.contact-section {
    margin-top: 4rem;
    text-align: center;
}

.contact-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.contact-button {
    padding: 1rem 2rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: transform 0.3s ease;
}

.contact-button:hover {
    transform: translateY(-3px);
}

.primary-button {
    background: var(--secondary-color);
    color: white;
}

.secondary-button {
    background: white;
    color: var(--secondary-color);
    border: 2px solid var(--secondary-color);
}

@media (max-width: 768px) {
    nav ul {
        display: none;
    }
    
    .hero-content h1 {
        font-size: 2rem;
    }
    
    .about-section {
        padding: 2rem;
    }
    
    .contact-buttons {
        flex-direction: column;
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

    <section class="hero">
        <div class="hero-content">
            <h1>Sobre o MangaLicious</h1>
            <p>Conectando fãs de mangá através de histórias incríveis desde 2023</p>
        </div>
    </section>

    <main>
        <section class="about-section">
            <h2>Nossa História</h2>
            <p>O MangaLicious nasceu da paixão de um grupo de entusiastas por mangás e cultura japonesa. Nossa missão é criar uma plataforma que não apenas disponibilize conteúdo de qualidade, mas também construa uma comunidade vibrante de fãs de mangá.</p>
            
            <div class="mission-values">
                <div class="value-card">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <h3>Paixão</h3>
                    <p>Amamos mangás e queremos compartilhar essa paixão com você</p>
                </div>
                <div class="value-card">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L1 21h22L12 2zm0 3.45l8.4 14.55H3.6L12 5.45z"/>
                    </svg>
                    <h3>Qualidade</h3>
                    <p>Compromisso com a melhor experiência de leitura possível</p>
                </div>
                <div class="value-card">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                    </svg>
                    <h3>Comunidade</h3>
                    <p>Construindo conexões através das histórias que amamos</p>
                </div>
            </div>
        </section>

        
    </main>

<script>

</body></html>