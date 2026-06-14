{{-- resources/views/tentang.blade.php --}}
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
            --navy2: #0d1526;
            --navy3: #111b33;
            --gold: #d4a843;
            --gold2: #f0c96a;
            --gold3: #a87c28;
            --white: #ffffff;
            --light: #f5f5f0;
            --text: #1a1a1a;
            --font: 'Poppins', sans-serif;
        }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font); color: var(--text); background: var(--light); overflow-x: hidden; }

        /* ══ NAVBAR ══ */
        .navbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 40px; height: 62px;
            background: linear-gradient(105deg,#060d1c 0%,#111b33 30%,#1a2340 55%,#0e1828 80%,#060d1c 100%);
            position: sticky; top: 0; z-index: 100;
            border-bottom: 1.5px solid rgba(212,168,67,0.35);
            box-shadow: 0 4px 32px rgba(0,0,0,0.55);
        }
        .navbar::after {
            content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 1.5px;
            background: linear-gradient(90deg,transparent,rgba(240,201,106,1) 50%,transparent);
            pointer-events: none;
        }
        .navbar-brand { text-decoration: none; display: flex; align-items: center; gap: 1px; }
        .brand-top    { font-size:18px; font-weight:900; background:linear-gradient(135deg,#fff,#e8dfc4); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .brand-dot    { font-size:18px; font-weight:900; color:#fff; }
        .brand-accent { font-size:18px; font-weight:900; background:linear-gradient(135deg,var(--gold2),var(--gold),var(--gold3)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .navbar-menu  { display: flex; list-style: none; gap: 38px; }
        .navbar-menu a { color:rgba(255,255,255,0.75); text-decoration:none; font-size:14px; font-weight:600; position:relative; transition:color .2s; letter-spacing:0.3px; }
        .navbar-menu a::after { content:''; position:absolute; bottom:-4px; left:0; width:0; height:2px; background:linear-gradient(90deg,var(--gold2),var(--gold)); transition:width .25s; border-radius:2px; }
        .navbar-menu a:hover::after, .navbar-menu a.active::after { width:100%; }
        .navbar-menu a:hover, .navbar-menu a.active { color:var(--gold2); }
        .btn-login {
            background: linear-gradient(135deg,#f5ca5e 0%,#d4a843 55%,#b8882a 100%);
            color: #0d1526; font-size:13px; font-weight:800;
            padding:9px 26px; border-radius:30px; text-decoration:none; letter-spacing:0.5px;
            box-shadow: 0 2px 12px rgba(212,168,67,0.45);
            transition: box-shadow .2s, transform .15s;
        }
        .btn-login:hover { box-shadow:0 4px 22px rgba(212,168,67,0.65); transform:translateY(-1px); }

        /* ══ HERO ══ */
        .about-hero {
            position: relative; overflow: hidden;
            padding: 72px 8% 80px;
            background: linear-gradient(135deg,#080f1f 0%,#0d1526 30%,#1a2340 60%,#101828 85%,#080f1f 100%);
        }
        .about-hero::after {
            content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg,transparent,rgba(240,201,106,0.7) 50%,transparent);
        }
        .hero-bg360 {
            position: absolute; right: 2%; top: 50%; transform: translateY(-50%);
            font-size: clamp(130px,20vw,280px); font-weight: 900;
            color: transparent; -webkit-text-stroke: 2px rgba(212,168,67,0.1);
            pointer-events: none; user-select: none; line-height: 1;
            animation: pulse360 6s ease-in-out infinite; z-index: 1; letter-spacing: -8px;
        }
        @keyframes pulse360 {
            0%,100% { -webkit-text-stroke-color: rgba(212,168,67,0.1); transform: translateY(-50%) scale(1); }
            50%      { -webkit-text-stroke-color: rgba(212,168,67,0.22); transform: translateY(-50%) scale(1.025); }
        }
        .hero-bubbles { position:absolute; inset:0; pointer-events:none; z-index:2; overflow:hidden; }
        .bubble { position:absolute; bottom:-60px; border-radius:50%; background:rgba(212,168,67,0.09); border:1px solid rgba(212,168,67,0.2); animation:floatUp linear infinite; }
        @keyframes floatUp { 0%{transform:translateY(0);opacity:0} 10%{opacity:0.6} 90%{opacity:0.2} 100%{transform:translateY(-340px);opacity:0} }
        .hero-dots { position:absolute; inset:0; pointer-events:none; overflow:hidden; z-index:1; }
        .dot { position:absolute; border-radius:50%; background:rgba(212,168,67,0.08); animation:dotF linear infinite; }
        @keyframes dotF { 0%{transform:translateY(0);opacity:0.4} 50%{opacity:0.7} 100%{transform:translateY(-36px);opacity:0} }
        .hero-content { position:relative; z-index:3; animation:hIn .85s cubic-bezier(.22,1,.36,1) both; }
        @keyframes hIn { from{opacity:0;transform:translateX(-24px)} to{opacity:1;transform:translateX(0)} }
        .hero-label-tag { display:flex; align-items:center; gap:10px; font-size:12px; font-weight:700; color:var(--gold2); letter-spacing:2px; text-transform:uppercase; margin-bottom:14px; }
        .lline { display:inline-block; width:32px; height:2px; background:linear-gradient(90deg,var(--gold2),var(--gold)); border-radius:2px; flex-shrink:0; }
        .about-title { font-size:clamp(32px,5vw,60px); font-weight:900; color:#fff; line-height:1.15; margin-bottom:18px; }
        .about-title .accent { background:linear-gradient(135deg,var(--gold3),var(--gold),var(--gold2)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .about-tagline { font-size:14px; color:rgba(255,255,255,0.6); line-height:1.85; max-width:520px; }

        /* ══ STATS BAR ══ */
        .stats-bar {
            display: flex; align-items: stretch;
            background: linear-gradient(105deg,#060d1c 0%,#111b33 35%,#1a2340 65%,#060d1c 100%);
            border-bottom: 1px solid rgba(212,168,67,0.15);
            position: relative;
        }
        .stats-bar::after {
            content: ''; position: absolute; bottom: 0; left: 8%; right: 8%; height: 1px;
            background: linear-gradient(90deg,transparent,rgba(240,201,106,0.4),transparent);
        }
        .stat-item { flex:1; text-align:center; padding:32px 20px; position:relative; transition:background .3s; cursor:default; }
        .stat-item:hover { background: rgba(212,168,67,0.06); }
        .stat-number {
            font-size:clamp(24px,3vw,40px); font-weight:900; margin-bottom:8px;
            background:linear-gradient(135deg,#fff,rgba(255,255,255,0.85));
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
        }
        .stat-label { font-size:10px; font-weight:700; color:var(--gold2); letter-spacing:2.5px; text-transform:uppercase; text-shadow:0 0 14px rgba(212,168,67,0.4); }
        .stat-divider { width:1px; background:linear-gradient(to bottom,transparent,rgba(212,168,67,0.4) 25%,rgba(212,168,67,0.4) 75%,transparent); margin:12px 0; }

        /* ══ SECTION SHARED ══ */
        .section { padding: 64px 8%; }
        .section-tag {
            display:flex; align-items:center; gap:14px;
            font-size:10px; font-weight:700; color:rgba(255,255,255,0.35);
            letter-spacing:3px; text-transform:uppercase; margin-bottom:28px;
        }
        .section-tag::after { content:''; flex:1; height:1px; background:rgba(255,255,255,0.1); }
        .section-tag.dark { color:#aaa; }
        .section-tag.dark::after { background:#e0e0e0; }

        /* ══ CERITA ══ */
        .cerita-section {
            background: linear-gradient(180deg,#eeede7 0%,#f5f5f0 100%);
        }
        .cerita-card {
            background: var(--white);
            border-radius: 18px;
            padding: 36px;
            border-left: 4px solid var(--gold);
            box-shadow: 0 4px 28px rgba(0,0,0,0.07);
            position: relative; overflow: hidden;
        }
        .cerita-card::before {
            content: '"'; position: absolute; top: -10px; right: 24px;
            font-size: 120px; font-weight: 900; color: rgba(212,168,67,0.07);
            line-height: 1; pointer-events: none;
        }
        .cerita-card p { font-size:14px; color:#555; line-height:1.9; font-style:italic; position:relative; z-index:1; }
        .cerita-card p + p { margin-top:16px; }

        .owner-card {
            background: linear-gradient(135deg,#080f1f 0%,#1a2340 55%,#101828 100%);
            border-radius: 18px; padding: 28px 32px; margin-top: 24px;
            display: flex; align-items: flex-start; gap: 20px;
            border: 1px solid rgba(212,168,67,0.2);
            position: relative; overflow: hidden;
            transition: border-color .3s, transform .3s;
        }
        .owner-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg,transparent,rgba(212,168,67,0.5),transparent);
        }
        .owner-card:hover { border-color: rgba(212,168,67,0.45); transform: translateY(-3px); }
        .owner-avatar {
            width: 52px; height: 52px; border-radius: 50%;
            background: linear-gradient(135deg,var(--gold2),var(--gold));
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; font-weight: 800; color: var(--navy2); flex-shrink: 0;
            box-shadow: 0 4px 16px rgba(212,168,67,0.4);
        }
        .owner-name  { font-size:16px; font-weight:700; color:#fff; margin-bottom:3px; }
        .owner-role  { font-size:12px; color:var(--gold2); font-weight:600; margin-bottom:14px; }
        .owner-divider { height:1px; background:rgba(255,255,255,0.1); margin-bottom:14px; }
        .owner-quote { font-size:13px; color:rgba(255,255,255,0.75); line-height:1.75; font-style:italic; }

        /* ══ TIM ══ */
        .tim-section { background: var(--light); }
        .tim-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:20px; }
        .tim-card {
            background: linear-gradient(160deg,#1e2a4a 0%,#1a2340 55%,#101828 100%);
            border-radius: 18px; padding: 32px 24px; text-align: center;
            border: 1px solid rgba(212,168,67,0.15);
            position: relative; overflow: hidden;
            transition: transform .28s, border-color .28s, box-shadow .28s;
        }
        .tim-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg,transparent,rgba(212,168,67,0.4),transparent);
        }
        .tim-card:hover { transform:translateY(-6px); border-color:rgba(212,168,67,0.4); box-shadow:0 18px 42px rgba(0,0,0,0.4); }
        .tim-avatar {
            width: 64px; height: 64px; border-radius: 50%;
            background: linear-gradient(135deg,var(--gold2),var(--gold));
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            box-shadow: 0 6px 22px rgba(212,168,67,0.4);
        }
        .tim-initial { font-size:20px; font-weight:900; color:var(--navy2); }
        .tim-name  { font-size:16px; font-weight:700; background:linear-gradient(135deg,var(--gold2),var(--gold)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; margin-bottom:4px; }
        .tim-role  { font-size:12px; color:rgba(212,168,67,0.7); font-weight:600; margin-bottom:16px; }
        .tim-divider { height:1px; background:rgba(255,255,255,0.1); margin-bottom:16px; }
        .tim-desc  { font-size:12px; color:rgba(255,255,255,0.65); line-height:1.7; }

        /* ══ MISI ══ */
        .misi-section { background: linear-gradient(180deg,#eeede7 0%,#f5f5f0 100%); }
        .misi-card {
            background: linear-gradient(135deg,#080f1f 0%,#101828 25%,#1a2340 55%,#111b33 80%,#080f1f 100%);
            border-radius: 20px; padding: 44px;
            border: 1px solid rgba(212,168,67,0.2);
            position: relative; overflow: hidden;
        }
        .misi-card::before {
            content: ''; position: absolute; top: 0; left: 8%; right: 8%; height: 1px;
            background: linear-gradient(90deg,transparent,rgba(240,201,106,0.6),transparent);
        }
        .misi-card::after {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(ellipse 55% 50% at 85% 15%,rgba(212,168,67,0.06) 0%,transparent 60%);
            pointer-events: none;
        }
        .misi-sub   { font-size:11px; color:var(--gold2); font-weight:700; letter-spacing:2px; text-transform:uppercase; margin-bottom:8px; }
        .misi-title { font-size:clamp(22px,3vw,34px); font-weight:900; color:#fff; line-height:1.25; margin-bottom:32px; }
        .misi-title .accent { background:linear-gradient(135deg,var(--gold3),var(--gold),var(--gold2)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .misi-list  { display:flex; flex-direction:column; gap:20px; position:relative; z-index:1; }
        .misi-item  { display:flex; align-items:flex-start; gap:18px; }
        .misi-num {
            width:34px; height:34px; border-radius:50%;
            background: linear-gradient(135deg,var(--gold2),var(--gold));
            display:flex; align-items:center; justify-content:center;
            font-size:12px; font-weight:800; color:var(--navy2); flex-shrink:0; margin-top:2px;
            box-shadow: 0 4px 14px rgba(212,168,67,0.4);
        }
        .misi-text { font-size:13px; color:rgba(255,255,255,0.75); line-height:1.8; }

        /* ══ KEUNGGULAN ══ */
        .keunggulan-section { background: var(--light); }
        .keunggulan-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:16px; }
        @media(min-width:1024px) { .keunggulan-grid { grid-template-columns:repeat(4,1fr); } }
        .keunggulan-card {
            background: linear-gradient(160deg,#1e2a4a 0%,#1a2340 55%,#101828 100%);
            border-radius: 16px; padding: 28px 22px;
            border: 1px solid rgba(212,168,67,0.12);
            border-top: 3px solid rgba(212,168,67,0.35);
            position: relative; overflow: hidden;
            transition: border-top-color .25s, transform .25s, box-shadow .25s;
        }
        .keunggulan-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg,transparent,rgba(212,168,67,0.3),transparent);
        }
        .keunggulan-card:hover { border-top-color:var(--gold2); transform:translateY(-5px); box-shadow:0 16px 38px rgba(0,0,0,0.4); }
        .keunggulan-icon { font-size:28px; margin-bottom:14px; }
        .keunggulan-title { font-size:15px; font-weight:700; color:#fff; margin-bottom:8px; }
        .keunggulan-desc  { font-size:12px; color:rgba(255,255,255,0.55); line-height:1.7; }

        /* ══ FOOTER ══ */
        .footer { background:linear-gradient(135deg,var(--navy2),var(--navy),var(--navy3)); text-align:center; padding:32px 8%; border-top:1px solid rgba(212,168,67,0.2); }
        .footer p { font-size:12px; color:rgba(255,255,255,0.4); line-height:1.9; }

        /* ══ REVEAL ══ */
        .rv { opacity:0; transform:translateY(22px); transition:opacity .65s ease, transform .65s ease; }
        .rv.vis { opacity:1; transform:translateY(0); }

        @media(max-width:768px) { .navbar { padding:0 20px; } .section { padding:48px 5%; } .misi-card { padding:28px; } }
        @media(max-width:480px) { .navbar-menu { display:none; } }
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

<!-- HERO -->
<section class="about-hero">
    <div class="hero-bubbles" id="heroBubbles"></div>
    <div class="hero-dots"    id="heroDots"></div>
    <div class="hero-bg360">360</div>
    <div class="hero-content">
        <p class="hero-label-tag"><span class="lline"></span>SIAPA KAMI</p>
        <h1 class="about-title">Pelopor<br>digital di <span class="accent">Waru.</span></h1>
        <p class="about-tagline">Street 360Coffee hadir bukan sekadar untuk menyajikan kopi — tapi untuk membuktikan bahwa UMKM lokal bisa bertumbuh dengan cara yang modern.</p>
    </div>
</section>

<!-- STATS BAR -->
<div class="stats-bar">
    <div class="stat-item">
        <p class="stat-number">15+</p>
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

<!-- CERITA -->
<section class="section cerita-section">
    <div class="section-tag dark">CERITA KAMI</div>
    <div class="cerita-card rv">
        <p>Street 360Coffee berdiri tahun 2025 di Waru, Kalimantan Timur. Kami hadir sebagai coffee shop yang fokus menghadirkan kopi berkualitas, sekaligus menjadi pelopor digitalisasi UMKM kuliner di kawasan ini.</p>
        <p>Semua kopi kami bersumber dari petani lokal pilihan — diolah dengan standar tinggi untuk menghadirkan cita rasa yang konsisten di setiap cangkir.</p>
    </div>
    <div class="owner-card rv">
        <div class="owner-avatar">MR</div>
        <div class="owner-info">
            <p class="owner-name">M. Rangga</p>
            <p class="owner-role">Owner &nbsp;·&nbsp; Waru, Penajam Paser Utara</p>
            <div class="owner-divider"></div>
            <p class="owner-quote">"Street 360 Coffee dibangun dengan semangat menghadirkan tempat ngopi yang nyaman dan berkesan."</p>
        </div>
    </div>
</section>

<!-- TIM -->
<section class="section tim-section">
    <div class="section-tag dark">TIM &amp; PATNER KERJA</div>
    <div class="tim-grid">
        <div class="tim-card rv">
            <div class="tim-avatar"><span class="tim-initial">MR</span></div>
            <p class="tim-name">M. Rangga</p>
            <p class="tim-role">Admin &amp; Barista</p>
            <div class="tim-divider"></div>
            <p class="tim-desc">Kami menyajikan berbagai pilihan kopi dengan cita rasa yang pas dan suasana yang nyaman untuk semua kalangan.</p>
        </div>
        <div class="tim-card rv">
            <div class="tim-avatar"><span class="tim-initial">GE</span></div>
            <p class="tim-name">Gadis.E</p>
            <p class="tim-role">Kasir &amp; Pelayanan</p>
            <div class="tim-divider"></div>
            <p class="tim-desc">Kami memastikan pengalaman berkunjung yang menyenangkan dan mudah agar pelanggan tidak kecewa.</p>
        </div>
    </div>
</section>

<!-- MISI -->
<section class="section misi-section">
    <div class="section-tag dark">MISI KAMI</div>
    <div class="misi-card rv">
        <p class="misi-sub">Mengapa kami ada</p>
        <h2 class="misi-title">Lebih dari<br>sekadar <span class="accent">kopi.</span></h2>
        <div class="misi-list">
            <div class="misi-item rv">
                <div class="misi-num">01</div>
                <p class="misi-text">Kami ingin menghadirkan tempat ngopi yang nyaman dan bisa dinikmati oleh semua kalangan.</p>
            </div>
            <div class="misi-item rv">
                <div class="misi-num">02</div>
                <p class="misi-text">Kami menyajikan kopi berkualitas dengan harga yang terjangkau agar semua pelanggan bisa menikmati kopi yang enak.</p>
            </div>
            <div class="misi-item rv">
                <div class="misi-num">03</div>
                <p class="misi-text">Kami berusaha mengembangkan usaha lokal agar bisa terus maju dan dikenal lebih luas.</p>
            </div>
        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section class="section keunggulan-section">
    <div class="section-tag dark">KEUNGGULAN KAMI</div>
    <div class="keunggulan-grid">
        <div class="keunggulan-card rv">
            <div class="keunggulan-icon">📱</div>
            <p class="keunggulan-title">Menu Digital</p>
            <p class="keunggulan-desc">Informasi menu tersedia online, mudah diakses kapan saja dan dari mana saja.</p>
        </div>
        <div class="keunggulan-card rv">
            <div class="keunggulan-icon">⚡</div>
            <p class="keunggulan-title">Stok Real-time</p>
            <p class="keunggulan-desc">Menu yang habis langsung diperbarui otomatis dari admin tanpa delay.</p>
        </div>
        <div class="keunggulan-card rv">
            <div class="keunggulan-icon">💳</div>
            <p class="keunggulan-title">Tunai &amp; QRIS</p>
            <p class="keunggulan-desc">Bayar mudah dengan berbagai metode pembayaran pilihan kamu.</p>
        </div>
        <div class="keunggulan-card rv">
            <div class="keunggulan-icon">☕</div>
            <p class="keunggulan-title">Kopi Lokal</p>
            <p class="keunggulan-desc">Biji kopi pilihan dari petani terbaik Kalimantan Timur.</p>
        </div>
    </div>
</section>

<footer class="footer">
    <p>Waru, Penajam Paser Utara · Kalimantan Timur</p>
    <p>© 2025 Street 360 Coffee. All rights reserved.</p>
</footer>

<script>
/* ── Bubbles ── */
(function(){
    const w = document.getElementById('heroBubbles');
    [16,24,12,30,18,10,26,14,20,9].forEach((s,i)=>{
        const b = document.createElement('div'); b.className='bubble';
        b.style.cssText=`width:${s}px;height:${s}px;left:${[6,14,23,33,43,53,63,72,82,91][i]}%;animation-duration:${3.5+(i%4)}s;animation-delay:${i*0.55}s`;
        w.appendChild(b);
    });
})();

/* ── Floating dots ── */
(function(){
    const w = document.getElementById('heroDots');
    for(let i=0;i<10;i++){
        const d = document.createElement('div'); d.className='dot';
        const s=3+Math.random()*8;
        d.style.cssText=`width:${s}px;height:${s}px;left:${Math.random()*100}%;top:${10+Math.random()*80}%;animation-duration:${3+Math.random()*4}s;animation-delay:${Math.random()*3}s`;
        w.appendChild(d);
    }
})();

/* ── Scroll reveal ── */
(function(){
    const io = new IntersectionObserver((entries)=>{
        entries.forEach((e,i)=>{
            if(e.isIntersecting){ setTimeout(()=>e.target.classList.add('vis'), i*80); io.unobserve(e.target); }
        });
    },{threshold:0.1});
    document.querySelectorAll('.rv').forEach(el=>io.observe(el));
})();

/* ── Ripple login btn ── */
document.querySelectorAll('.btn-login').forEach(btn=>{
    btn.addEventListener('click',e=>{
        const r=document.createElement('span');
        r.style.cssText='position:absolute;border-radius:50%;transform:scale(0);background:rgba(255,255,255,0.3);animation:rip .55s linear;pointer-events:none;';
        const rect=btn.getBoundingClientRect(), s=Math.max(rect.width,rect.height);
        r.style.width=r.style.height=s+'px';
        r.style.left=(e.clientX-rect.left-s/2)+'px';
        r.style.top=(e.clientY-rect.top-s/2)+'px';
        if(!document.querySelector('#ripStyle')){
            const st=document.createElement('style');st.id='ripStyle';
            st.textContent='@keyframes rip{to{transform:scale(4);opacity:0}}';
            document.head.appendChild(st);
        }
        btn.style.position='relative'; btn.style.overflow='hidden';
        btn.appendChild(r); setTimeout(()=>r.remove(),600);
    });
});
</script>

</body>
</html>