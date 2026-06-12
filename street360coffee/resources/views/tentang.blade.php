<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang — Street 360.coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --navy: #1a2340;
            --gold: #d4a843;
            --white: #ffffff;
            --light: #f0f0eb;
            --text: #1a1a1a;
            --font: 'Poppins', sans-serif;
        }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font); color: var(--text); background: var(--white); margin: 0; overflow-x: hidden; }

        /* NAVBAR */
        .navbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 32px; background: var(--navy);
            position: sticky; top: 0; z-index: 100;
        }
        .navbar-brand {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .brand-top    { font-size: 16px; font-weight: 800; color: var(--white); }
        .brand-dot    { font-size: 16px; font-weight: 800; color: var(--white); }
        .brand-accent { font-size: 16px; font-weight: 800; color: var(--gold); }
        .navbar-menu  { display: flex; list-style: none; gap: 40px; }
        .navbar-menu a { color: var(--white); text-decoration: none; font-size: 15px; font-weight: 600; transition: color .2s; }
        .navbar-menu a:hover, .navbar-menu a.active { color: var(--gold); }
        .btn-login {
            background: var(--gold); color: var(--navy); font-size: 14px; font-weight: 700;
            padding: 10px 28px; border-radius: 30px; text-decoration: none; transition: opacity .2s;
        }
        .btn-login:hover { opacity: 0.85; }

        /* HERO ABOUT */
        .about-hero {
            background: var(--navy);
            padding: 80px 8% 70px;
            position: relative;
            overflow: hidden;
        }
        .about-hero-bg {
            position: absolute;
            right: 4%;
            top: 50%;
            transform: translateY(-50%);
            font-size: clamp(100px, 18vw, 220px);
            font-weight: 900;
            color: rgba(255,255,255,0.05);
            letter-spacing: -10px;
            pointer-events: none;
            user-select: none;
            line-height: 1;
        }
        .about-label { font-size: 12px; font-weight: 700; color: var(--gold); letter-spacing: 2.5px; text-transform: uppercase; margin-bottom: 14px; }
        .about-title { font-size: clamp(32px, 5vw, 60px); font-weight: 900; color: var(--white); line-height: 1.15; margin-bottom: 24px; }
        .about-title .accent { color: var(--gold); }
        .about-tagline { font-size: clamp(14px, 1.5vw, 16px); color: rgba(255,255,255,0.75); line-height: 1.8; max-width: 520px; }

        /* STATS BAR */
        .stats-bar {
            background: var(--navy);
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex; align-items: stretch;
        }
        .stat-item { flex: 1; text-align: center; padding: 32px 20px; }
        .stat-number { font-size: clamp(26px, 3vw, 40px); font-weight: 900; color: var(--white); margin-bottom: 6px; }
        .stat-label  { font-size: 11px; font-weight: 700; color: var(--gold); letter-spacing: 2px; text-transform: uppercase; }
        .stat-divider { width: 1px; background: rgba(255,255,255,0.12); }

        /* SECTION SHARED */
        .section { padding: 70px 8%; }
        .section-tag {
            display: flex; align-items: center; gap: 16px;
            font-size: 11px; font-weight: 700; color: #aaa;
            letter-spacing: 2px; text-transform: uppercase;
            margin-bottom: 32px;
        }
        .section-tag::after { content: ''; flex: 1; height: 1px; background: #e0e0e0; }

        /* CERITA KAMI */
        .cerita-section { background: var(--light); }
        .cerita-card {
            background: var(--white);
            border-radius: 16px;
            padding: 36px;
            border-left: 4px solid var(--gold);
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        }
        .cerita-card p { font-size: 14px; color: #555; line-height: 1.85; font-style: italic; }
        .cerita-card p + p { margin-top: 16px; }

        /* OWNER */
        .owner-card {
            background: var(--navy);
            border-radius: 16px;
            padding: 28px 32px;
            margin-top: 28px;
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }
        .owner-avatar {
            width: 52px; height: 52px; border-radius: 50%;
            background: var(--gold);
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; font-weight: 800; color: var(--navy);
            flex-shrink: 0;
        }
        .owner-info { flex: 1; }
        .owner-name  { font-size: 16px; font-weight: 700; color: var(--white); margin-bottom: 2px; }
        .owner-role  { font-size: 12px; color: var(--gold); font-weight: 600; margin-bottom: 14px; }
        .owner-divider { height: 1px; background: rgba(255,255,255,0.15); margin-bottom: 14px; }
        .owner-quote { font-size: 13px; color: rgba(255,255,255,0.8); line-height: 1.7; font-style: italic; }

        /* TIM */
        .tim-section { background: var(--white); }
        .tim-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }

        .tim-card {
            background: var(--navy);
            border-radius: 16px;
            padding: 28px 24px;
            text-align: center;
        }
        .tim-avatar {
            width: 56px; height: 56px; border-radius: 50%;
            background: var(--gold);
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 800; color: var(--navy);
            margin: 0 auto 14px;
        }
        .tim-initial { font-size: 18px; font-weight: 900; }
        .tim-name  { font-size: 16px; font-weight: 700; color: var(--gold); margin-bottom: 4px; }
        .tim-role  { font-size: 13px; font-weight: 600; color: var(--gold); margin-bottom: 14px; opacity: 0.8; }
        .tim-divider { height: 1px; background: rgba(255,255,255,0.15); margin-bottom: 14px; }
        .tim-desc  { font-size: 12px; color: rgba(255,255,255,0.7); line-height: 1.65; }

        /* MISI */
        .misi-section { background: var(--light); }
        .misi-card {
            background: var(--navy);
            border-radius: 16px;
            padding: 36px;
        }
        .misi-header { margin-bottom: 28px; }
        .misi-sub  { font-size: 13px; color: var(--gold); font-weight: 600; margin-bottom: 6px; }
        .misi-title { font-size: clamp(22px, 3vw, 32px); font-weight: 800; color: var(--white); line-height: 1.3; }
        .misi-title .accent { color: var(--gold); }
        .misi-list { display: flex; flex-direction: column; gap: 18px; }
        .misi-item { display: flex; align-items: flex-start; gap: 16px; }
        .misi-num {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--gold);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 800; color: var(--navy);
            flex-shrink: 0; margin-top: 2px;
        }
        .misi-text { font-size: 13px; color: rgba(255,255,255,0.8); line-height: 1.7; }

        /* KEUNGGULAN */
        .keunggulan-section { background: var(--white); }
        .keunggulan-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
        @media (min-width: 1024px) { .keunggulan-grid { grid-template-columns: repeat(4, 1fr); } }

        .keunggulan-card {
            background: var(--light);
            border-radius: 14px;
            padding: 24px 20px;
            border-top: 3px solid transparent;
            transition: border-color .2s, transform .2s;
        }
        .keunggulan-card:hover { border-color: var(--gold); transform: translateY(-3px); }
        .keunggulan-title { font-size: 15px; font-weight: 700; color: var(--text); margin-bottom: 8px; }
        .keunggulan-desc  { font-size: 12px; color: #888; line-height: 1.65; }

        /* FOOTER */
        .footer { background: var(--light); text-align: center; padding: 30px 8%; border-top: 1px solid #ddd; }
        .footer p { font-size: 12px; color: #999; line-height: 1.8; }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar { padding: 12px 20px; }
            .navbar-menu { gap: 16px; }
            .navbar-menu a { font-size: 13px; }
            .about-hero { padding: 50px 5% 50px; }
            .stats-bar { flex-wrap: wrap; }
            .stat-item { flex: 1 1 30%; }
            .section { padding: 50px 5%; }
            .tim-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 480px) { .navbar-menu { display: none; } }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ route('home') }}" class="navbar-brand">
            <span class="brand-top">Street</span>
            <span class="brand-dot">360.</span><span class="brand-accent">coffee</span>
        </a>
        <ul class="navbar-menu">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('menu.index') }}">Menu</a></li>
            <li><a href="{{ route('tentang') }}" class="active">Tentang</a></li>
            <li><a href="{{ route('lokasi') }}">Lokasi</a></li>
        </ul>
        <a href="{{ route('login') }}" class="btn-login">LOGIN</a>
    </nav>

    <section class="about-hero">
        <div class="about-hero-bg">360</div>
        <p class="about-label">SIAPA KAMI</p>
        <h1 class="about-title">Pelopor<br>digital di <span class="accent">Waru.</span></h1>
        <p class="about-tagline">Street 360Coffee hadir bukan sekadar untuk menyajikan kopi — tapi untuk membuktikan bahwa UMKM lokal bisa bertumbuh dengan cara yang modern</p>
    </section>

    <div class="stats-bar">
        <div class="stat-item">
            <p class="stat-number">15 +</p>
            <p class="stat-label">MENU PILIHAN</p>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <p class="stat-number">2025</p>
            <p class="stat-label">BERDIRI SEJAK</p>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <p class="stat-number">100%</p>
            <p class="stat-label">KOPI LOKAL</p>
        </div>
    </div>

    <section class="section cerita-section">
        <div class="section-tag">CERITA KAMI</div>
        <div class="cerita-card">
            <p>Street 360Coffee berdiri tahun 2025 di Waru, Kalimantan Timur. Kami hadir sebagai coffeeShop yang fokus menjadikan kopi berkualitas, tapi juga menjadi pelopor digitalisasi UMKM kuliner di kawasan ini.</p>
            <p>Semua kopi kami bersumber dari petani lokal  pilihan — diolah dengan standar tinggi untuk menghadirkan cita rasa yang konsisten di setiap cangkir.</p>
        </div>
        <div class="owner-card">
            <div class="owner-avatar">MR</div>
            <div class="owner-info">
                <p class="owner-name">M.Rangga</p>
                <p class="owner-role">Owner &nbsp;·&nbsp; Waru, Penajam Paser Utara</p>
                <div class="owner-divider"></div>
                <p class="owner-quote">"Street 360 Coffee dibangun dengan semangat menghadirkan tempat ngopi yang nyaman"</p>
            </div>
        </div>
    </section>

    <section class="section tim-section">
        <div class="section-tag">TIM &amp; PATNER KERJA</div>
        <div class="tim-grid">
            <div class="tim-card">
                <div class="tim-avatar"><span class="tim-initial">MR</span></div>
                <p class="tim-name">M. Rangga</p>
                <p class="tim-role">Admin &amp; Barista</p>
                <div class="tim-divider"></div>
                <p class="tim-desc">Kami menyajikan berbagai pilihan kopi dengan cita rasa yang pas dan suasana yang nyaman</p>
            </div>
            <div class="tim-card">
                <div class="tim-avatar"><span class="tim-initial">GE</span></div>
                <p class="tim-name">Gadis.E</p>
                <p class="tim-role">Kasir &amp; Pelayanan</p>
                <div class="tim-divider"></div>
                <p class="tim-desc">Kami memastikan pengalaman berkunjung yang menyenangkan dan mudah agar pelanggan tidak kecewa.</p>
            </div>
        </div>
    </section>

    <section class="section misi-section">
        <div class="section-tag">MISI KAMI</div>
        <div class="misi-card">
            <div class="misi-header">
                <p class="misi-sub">Mengapa kami ada</p>
                <h2 class="misi-title">Lebih dari<br>sekadar <span class="accent">kopi</span></h2>
            </div>
            <div class="misi-list">
                <div class="misi-item">
                    <div class="misi-num">01</div>
                    <p class="misi-text">Kami ingin menghadirkan tempat ngopi yang nyaman dan bisa dinikmati oleh semua kalangan.</p>
                </div>
                <div class="misi-item">
                    <div class="misi-num">02</div>
                    <p class="misi-text">Kami menyajikan kopi berkualitas dengan harga yang terjangkau agar semua pelanggan bisa menikmati kopi yang enak.</p>
                </div>
                <div class="misi-item">
                    <div class="misi-num">03</div>
                    <p class="misi-text">Kami berusaha mengembangkan usaha lokal agar bisa terus maju dan dikenal lebih luas.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section keunggulan-section">
        <div class="section-tag">KEUNGGULAN KAMI</div>
        <div class="keunggulan-grid">
            <div class="keunggulan-card">
                <p class="keunggulan-title">Menu Digital</p>
                <p class="keunggulan-desc">Informasi menu tersedia online, mudah diakses kapan saja.</p>
            </div>
            <div class="keunggulan-card">
                <p class="keunggulan-title">Stok Real-time</p>
                <p class="keunggulan-desc">Menu yang habis langsung diperbarui otomatis.</p>
            </div>
            <div class="keunggulan-card">
                <p class="keunggulan-title">Tunai &amp; QRIS</p>
                <p class="keunggulan-desc">Bayar mudah dengan berbagai metode pembayaran pilihan kamu.</p>
            </div>
            <div class="keunggulan-card">
                <p class="keunggulan-title">Kopi Lokal</p>
                <p class="keunggulan-desc">Biji kopi pilihan dari petani terbaik.</p>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p>Waru, Penajam Paser Utara · Kalimantan Timur</p>
        <p>© 2025 Street 360 Coffee. All rights reserved.</p>
    </footer>

</body>
</html>