<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lokasi — Street 360.coffee</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
:root {
    --navy: #1a2340;
    --gold: #d4a843;
    --white: #ffffff;
    --light: #f3f4f6;
    --font: 'Poppins', sans-serif;
}
body { font-family: var(--font); background: #e5e7eb; }

/* NAVBAR */
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

/* HERO */
.lokasi-hero {
    background: var(--navy); color: var(--white);
    padding: 80px 8%; position: relative; overflow: hidden;
}
.hero-bg {
    position: absolute; right: 5%; top: 50%;
    transform: translateY(-50%);
    font-size: 200px; font-weight: 900;
    color: rgba(255,255,255,0.05);
    pointer-events: none; user-select: none;
}
.hero-title { font-size: 48px; font-weight: 900; }
.hero-sub { margin-top: 10px; color: rgba(255,255,255,0.7); }

/* MAP */
.map-wrap { height: 320px; }
.map-wrap iframe { width: 100%; height: 100%; border: none; }

/* BODY */
.lokasi-body { max-width: 900px; margin: auto; padding: 24px; }

.detail-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
.detail-header h3 { font-size: 18px; font-weight: 700; }

/* Badge dinamis */
.badge { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
.badge-open   { background: #d1fae5; color: #065f46; }
.badge-closed { background: #fee2e2; color: #991b1b; }

.card { border-radius: 18px; overflow: hidden; background: var(--white); margin-bottom: 16px; }
.card-header { background: var(--navy); padding: 14px 16px; color: var(--gold); font-weight: 800; font-size: 13px; letter-spacing: 1px; }
.card-body { background: var(--light); padding: 16px; }

.row { display: flex; gap: 12px; align-items: flex-start; }
.icon { width: 38px; height: 38px; background: #ddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 18px; }
.sub  { font-size: 12px; color: #999; margin-bottom: 2px; }
.main { font-weight: 700; font-size: 14px; }

.jam { display: flex; justify-content: space-between; align-items: center; }

.warning {
    background: #fff3cd; padding: 12px 16px; border-radius: 12px;
    color: #c0392b; font-size: 12px; margin-bottom: 16px;
    border-left: 3px solid #f39c12;
}

.kontak-item { display: flex; gap: 12px; align-items: flex-start; }
.divider { height: 1px; background: #ddd; margin: 12px 0; }
.kontak-link { color: inherit; text-decoration: none; }
.kontak-link:hover { text-decoration: underline; }

.btn-maps {
    display: block; text-align: center; padding: 16px;
    background: var(--navy); color: var(--white);
    border-radius: 14px; text-decoration: none;
    font-weight: 700; font-size: 15px; transition: opacity .2s;
}
.btn-maps:hover { opacity: 0.85; }

/* FOOTER */
.footer { background: var(--navy); color: #aaa; text-align: center; padding: 20px; font-size: 13px; }

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
        <li><a href="{{ route('tentang') }}">Tentang</a></li>
        <li><a href="{{ route('lokasi') }}" class="active">Lokasi</a></li>
    </ul>
    <a href="{{ route('login') }}" class="btn-login">LOGIN</a>
</nav>

<section class="lokasi-hero">
    <div class="hero-bg">360</div>
    <h1 class="hero-title">Temukan Kami</h1>
    <p class="hero-sub">{{ $alamat }}</p>
</section>

<div class="map-wrap">
    <iframe
        src="https://maps.google.com/maps?q={{ urlencode($maps_query) }}&t=&z=15&output=embed"
        allowfullscreen
        loading="lazy">
    </iframe>
</div>

<div class="lokasi-body">

    <div class="detail-header">
        <h3>Detail Lokasi</h3>
        <div class="badge" id="status-badge">● Mengecek...</div>
    </div>

    {{-- ALAMAT --}}
    <div class="card">
        <div class="card-header">ALAMAT</div>
        <div class="card-body">
            <div class="row">
                <div class="icon">📍</div>
                <div>
                    <div class="sub">Alamat Lengkap</div>
                    <div class="main">{{ $alamat }}</div>
                    <div class="sub" style="margin-top:4px">{{ $alamat_detail }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- JAM OPERASIONAL --}}
    <div class="card">
        <div class="card-header">JAM OPERASIONAL</div>
        <div class="card-body jam">
            <span class="sub">{{ $hari_operasional }}</span>
            <span class="main">{{ $jam_buka }} – {{ $jam_tutup }}</span>
        </div>
    </div>

    <div class="warning">
        ⚠️ Jam buka bisa berubah saat hari libur nasional
    </div>

    {{-- KONTAK --}}
    <div class="card">
        <div class="card-header">KONTAK</div>
        <div class="card-body">
            <div class="kontak-item">
                <div class="icon">📞</div>
                <div>
                    <div class="sub">WhatsApp</div>
                    <div class="main">
                        <a class="kontak-link"
                           href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}"
                           target="_blank">
                            {{ $whatsapp }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="kontak-item">
                <div class="icon">📸</div>
                <div>
                    <div class="sub">Instagram</div>
                    <div class="main">
                        <a class="kontak-link"
                           href="https://instagram.com/{{ ltrim($instagram, '@') }}"
                           target="_blank">
                            {{ $instagram }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ $maps_url }}" target="_blank" class="btn-maps">
        🗺️ Buka di Google Maps
    </a>

</div>

<div class="footer">
    © 2025 Street 360 Coffee
</div>

{{-- ═══════════════════════════════════════════════════
     Script: cek status buka/tutup otomatis WITA
     Timezone: Asia/Makassar (UTC+8 = WITA)
     ═══════════════════════════════════════════════════ --}}
<script>
(function () {
    var jamBukaStr  = "{{ $jam_buka }}";
    var jamTutupStr = "{{ $jam_tutup }}";

    function parseJam(str) {
        var parts = str.replace(',', '.').split('.');
        return parseInt(parts[0]) * 60 + parseInt(parts[1] || 0);
    }

    var now        = new Date(new Date().toLocaleString('en-US', { timeZone: 'Asia/Makassar' }));
    var totalMenit = now.getHours() * 60 + now.getMinutes();
    var buka       = parseJam(jamBukaStr);
    var tutup      = parseJam(jamTutupStr);
    var isOpen     = totalMenit >= buka && totalMenit < tutup;

    var badge = document.getElementById('status-badge');
    if (isOpen) {
        badge.textContent = '● Sedang Buka';
        badge.className   = 'badge badge-open';
    } else {
        badge.textContent = '● Sedang Tutup';
        badge.className   = 'badge badge-closed';
    }
})();
</script>

</body>
</html>