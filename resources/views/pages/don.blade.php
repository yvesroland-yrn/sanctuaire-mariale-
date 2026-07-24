@extends('layouts.app')

@section('title', 'Faire un don - ' . config('mudea.brand.name'))

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500;1,600&family=Work+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500&display=swap');

    :root {
        --sk-navy: #1c2f52;
        --sk-navy-deep: #14213c;
        --sk-ivory: #faf5e9;
        --sk-ivory-panel: #fffdf8;
        --sk-ink: #221f2b;
        --sk-gold: #b8862e;
        --sk-gold-soft: #e7c98a;
        --sk-burgundy: #7a1f3d;
        --sk-line: #e4d9c3;
        --sk-muted: #6c6558;
    }

    .sk-page {
        max-width: 1180px;
        margin: 0 auto;
        padding: 0 24px 80px;
        color: var(--sk-ink);
        font-family: 'Work Sans', sans-serif;
    }

    /* ---------- Hero ---------- */
    .sk-hero {
        position: relative;
        background: radial-gradient(120% 160% at 15% 0%, #24406c 0%, var(--sk-navy) 45%, var(--sk-navy-deep) 100%);
        color: var(--sk-ivory);
        padding: 56px 40px 52px;
        margin: 40px 0 32px;
        overflow: hidden;
        border-top: 1px solid rgba(231, 201, 138, 0.5);
        border-bottom: 1px solid rgba(231, 201, 138, 0.5);
    }

    .sk-hero::before,
    .sk-hero::after {
        content: "";
        position: absolute;
        left: 40px;
        right: 40px;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--sk-gold-soft) 50%, transparent);
    }

    .sk-hero::before { top: 10px; }
    .sk-hero::after { bottom: 10px; }

    .sk-hero-inner {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 40px;
        flex-wrap: wrap;
    }

    .sk-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.7rem;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--sk-gold-soft);
        margin-bottom: 18px;
    }

    .sk-eyebrow::before {
        content: "";
        width: 22px;
        height: 1px;
        background: var(--sk-gold-soft);
    }

    .sk-hero h1 {
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        font-weight: 600;
        font-size: clamp(2.1rem, 4vw, 3.3rem);
        line-height: 1.08;
        margin-bottom: 14px;
        max-width: 640px;
    }

    .sk-hero p {
        max-width: 520px;
        line-height: 1.75;
        color: rgba(250, 245, 233, 0.78);
        font-size: 0.98rem;
    }

    .sk-flame {
        flex-shrink: 0;
        width: 74px;
        height: 96px;
    }

    .sk-flame .flame-core {
        transform-origin: 37px 66px;
        animation: sk-flicker 3.2s ease-in-out infinite;
    }

    @keyframes sk-flicker {
        0%, 100% { transform: scaleY(1) scaleX(1) rotate(0deg); }
        30% { transform: scaleY(1.05) scaleX(0.97) rotate(-1.5deg); }
        60% { transform: scaleY(0.97) scaleX(1.03) rotate(1.5deg); }
    }

    @media (prefers-reduced-motion: reduce) {
        .sk-flame .flame-core { animation: none; }
    }

    /* ---------- Grid & panel ---------- */
    .sk-grid {
        display: grid;
        grid-template-columns: 1.4fr 0.75fr;
        gap: 28px;
        align-items: start;
    }

    .sk-panel {
        background: var(--sk-ivory-panel);
        border: 1px solid var(--sk-line);
        border-radius: 4px;
        box-shadow: 0 20px 50px rgba(28, 47, 82, 0.08);
        overflow: hidden;
    }

    .sk-arch {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 26px 0 8px;
        background: linear-gradient(180deg, #f2ead8 0%, var(--sk-ivory-panel) 100%);
        border-bottom: 1px solid var(--sk-line);
    }

    .sk-panel-body {
        padding: 12px 34px 34px;
    }

    .sk-panel-body h2 {
        font-family: 'Cormorant Garamond', serif;
        font-weight: 600;
        font-size: 1.55rem;
        text-align: center;
        margin-bottom: 4px;
    }

    .sk-panel-body .sk-hint {
        text-align: center;
        color: var(--sk-muted);
        font-size: 0.9rem;
        max-width: 440px;
        margin: 0 auto 28px;
        line-height: 1.6;
    }

    /* ---------- Form ---------- */
    .sk-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .sk-field { display: flex; flex-direction: column; gap: 8px; }
    .sk-field.full { grid-column: 1 / -1; }

    .sk-field label {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.68rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--sk-muted);
    }

    .sk-field input,
    .sk-field textarea {
        width: 100%;
        border: 1px solid var(--sk-line);
        border-radius: 2px;
        padding: 13px 14px;
        background: #fff;
        color: var(--sk-ink);
        font: 500 0.96rem/1.4 'Work Sans', sans-serif;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .sk-field input:focus,
    .sk-field textarea:focus {
        outline: none;
        border-color: var(--sk-gold);
        box-shadow: 0 0 0 3px rgba(184, 134, 46, 0.16);
    }

    .sk-field textarea { min-height: 110px; resize: vertical; }

    .sk-field .sk-error {
        font-size: 0.78rem;
        color: var(--sk-burgundy);
    }

    /* Donor type chips */
    .sk-radio-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .sk-radio-chip {
        flex: 1 1 200px;
        position: relative;
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1px solid var(--sk-line);
        border-radius: 2px;
        padding: 13px 16px;
        background: #fff;
        cursor: pointer;
        transition: border-color 0.2s ease, background 0.2s ease;
    }

    .sk-radio-chip input {
        width: 16px;
        height: 16px;
        accent-color: var(--sk-gold);
    }

    .sk-radio-chip:has(input:checked) {
        border-color: var(--sk-gold);
        background: #fbf3e2;
    }

    .sk-radio-chip span { font-size: 0.92rem; font-weight: 500; }

    /* Actions */
    .sk-actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        margin-top: 22px;
        align-items: center;
    }

    .sk-btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        border: 1px solid var(--sk-gold);
        border-radius: 2px;
        background: var(--sk-navy);
        color: var(--sk-gold-soft);
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.78rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        font-weight: 500;
        padding: 15px 26px;
        min-height: 50px;
        cursor: pointer;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .sk-btn-submit:hover { background: var(--sk-navy-deep); }
    .sk-btn-submit:focus-visible { outline: 2px solid var(--sk-gold); outline-offset: 2px; }

    .sk-btn-soft {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--sk-navy);
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: underline;
        text-underline-offset: 4px;
        text-decoration-color: var(--sk-line);
    }

    .sk-btn-soft:hover { text-decoration-color: var(--sk-gold); }

    /* ---------- Side card ---------- */
    .sk-side {
        position: sticky;
        top: 100px;
        background: var(--sk-navy);
        color: rgba(250, 245, 233, 0.9);
        border-radius: 4px;
        padding: 30px 26px;
        border: 1px solid var(--sk-navy-deep);
    }

    .sk-side h3 {
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        font-size: 1.3rem;
        margin-bottom: 18px;
        color: var(--sk-gold-soft);
    }

    .sk-intentions {
        display: grid;
        gap: 16px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sk-intentions li {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        padding-bottom: 16px;
        border-bottom: 1px solid rgba(231, 201, 138, 0.18);
        font-size: 0.88rem;
        line-height: 1.6;
        color: rgba(250, 245, 233, 0.75);
    }

    .sk-intentions li:last-child { border-bottom: none; padding-bottom: 0; }

    .sk-intentions strong {
        display: block;
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.68rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--sk-gold-soft);
        margin-bottom: 4px;
    }

    @media (max-width: 960px) {
        .sk-grid { grid-template-columns: 1fr; }
        .sk-side { position: static; }
    }

    @media (max-width: 640px) {
        .sk-hero { padding: 40px 22px; margin: 20px 0 24px; }
        .sk-hero-inner { flex-direction: column-reverse; align-items: flex-start; }
        .sk-panel-body { padding: 8px 20px 26px; }
        .sk-form-grid { grid-template-columns: 1fr; }
        .sk-radio-chip { flex: 1 1 100%; }
    }
</style>
@endpush

@section('content')
<div class="sk-page">

    <section class="sk-hero">
        <div class="sk-hero-inner">
            <div>
                <span class="sk-eyebrow">Sanctuaire Notre Dame de Sassako</span>
                <h1>Un geste qui éclaire la route des pèlerins</h1>
                <p>
                    Chaque don soutient la vie du sanctuaire&nbsp;: l'accueil de ceux qui viennent prier,
                    l'entretien des lieux et les besoins quotidiens de la communauté.
                    Le paiement est traité en toute sécurité par GeniusPay.
                </p>
            </div>
            <svg class="sk-flame" viewBox="0 0 74 96" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M8 84C8 92 16 96 37 96C58 96 66 92 66 84" stroke="#e7c98a" stroke-opacity="0.4"/>
                <rect x="34" y="70" width="6" height="20" fill="#e7c98a" fill-opacity="0.5"/>
                <path class="flame-core" d="M37 6C37 6 20 30 20 48C20 61 27.5 70 37 70C46.5 70 54 61 54 48C54 30 37 6 37 6Z" fill="url(#skFlameGrad)"/>
                <defs>
                    <linearGradient id="skFlameGrad" x1="37" y1="6" x2="37" y2="70" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#f4e0a8"/>
                        <stop offset="0.55" stop-color="#e7c98a"/>
                        <stop offset="1" stop-color="#b8862e"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </section>

    <div class="sk-grid">
        <section class="sk-panel">
            <div class="sk-arch">
                <svg width="120" height="70" viewBox="0 0 120 70" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M14 68V38C14 17 33 4 60 4C87 4 106 17 106 38V68" stroke="#b8862e" stroke-width="1.5"/>
                    <path d="M28 68V42C28 26 41 16 60 16C79 16 92 26 92 42V68" stroke="#b8862e" stroke-width="1" stroke-opacity="0.5"/>
                    <circle cx="60" cy="30" r="3" fill="#b8862e"/>
                </svg>
            </div>
            <div class="sk-panel-body">
                <h2>Formulaire de don</h2>
                <p class="sk-hint">Renseignez les informations utiles, puis choisissez votre moyen de paiement sur la page sécurisée GeniusPay.</p>

                <form action="{{ route('payments.geniuspay.checkout') }}" method="POST">
                    @csrf
                    <input type="hidden" name="description" id="don-description" value="{{ old('description', 'Don pour le Sanctuaire de Sassako') }}">
                    <input type="hidden" name="customer_country" value="{{ old('customer_country', 'CI') }}">

                    <div class="sk-form-grid">
                        <div class="sk-field full">
                            <label>Type de donateur</label>
                            <div class="sk-radio-row">
                                <label class="sk-radio-chip">
                                    <input type="radio" name="donor_type" value="identifie" checked>
                                    <span>Donateur identifié</span>
                                </label>
                                <label class="sk-radio-chip">
                                    <input type="radio" name="donor_type" value="anonyme">
                                    <span>Donateur anonyme</span>
                                </label>
                            </div>
                        </div>

                        <div class="sk-field">
                            <label for="customer_name">Nom</label>
                            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" placeholder="Nom du donateur">
                            @error('customer_name')<span class="sk-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="sk-field">
                            <label for="customer_phone">Téléphone</label>
                            <input type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}" placeholder="+225 07 XX XX XX XX">
                            @error('customer_phone')<span class="sk-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="sk-field">
                            <label for="customer_email">Email</label>
                            <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}" placeholder="exemple@email.com">
                            @error('customer_email')<span class="sk-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="sk-field">
                            <label for="amount">Montant (FCFA)</label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount') }}" min="200" step="500" required placeholder="5000">
                            @error('amount')<span class="sk-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="sk-field full">
                            <label for="description">Motif du don</label>
                            <textarea name="description" id="description" required placeholder="Soutien au sanctuaire, action de grâce, intention particulière...">{{ old('description', 'Don pour le Sanctuaire de Sassako') }}</textarea>
                            @error('description')<span class="sk-error">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="sk-actions">
                        <button type="submit" class="sk-btn-submit">Passer au paiement sécurisé</button>
                        <a href="{{ route('contact') }}" class="sk-btn-soft">Nous contacter</a>
                    </div>
                </form>
            </div>
        </section>

        <aside class="sk-side">
            <h3>Pourquoi votre don compte</h3>
            <ul class="sk-intentions">
                <li>
                    <div>
                        <strong>Accueil</strong>
                        Vivres, eau et repos pour les pèlerins de passage.
                    </div>
                </li>
                <li>
                    <div>
                        <strong>Entretien</strong>
                        Préservation des lieux de culte et des espaces de prière.
                    </div>
                </li>
                <li>
                    <div>
                        <strong>Sécurité</strong>
                        Paiement chiffré, aucune donnée bancaire conservée sur nos serveurs.
                    </div>
                </li>
            </ul>
        </aside>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const donorTypeInputs = document.querySelectorAll('input[name="donor_type"]');
    const customerName = document.getElementById('customer_name');
    const customerPhone = document.getElementById('customer_phone');
    const customerEmail = document.getElementById('customer_email');

    function syncDonorFields() {
        const anonymous = document.querySelector('input[name="donor_type"]:checked')?.value === 'anonyme';
        [customerName, customerPhone, customerEmail].forEach((field) => {
            if (!field) {
                return;
            }

            field.required = !anonymous;
            field.parentElement.style.opacity = anonymous ? '0.7' : '1';
        });
    }

    donorTypeInputs.forEach((input) => input.addEventListener('change', syncDonorFields));
    syncDonorFields();
</script>
@endpush