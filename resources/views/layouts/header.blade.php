{{-- resources/views/layouts/header.blade.php --}}
<header class="mudea-header">
    <div class="header-inner">
        <a href="{{ route('Accueil') }}" class="header-logo">
            <img src="{{ asset(config('mudea.brand.logo')) }}" alt="{{ config('mudea.brand.full_name') }}" class="logo-img">
            <div class="logo-text">
                <span class="logo-name">{{ config('mudea.brand.name') }}</span>
                <span class="logo-subtitle">{{ config('mudea.brand.tagline') }}</span>
            </div>
        </a>

        <nav class="header-nav" id="mainNav">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="{{ route('Accueil') }}" class="nav-link">Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('propos') }}" class="nav-link">À Propos</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('actualites') }}" class="nav-link">Actualités</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('don') }}" class="nav-link">Faire un don</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reservation') }}" class="nav-link">Réservation</a>
                </li>
            </ul>
        </nav>

        <div class="header-actions">
            <button class="btn-search" id="searchToggle" aria-label="Rechercher">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>

            <a href="{{ route('login') }}" class="btn btn-adherer">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"></path>
                </svg>
                Connexion
            </a>

            <a href="{{ route('contact') }}" class="btn btn-contribuer">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"></path>
                </svg>
                Nous Contacter
            </a>

            <button class="burger-btn" id="burgerBtn" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>

    <div class="search-bar" id="searchBar">
        <div class="search-bar-inner">
            <input type="text" placeholder="Rechercher sur le sanctuaire..." class="search-input" id="searchInput">
            <button class="search-submit" type="button">Rechercher</button>
            <button class="search-close" id="searchClose" type="button">&times;</button>
        </div>
    </div>
</header>

@if (request()->routeIs('Accueil'))


<section class="hero">
    <div class="hero-shell">
        <div class="hero-content">
        <span class="hero-badge">Lieu de Prière et de Grâce</span>
        <h1 class="hero-title">
            SANCTUAIRE NOTRE DAME DE SASSAKO<br>
        </h1>
        <p class="hero-desc">
            Un espace de prière, de recueillement et de partage de la foi.
            Les actualités, projets et conseils spirituels du Sanctuaire s'y retrouvent dans un cadre lumineux et apaisant.
        </p>
       
        <div class="hero-meta">
            <span>Jacqueville , Sassako , Cote d'Ivoire</span>
            <span>Lieu de priere et de grace</span>
        </div>
        </div>
        <div class="hero-visual" aria-hidden="true">
            <div class="hero-frame">
                <img src="{{ asset('images/home-banner-sanctuaire.jpeg') }}" alt="Sanctuaire Notre Dame de Cana" class="hero-image" fetchpriority="high" decoding="async">
            </div>
        </div>
    </div>
</section>



<div class="home-stats-wrap">
    <div class="stats-bar">
        <div class="stat-item">
            <div class="stat-top">
                <div class="stat-icon stat-icon--green">
                    <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                </div>
                <div>
                    <div class="stat-number">3000+</div>
                    <div class="stat-label">Fidèles</div>
                </div>
            </div>
            <p class="stat-desc">Une communauté unie dans la prière et le partage.</p>
            <a href="{{ route('propos') }}" class="stat-link">En savoir plus &rarr;</a>
        </div>

        <div class="stat-item">
            <div class="stat-top">
                <div class="stat-icon stat-icon--gold">
                    <svg viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zm0 12.08L5.08 11 12 7.5 18.92 11 12 15.08zM1 17l11 6 11-6v-2.54L12 21 1 14.54V17z"/></svg>
                </div>
                <div>
                    <div class="stat-number" style="color:#d62828;">5000+</div>
                    <div class="stat-label">Intentions confiées</div>
                </div>
            </div>
            <p class="stat-desc">Soutenir les célébrations et les temps de grâce.</p>
            <a href="{{ route('contact') }}" class="stat-link" style="color:var(--gold);">En savoir plus &rarr;</a>
        </div>

        <div class="stat-item">
            <div class="stat-top">
                <div class="stat-icon stat-icon--blue">
                    <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/></svg>
                </div>
                <div>
                    <div class="stat-number" style="color:#1b85d6;">300+</div>
                    <div class="stat-label">Temps forts</div>
                </div>
            </div>
          
        </div>

        <div class="stat-item">
            <div class="stat-top">
                <div class="stat-icon stat-icon--purple">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                </div>
                <div>
                    <div class="stat-number" style="color:var(--gold);">Prière</div>
                </div>
            </div>
            <p class="stat-desc">Un lieu d'espérance, d'adoration et de communion spirituelle.</p>
            <a href="{{ route('actualites') }}" class="stat-link" style="color:var(--gold);">En savoir plus &rarr;</a>
        </div>
    </div>
</div>
<style>
    .hero {
    padding: 4rem 2rem;

}

.hero-shell {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 3rem;
    max-width: 1200px;
    margin: 0 auto;
}

.hero-content {
    flex: 1 1 50%;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.hero-badge {
    display: inline-block;
    align-self: flex-start;
    padding: 0.4rem 1rem;

   
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.hero-title {
    font-size: 2.5rem;
    line-height: 1.2;
    font-weight: 700;
  
    margin: 0;
}

.hero-desc {
    font-size: 1.05rem;
    line-height: 1.6;
   
    max-width: 500px;
}

.hero-meta {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
    margin-top: 0.5rem;
    font-size: 0.9rem;
  
}

.hero-visual {
    flex: 1 1 50%;
    display: flex;
    justify-content: center;
}

.hero-frame {
    width: 100%;
    max-width: 500px;
    border-radius: 16px;
    overflow: hidden;

}

.hero-image {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
}

/* Responsive : empile en colonne sur mobile */
@media (max-width: 900px) {
    .hero-shell {
        flex-direction: column;
        text-align: center;
    }

    .hero-content {
        align-items: center;
    }

    .hero-badge {
        align-self: center;
    }

    .hero-desc {
        max-width: 100%;
    }
}
</style>
@endif
