<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Street 360.coffee</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --navy: #1a2340;
            --navy-deep: #111827;
            --navy-mid: #1e2d6b;
            --gold: #d4a843;
            --gold-light: #e8c068;
            --white: #ffffff;
            --gray: rgba(255,255,255,0.08);
            --border: rgba(255,255,255,0.12);
            --text-muted: rgba(255,255,255,0.5);
            --font: 'Poppins', sans-serif;
        }

        html, body {
            height: 100%;
            font-family: var(--font);
            background: var(--navy-deep);
            color: var(--white);
            overflow-x: hidden;
        }

        /* ── BACKGROUND ── */
        .bg-wrap {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }
        .bg-wrap::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #0d1525 0%, #1a2340 45%, #1e2d6b 100%);
        }
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.18;
        }
        .bg-circle-1 { width: 500px; height: 500px; background: var(--gold); top: -150px; right: -100px; }
        .bg-circle-2 { width: 400px; height: 400px; background: #2e4080; bottom: -120px; left: -80px; }
        .bg-text {
            position: absolute;
            bottom: -60px;
            right: -40px;
            font-size: clamp(180px, 25vw, 320px);
            font-weight: 900;
            color: rgba(255,255,255,0.03);
            line-height: 1;
            user-select: none;
            pointer-events: none;
            letter-spacing: -10px;
        }
        .bg-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* ── LAYOUT ── */
        .page {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── TOP BAR ── */
        .top-bar {
            padding: 24px 6%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        .brand {
            text-decoration: none;
            line-height: 1.1;
        }
        .brand-top    { display: block; font-size: 18px; font-weight: 900; color: var(--white); }
        .brand-accent { display: block; font-size: 16px; font-weight: 700; color: var(--gold); }
        .back-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: color .2s;
        }
        .back-link:hover { color: var(--white); }
        .back-arrow { font-size: 16px; }

        /* ── MAIN ── */
        .main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 6%;
        }

        /* ── CARD ── */
        .card {
            width: 100%;
            max-width: 440px;
            animation: cardUp 0.7s cubic-bezier(0.34,1.3,0.64,1) both;
        }

        @keyframes cardUp {
            from { opacity: 0; transform: translateY(40px) scale(0.96); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* ── LOGO ── */
        .logo-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 28px;
            animation: fadeDown 0.6s ease both;
        }
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .logo-circle {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: rgba(212,168,67,0.12);
            border: 2px solid rgba(212,168,67,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo-circle svg { width: 44px; height: 44px; }

        /* ── HEADER ── */
        .card-header {
            text-align: center;
            margin-bottom: 28px;
            animation: fadeUp 0.6s 0.1s ease both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card-header h1 {
            font-size: 28px;
            font-weight: 900;
            color: var(--white);
            margin-bottom: 6px;
        }
        .card-header p {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ── ROLE TABS ── */
        .role-tabs {
            display: flex;
            background: rgba(0,0,0,0.25);
            border-radius: 10px;
            padding: 4px;
            margin-bottom: 28px;
            border: 1px solid var(--border);
            animation: fadeUp 0.6s 0.2s ease both;
        }
        .role-tab {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            border: none;
            background: transparent;
            color: var(--text-muted);
            font-family: var(--font);
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all .25s;
            text-align: center;
        }
        .role-tab.active {
            background: var(--navy-mid);
            color: var(--gold);
            box-shadow: 0 2px 12px rgba(0,0,0,0.3);
        }
        .role-tab-sub {
            display: block;
            font-size: 10px;
            font-weight: 500;
            opacity: 0.7;
            margin-top: 2px;
        }

        /* ── FORM PANEL ── */
        .form-panel {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px 24px;
            backdrop-filter: blur(12px);
            animation: fadeUp 0.6s 0.3s ease both;
        }

        /* Role indicator */
        .role-indicator {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(212,168,67,0.08);
            border: 1px solid rgba(212,168,67,0.2);
            border-radius: 10px;
            margin-bottom: 22px;
        }
        .role-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }
        .role-info-name  { font-size: 13px; font-weight: 700; color: var(--gold); }
        .role-info-desc  { font-size: 11px; color: var(--text-muted); }

        /* Fields */
        .field { margin-bottom: 18px; }
        .field-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .field-input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(0,0,0,0.25);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            color: var(--white);
            font-family: var(--font);
            font-size: 14px;
            font-weight: 500;
            outline: none;
            transition: border-color .2s, background .2s;
        }
        .field-input::placeholder { color: rgba(255,255,255,0.25); }
        .field-input:focus {
            border-color: var(--gold);
            background: rgba(212,168,67,0.05);
        }

        /* Password wrap */
        .pw-wrap { position: relative; }
        .pw-wrap .field-input { padding-right: 48px; }
        .pw-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 16px;
            padding: 4px;
            transition: color .2s;
        }
        .pw-toggle:hover { color: var(--gold); }

        /* Forgot */
        .forgot-row {
            display: flex;
            justify-content: flex-end;
            margin-top: -8px;
            margin-bottom: 22px;
        }
        .forgot-link {
            font-size: 12px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            transition: color .2s;
        }
        .forgot-link:hover { color: var(--gold); }

        /* Submit */
        .btn-submit {
            width: 100%;
            padding: 16px;
            background: var(--gold);
            color: var(--navy-deep);
            font-family: var(--font);
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: opacity .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 4px 20px rgba(212,168,67,0.3);
            position: relative;
            overflow: hidden;
        }
        .btn-submit::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15) 0%, transparent 60%);
            pointer-events: none;
        }
        .btn-submit:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(212,168,67,0.45);
        }
        .btn-submit:active { transform: scale(0.98); }

        /* ── SECURITY NOTE ── */
        .security-note {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            border-radius: 10px;
            margin-top: 20px;
            animation: fadeUp 0.6s 0.45s ease both;
        }
        .security-icon { font-size: 16px; flex-shrink: 0; }
        .security-text { font-size: 11px; color: var(--text-muted); line-height: 1.5; }
        .security-text strong { color: rgba(255,255,255,0.6); }

        /* ── FOOTER ── */
        .page-footer {
            text-align: center;
            padding: 14px 6%;
            font-size: 11px;
            color: var(--text-muted);
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1;
        }

        /* ── ALERT ── */
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 16px;
            display: none;
        }
        .alert.show { display: flex; align-items: center; gap: 10px; }
        .alert-error   { background: rgba(220,50,50,0.15); border: 1px solid rgba(220,50,50,0.3); color: #ff8080; }
        .alert-success { background: rgba(50,200,100,0.15); border: 1px solid rgba(50,200,100,0.3); color: #80e0a0; }

        /* ── RESPONSIVE ── */
        @media (max-width: 480px) {
            .top-bar { padding: 18px 5%; }
            .main { padding: 10px 5% 20px; }
            .form-panel { padding: 22px 18px; }
            .card-header h1 { font-size: 24px; }
        }

        @keyframes shake {
            0%,100% { transform: translateX(0); }
            20%,60%  { transform: translateX(-6px); }
            40%,80%  { transform: translateX(6px); }
        }
    </style>
</head>
<body>

<div class="bg-wrap">
    <div class="bg-grid"></div>
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-text">360</div>
</div>

<div class="page">

    <!-- TOP BAR -->
    <div class="top-bar">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-top">Street</span>
            <span class="brand-accent">360.coffee</span>
        </a>
        <a href="{{ route('home') }}" class="back-link">
            <span class="back-arrow">←</span> Kembali ke Website
        </a>
    </div>

    <!-- MAIN -->
    <div class="main">
        <div class="card">

            <!-- LOGO -->
            <div class="logo-wrap">
                <div class="logo-circle">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="100" cy="100" r="85" fill="rgba(220,222,230,0.15)"/>
                        <path d="M 38 75 Q 25 100 38 125" stroke="#d4a843" stroke-width="9" fill="none" stroke-linecap="round"/>
                        <polygon points="38,72 30,82 46,82" fill="#d4a843"/>
                        <path d="M 162 75 Q 175 100 162 125" stroke="#d4a843" stroke-width="9" fill="none" stroke-linecap="round"/>
                        <polygon points="162,128 154,118 170,118" fill="#d4a843"/>
                        <text x="100" y="108" text-anchor="middle" font-family="Poppins,sans-serif" font-size="38" font-weight="900" fill="#d4a843">360</text>
                        <text x="100" y="138" text-anchor="middle" font-family="Poppins,sans-serif" font-size="20" font-weight="700" fill="rgba(255,255,255,0.8)">Coffee</text>
                    </svg>
                </div>
            </div>

            <!-- HEADER -->
            <div class="card-header">
                <h1>Selamat Datang</h1>
                <p>Masuk ke sistem Street 360 Coffee</p>
            </div>

            <!-- ROLE TABS -->
            <div class="role-tabs">
                <button class="role-tab active" id="tab-admin" onclick="switchRole('admin')">
                    Admin
                    <span class="role-tab-sub">Dashboard & Laporan</span>
                </button>
                <button class="role-tab" id="tab-kasir" onclick="switchRole('kasir')">
                    Kasir
                    <span class="role-tab-sub">Point of Sale</span>
                </button>
            </div>

            <!-- FORM PANEL -->
            <div class="form-panel">

                <!-- Role indicator -->
                <div class="role-indicator" id="roleIndicator">
                    <div class="role-icon" id="roleIcon">🛡️</div>
                    <div>
                        <div class="role-info-name" id="roleName">Mode: Administrator</div>
                        <div class="role-info-desc" id="roleDesc">Akses penuh ke seluruh fitur sistem</div>
                    </div>
                </div>

                <!-- Alert -->
                <div class="alert alert-error" id="alertBox">
                    <span>⚠️</span>
                    <span id="alertMsg">Username atau password salah.</span>
                </div>

                @if(session('error'))
                <div class="alert alert-error show">
                    <span>⚠️</span>
                    <span>{{ session('error') }}</span>
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success show">
                    <span>✓</span>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                <!-- FORM -->
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    <input type="hidden" name="role" id="roleInput" value="admin">

                    <div class="field">
                        <label class="field-label" for="username">Username</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="field-input"
                            placeholder="Masukkan Username"
                            autocomplete="username"
                            required
                            value="{{ old('username') }}"
                        >
                        @error('username')
                            <span style="font-size:11px;color:#ff8080;margin-top:4px;display:block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="field-label" for="password">Password</label>
                        <div class="pw-wrap">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="field-input"
                                placeholder="Masukkan Password"
                                autocomplete="current-password"
                                required
                            >
                            <button type="button" class="pw-toggle" onclick="togglePassword()" title="Tampilkan password">
                                <span id="pwIcon">👁</span>
                            </button>
                        </div>
                        @error('password')
                            <span style="font-size:11px;color:#ff8080;margin-top:4px;display:block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="forgot-row">
                        <a href="#" class="forgot-link">Lupa Password?</a>
                    </div>

                    <button type="submit" class="btn-submit" id="btnSubmit">
                        MASUK
                    </button>
                </form>

            </div>

            <!-- Security Note -->
            <div class="security-note">
                <span class="security-icon">🔒</span>
                <p class="security-text">
                    <strong>Area Khusus Staff.</strong> Halaman ini hanya untuk Admin dan Kasir Street 360 Coffee. Pengunjung tidak dapat login.
                </p>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <div class="page-footer">
        © 2025 Street 360 Coffee · Waru, Penajam Paser Utara
    </div>

</div>

<script>
    let currentRole = 'admin';

    function switchRole(role) {
        currentRole = role;
        const tabAdmin = document.getElementById('tab-admin');
        const tabKasir = document.getElementById('tab-kasir');
        const roleInput = document.getElementById('roleInput');
        const roleIcon  = document.getElementById('roleIcon');
        const roleName  = document.getElementById('roleName');
        const roleDesc  = document.getElementById('roleDesc');

        tabAdmin.classList.toggle('active', role === 'admin');
        tabKasir.classList.toggle('active', role === 'kasir');
        roleInput.value = role;

        if (role === 'admin') {
            roleIcon.textContent = '🛡️';
            roleName.textContent = 'Mode: Administrator';
            roleDesc.textContent = 'Akses penuh ke seluruh fitur sistem';
        } else {
            roleIcon.textContent = '🧾';
            roleName.textContent = 'Mode: Kasir';
            roleDesc.textContent = 'Akses Point of Sale & Antrian Pesanan';
        }
    }

    function togglePassword() {
        const pw = document.getElementById('password');
        const icon = document.getElementById('pwIcon');
        if (pw.type === 'password') {
            pw.type = 'text';
            icon.textContent = '🙈';
        } else {
            pw.type = 'password';
            icon.textContent = '👁';
        }
    }

    @if($errors->any())
    document.getElementById('loginForm').style.animation = 'shake 0.4s ease';
    @endif
</script>

</body>
</html>