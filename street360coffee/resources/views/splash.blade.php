<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street 360.coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --navy: #1e2d6b;
            --gold: #d4a843;
            --white: #ffffff;
            --font: 'Poppins', sans-serif;
        }

        html, body {
            height: 100%;
            font-family: var(--font);
            background: var(--navy);
            color: var(--white);
            overflow: auto; /* FIXED: dari hidden ke auto */
        }

        .splash {
            min-height: 100vh;
            min-height: 100dvh; /* FIXED: support mobile browser bar */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: clamp(20px, 4vh, 40px) 32px; /* FIXED: responsif */
            text-align: center;
            gap: 0;
        }

        /* ===== LOGO ===== */
        .logo-wrap {
            width: clamp(120px, 20vh, 180px);   /* FIXED: responsif terhadap tinggi layar */
            height: clamp(120px, 20vh, 180px);
            margin-bottom: clamp(20px, 4vh, 50px); /* FIXED: margin responsif */
            animation: fadeDown 0.8s ease both;
        }

        .logo-wrap svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 8px 24px rgba(0,0,0,0.35));
        }

        /* ===== SELAMAT DATANG ===== */
        .welcome-row {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: clamp(10px, 2vh, 16px); /* FIXED */
            animation: fadeUp 0.8s 0.2s ease both;
        }
        .welcome-line { flex: 1; height: 1.5px; background: var(--gold); max-width: 70px; }
        .welcome-text { font-size: 13px; font-weight: 600; color: var(--gold); letter-spacing: 3px; text-transform: uppercase; }

        /* ===== BRAND ===== */
        .brand {
            animation: fadeUp 0.8s 0.35s ease both;
            margin-bottom: clamp(10px, 2vh, 18px); /* FIXED */
            line-height: 1;
        }
        .brand-street {
            display: block;
            font-size: clamp(36px, 8vw, 56px);
            font-weight: 900;
            color: var(--white);
            letter-spacing: 4px;
            text-transform: uppercase;
        }
        .brand-360 {
            display: block;
            font-size: clamp(40px, 9vw, 62px);
            font-weight: 900;
            color: var(--gold);
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        /* ===== TAGLINE ===== */
        .tagline {
            font-size: clamp(13px, 3.5vw, 16px);
            font-weight: 500;
            color: rgba(255,255,255,0.85);
            line-height: 1.6;
            max-width: 320px;
            margin-bottom: clamp(16px, 3vh, 36px); /* FIXED */
            animation: fadeUp 0.8s 0.5s ease both;
        }

        /* ===== DIVIDER ===== */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: clamp(20px, 4vh, 44px); /* FIXED */
            width: 100%;
            max-width: 320px;
            animation: fadeUp 0.8s 0.6s ease both;
        }
        .divider-line { flex: 1; height: 1.5px; background: var(--gold); }
        .divider-dot {
            width: 10px; height: 10px;
            background: var(--gold);
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* ===== BUTTON ===== */
        .btn-wrap {
            width: 100%;
            max-width: 380px;
            animation: fadeUp 0.8s 0.75s ease both;
        }

        .btn-start {
            display: block;
            width: 100%;
            padding: 22px;
            background: var(--gold);
            color: var(--navy);
            font-family: var(--font);
            font-size: 18px;
            font-weight: 900;
            letter-spacing: 3px;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 18px;
            transition: transform .2s, box-shadow .2s, opacity .2s;
            box-shadow: 0 6px 24px rgba(212,168,67,0.35);
        }
        .btn-start:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 32px rgba(212,168,67,0.5);
            opacity: 0.92;
        }
        .btn-start:active { transform: scale(0.98); }

        .tap-text {
            font-size: 14px;
            font-weight: 500;
            color: rgba(255,255,255,0.55);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .tap-arrow {
            display: inline-block;
            animation: slideRight 1.2s ease-in-out infinite;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideRight {
            0%, 100% { transform: translateX(0); }
            50%       { transform: translateX(6px); }
        }

        /* Desktop */
        @media (min-width: 768px) {
            .logo-wrap { 
                width: clamp(160px, 22vh, 220px); 
                height: clamp(160px, 22vh, 220px); 
            }
        }
    </style>
</head>
<body>

<div class="splash">

    {{-- LOGO SVG --}}
    <div class="logo-wrap">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <!-- Lingkaran luar -->
            <circle cx="100" cy="100" r="95" fill="#e8e8e8" opacity="0.15"/>
            <circle cx="100" cy="100" r="90" fill="#d0d0d0" opacity="0.2"/>

            <!-- Background lingkaran putih -->
            <circle cx="100" cy="100" r="85" fill="rgba(220,222,230,0.95)"/>

            <!-- Panah kiri (melengkung) -->
            <path d="M 38 75 Q 25 100 38 125" stroke="#1e2d6b" stroke-width="9" fill="none" stroke-linecap="round"/>
            <polygon points="38,72 30,82 46,82" fill="#1e2d6b"/>

            <!-- Panah kanan (melengkung) -->
            <path d="M 162 75 Q 175 100 162 125" stroke="#1e2d6b" stroke-width="9" fill="none" stroke-linecap="round"/>
            <polygon points="162,128 154,118 170,118" fill="#1e2d6b"/>

            <!-- Teks 360 -->
            <text x="100" y="108" text-anchor="middle" font-family="Poppins, sans-serif" font-size="38" font-weight="900" fill="#1e2d6b">360</text>
            <!-- Superscript o -->
            <text x="148" y="86" text-anchor="middle" font-family="Poppins, sans-serif" font-size="16" font-weight="700" fill="#1e2d6b">°</text>
            <!-- Teks Coffee -->
            <text x="100" y="138" text-anchor="middle" font-family="Poppins, sans-serif" font-size="20" font-weight="700" fill="#1e2d6b">Coffee</text>

            <!-- Lingkaran dekoratif dalam -->
            <circle cx="100" cy="100" r="85" fill="none" stroke="#1e2d6b" stroke-width="3" opacity="0.15"/>
        </svg>
    </div>

    {{-- SELAMAT DATANG --}}
    <div class="welcome-row">
        <span class="welcome-line"></span>
        <span class="welcome-text">Selamat Datang</span>
        <span class="welcome-line"></span>
    </div>

    {{-- BRAND --}}
    <div class="brand">
        <span class="brand-street">STREET</span>
        <span class="brand-360">360.COFFEE</span>
    </div>

    {{-- TAGLINE --}}
    <p class="tagline">Menyajikan kopi lokal dengan rasa yang nikmat sejak 2025</p>

    {{-- DIVIDER --}}
    <div class="divider">
        <span class="divider-line"></span>
        <span class="divider-dot"></span>
        <span class="divider-line"></span>
    </div>

    {{-- TOMBOL --}}
    <div class="btn-wrap">
        <a href="{{ route('home') }}" class="btn-start">GET STARTED</a>
        <p class="tap-text">
            Tap Untuk Masuk
            <span class="tap-arrow">→</span>
        </p>
    </div>

</div>

</body>
</html>