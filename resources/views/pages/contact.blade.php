@extends('layouts.app')

@section('title', 'Contact - ' . config('mudea.brand.name'))

@section('content')

<style>
    :root {
        --vert:        #1b85d6;
        --vert-fonce:  #0b5c9c;
        --vert-clair:  #52a8e7;
        --jaune:       #d62828;
        --jaune-clair: #ffb3b3;
        --gold:        #a61d1d;
        --green-dark:  #0b2a57;
        --gris-fond:   #f5f5f5;
        --gris-bord:   #e0e0e0;
        --texte:       #1a2736;
        --texte-sec:   #556779;
        --blanc:       #ffffff;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Segoe UI', Arial, sans-serif; color: var(--texte); background: var(--blanc); overflow-x: hidden; }
    a { text-decoration: none; color: inherit; }
    img { display: block; max-width: 100%; }

    /* ══ HERO SPLIT ══════════════════════════════════ */
    .hero-split {
        display: grid; grid-template-columns: 1fr 1fr;
        min-height: 340px; background: var(--green-dark);
    }
    .hero-left {
        padding: 56px 52px 56px clamp(24px, 5vw, 72px);
        display: flex; flex-direction: column; justify-content: center;
        background: linear-gradient(135deg, #0b2a57 0%, #1b85d6 58%, #d62828 100%);
        position: relative; z-index: 2;
    }
    .hero-left::after {
        content: ''; position: absolute; top: 0; right: -36px; bottom: 0; width: 72px;
        background: linear-gradient(135deg, #0b2a57 0%, #1b85d6 58%, #d62828 100%);
        clip-path: polygon(0 0, 0 100%, 100% 100%); z-index: 3;
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 4vw, 3.2rem);
        font-weight: 900; color: #fffef7; line-height: 1.05;
        letter-spacing: -.02em; margin-bottom: 10px;
    }
    .hero-subtitle {
        font-size: .9rem; font-weight: 800; color: var(--gold);
        margin-bottom: 8px; text-transform: uppercase; letter-spacing: .1em;
    }
    .hero-accent-line { width: 44px; height: 3px; background: var(--gold); border-radius: 2px; margin-bottom: 16px; }
    .hero-desc { color: rgba(255,255,255,.88); font-size: .9rem; line-height: 1.75; max-width: 420px; }
    .hero-right { position: relative; overflow: hidden; min-height: 340px; }
    .hero-right img { width: 100%; height: 100%; object-fit: cover; object-position: center; }
    .hero-right-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(7,31,11,.5) 0%, transparent 55%); }

    /* ══ MAIN CONTACT GRID ═══════════════════════════ */
    .contact-page-wrap {
        background: var(--gris-fond);
        padding: 44px 24px;
    }
    .contact-grid-3 {
        max-width: 1200px; margin: 0 auto 24px;
        display: grid; grid-template-columns: 280px 1fr 260px; gap: 24px;
        align-items: start;
    }

    /* ── Card générique ── */
    .c-card {
        background: var(--blanc); border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,.07);
        padding: 24px 22px; margin-bottom: 20px;
    }
    .c-card:last-child { margin-bottom: 0; }

    /* ── Card header (titre avec icône) ── */
    .card-head {
        display: flex; align-items: center; gap: 10px; margin-bottom: 18px;
    }
    .card-head-icon {
        width: 36px; height: 36px; border-radius: 50%;
        background: var(--vert); display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .card-head-icon svg { color: var(--blanc); }
    .card-head h3 {
        font-size: .82rem; font-weight: 900; text-transform: uppercase;
        letter-spacing: .06em; color: var(--vert-fonce);
    }

    /* ══ COLONNE GAUCHE : Coordonnées ═══════════════ */
    .coord-item {
        display: flex; align-items: flex-start; gap: 12px;
        padding: 10px 0; border-bottom: 1px solid var(--gris-bord);
    }
    .coord-item:last-child { border-bottom: none; padding-bottom: 0; }
    .coord-icon {
        width: 34px; height: 34px; border-radius: 50%;
        background: var(--vert); display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; margin-top: 1px;
    }
    .coord-icon svg { color: var(--blanc); }
    .coord-body h5 { font-size: .77rem; font-weight: 800; color: var(--texte); margin-bottom: 2px; }
    .coord-body p, .coord-body a { font-size: .78rem; color: var(--texte-sec); line-height: 1.55; }
    .coord-body a:hover { color: var(--vert); }

    /* ══ COLONNE CENTRE : Formulaire ════════════════ */
    .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .fg { display: flex; flex-direction: column; gap: 5px; margin-bottom: 14px; }
    .fg label {
        font-size: .76rem; font-weight: 700; color: var(--vert-fonce);
        display: flex; align-items: center; gap: 4px;
    }
    .fg label .req { color: #e53935; }
    .fg input, .fg select, .fg textarea {
        border: 1.5px solid var(--gris-bord); border-radius: 7px;
        padding: 10px 13px; font-size: .86rem; font-family: inherit;
        color: var(--texte); outline: none; background: #fafafa;
        transition: border-color .2s, box-shadow .2s;
    }
    .fg input:focus, .fg select:focus, .fg textarea:focus {
        border-color: var(--vert);
        box-shadow: 0 0 0 3px rgba(45,106,45,.1);
        background: var(--blanc);
    }
    .fg textarea { resize: vertical; min-height: 110px; }
    .fg input::placeholder, .fg textarea::placeholder { color: #bbb; }

    .btn-send {
        width: 100%; background: var(--vert); color: var(--blanc);
        border: none; cursor: pointer;
        font-weight: 800; font-size: .88rem; text-transform: uppercase; letter-spacing: .5px;
        padding: 13px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center; gap: 9px;
        transition: background .2s, transform .15s; margin-top: 2px;
    }
    .btn-send:hover { background: var(--vert-fonce); transform: translateY(-2px); }

    /* ══ COLONNE DROITE : Assistant ═════════════════ */
    .assist-question {
        font-size: .8rem; font-weight: 700; color: var(--texte-sec); margin-bottom: 14px;
    }
    .assist-option {
        display: flex; align-items: flex-start; gap: 11px;
        padding: 10px 0; border-bottom: 1px solid var(--gris-bord); cursor: pointer;
    }
    .assist-option:last-child { border-bottom: none; padding-bottom: 0; }
    .assist-option input[type="radio"] {
        margin-top: 3px; accent-color: var(--vert); flex-shrink: 0;
    }
    .assist-opt-icon {
        width: 30px; height: 30px; border-radius: 50%;
        background: #eef5ee; display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .assist-opt-icon svg { color: var(--vert); }
    .assist-opt-body h5 { font-size: .77rem; font-weight: 800; color: var(--texte); margin-bottom: 1px; }
    .assist-opt-body p  { font-size: .72rem; color: var(--texte-sec); line-height: 1.4; }

    /* ══ DEUXIÈME RANGÉE ════════════════════════════ */
    .contact-grid-3-bottom {
        max-width: 1200px; margin: 0 auto;
        display: grid; grid-template-columns: 280px 1fr 260px; gap: 24px;
        align-items: start;
    }

    /* ── FAQ Accordion ── */
    .faq-item {
        border-bottom: 1px solid var(--gris-bord);
    }
    .faq-item:last-child { border-bottom: none; }
    .faq-btn {
        width: 100%; background: none; border: none; cursor: pointer;
        display: flex; align-items: center; justify-content: space-between;
        padding: 11px 0; text-align: left; gap: 8px;
    }
    .faq-btn span {
        font-size: .79rem; font-weight: 700; color: var(--texte); line-height: 1.3;
    }
    .faq-btn svg { flex-shrink: 0; transition: transform .25s; color: var(--vert); }
    .faq-btn.open svg { transform: rotate(180deg); }
    .faq-answer {
        font-size: .76rem; color: var(--texte-sec); line-height: 1.55;
        max-height: 0; overflow: hidden; transition: max-height .3s ease, padding .3s;
        padding-bottom: 0;
    }
    .faq-answer.open { max-height: 200px; padding-bottom: 10px; }

    /* ── Carte localisation ── */
    .map-embed {
        border-radius: 8px; overflow: hidden; margin-bottom: 14px;
        border: 1px solid var(--gris-bord);
    }
    .map-embed iframe { display: block; width: 100%; height: 210px; border: none; }
    .map-info p { font-size: .77rem; color: var(--texte-sec); line-height: 1.5; margin-bottom: 12px; }
    .map-info strong { color: var(--texte); font-weight: 800; font-size: .79rem; }
    .btn-itineraire {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        width: 100%; background: var(--vert); color: var(--blanc);
        border-radius: 7px; padding: 10px; font-size: .8rem;
        font-weight: 800; text-transform: uppercase; letter-spacing: .4px;
        transition: background .2s;
    }
    .btn-itineraire:hover { background: var(--vert-fonce); }

    /* ── Réseaux sociaux ── */
    .social-desc { font-size: .8rem; color: var(--texte-sec); margin-bottom: 14px; line-height: 1.5; }
    .social-list { display: flex; flex-direction: column; gap: 10px; }
    .social-link {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 8px; border: 1px solid var(--gris-bord);
        transition: border-color .2s, background .2s;
    }
    .social-link:hover { border-color: var(--vert); background: #f5fbf5; }
    .social-link-icon {
        width: 32px; height: 32px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .social-link-icon.fb   { background: #1877f2; }
    .social-link-icon.wa   { background: #25d366; }
    .social-link-icon.yt   { background: #ff0000; }
    .social-link-icon.li   { background: #0a66c2; }
    .social-link-icon svg  { color: var(--blanc); }
    .social-link-body h5   { font-size: .78rem; font-weight: 800; color: var(--vert); margin-bottom: 1px; }
    .social-link-body p    { font-size: .72rem; color: var(--texte-sec); }

    /* ══ CTA BAS DE PAGE ════════════════════════════ */
    .cta-bottom {
        background: var(--vert-fonce);
        padding: 32px 24px;
    }
    .cta-bottom-inner {
        max-width: 1200px; margin: 0 auto;
        display: flex; align-items: center; gap: 28px; flex-wrap: wrap;
    }
    .cta-avatar {
        width: 90px; height: 90px; border-radius: 50%; overflow: hidden;
        border: 3px solid rgba(255,255,255,.2); flex-shrink: 0;
        background: var(--vert);
        display: flex; align-items: center; justify-content: center;
    }
    .cta-avatar svg { color: rgba(255,255,255,.6); }
    .cta-text-block { flex: 1; min-width: 200px; }
    .cta-text-block h3 { font-size: 1.05rem; font-weight: 900; color: var(--blanc); margin-bottom: 5px; }
    .cta-text-block p  { font-size: .84rem; color: rgba(255,255,255,.72); line-height: 1.5; }
    .cta-btn-discuss {
        display: inline-flex; align-items: center; gap: 9px;
        background: var(--blanc); color: var(--vert-fonce);
        font-weight: 800; font-size: .84rem; text-transform: uppercase; letter-spacing: .4px;
        padding: 12px 24px; border-radius: 7px; transition: background .2s; flex-shrink: 0;
    }
    .cta-btn-discuss:hover { background: #e8e8e8; }
    .cta-badges {
        display: flex; gap: 28px; flex-wrap: wrap; margin-left: auto;
    }
    .cta-badge {
        display: flex; flex-direction: column; align-items: center; text-align: center; gap: 6px;
    }
    .cta-badge-icon {
        width: 44px; height: 44px; border-radius: 50%;
        border: 2px solid rgba(255,255,255,.25);
        display: flex; align-items: center; justify-content: center;
    }
    .cta-badge-icon svg { color: rgba(255,255,255,.8); }
    .cta-badge h5 { font-size: .72rem; font-weight: 800; color: var(--blanc); line-height: 1.2; }
    .cta-badge p  { font-size: .67rem; color: rgba(255,255,255,.6); }

    /* ══ RESPONSIVE ══════════════════════════════════ */
    @media (max-width: 1080px) {
        .contact-grid-3,
        .contact-grid-3-bottom { grid-template-columns: 1fr 1fr; }
        .contact-grid-3 > *:last-child,
        .contact-grid-3-bottom > *:last-child { grid-column: 1 / -1; }
    }
    @media (max-width: 768px) {
        .hero-split { grid-template-columns: 1fr; }
        .hero-right { min-height: 200px; }
        .hero-left::after { display: none; }
        .contact-grid-3,
        .contact-grid-3-bottom { grid-template-columns: 1fr; }
        .contact-grid-3 > *:last-child,
        .contact-grid-3-bottom > *:last-child { grid-column: auto; }
        .form-row-2 { grid-template-columns: 1fr; }
        .cta-badges { display: none; }
        .cta-bottom-inner { flex-direction: column; align-items: flex-start; gap: 18px; }
    }
</style>

{{-- ══ HERO ══════════════════════════════════════════ --}}
<section class="hero-split">
    <div class="hero-left">
        <h1 class="hero-title">Contact &amp;<br>Sanctuaire Notre Dame de Cana</h1>
        <p class="hero-subtitle">Nous sommes à votre écoute</p>
        <div class="hero-accent-line"></div>
        <p class="hero-desc">Vous avez une question, une suggestion, une demande d'information ou souhaitez nous proposer un projet ? Contactez-nous, nous serons ravis de vous répondre.</p>
    </div>
    <div class="hero-right">
        <img src="{{ asset('images/communaute/1.png') }}" alt="Village d'Andé" onerror="this.style.display='none'">
        <div class="hero-right-overlay"></div>
    </div>
</section>

{{-- ══ RANGÉE PRINCIPALE ══════════════════════════════ --}}
<div class="contact-page-wrap">

    <div class="contact-grid-3">

        {{-- ── Colonne 1 : Coordonnées ── --}}
        <div>
            <div class="c-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M4 4h16v16H4z" opacity="0"/><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                    </div>
                    <h3>Nos coordonnées</h3>
                </div>

                <div class="coord-item">
                    <div class="coord-icon">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                    </div>
                    <div class="coord-body">
                        <h5>Adresse</h5>
                        <p>Village d'Andé, Sous-préfecture d'Agnè,<br>Région de la N'zi, Côte d'Ivoire</p>
                    </div>
                </div>

                <div class="coord-item">
                    <div class="coord-icon">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.34 1.79.65 2.65a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.43-1.43a2 2 0 0 1 2.11-.45c.86.31 1.75.53 2.65.65A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div class="coord-body">
                        <h5>Téléphone</h5>
                        <a href="tel:+22507000060000">+225 07 00 00 60 00</a>
                    </div>
                </div>

                <div class="coord-item">
                    <div class="coord-icon">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></svg>
                    </div>
                    <div class="coord-body">
                        <h5>Email</h5>
                        <a href="mailto:contact@sanctuairecana.org">contact@sanctuairecana.org</a>
                    </div>
                </div>

                <div class="coord-item">
                    <div class="coord-icon">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="coord-body">
                        <h5>Horaires</h5>
                        <p>Lundi - Samedi : 8h00 - 18h00<br>Dimanche : après les messes</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Colonne 2 : Formulaire ── --}}
        <div>
            <div class="c-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <h3>Formulaire de contact</h3>
                </div>

                <form action="" method="POST">
                    @csrf

                    <div class="form-row-2">
                        <div class="fg">
                            <label>Nom <span class="req">*</span></label>
                            <input type="text" name="nom" placeholder="Nom *" required value="{{ old('nom') }}">
                        </div>
                        <div class="fg">
                            <label>Prénom <span class="req">*</span></label>
                            <input type="text" name="prenom" placeholder="Prénom *" required value="{{ old('prenom') }}">
                        </div>
                    </div>

                    <div class="fg">
                        <label>Téléphone <span class="req">*</span></label>
                        <input type="tel" name="telephone" placeholder="Téléphone *" required value="{{ old('telephone') }}">
                    </div>

                    <div class="fg">
                        <label>Email <span class="req">*</span></label>
                        <input type="email" name="email" placeholder="Email *" required value="{{ old('email') }}">
                    </div>

                    <div class="fg">
                        <label>Objet <span class="req">*</span></label>
                        <select name="objet" required>
                            <option value="" disabled {{ old('objet') ? '' : 'selected' }}>Objet *</option>
                            <option value="adhesion"     {{ old('objet') === 'adhesion'     ? 'selected' : '' }}>Adhésion / Membership</option>
                            <option value="contribution" {{ old('objet') === 'contribution' ? 'selected' : '' }}>Contribution / Don</option>
                            <option value="projet"       {{ old('objet') === 'projet'       ? 'selected' : '' }}>Proposition de projet</option>
                            <option value="education"    {{ old('objet') === 'education'    ? 'selected' : '' }}>Éducation &amp; Excellence</option>
                            <option value="information"  {{ old('objet') === 'information'  ? 'selected' : '' }}>Information générale</option>
                            <option value="autre"        {{ old('objet') === 'autre'        ? 'selected' : '' }}>Autre demande</option>
                        </select>
                    </div>

                    <div class="fg">
                        <label>Votre message <span class="req">*</span></label>
                        <textarea name="message" placeholder="Votre message *" required>{{ old('message') }}</textarea>
                    </div>

                    @if(session('success'))
                        <div style="background:#e9f4ff;border:1px solid #b8dff7;color:#0b5c9c;padding:10px 14px;border-radius:7px;font-size:.8rem;margin-bottom:12px;font-weight:700;">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div style="background:#ffebee;border:1px solid #ef9a9a;color:#c62828;padding:10px 14px;border-radius:7px;font-size:.8rem;margin-bottom:12px;">
                            @foreach($errors->all() as $e) <div>{{ $e }}</div> @endforeach
                        </div>
                    @endif

                    <button type="submit" class="btn-send">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Envoyer le message
                    </button>
                </form>
            </div>
        </div>

        {{-- ── Colonne 3 : Assistant ── --}}
        <div>
            <div class="c-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 2-3 4"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <h3>On vous oriente</h3>
                </div>

                <p class="assist-question">Quel est l'objet de votre demande ?</p>

                <label class="assist-option">
                    <input type="radio" name="assist_topic" value="adhesion">
                    <div class="assist-opt-icon">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div class="assist-opt-body">
                        <h5>Adhésion</h5>
                        <p>Devenir membre de la communauté</p>
                    </div>
                </label>

                <label class="assist-option">
                    <input type="radio" name="assist_topic" value="contribution">
                    <div class="assist-opt-icon">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <div class="assist-opt-body">
                        <h5>Contribution / Don</h5>
                        <p>Soutenir un projet du sanctuaire</p>
                    </div>
                </label>

                <label class="assist-option">
                    <input type="radio" name="assist_topic" value="projet">
                    <div class="assist-opt-icon">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>
                    </div>
                    <div class="assist-opt-body">
                        <h5>Proposition de projet</h5>
                        <p>Nous soumettre une initiative</p>
                    </div>
                </label>

                <label class="assist-option">
                    <input type="radio" name="assist_topic" value="information">
                    <div class="assist-opt-icon">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    </div>
                    <div class="assist-opt-body">
                        <h5>Information générale</h5>
                        <p>Une question sur le sanctuaire</p>
                    </div>
                </label>
            </div>
        </div>

    </div>

    <div class="contact-grid-3-bottom">

        {{-- ── FAQ ── --}}
        <div>
            <div class="c-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 2-3 4"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <h3>Questions fréquentes</h3>
                </div>

                @php
                    $faqs = [
                        ['q' => 'Comment devenir membre du sanctuaire ?', 'a' => 'Remplissez le formulaire de contact en sélectionnant "Adhésion" comme objet, ou contactez-nous directement par WhatsApp.'],
                        ['q' => 'Comment faire un don ou une contribution ?', 'a' => 'Utilisez le formulaire ci-dessus en choisissant "Contribution / Don" ; notre équipe vous recontactera avec les modalités.'],
                        ['q' => 'Puis-je proposer un projet au sanctuaire ?', 'a' => 'Oui, toute proposition est la bienvenue. Décrivez votre initiative dans le formulaire et nous l\'étudierons avec attention.'],
                        ['q' => 'Quels sont les horaires de visite ?', 'a' => 'Le sanctuaire est ouvert du lundi au samedi de 8h à 18h, et le dimanche après les messes.'],
                    ];
                @endphp

                @foreach($faqs as $i => $faq)
                    <div class="faq-item">
                        <button type="button" class="faq-btn" onclick="toggleFaq({{ $i }})">
                            <span>{{ $faq['q'] }}</span>
                            <svg id="faq-icon-{{ $i }}" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <div id="faq-answer-{{ $i }}" class="faq-answer">
                            <p>{{ $faq['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ── Localisation ── --}}
        <div>
            <div class="c-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                    </div>
                    <h3>Notre localisation</h3>
                </div>

                <div class="map-embed">
                 
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.2794306448127!2d-4.284684724155265!3d5.218724636947293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1cfa908c5331f%3A0x69ae742e3fdcdb7a!2sSanctuaire%20Marial%20de%20Jacqueville!5e0!3m2!1sfr!2sci!4v1784892506958!5m2!1sfr!2sci" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>

                </div>

                <div class="map-info">
                    <strong>{{ config('mudea.brand.full_name') }}</strong>
                    <p>Village officiel, Sous-préfecture d'Agne,<br>Région de la Nde, Côte d'Ivoire</p>
                </div>

                <a href="https://maps.google.com/?q=Ande,Cote+d'Ivoire" target="_blank" class="btn-itineraire">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                    Itinéraire
                </a>
            </div>
        </div>

        {{-- ── Réseaux sociaux ── --}}
        <div>
            <div class="c-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                    </div>
                    <h3>Suivez-nous</h3>
                </div>
                <p class="social-desc">Restez connectés avec nous<br>sur nos réseaux sociaux.</p>

                <div class="social-list">
                    <a href="#" class="social-link" target="_blank">
                        <div class="social-link-icon fb">
                            <svg width="15" height="15" fill="none" stroke="white" stroke-width="2.2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </div>
                        <div class="social-link-body">
                            <h5>Facebook</h5>
                            <p>SanctuaireCana</p>
                        </div>
                    </a>
                    <a href="https://wa.me/22507000060000" class="social-link" target="_blank">
                        <div class="social-link-icon wa">
                            <svg width="15" height="15" fill="none" stroke="white" stroke-width="2.2" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                        </div>
                        <div class="social-link-body">
                            <h5>WhatsApp</h5>
                            <p>+225 07 00 00 60 00</p>
                        </div>
                    </a>
                    <a href="#" class="social-link" target="_blank">
                        <div class="social-link-icon yt">
                            <svg width="15" height="15" fill="none" stroke="white" stroke-width="2.2" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
                        </div>
                        <div class="social-link-body">
                            <h5>YouTube</h5>
                            <p>Sanctuaire Notre Dame de Cana</p>
                        </div>
                    </a>
                    <a href="#" class="social-link" target="_blank">
                        <div class="social-link-icon li">
                            <svg width="15" height="15" fill="none" stroke="white" stroke-width="2.2" viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                        </div>
                        <div class="social-link-body">
                            <h5>LinkedIn</h5>
                            <p>Notre Dame de l'Heure de la Grace</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ══ CTA BAS DE PAGE ══════════════════════════════ --}}
<div class="cta-bottom">
    <div class="cta-bottom-inner">
        <div class="cta-avatar">
            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <div class="cta-text-block">
            <h3>Besoin d'aide immédiate ?</h3>
            <p>Discutez en direct avec notre assistant du sanctuaire<br>et obtenez une réponse rapide à vos questions.</p>
        </div>
        <a href="https://wa.me/22507000060000" class="cta-btn-discuss" target="_blank">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            Démarrer la discussion
        </a>
        <div class="cta-badges">
            <div class="cta-badge">
                <div class="cta-badge-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <h5>Réponse rapide</h5>
                <p>Nous répondons dans<br>les meilleurs délais</p>
            </div>
            <div class="cta-badge">
                <div class="cta-badge-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h5>Confidentialité</h5>
                <p>Vos données sont<br>sécurisées</p>
            </div>
            <div class="cta-badge">
                <div class="cta-badge-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h5>À votre écoute</h5>
                <p>Notre équipe est là<br>pour vous aider</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleFaq(i) {
    const answer = document.getElementById('faq-answer-' + i);
    const icon   = document.getElementById('faq-icon-'   + i);
    const btn    = icon.closest('.faq-btn');
    const isOpen = answer.classList.contains('open');

    // Ferme tous les autres
    document.querySelectorAll('.faq-answer').forEach(el => el.classList.remove('open'));
    document.querySelectorAll('.faq-btn').forEach(el => el.classList.remove('open'));

    if (!isOpen) {
        answer.classList.add('open');
        btn.classList.add('open');
    }
}

// Pré-remplir l'objet du formulaire depuis le sélecteur "Assistant"
document.querySelectorAll('input[name="assist_topic"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        var select = document.querySelector('select[name="objet"]');
        if (select) select.value = this.value;
    });
});
</script>
@endpush

@endsection