<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Street 360 Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy-deep:   #0f1d3a;
            --navy-mid:    #152445;
            --navy-card:   #1a2d52;
            --navy-input:  #243460;
            --gold:        #c8922a;
            --gold-light:  #e0a83a;
            --white:       #ffffff;
            --muted:       rgba(255,255,255,0.45);
            --green:       #3a8c3f;
            --green-hover: #2e7233;
            --tab-active-bg:   #1a2d52;
            --tab-inactive-bg: #243460;
        }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--navy-deep);
            color: var(--white);
        }

        body::before {
            content: '';
            position: fixed; inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 50% -10%, rgba(200,146,42,.12) 0%, transparent 70%),
                radial-gradient(ellipse 60% 50% at 100% 100%, rgba(21,36,69,.9) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        .page-wrap {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 20px 60px;
        }

        .back-link {
            align-self: flex-start;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--white);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin: 36px 0 0 4px;
            opacity: .85;
            transition: opacity .2s;
        }
        .back-link:hover { opacity: 1; }
        .back-link svg { width: 18px; height: 18px; }

        .heading-wrap {
            text-align: center;
            margin-top: 32px;
        }
        .heading-wrap h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(28px, 7vw, 38px);
            font-weight: 700;
            color: var(--gold);
            letter-spacing: .03em;
            line-height: 1.15;
        }
        .heading-wrap p {
            margin-top: 6px;
            font-size: 14px;
            color: var(--muted);
            font-weight: 300;
        }

        .card {
            background: var(--navy-card);
            border: 1px solid rgba(200,146,42,.15);
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            margin-top: 28px;
            padding: 28px 24px 32px;
            box-shadow: 0 24px 64px rgba(0,0,0,.45);
        }

        .tab-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.1);
            margin-bottom: 28px;
        }
        .tab-btn {
            background: var(--tab-inactive-bg);
            color: var(--gold);
            border: none;
            padding: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, color .2s;
            letter-spacing: .02em;
        }
        .tab-btn.active {
            background: var(--tab-active-bg);
            color: var(--gold-light);
            box-shadow: inset 0 -2px 0 var(--gold);
        }
        .tab-btn:hover:not(.active) { background: rgba(36,52,96,.7); }

        .field + .field { margin-top: 18px; }
        .field label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 7px;
        }
        .field input {
            width: 100%;
            background: var(--navy-input);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 8px;
            padding: 13px 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--white);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .field input::placeholder { color: rgba(255,255,255,.3); }
        .field input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(200,146,42,.12);
        }

        .pw-input-wrap { position: relative; }
        .pw-input-wrap input { padding-right: 44px; }
        .pw-toggle {
            position: absolute;
            right: 13px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            color: var(--muted);
            cursor: pointer;
            padding: 4px;
            transition: color .2s;
        }
        .pw-toggle:hover { color: var(--gold); }

        .forgot-row {
            text-align: right;
            margin-top: 8px;
        }
        .forgot-row a {
            font-size: 13px;
            color: var(--muted);
            text-decoration: none;
            transition: color .2s;
        }
        .forgot-row a:hover { color: var(--gold); }

        .btn-submit {
            display: block;
            width: 100%;
            margin-top: 28px;
            background: var(--green);
            border: none;
            border-radius: 9px;
            padding: 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: #fff;
            cursor: pointer;
            transition: background .2s, transform .1s, box-shadow .2s;
            box-shadow: 0 4px 18px rgba(58,140,63,.3);
        }
        .btn-submit:hover {
            background: var(--green-hover);
            box-shadow: 0 6px 24px rgba(58,140,63,.45);
        }
        .btn-submit:active { transform: scale(.98); }

        .alert-error {
            background: rgba(200,50,50,.15);
            border: 1px solid rgba(200,50,50,.35);
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 13px;
            color: #f97676;
            margin-bottom: 20px;
        }

        .coffee-icon {
            display: block;
            width: 38px; height: 38px;
            margin: 0 auto 18px;
            opacity: .55;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(22px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card         { animation: fadeUp .45s ease both; }
        .heading-wrap { animation: fadeUp .35s ease both; }
        .back-link    { animation: fadeUp .25s ease both; }
    </style>
</head>
<body>
<div class="page-wrap">

    <a href="{{ route('home') }}" class="back-link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        Kembali Ke Website
    </a>

    <div class="heading-wrap">
        <h1>Selamat Datang</h1>
        <p>Masuk ke sistem Street 360 Coffee</p>
    </div>

    <div class="card">

        <svg class="coffee-icon" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 22h36l-4 26H14L10 22Z" stroke="#c8922a" stroke-width="2.5" stroke-linejoin="round"/>
            <path d="M46 26h4a6 6 0 0 1 0 12h-4" stroke="#c8922a" stroke-width="2.5" stroke-linecap="round"/>
            <path d="M22 14c0-4 4-4 4-8" stroke="#c8922a" stroke-width="2" stroke-linecap="round"/>
            <path d="M30 14c0-4 4-4 4-8" stroke="#c8922a" stroke-width="2" stroke-linecap="round"/>
        </svg>

        <div class="tab-row">
            <button class="tab-btn active" data-role="admin" onclick="switchRole(this)">Admin</button>
            <button class="tab-btn"        data-role="kasir" onclick="switchRole(this)">Kasir</button>
        </div>

        @if ($errors->any() || session('error'))
        <div class="alert-error">
            {{ $errors->first() ?: session('error') }}
        </div>
        @endif

        {{-- ✅ Sudah diperbaiki: login.post → login --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="role" id="roleInput" value="admin">

            <div class="field">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Masukkan username"
                    value="{{ old('username') }}"
                    autocomplete="username"
                    required
                >
            </div>

            <div class="field">
                <label for="password">Password</label>
                <div class="pw-input-wrap">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >
                    <button type="button" class="pw-toggle" onclick="togglePw()" aria-label="Tampilkan password">
                        <svg id="eyeIcon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="forgot-row">
                <a href="{{ route('password.forgot') }}">Lupa Password</a>
            </div>

            <button type="submit" class="btn-submit">MASUK</button>
        </form>

    </div>
</div>

<script>
    const roleInput = document.getElementById('roleInput');

    function switchRole(btn) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        roleInput.value = btn.dataset.role;
    }

    function togglePw() {
        const pw   = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        const isHidden = pw.type === 'password';
        pw.type = isHidden ? 'text' : 'password';
        icon.innerHTML = isHidden
            ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`
            : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
    }
</script>
</body>
</html>