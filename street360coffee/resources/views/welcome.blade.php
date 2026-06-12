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
            --navy: #1a2340;
            --gold: #d4a843;
            --white: #ffffff;
            --light: #f5f5f0;
            --text: #1a1a1a;
            --font: 'Poppins', sans-serif;
        }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font); color: var(--text); background: var(--white); overflow-x: hidden; }

        /* ══ NAVBAR ══ */
        .navbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 32px; background: var(--navy);
            position: sticky; top: 0; z-index: 100;
        }
        .navbar-brand { text-decoration: none; display: flex; align-items: center; gap: 6px; }
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

        /* ══ HERO ══ */
        .hero {
            position: relative;
            min-height: 520px;
            background: #b5b8b4;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 60px 6% 0;
        }
        .hero-beans {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            mix-blend-mode: screen;
            opacity: 0.85;
            pointer-events: none;
            z-index: 1;
        }
        .hero-content {
            flex: 1;
            max-width: 50%;
            z-index: 3;
            position: relative;
            padding-top: 10px;
        }
        .hero-label {
            display: flex; align-items: center; gap: 10px;
            font-size: 15px; font-weight: 600; color: #333;
            letter-spacing: 0.5px; margin-bottom: 16px;
        }
        .label-line { display: inline-block; width: 36px; height: 2px; background: var(--gold); flex-shrink: 0; }
        .hero-title { font-size: clamp(36px, 5vw, 64px); font-weight: 900; line-height: 1.1; color: var(--text); margin-bottom: 6px; }
        .hero-accent { color: var(--gold); }
        .hero-desc { font-size: clamp(14px, 1.3vw, 17px); color: #333; line-height: 1.7; margin-top: 16px; max-width: 460px; }
        .hero-right {
            position: absolute;
            right: 4%;
            bottom: 0;
            width: clamp(220px, 32%, 430px);
            height: 100%;
            z-index: 2;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }
        .hero-cup {
            width: 100%;
            max-height: 110%;
            object-fit: contain;
            object-position: bottom center;
            mix-blend-mode: screen;
            display: block;
        }

        /* ══ INFO BAR ══ */
        .info-bar { background: var(--navy); display: flex; align-items: stretch; }
        .info-item { text-align: center; flex: 1; padding: 36px 20px; }
        .info-label { font-size: 13px; font-weight: 700; color: var(--gold); letter-spacing: 2px; text-transform: uppercase; margin-bottom: 8px; }
        .info-value { font-size: 20px; font-weight: 700; color: var(--white); line-height: 1.4; }
        .info-divider { width: 1px; background: rgba(255,255,255,0.15); }

        /* ══ MENU SECTION ══ */
        .menu-section { background: var(--light); padding: 80px 6%; }
        .section-label {
            display: flex; align-items: center; gap: 10px;
            font-size: 13px; font-weight: 700; color: #888;
            letter-spacing: 2px; text-transform: uppercase; margin-bottom: 10px;
        }
        .section-title { font-size: clamp(28px, 3vw, 44px); font-weight: 800; color: var(--text); margin-bottom: 8px; }
        .accent { color: var(--gold); }
        .section-desc { font-size: 16px; color: #777; margin-bottom: 36px; }

        .menu-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; margin-bottom: 30px; }
        @media (min-width: 768px) { .menu-grid { grid-template-columns: repeat(4, 1fr); } }

        /* ✅ Card putih */
        .menu-card {
            background: var(--white);
            border-radius: 14px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 2px 14px rgba(0,0,0,0.10);
            transition: transform .25s, box-shadow .25s;
            border: 1px solid rgba(0,0,0,0.07);
        }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 12px 32px rgba(0,0,0,0.15); }

        .menu-badge {
            position: absolute; top: 10px; left: 10px;
            font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 20px; z-index: 2;
        }
        .badge-best { background: var(--gold); color: var(--navy); }
        .badge-new  { background: #3daa5c; color: var(--white); }

        /* ✅ Area foto putih/terang */
        .menu-img-wrap {
            width: 100%;
            aspect-ratio: 1/1;
            background: #f0f0ec;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .menu-img-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .no-img { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #ebebeb; }

        /* Info card — background navy, teks putih/gold */
        .menu-info { padding: 12px 14px 16px; background: var(--navy); }
        .menu-name { font-size: 15px; font-weight: 700; color: var(--white); margin-bottom: 10px; }
        .menu-footer { display: flex; align-items: center; justify-content: space-between; }
        .menu-price { font-size: 14px; font-weight: 700; color: var(--gold); }
        .menu-tag {
            background: rgba(255,255,255,0.12); color: var(--white);
            font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 20px;
        }

        .btn-all-menu {
            display: flex; align-items: center; justify-content: center; gap: 10px;
            width: 100%; padding: 20px;
            background: transparent; border: 2.5px solid var(--navy);
            color: var(--navy); font-family: var(--font); font-size: 16px; font-weight: 700;
            letter-spacing: 1.5px; border-radius: 10px; text-decoration: none;
            transition: background .2s, color .2s;
        }
        .btn-all-menu:hover { background: var(--navy); color: var(--white); }

        /* ══ ABOUT SECTION ══ */
        .about-section { background: var(--navy); padding: 80px 6%; }
        .about-label { font-size: 13px; font-weight: 700; color: var(--gold); letter-spacing: 2.5px; text-transform: uppercase; margin-bottom: 12px; }
        .about-title { font-size: clamp(36px, 4vw, 60px); font-weight: 900; color: var(--white); line-height: 1.15; margin-bottom: 28px; }
        .about-title .accent { color: var(--gold); }
        .about-text p { font-size: 16px; color: rgba(255,255,255,0.75); line-height: 1.8; margin-bottom: 14px; }
        .about-stats { display: flex; justify-content: flex-start; gap: 60px; margin: 40px 0; }
        .stat { text-align: left; }
        .stat-number { font-size: clamp(28px, 3vw, 44px); font-weight: 900; color: var(--white); margin-bottom: 4px; }
        .stat-label { font-size: 12px; font-weight: 700; color: var(--gold); letter-spacing: 1.5px; text-transform: uppercase; }
        .about-features { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
        @media (min-width: 768px) { .about-features { grid-template-columns: repeat(4, 1fr); } }
        .feature-item { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 22px 18px; }
        .feature-title { font-size: 16px; font-weight: 700; color: var(--white); margin-bottom: 8px; }
        .feature-desc  { font-size: 14px; color: rgba(255,255,255,0.6); line-height: 1.6; }

        /* ══ FOOTER ══ */
        .footer { background: var(--light); text-align: center; padding: 28px 6%; border-top: 1px solid #ddd; }
        .footer p { font-size: 14px; color: #999; line-height: 1.8; }

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
        <li><a href="{{ route('home') }}" class="active">Beranda</a></li>
        <li><a href="{{ route('menu.index') }}">Menu</a></li>
        <li><a href="{{ route('tentang') }}">Tentang</a></li>
        <li><a href="{{ route('lokasi') }}">Lokasi</a></li>
    </ul>
    <a href="{{ route('login') }}" class="btn-login">LOGIN</a>
</nav>

{{-- ══ HERO SECTION ══ --}}
<section class="hero" id="home">

    <img
        class="hero-beans"
        src="{{ asset('images/hero-beans.png') }}"
        alt=""
        aria-hidden="true"
    >

    <div class="hero-content">
        <p class="hero-label"><span class="label-line"></span> Kopi Lokal · Est. 2025</p>
        <h1 class="hero-title">Dari biji terbaik<br><span class="hero-accent">Pilihan.</span></h1>
        <p class="hero-desc">Pengalaman ngopi yang jujur dan autentik — diseduh dengan teliti, disajikan dengan hangat. Cek menu kami dan temukan favoritmu.</p>
    </div>

    <div class="hero-right">
        <img
            class="hero-cup"
            src="{{ asset('images/hero-cup.png') }}"
            alt="Street 360 Coffee Cup"
        >
    </div>

</section>

{{-- ══ INFO BAR ══ --}}
<div class="info-bar">
    <div class="info-item">
        <p class="info-label">JAM BUKA</p>
        <p class="info-value">17.30 – CLOSE</p>
    </div>
    <div class="info-divider"></div>
    <div class="info-item">
        <p class="info-label">PEMBAYARAN</p>
        <p class="info-value">TUNAI &amp; QRIS</p>
    </div>
    <div class="info-divider"></div>
    <div class="info-item">
        <p class="info-label">MENU</p>
        <p class="info-value">{{ \App\Models\Menu::where('tersedia', true)->count() }}+<br>VARIAN MENU</p>
    </div>
</div>

{{-- ══ MENU SECTION ══ --}}
<section class="menu-section" id="menu">
    <p class="section-label"><span class="label-line"></span> PILIHAN KAMI</p>
    <h2 class="section-title">Menu <span class="accent">Unggulan</span></h2>
    <p class="section-desc">Yang paling banyak dipesan pelanggan kami setiap malam.</p>

    <div class="menu-grid">
        @forelse($unggulan as $item)
        <div class="menu-card">
            @if($item->badge)
                <span class="menu-badge {{ $item->badge === 'New' ? 'badge-new' : 'badge-best' }}">
                    {{ $item->badge }}
                </span>
            @endif
            <div class="menu-img-wrap">
                @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                @else
                    <div class="no-img">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.2">
                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                    </div>
                @endif
            </div>
            <div class="menu-info">
                <p class="menu-name">{{ $item->nama }}</p>
                <div class="menu-footer">
                    <span class="menu-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                    <span class="menu-tag">{{ $item->kategori }}</span>
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column:span 4;text-align:center;color:#aaa;padding:40px 0;">
            Belum ada menu tersedia.
        </div>
        @endforelse
    </div>

    <a href="{{ route('menu.index') }}" class="btn-all-menu">LIHAT SEMUA MENU →</a>
</section>

{{-- ══ ABOUT SECTION ══ --}}
<section class="about-section" id="about">
    <p class="about-label">SIAPA KAMI</p>
    <h2 class="about-title">Pelopor<br>digital di <span class="accent">Waru.</span></h2>
    <div class="about-text">
        <p>Street 360Coffee berdiri tahun 2025 di Waru, Kalimantan Timur. Kami hadir sebagai coffeeShop yang fokus menjadikan kopi berkualitas, tapi juga menjadi pelopor digitalisasi UMKM kuliner di kawasan ini.</p>
        <p>Semua kopi kami bersumber dari petani lokal pilihan — diolah dengan standar tinggi untuk menghadirkan cita rasa yang konsisten di setiap cangkir.</p>
    </div>
    <div class="about-stats">
        <div class="stat"><p class="stat-number">15 +</p><p class="stat-label">MENU PILIHAN</p></div>
        <div class="stat"><p class="stat-number">2025</p><p class="stat-label">BERDIRI SEJAK</p></div>
        <div class="stat"><p class="stat-number">100%</p><p class="stat-label">KOPI LOKAL</p></div>
    </div>
    <div class="about-features">
        <div class="feature-item"><p class="feature-title">Menu Digital</p><p class="feature-desc">Informasi menu tersedia online, mudah diakses kapan saja.</p></div>
        <div class="feature-item"><p class="feature-title">Stok Real-time</p><p class="feature-desc">Menu yang habis langsung diperbarui otomatis.</p></div>
        <div class="feature-item"><p class="feature-title">Tunai &amp; QRIS</p><p class="feature-desc">Bayar mudah dengan berbagai metode pembayaran pilihan kamu.</p></div>
        <div class="feature-item"><p class="feature-title">Kopi Lokal</p><p class="feature-desc">Biji kopi pilihan dari petani  terbaik.</p></div>
    </div>
</section>

<footer class="footer">
    <p>Waru, Penajam Paser Utara - Kalimantan Timur</p>
    <p>© 2025 Street 360 Coffee. All rights reserved.</p>
</footer>

</body>
</html>