<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - {{ config('mudea.brand.name') }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --green: #1B5E3C;
            --green-dark: #123f28;
            --green-light: #2f8a5c;
            --gold: #C9A227;
            --gold-light: #f3dd8a;
            --text: #1a2736;
            --muted: rgba(255, 255, 255, .72);
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html, body {
            height: 100%;
        }

        body {
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            color: #fff;
        }

        /* ══ FOND PLEIN ECRAN ══════════════════════════════ */
        .bg-photo {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image: linear-gradient(120deg, rgba(10, 20, 15, .55) 0%, rgba(10, 20, 15, .25) 45%, rgba(18, 63, 40, .55) 100%),
                url('{{ asset('images/1.png') }}');
            background-size: cover;
            background-position: center;
        }

        /* Découpe diagonale claire qui traverse l'écran */
        .bg-photo::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(100deg,
                    transparent 0%,
                    transparent calc(52% - 2px),
                    rgba(255, 255, 255, .9) calc(52% - 1px),
                    rgba(255, 255, 255, .9) 52%,
                    transparent calc(52% + 1px),
                    transparent 100%);
        }

        /* ══ LAYOUT ═════════════════════════════════════════ */
        .page {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 5vw 7vw;
        }

        .brand-mark {
            position: absolute;
            top: 40px;
            left: 48px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-mark img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .brand-mark span {
            font-weight: 800;
            font-size: 1rem;
            letter-spacing: .04em;
        }

        /* ══ PANNEAU FORMULAIRE (verre dépoli) ═════════════ */
        .auth-panel {
            width: 420px;
            max-width: 100%;
            backdrop-filter: blur(18px);
            background: rgba(10, 20, 15, .32);
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 20px;
            padding: 44px 40px;
            box-shadow: 0 30px 70px rgba(0, 0, 0, .35);
        }

        .auth-panel h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 2.4rem;
            margin-bottom: 6px;
            text-shadow: 0 2px 14px rgba(0, 0, 0, .3);
        }

        .auth-panel .subtitle {
            font-size: .85rem;
            color: var(--muted);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .03em;
            color: rgba(255, 255, 255, .9);
            text-transform: uppercase;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, .65);
            pointer-events: none;
        }

        .input-wrap input {
            width: 100%;
            height: 50px;
            border: 1.5px solid rgba(255, 255, 255, .28);
            background: rgba(255, 255, 255, .1);
            border-radius: 11px;
            padding: 0 44px 0 44px;
            font-size: .9rem;
            color: #fff;
            outline: none;
            transition: border-color .2s, background .2s;
        }

        .input-wrap input::placeholder {
            color: rgba(255, 255, 255, .5);
        }

        .input-wrap input:focus {
            border-color: var(--gold);
            background: rgba(255, 255, 255, .16);
        }

        .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: rgba(255, 255, 255, .65);
            padding: 4px;
            line-height: 0;
        }

        .toggle-pw:hover {
            color: var(--gold);
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 6px 0 24px;
            gap: 10px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .8rem;
            color: var(--muted);
            cursor: pointer;
            user-select: none;
        }

        .remember input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: var(--gold);
            cursor: pointer;
        }

        .options a {
            font-size: .8rem;
            color: var(--gold-light);
            font-weight: 700;
            text-decoration: none;
        }

        .options a:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 11px;
            background: linear-gradient(135deg, var(--gold) 0%, #a67e1a 100%);
            color: #10230f;
            font-size: .92rem;
            font-weight: 800;
            letter-spacing: .4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 10px 24px rgba(201, 162, 39, .35);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 32px rgba(201, 162, 39, .45);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 22px 0;
            color: var(--muted);
            font-size: .76rem;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, .22);
        }

        .btn-google {
            width: 100%;
            height: 48px;
            border-radius: 11px;
            border: 1.5px solid rgba(255, 255, 255, .3);
            background: rgba(255, 255, 255, .08);
            color: #fff;
            font-size: .85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-google:hover {
            background: rgba(255, 255, 255, .16);
        }

        .form-footer {
            text-align: center;
            font-size: .8rem;
            color: var(--muted);
            margin-top: 22px;
        }

        .form-footer a {
            color: var(--gold-light);
            font-weight: 700;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .alert-box {
            padding: 10px 14px;
            border-radius: 8px;
            font-size: .8rem;
            margin-bottom: 16px;
            font-weight: 600;
        }

        .alert-error {
            background: rgba(198, 40, 40, .25);
            border: 1px solid rgba(239, 154, 154, .5);
            color: #ffd7d7;
        }

        .alert-status {
            background: rgba(27, 94, 60, .35);
            border: 1px solid rgba(201, 162, 39, .4);
            color: #eaf7ee;
        }

        .field-error {
            color: #ffb3b3;
            font-size: .74rem;
            margin-top: 5px;
        }

        /* ══ RESPONSIVE ══════════════════════════════════ */
        @media (max-width: 900px) {
            .bg-photo::after {
                display: none;
            }

            .page {
                justify-content: center;
                padding: 8vw 6vw;
            }

            .brand-mark {
                left: 24px;
            }
        }

        @media (max-width: 480px) {
            .auth-panel {
                padding: 32px 24px;
            }

            .auth-panel h1 {
                font-size: 1.9rem;
            }
        }
    </style>
</head>

<body>

    <div class="bg-photo"></div>

    <div class="brand-mark">
        <img src="{{ asset(config('mudea.brand.logo')) }}" alt="{{ config('mudea.brand.full_name') }}"
            onerror="this.style.display='none'">
        <span>{{ config('mudea.brand.name') }}</span>
    </div>

    <div class="page">
        <div class="auth-panel">

            <h1>Connexion</h1>
            <p class="subtitle">Connectez-vous à votre espace sécurisé.</p>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                @if ($errors->has('login'))
                    <div class="alert-box alert-error">
                        {{ $errors->first('login') }}
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert-box alert-status">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <div class="input-wrap">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M4 4h16v16H4z" />
                            <polyline points="22 6 12 13 2 6" />
                        </svg>
                        <input type="email" id="email" name="email" placeholder="votre@email.com"
                            value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrap">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <button type="button" class="toggle-pw" onclick="togglePassword()" title="Afficher/Masquer">
                            <svg id="eye-icon" width="17" height="17" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="options">
                    <label class="remember">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Se souvenir de moi
                    </label>
                    <a href="#">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="btn-login">
                    Se connecter
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </button>
            </form>

            <div class="divider">ou continuer avec</div>

            <button type="button" class="btn-google" onclick="/* TODO: OAuth Google */">
                <svg width="18" height="18" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M23.49 12.27c0-.79-.07-1.54-.2-2.27H12v4.51h6.47c-.28 1.48-1.13 2.73-2.4 3.58v2.98h3.88c2.27-2.09 3.58-5.17 3.58-8.8z" />
                    <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-2.98c-1.08.72-2.45 1.16-4.05 1.16-3.13 0-5.78-2.11-6.73-4.96H1.27v3.09C3.24 21.3 7.32 24 12 24z" />
                    <path fill="#FBBC05" d="M5.27 14.31c-.24-.72-.38-1.49-.38-2.31s.14-1.59.38-2.31V6.6H1.27C.46 8.24 0 10.06 0 12s.46 3.76 1.27 5.4l4-3.09z" />
                    <path fill="#EA4335" d="M12 4.76c1.76 0 3.34.6 4.58 1.79l3.44-3.44C17.94 1.19 15.24 0 12 0 7.32 0 3.24 2.7 1.27 6.6l4 3.09C6.22 6.87 8.87 4.76 12 4.76z" />
                </svg>
                Continuer avec Google
            </button>

            <p class="form-footer">
                Pas encore membre ?
                <a href="">Créer un compte</a>
            </p>

        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
            <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
            <line x1="1" y1="1" x2="23" y2="23"/>`;
            } else {
                input.type = 'password';
                icon.innerHTML = `
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>`;
            }
        }
    </script>

</body>

</html>