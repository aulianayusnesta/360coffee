{{-- resources/views/lokasi.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lokasi — Street 360.coffee</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<style>
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
:root {
    --navy: #1a2340; --navy2: #0d1526; --navy3: #111b33;
    --gold: #d4a843; --gold2: #f0c96a; --gold3: #a87c28;
    --white: #ffffff; --light: #f5f5f0; --font: 'Poppins', sans-serif;
}
html { scroll-behavior: smooth; }
body { font-family: var(--font); background: var(--light); overflow-x: hidden; }

/* ══ NAVBAR ══ */
.navbar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 40px; height: 62px;
    background: linear-gradient(105deg,#060d1c 0%,#111b33 30%,#1a2340 55%,#0e1828 80%,#060d1c 100%);
    position: sticky; top: 0; z-index: 200;
    border-bottom: 1.5px solid rgba(212,168,67,0.35);
    box-shadow: 0 4px 32px rgba(0,0,0,0.55);
}
.navbar::after {
    content:''; position:absolute; bottom:0; left:0; right:0; height:1.5px;
    background:linear-gradient(90deg,transparent,rgba(240,201,106,1) 50%,transparent);
    pointer-events:none;
}
.navbar-brand { text-decoration:none; display:flex; align-items:center; gap:1px; }
.brand-top    { font-size:18px; font-weight:900; background:linear-gradient(135deg,#fff,#e8dfc4); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
.brand-dot    { font-size:18px; font-weight:900; color:#fff; }
.brand-accent { font-size:18px; font-weight:900; background:linear-gradient(135deg,var(--gold2),var(--gold),var(--gold3)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
.navbar-menu  { display:flex; list-style:none; gap:38px; }
.navbar-menu a { color:rgba(255,255,255,0.75); text-decoration:none; font-size:14px; font-weight:600; position:relative; transition:color .2s; }
.navbar-menu a::after { content:''; position:absolute; bottom:-4px; left:0; width:0; height:2px; background:linear-gradient(90deg,var(--gold2),var(--gold)); transition:width .25s; border-radius:2px; }
.navbar-menu a:hover::after, .navbar-menu a.active::after { width:100%; }
.navbar-menu a:hover, .navbar-menu a.active { color:var(--gold2); }
.btn-login {
    background:linear-gradient(135deg,#f5ca5e 0%,#d4a843 55%,#b8882a 100%);
    color:#0d1526; font-size:13px; font-weight:800;
    padding:9px 26px; border-radius:30px; text-decoration:none;
    box-shadow:0 2px 12px rgba(212,168,67,0.45); transition:box-shadow .2s,transform .15s;
}
.btn-login:hover { box-shadow:0 4px 22px rgba(212,168,67,0.65); transform:translateY(-1px); }

/* ══ HERO ══ */
.lokasi-hero {
    position:relative; overflow:hidden;
    padding:64px 8% 76px;
    background:linear-gradient(135deg,#080f1f 0%,#0d1526 30%,#1a2340 60%,#101828 85%,#080f1f 100%);
}
.lokasi-hero::after {
    content:''; position:absolute; bottom:0; left:0; right:0; height:1px;
    background:linear-gradient(90deg,transparent,rgba(240,201,106,0.7) 50%,transparent);
}
.hero-bg360 {
    position:absolute; right:2%; top:50%; transform:translateY(-50%);
    font-size:clamp(130px,20vw,260px); font-weight:900;
    color:transparent; -webkit-text-stroke:2px rgba(212,168,67,0.1);
    pointer-events:none; user-select:none; line-height:1;
    animation:pulse360 6s ease-in-out infinite; z-index:1;
}
@keyframes pulse360 {
    0%,100%{-webkit-text-stroke-color:rgba(212,168,67,0.1);transform:translateY(-50%) scale(1);}
    50%{-webkit-text-stroke-color:rgba(212,168,67,0.22);transform:translateY(-50%) scale(1.025);}
}
.hero-bubbles { position:absolute; inset:0; pointer-events:none; z-index:2; overflow:hidden; }
.bubble { position:absolute; bottom:-60px; border-radius:50%; background:rgba(212,168,67,0.09); border:1px solid rgba(212,168,67,0.2); animation:floatUp linear infinite; }
@keyframes floatUp { 0%{transform:translateY(0);opacity:0} 10%{opacity:0.6} 90%{opacity:0.2} 100%{transform:translateY(-340px);opacity:0} }
.hero-dots { position:absolute; inset:0; pointer-events:none; overflow:hidden; z-index:1; }
.hdot { position:absolute; border-radius:50%; background:rgba(212,168,67,0.08); animation:dotF linear infinite; }
@keyframes dotF { 0%{transform:translateY(0);opacity:0.4} 50%{opacity:0.7} 100%{transform:translateY(-36px);opacity:0} }
.hero-content { position:relative; z-index:3; animation:hIn .85s cubic-bezier(.22,1,.36,1) both; }
@keyframes hIn { from{opacity:0;transform:translateX(-24px)} to{opacity:1;transform:translateX(0)} }
.hero-label { display:flex; align-items:center; gap:10px; font-size:12px; font-weight:700; color:var(--gold2); letter-spacing:2px; text-transform:uppercase; margin-bottom:14px; }
.lline { display:inline-block; width:32px; height:2px; background:linear-gradient(90deg,var(--gold2),var(--gold)); border-radius:2px; flex-shrink:0; }
.hero-title { font-size:clamp(28px,4.5vw,52px); font-weight:900; color:#fff; margin-bottom:10px; line-height:1.15; }
.hero-acc { background:linear-gradient(135deg,var(--gold3),var(--gold),var(--gold2)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
.hero-sub { font-size:14px; color:rgba(255,255,255,0.55); line-height:1.8; }

/* ══ MAP ══ */
.map-section {
    position:relative; width:100%;
    border-top:2px solid rgba(212,168,67,0.3);
    border-bottom:2px solid rgba(212,168,67,0.3);
    box-shadow:0 8px 48px rgba(0,0,0,0.35);
}
#leaflet-map {
    width:100%; height:520px;
    z-index:1; display:block;
}
.map-overlay {
    position:absolute; bottom:20px; left:20px; z-index:400;
    background:rgba(10,18,38,0.92);
    border:1px solid rgba(212,168,67,0.4);
    border-radius:14px; padding:14px 18px;
    backdrop-filter:blur(10px);
    animation:hIn .8s cubic-bezier(.22,1,.36,1) .4s both;
}
.mo-name { font-size:14px; font-weight:800; color:var(--gold2); margin-bottom:4px; }
.mo-addr { font-size:11px; color:rgba(255,255,255,0.6); line-height:1.6; }
.map-overlay-right {
    position:absolute; bottom:20px; right:20px; z-index:400;
    background:rgba(10,18,38,0.92);
    border:1px solid rgba(212,168,67,0.25);
    border-radius:14px; padding:12px 16px; text-align:center;
    backdrop-filter:blur(10px);
    animation:hIn .8s cubic-bezier(.22,1,.36,1) .5s both;
}
.mo-status-label { font-size:10px; font-weight:700; color:var(--gold2); letter-spacing:1.5px; text-transform:uppercase; margin-bottom:6px; }
.mo-status-badge { font-size:12px; font-weight:700; display:flex; align-items:center; gap:6px; justify-content:center; }
.bdot { width:7px; height:7px; border-radius:50%; display:inline-block; }
.bdot-open   { background:#10b981; animation:blink 1.8s ease-in-out infinite; }
.bdot-closed { background:#ef4444; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.25} }

.leaflet-popup-content-wrapper {
    background:var(--navy2) !important; color:#fff !important;
    border-radius:14px !important; border:1px solid rgba(212,168,67,0.4) !important;
    box-shadow:0 10px 40px rgba(0,0,0,0.55) !important;
}
.leaflet-popup-tip { background:var(--navy2) !important; }
.leaflet-popup-content { margin:14px 18px !important; }
.popup-name { font-size:14px; font-weight:800; color:var(--gold2); margin-bottom:5px; }
.popup-addr { font-size:12px; color:rgba(255,255,255,0.65); line-height:1.65; }
.popup-jam  { font-size:11px; color:var(--gold2); margin-top:6px; font-weight:600; }

/* ══ BODY CONTENT ══ */
.lokasi-body { max-width:900px; margin:0 auto; padding:36px 24px 64px; }

.detail-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
.detail-title { font-size:20px; font-weight:900; color:var(--navy); }
.badge { padding:8px 18px; border-radius:20px; font-size:12px; font-weight:700; display:flex; align-items:center; gap:7px; }
.badge-open   { background:rgba(16,185,129,0.12); color:#047857; border:1px solid rgba(16,185,129,0.3); }
.badge-closed { background:rgba(239,68,68,0.1);   color:#dc2626; border:1px solid rgba(239,68,68,0.25); }

.card {
    border-radius:20px; overflow:hidden; margin-bottom:18px;
    border:1px solid rgba(212,168,67,0.12);
    box-shadow:0 4px 24px rgba(0,0,0,0.08);
    opacity:0; transform:translateY(20px);
    transition:opacity .6s ease, transform .6s ease;
}
.card.vis { opacity:1; transform:translateY(0); }
.card-header {
    background:linear-gradient(105deg,#060d1c 0%,#1a2340 55%,#060d1c 100%);
    padding:14px 22px; color:var(--gold2);
    font-weight:800; font-size:11px; letter-spacing:2.5px; text-transform:uppercase;
    border-bottom:1px solid rgba(212,168,67,0.18);
    display:flex; align-items:center; gap:10px;
}
.card-header::before { content:''; display:inline-block; width:18px; height:2px; background:linear-gradient(90deg,var(--gold2),var(--gold)); border-radius:2px; }
.card-body { background:var(--white); padding:22px; }

.row-info { display:flex; gap:16px; align-items:flex-start; }
.icon-box {
    width:44px; height:44px; border-radius:14px; flex-shrink:0;
    background:linear-gradient(135deg,rgba(212,168,67,0.15),rgba(212,168,67,0.06));
    border:1px solid rgba(212,168,67,0.22);
    display:flex; align-items:center; justify-content:center; font-size:20px;
}
.info-sub  { font-size:11px; color:#bbb; font-weight:600; margin-bottom:4px; letter-spacing:0.5px; }
.info-main { font-weight:700; font-size:15px; color:var(--navy); }
.info-note { font-size:12px; color:#999; margin-top:4px; }

.jam-row { display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; }
.jam-time-big { font-size:22px; font-weight:700; color:var(--navy); }

.divider { height:1px; background:#f0f0f0; margin:16px 0; }

.warning-box {
    background:linear-gradient(135deg,#fffbeb,#fef3c7);
    padding:15px 20px; border-radius:16px;
    color:#92400e; font-size:13px; font-weight:600;
    margin-bottom:18px; border:1px solid rgba(212,168,67,0.3);
    border-left:4px solid var(--gold);
    opacity:0; transform:translateY(14px);
    transition:opacity .6s ease,transform .6s ease;
}
.warning-box.vis { opacity:1; transform:translateY(0); }

.kontak-link { color:inherit; text-decoration:none; transition:color .2s; }
.kontak-link:hover { color:var(--gold3); text-decoration:underline; }

.pay-chips { display:flex; gap:10px; flex-wrap:wrap; margin-top:10px; }
.pay-chip {
    padding:7px 16px; border-radius:20px;
    background:linear-gradient(135deg,rgba(212,168,67,0.1),rgba(212,168,67,0.05));
    border:1px solid rgba(212,168,67,0.3);
    font-size:12px; font-weight:700; color:var(--navy);
    display:flex; align-items:center; gap:6px;
}

.btn-maps {
    display:flex; align-items:center; justify-content:center; gap:12px;
    padding:20px;
    background:linear-gradient(135deg,#080f1f 0%,#1a2340 55%,#080f1f 100%);
    color:var(--white); border-radius:18px; text-decoration:none;
    font-weight:800; font-size:15px; letter-spacing:0.5px;
    border:1px solid rgba(212,168,67,0.25);
    box-shadow:0 6px 28px rgba(0,0,0,0.2);
    transition:box-shadow .25s,transform .2s,border-color .25s;
    position:relative; overflow:hidden;
    opacity:0; transform:translateY(14px);
    animation:none;
}
.btn-maps.vis { animation:cardIn .6s cubic-bezier(.22,1,.36,1) forwards; }
@keyframes cardIn { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:translateY(0)} }
.btn-maps::before {
    content:''; position:absolute; top:0; left:0; right:0; height:1px;
    background:linear-gradient(90deg,transparent,rgba(212,168,67,0.55),transparent);
}
.btn-maps::after {
    content:''; position:absolute; inset:0;
    background:radial-gradient(ellipse 60% 80% at 50% 0%,rgba(212,168,67,0.07) 0%,transparent 70%);
    pointer-events:none;
}
.btn-maps:hover { box-shadow:0 14px 42px rgba(0,0,0,0.4); transform:translateY(-4px); border-color:rgba(212,168,67,0.5); }
.btn-maps-text { font-size:15px; }
.btn-maps-arrow { font-size:18px; transition:transform .25s; }
.btn-maps:hover .btn-maps-arrow { transform:translateX(4px); }

.footer { background:linear-gradient(135deg,var(--navy2),var(--navy),var(--navy3)); text-align:center; padding:32px 8%; border-top:1px solid rgba(212,168,67,0.2); }
.footer p { font-size:12px; color:rgba(255,255,255,0.4); line-height:1.9; }

/* ══ HAMBURGER MENU ══ */
.hamburger{display:none;background:none;border:none;cursor:pointer;padding:6px;z-index:201;position:relative}
.hamburger span{display:block;width:22px;height:2.5px;background:#fff;border-radius:2px;transition:transform .3s,opacity .3s}
.hamburger span+span{margin-top:5px}
.hamburger.active span:nth-child(1){transform:translateY(7.5px) rotate(45deg)}
.hamburger.active span:nth-child(2){opacity:0}
.hamburger.active span:nth-child(3){transform:translateY(-7.5px) rotate(-45deg)}
.mobile-menu{display:none;position:fixed;top:62px;left:0;right:0;background:linear-gradient(180deg,#0d1526 0%,#1a2340 100%);padding:0;z-index:199;border-bottom:1.5px solid rgba(212,168,67,0.35);box-shadow:0 8px 32px rgba(0,0,0,0.5);max-height:0;overflow:hidden;transition:max-height .35s ease,padding .35s ease}
.mobile-menu.open{max-height:400px;padding:20px 0}
.mobile-menu ul{list-style:none;padding:0;margin:0}
.mobile-menu li{border-bottom:1px solid rgba(255,255,255,0.06)}
.mobile-menu li:last-child{border-bottom:none}
.mobile-menu a{display:block;padding:14px 28px;color:rgba(255,255,255,0.75);text-decoration:none;font-size:15px;font-weight:600;transition:background .2s,color .2s}
.mobile-menu a:hover,.mobile-menu a.active{color:var(--gold2);background:rgba(212,168,67,0.08)}
.mobile-menu .mobile-login{display:block;margin:16px 28px 8px;text-align:center;background:linear-gradient(135deg,#f5ca5e 0%,#d4a843 55%,#b8882a 100%);color:#0d1526;font-size:13px;font-weight:800;padding:12px 26px;border-radius:30px;text-decoration:none}
.mobile-overlay{display:none;position:fixed;inset:0;top:62px;background:rgba(0,0,0,0.5);z-index:198}
.mobile-overlay.open{display:block}

/* ══ RESPONSIVE ══ */
@media(max-width:1024px){
    .lokasi-hero{padding:48px 6% 60px}
    .lokasi-body{padding:28px 20px 48px}
}
@media(max-width:768px){
    .hamburger{display:flex;flex-direction:column;justify-content:center}
    .mobile-menu{display:block}
    .navbar-menu{display:none}
    .btn-login{display:none}
    .navbar{padding:0 20px}
    .lokasi-hero{padding:36px 5% 48px}
    .hero-title{font-size:clamp(24px,5vw,40px)}
    #leaflet-map{height:380px}
    .map-overlay-right{display:none}
    .map-overlay{bottom:12px;left:12px;padding:10px 14px;border-radius:10px}
    .mo-name{font-size:13px}
    .mo-addr{font-size:10px}
    .lokasi-body{padding:24px 16px 48px}
    .detail-header{flex-direction:column;gap:12px;align-items:flex-start}
    .jam-row{flex-direction:column;gap:8px}
    .card-body{padding:18px}
}
@media(max-width:480px){
    .lokasi-hero{padding:28px 4% 36px}
    .hero-title{font-size:clamp(20px,6vw,32px)}
    #leaflet-map{height:260px}
    .lokasi-body{padding:20px 12px 40px}
    .detail-header{margin-bottom:16px}
    .detail-title{font-size:17px}
    .card-body{padding:14px}
    .row-info{gap:12px}
    .icon-box{width:38px;height:38px;border-radius:10px;font-size:17px}
    .info-main{font-size:14px}
    .jam-time-big{font-size:18px}
    .btn-maps{padding:16px;font-size:14px;border-radius:14px}
    .footer{padding:24px 4%}
}
@media(max-width:360px){
    .hero-title{font-size:20px}
    .hero-sub{font-size:12px}
    .detail-title{font-size:15px}
    .info-main{font-size:13px}
    .info-note{font-size:11px}
}
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
        <li><a href="{{ route('tentang') }}">Tentang</a></li>
        <li><a href="{{ route('lokasi') }}" class="active">Lokasi</a></li>
    </ul>
    <a href="{{ route('login') }}" class="btn-login">LOGIN</a>
    <button class="hamburger" id="hamburgerBtn" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>
<div class="mobile-overlay" id="mobileOverlay"></div>
<div class="mobile-menu" id="mobileMenu">
    <ul>
        <li><a href="{{ route('home') }}">Beranda</a></li>
        <li><a href="{{ route('menu.index') }}">Menu</a></li>
        <li><a href="{{ route('tentang') }}">Tentang</a></li>
        <li><a href="{{ route('lokasi') }}" class="active">Lokasi</a></li>
    </ul>
    <a href="{{ route('login') }}" class="mobile-login">LOGIN</a>
</div>

<!-- HERO -->
<section class="lokasi-hero">
    <div class="hero-bubbles" id="heroBubbles"></div>
    <div class="hero-dots"    id="heroDots"></div>
    <div class="hero-bg360">360</div>
    <div class="hero-content">
        <p class="hero-label"><span class="lline"></span>TEMUKAN KAMI</p>
        <h1 class="hero-title">Kami ada di<br><span class="hero-acc">Waru, Kaltim.</span></h1>
        <p class="hero-sub">{{ $alamat }}</p>
    </div>
</section>

<!-- MAP -->
<div class="map-section">
    <div id="leaflet-map"></div>
    <div class="map-overlay">
        <div class="mo-name">☕ Street 360 Coffee</div>
        <div class="mo-addr">{{ $alamat }}<br>{{ $alamat_detail }}</div>
    </div>
    <div class="map-overlay-right">
        <div class="mo-status-label">Status</div>
        <div class="mo-status-badge" id="map-status-badge">
            <span class="bdot" id="map-bdot"></span>
            <span id="map-status-text">...</span>
        </div>
    </div>
</div>

<!-- BODY -->
<div class="lokasi-body">

    <div class="detail-header">
        <p class="detail-title">Detail Lokasi</p>
        <div class="badge" id="status-badge">
            <span class="bdot" id="status-bdot"></span>
            <span id="status-text">Mengecek...</span>
        </div>
    </div>

    <!-- ALAMAT -->
    <div class="card">
        <div class="card-header">ALAMAT</div>
        <div class="card-body">
            <div class="row-info">
                <div class="icon-box">📍</div>
                <div>
                    <div class="info-sub">Alamat Lengkap</div>
                    <div class="info-main">{{ $alamat }}</div>
                    <div class="info-note">{{ $alamat_detail }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAM -->
    <div class="card">
        <div class="card-header">JAM OPERASIONAL</div>
        <div class="card-body">
            <div class="jam-row">
                <div class="row-info">
                    <div class="icon-box">🕔</div>
                    <div>
                        <div class="info-sub">{{ $hari_operasional }}</div>
                        <div class="info-main">Setiap Hari</div>
                    </div>
                </div>
                <div class="jam-time-big">{{ $jam_buka }} – {{ $jam_tutup }}</div>
            </div>
        </div>
    </div>

    <div class="warning-box">
        ⚠️ &nbsp;Jam buka bisa berubah saat hari libur nasional.
    </div>

    <!-- KONTAK -->
    <div class="card">
        <div class="card-header">KONTAK</div>
        <div class="card-body">
            <div class="row-info">
                <div class="icon-box">📞</div>
                <div>
                    <div class="info-sub">WhatsApp</div>
                    <div class="info-main">
                        <a class="kontak-link"
                           href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}"
                           target="_blank">{{ $whatsapp }}</a>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="row-info">
                <div class="icon-box">📸</div>
                <div>
                    <div class="info-sub">Instagram</div>
                    <div class="info-main">
                        <a class="kontak-link"
                           href="https://instagram.com/{{ ltrim($instagram, '@') }}"
                           target="_blank">{{ $instagram }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PEMBAYARAN -->
    <div class="card">
        <div class="card-header">PEMBAYARAN</div>
        <div class="card-body">
            <div class="row-info">
                <div class="icon-box">💳</div>
                <div>
                    <div class="info-sub">Metode yang Diterima</div>
                    <div class="pay-chips">
                        <div class="pay-chip">💵 Tunai</div>
                        <div class="pay-chip">📲 QRIS</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ $maps_url }}" target="_blank" class="btn-maps">
        <span>🗺️</span>
        <span class="btn-maps-text">Buka di Google Maps</span>
        <span class="btn-maps-arrow">→</span>
    </a>

</div>

<footer class="footer">
    <p>Waru, Penajam Paser Utara · Kalimantan Timur</p>
    <p>© 2025 Street 360 Coffee. All rights reserved.</p>
</footer>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
var LAT = -1.2650;
var LNG = 116.5200;

var map = L.map('leaflet-map', {
    center: [LAT, LNG], zoom: 17,
    zoomControl: true, scrollWheelZoom: false
});
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© <a href="https://www.openstreetmap.org/">OpenStreetMap</a>', maxZoom: 19
}).addTo(map);

var goldIcon = L.divIcon({
    className: '',
    html: '<div style="position:relative;width:40px;height:40px">' +
          '<div style="width:40px;height:40px;background:linear-gradient(135deg,#f0c96a,#d4a843);border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 6px 20px rgba(0,0,0,0.4)"></div>' +
          '<div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-60%);font-size:16px">☕</div>' +
          '</div>',
    iconSize: [40, 40], iconAnchor: [20, 40], popupAnchor: [0, -44]
});

L.marker([LAT, LNG], { icon: goldIcon })
    .addTo(map)
    .bindPopup(
        '<div class="popup-name">☕ Street 360 Coffee</div>' +
        '<div class="popup-addr">{{ $alamat }}<br>{{ $alamat_detail }}</div>' +
        '<div class="popup-jam">🕔 {{ $jam_buka }} – {{ $jam_tutup }} WITA</div>'
    )
    .openPopup();

L.circle([LAT, LNG], {
    color: 'rgba(212,168,67,0.5)', fillColor: 'rgba(212,168,67,0.07)',
    fillOpacity: 1, radius: 120, weight: 1.5
}).addTo(map);

/* ══ CEK STATUS BUKA/TUTUP — WITA (UTC+8) ══
   Mendukung rentang melewati tengah malam, misal 17.30 – 01.00
   ================================================ */
(function () {

    /* Konversi string jam "17.30" atau "17,30" → total menit */
    function parseJam(s) {
        var clean = s.toString().replace(',', '.');
        var parts = clean.split('.');
        var jam   = parseInt(parts[0], 10) || 0;
        var menit = parseInt(parts[1] || '0', 10) || 0;
        return jam * 60 + menit;
    }

    /* Ambil waktu WITA saat ini (UTC+8) */
    var nowWITA  = new Date(new Date().toLocaleString('en-US', { timeZone: 'Asia/Makassar' }));
    var menitNow = nowWITA.getHours() * 60 + nowWITA.getMinutes();

    var jamBukaStr  = "{{ $jam_buka }}";
    var jamTutupStr = "{{ $jam_tutup }}";

    var buka  = parseJam(jamBukaStr);
    var tutup = parseJam(jamTutupStr);

    var isOpen;
    if (tutup <= buka) {
        /*
         * Rentang melewati tengah malam (contoh: 17.30 → 01.00)
         * Buka jika sekarang >= jam buka  ATAU  sekarang < jam tutup
         */
        isOpen = menitNow >= buka || menitNow < tutup;
    } else {
        /* Rentang normal dalam satu hari (contoh: 08.00 → 22.00) */
        isOpen = menitNow >= buka && menitNow < tutup;
    }

    /* Terapkan ke semua elemen status */
    var badge = document.getElementById('status-badge');
    var bdot  = document.getElementById('status-bdot');
    var text  = document.getElementById('status-text');
    var mBdot = document.getElementById('map-bdot');
    var mText = document.getElementById('map-status-text');

    if (isOpen) {
        badge.className          = 'badge badge-open';
        bdot.className           = 'bdot bdot-open';
        text.textContent         = 'Sedang Buka';
        mBdot.className          = 'bdot bdot-open';
        mText.textContent        = 'Sedang Buka';
        mText.style.color        = '#10b981';
    } else {
        badge.className          = 'badge badge-closed';
        bdot.className           = 'bdot bdot-closed';
        text.textContent         = 'Sedang Tutup';
        mBdot.className          = 'bdot bdot-closed';
        mText.textContent        = 'Sedang Tutup';
        mText.style.color        = '#ef4444';
    }

})();

/* ══ ANIMASI HERO ══ */
(function(){
    var w=document.getElementById('heroBubbles');
    [16,24,12,30,18,10,26,14,20,9].forEach(function(s,i){
        var b=document.createElement('div'); b.className='bubble';
        b.style.cssText='width:'+s+'px;height:'+s+'px;left:'+[6,14,23,33,43,53,63,72,82,91][i]+'%;animation-duration:'+(3.5+(i%4))+'s;animation-delay:'+(i*0.55)+'s';
        w.appendChild(b);
    });
})();

(function(){
    var w=document.getElementById('heroDots');
    for(var i=0;i<10;i++){
        var d=document.createElement('div'); d.className='hdot';
        var s=3+Math.random()*8;
        d.style.cssText='width:'+s+'px;height:'+s+'px;left:'+Math.random()*100+'%;top:'+(10+Math.random()*80)+'%;animation-duration:'+(3+Math.random()*4)+'s;animation-delay:'+(Math.random()*3)+'s';
        w.appendChild(d);
    }
})();

/* ══ SCROLL REVEAL CARDS ══ */
(function(){
    var io=new IntersectionObserver(function(entries){
        entries.forEach(function(e,i){
            if(e.isIntersecting){ setTimeout(function(){e.target.classList.add('vis');},i*90); io.unobserve(e.target); }
        });
    },{threshold:0.06});
    document.querySelectorAll('.card,.warning-box,.btn-maps').forEach(function(el){ io.observe(el); });
})();

/* ══ RIPPLE EFFECT LOGIN BTN ══ */
document.querySelectorAll('.btn-login').forEach(function(btn){
    btn.addEventListener('click',function(e){
        var r=document.createElement('span');
        r.style.cssText='position:absolute;border-radius:50%;transform:scale(0);background:rgba(255,255,255,0.3);animation:rip .55s linear;pointer-events:none;';
        var rect=btn.getBoundingClientRect(),s=Math.max(rect.width,rect.height);
        r.style.width=r.style.height=s+'px';
        r.style.left=(e.clientX-rect.left-s/2)+'px';
        r.style.top=(e.clientY-rect.top-s/2)+'px';
        if(!document.querySelector('#ripStyle')){
            var st=document.createElement('style');st.id='ripStyle';
            st.textContent='@keyframes rip{to{transform:scale(4);opacity:0}}';
            document.head.appendChild(st);
        }
        btn.style.position='relative'; btn.style.overflow='hidden';
        btn.appendChild(r); setTimeout(function(){r.remove();},600);
    });
});

/* ══ HAMBURGER TOGGLE ══ */
(function(){
    const btn     = document.getElementById('hamburgerBtn');
    const menu    = document.getElementById('mobileMenu');
    const overlay = document.getElementById('mobileOverlay');
    if(!btn||!menu) return;
    function toggle(){
        btn.classList.toggle('active');
        menu.classList.toggle('open');
        overlay.classList.toggle('open');
        document.body.style.overflow = menu.classList.contains('open') ? 'hidden' : '';
    }
    btn.addEventListener('click', toggle);
    overlay.addEventListener('click', toggle);
})();
</script>
</body>
</html>