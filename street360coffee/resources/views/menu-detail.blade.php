{{-- resources/views/menu/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu — Street 360.coffee</title>
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
        body { font-family: var(--font); background: var(--light); color: var(--text); overflow-x: hidden; }

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
        .brand-top  { font-size:18px; font-weight:900; background:linear-gradient(135deg,#fff,#e8dfc4); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .brand-dot  { font-size:18px; font-weight:900; color:#fff; }
        .brand-accent { font-size:18px; font-weight:900; background:linear-gradient(135deg,var(--gold2),var(--gold),var(--gold3)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .navbar-menu { display: flex; list-style: none; gap: 38px; }
        .navbar-menu a {
            color: rgba(255,255,255,0.75); text-decoration: none;
            font-size: 14px; font-weight: 600; position: relative;
            transition: color .2s; letter-spacing: 0.3px;
        }
        .navbar-menu a::after {
            content: ''; position: absolute; bottom: -4px; left: 0;
            width: 0; height: 2px;
            background: linear-gradient(90deg,var(--gold2),var(--gold));
            transition: width .25s; border-radius: 2px;
        }
        .navbar-menu a:hover::after, .navbar-menu a.active::after { width: 100%; }
        .navbar-menu a:hover, .navbar-menu a.active { color: var(--gold2); }
        .btn-login {
            background: linear-gradient(135deg,#f5ca5e 0%,#d4a843 55%,#b8882a 100%);
            color: #0d1526; font-size: 13px; font-weight: 800;
            padding: 9px 26px; border-radius: 30px; text-decoration: none;
            letter-spacing: 0.5px; box-shadow: 0 2px 12px rgba(212,168,67,0.45);
            transition: box-shadow .2s, transform .15s;
        }
        .btn-login:hover { box-shadow: 0 4px 22px rgba(212,168,67,0.65); transform: translateY(-1px); }

        /* ══ HERO ══ */
        .menu-hero {
            position: relative; overflow: hidden;
            padding: 52px 6% 72px;
            background: linear-gradient(135deg,#080f1f 0%,#0d1526 30%,#1a2340 60%,#101828 85%,#080f1f 100%);
        }
        .menu-hero::after { display: none; }
        .hero-bg360 {
            position: absolute; right: -1%; top: 50%; transform: translateY(-50%);
            font-size: clamp(140px, 20vw, 300px); font-weight: 900;
            color: transparent; -webkit-text-stroke: 2px rgba(212,168,67,0.1);
            pointer-events: none; user-select: none; line-height: 1;
            animation: pulse360 6s ease-in-out infinite; z-index: 1;
        }
        @keyframes pulse360 {
            0%,100% { -webkit-text-stroke-color: rgba(212,168,67,0.1); transform: translateY(-50%) scale(1); }
            50%      { -webkit-text-stroke-color: rgba(212,168,67,0.2); transform: translateY(-50%) scale(1.025); }
        }
        .hero-bubbles { position: absolute; inset: 0; pointer-events: none; z-index: 2; overflow: hidden; }
        .bubble { position: absolute; bottom: -60px; border-radius: 50%; background: rgba(212,168,67,0.1); border: 1px solid rgba(212,168,67,0.22); animation: floatUp linear infinite; }
        @keyframes floatUp { 0%{transform:translateY(0);opacity:0} 10%{opacity:0.6} 90%{opacity:0.2} 100%{transform:translateY(-320px);opacity:0} }
        .hero-dots { position: absolute; inset: 0; pointer-events: none; overflow: hidden; z-index: 1; }
        .dot { position: absolute; border-radius: 50%; background: rgba(212,168,67,0.09); animation: dotF linear infinite; }
        @keyframes dotF { 0%{transform:translateY(0);opacity:0.4} 50%{opacity:0.7} 100%{transform:translateY(-36px);opacity:0} }

        .hero-content { position: relative; z-index: 3; animation: hIn .85s cubic-bezier(.22,1,.36,1) both; }
        @keyframes hIn { from{opacity:0;transform:translateX(-24px)} to{opacity:1;transform:translateX(0)} }
        .hero-label { display: flex; align-items: center; gap: 10px; font-size: 12px; font-weight: 700; color: var(--gold2); letter-spacing: 2px; text-transform: uppercase; margin-bottom: 14px; }
        .lline { display: inline-block; width: 32px; height: 2px; background: linear-gradient(90deg,var(--gold2),var(--gold)); border-radius: 2px; flex-shrink: 0; }
        .hero-title { font-size: clamp(26px,4vw,48px); font-weight: 900; color: #fff; margin-bottom: 8px; line-height: 1.15; }
        .hero-acc { background: linear-gradient(135deg,var(--gold3),var(--gold),var(--gold2)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero-sub { font-size: 13px; color: rgba(255,255,255,0.5); font-weight: 500; letter-spacing: 0.5px; }

        /* ══ FILTER BAR ══ */
        .filter-wrap {
            background: linear-gradient(105deg,#060d1c 0%,#111b33 40%,#1a2340 70%,#060d1c 100%);
            padding: 0 6% 20px;
            display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
            border-bottom: none;
        }
        .filter-btn {
            padding: 8px 20px; border-radius: 20px;
            border: 1.5px solid rgba(255,255,255,0.15);
            background: transparent; color: rgba(255,255,255,0.65);
            font-family: var(--font); font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all .2s;
        }
        .filter-btn:hover  { border-color: var(--gold2); color: var(--gold2); background: rgba(212,168,67,0.07); }
        .filter-btn.active {
            background: linear-gradient(135deg,#f5ca5e,#d4a843,#b8882a);
            border-color: transparent; color: var(--navy2);
            box-shadow: 0 2px 14px rgba(212,168,67,0.4);
        }
        .menu-count { margin-left: auto; font-size: 12px; color: rgba(255,255,255,0.4); font-weight: 600; }

        /* ══ SEARCH ══ */
        .search-wrap { padding: 20px 6% 10px; background: var(--light); }
        .search-inner { position: relative; }
        .search-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); opacity: 0.35; pointer-events: none; }
        .search-input {
            width: 100%; padding: 14px 18px 14px 46px; border-radius: 12px;
            border: 2px solid #e0e0e0; background: var(--white);
            font-family: var(--font); font-size: 14px; color: var(--text);
            outline: none; transition: border-color .25s, box-shadow .25s;
        }
        .search-input:focus { border-color: var(--gold); box-shadow: 0 0 0 4px rgba(212,168,67,0.12); }

        /* ══ MENU CONTENT ══ */
        .menu-content { padding: 24px 6% 60px; background: var(--light); }

        .category-section { margin-bottom: 40px; opacity: 0; transform: translateY(20px); transition: opacity .6s ease, transform .6s ease; }
        .category-section.vis { opacity: 1; transform: translateY(0); }

        .category-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 18px; padding-bottom: 12px;
            border-bottom: 2px solid transparent;
            background: linear-gradient(var(--light),var(--light)) padding-box,
                        linear-gradient(90deg,var(--navy) 60%,rgba(212,168,67,0.3)) border-box;
        }
        .category-name {
            display: flex; align-items: center; gap: 10px;
            font-size: 14px; font-weight: 800; color: var(--navy);
            text-transform: uppercase; letter-spacing: 1.5px;
        }
        .category-dot { width: 8px; height: 8px; border-radius: 50%; background: linear-gradient(135deg,var(--gold2),var(--gold)); box-shadow: 0 0 8px rgba(212,168,67,0.6); }
        .category-count { font-size: 11px; color: #bbb; font-weight: 600; }

        .items-grid { display: grid; grid-template-columns: repeat(2,1fr); gap: 16px; }
        @media(min-width:768px) { .items-grid { grid-template-columns: repeat(4,1fr); } }

        /* ══ MENU CARD ══ */
        .menu-card {
            background: linear-gradient(160deg,#1e2a4a 0%,#1a2340 55%,#101828 100%);
            border-radius: 16px; overflow: hidden;
            position: relative;
            border: none;
            box-shadow: 0 4px 18px rgba(0,0,0,0.25);
            transition: transform .28s cubic-bezier(.22,1,.36,1), box-shadow .28s;
            opacity: 0; transform: translateY(16px);
            animation: none;
        }
        .menu-card.card-vis {
            animation: cardIn .5s cubic-bezier(.22,1,.36,1) forwards;
        }
        @keyframes cardIn { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }
        .menu-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg,transparent,rgba(212,168,67,0.35),transparent);
        }
        .menu-card:hover {
            transform: translateY(-6px) scale(1.01);
            box-shadow: 0 18px 42px rgba(0,0,0,0.4), 0 0 0 1px rgba(212,168,67,0.35);
        }
        .menu-card.unavailable { opacity: 0.5; }
        .menu-card.unavailable.card-vis { animation: cardIn .5s cubic-bezier(.22,1,.36,1) forwards; }

        .menu-badge { position: absolute; top: 9px; left: 9px; font-size: 9px; font-weight: 700; padding: 3px 9px; border-radius: 20px; z-index: 2; letter-spacing: 0.5px; }
        .badge-best  { background: linear-gradient(135deg,var(--gold2),var(--gold)); color: var(--navy2); box-shadow: 0 2px 8px rgba(212,168,67,0.5); }
        .badge-new   { background: linear-gradient(135deg,#4dbf6e,#2e9e50); color: #fff; }
        .badge-habis { background: #e53935; color: #fff; }

        .menu-img-wrap {
            width: 100%; aspect-ratio: 1/1; background: #fff;
            overflow: hidden; display: flex; align-items: center; justify-content: center;
        }
        .menu-img-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .4s ease; }
        .menu-card:hover .menu-img-wrap img { transform: scale(1.06); }
        .no-img { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f7f7f5; }

        .menu-info { padding: 11px 13px 15px; }
        .menu-name  { font-size: 14px; font-weight: 700; color: #fff; margin-bottom: 6px; }
        .menu-desc  {
            font-size: 11px; color: rgba(255,255,255,0.45); line-height: 1.55; margin-bottom: 10px;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }
        .menu-footer { display: flex; align-items: center; justify-content: space-between; }
        .menu-price  {
            font-size: 13px; font-weight: 700;
            color: var(--gold2);
        }
        .menu-tag { font-size: 9px; font-weight: 700; padding: 3px 10px; border-radius: 20px; letter-spacing: 0.5px; }
        .tag-kopi    { background: linear-gradient(135deg,var(--gold2),var(--gold)); color: var(--navy2); }
        .tag-nonkopi { background: #2e7d32; color: #fff; }
        .tag-snack   { background: #e65100; color: #fff; }

        .hidden { display: none !important; }

        /* ══ FOOTER ══ */
        .footer { background: linear-gradient(135deg,var(--navy2),var(--navy),var(--navy3)); text-align: center; padding: 32px 6%; border-top: 1px solid rgba(212,168,67,0.2); }
        .footer p { font-size: 12px; color: rgba(255,255,255,0.4); line-height: 1.9; }

        @media(max-width:480px) { .navbar-menu { display: none; } .navbar { padding: 0 20px; } }
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
        <li><a href="{{ route('menu.index') }}" class="active">Menu</a></li>
        <li><a href="{{ route('tentang') }}">Tentang</a></li>
        <li><a href="{{ route('lokasi') }}">Lokasi</a></li>
    </ul>
    <a href="{{ route('login') }}" class="btn-login">LOGIN</a>
</nav>

<!-- HERO -->
<div class="menu-hero">
    <div class="hero-bubbles" id="heroBubbles"></div>
    <div class="hero-dots"    id="heroDots"></div>
    <div class="hero-bg360">360</div>
    <div class="hero-content">
        <p class="hero-label"><span class="lline"></span>PILIHAN TERBAIK KAMI</p>
        <h1 class="hero-title">Menu <span class="hero-acc">Kami</span></h1>
        <p class="hero-sub">Kopi lokal &nbsp;·&nbsp; Minuman segar &nbsp;·&nbsp; Snack pendamping</p>
    </div>
</div>

<!-- FILTER -->
<div class="filter-wrap">
    <button class="filter-btn active" onclick="filterMenu('semua', this)">Semua</button>
    <button class="filter-btn" onclick="filterMenu('kopi', this)">Kopi</button>
    <button class="filter-btn" onclick="filterMenu('non-kopi', this)">Non-Kopi</button>
    <button class="filter-btn" onclick="filterMenu('snack', this)">Snack</button>
    <span class="menu-count" id="menuCount">{{ $total }} Menu Tersedia</span>
</div>

<!-- SEARCH -->
<div class="search-wrap">
    <div class="search-inner">
        <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" class="search-input" placeholder="Cari menu kopi, minuman, snack..." id="searchInput" oninput="searchMenu()">
    </div>
</div>

<!-- MENU GRID -->
<div class="menu-content">

    @php
        $kategoriList = ['kopi' => 'KOPI', 'non-kopi' => 'NON-KOPI', 'snack' => 'SNACK'];
    @endphp

    @foreach($kategoriList as $slug => $label)
        @if(isset($menus[$slug]) && $menus[$slug]->count())
        <div class="category-section" id="cat-{{ $slug }}" data-category="{{ $slug }}">
            <div class="category-header">
                <div class="category-name">
                    <span class="category-dot"></span> {{ $label }}
                </div>
                <span class="category-count">{{ $menus[$slug]->count() }} menu</span>
            </div>
            <div class="items-grid">
                @foreach($menus[$slug] as $item)
                <div class="menu-card {{ !$item->tersedia ? 'unavailable' : '' }}"
                     data-name="{{ strtolower($item->nama) }}"
                     data-category="{{ $slug }}">

                    @if(!$item->tersedia)
                        <span class="menu-badge badge-habis">Tidak Tersedia</span>
                    @elseif($item->badge)
                        <span class="menu-badge {{ $item->badge === 'New' ? 'badge-new' : 'badge-best' }}">{{ $item->badge }}</span>
                    @endif

                    <div class="menu-img-wrap">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" loading="lazy">
                        @else
                            <div class="no-img">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(0,0,0,0.12)" stroke-width="1">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="menu-info">
                        <p class="menu-name">{{ $item->nama }}</p>
                        @if($item->deskripsi)
                            <p class="menu-desc">{{ $item->deskripsi }}</p>
                        @endif
                        <div class="menu-footer">
                            <span class="menu-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                            <span class="menu-tag {{ $slug === 'kopi' ? 'tag-kopi' : ($slug === 'snack' ? 'tag-snack' : 'tag-nonkopi') }}">
                                {{ $slug }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    @endforeach

</div>

<footer class="footer">
    <p>Waru, Penajam Paser Utara · Kalimantan Timur</p>
    <p>© 2025 Street 360 Coffee. All rights reserved.</p>
</footer>

<script>
/* ── Bubbles hero ── */
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

/* ── Scroll reveal: category sections ── */
(function(){
    const io = new IntersectionObserver((entries)=>{
        entries.forEach((e,i)=>{
            if(e.isIntersecting){ setTimeout(()=>e.target.classList.add('vis'), i*60); io.unobserve(e.target); }
        });
    },{threshold:0.08});
    document.querySelectorAll('.category-section').forEach(el=>io.observe(el));
})();

/* ── Scroll reveal: cards (staggered) ── */
(function(){
    const io = new IntersectionObserver((entries)=>{
        entries.forEach((e,i)=>{
            if(e.isIntersecting){
                setTimeout(()=>e.target.classList.add('card-vis'), i*55);
                io.unobserve(e.target);
            }
        });
    },{threshold:0.05, rootMargin:'0px 0px -30px 0px'});
    document.querySelectorAll('.menu-card').forEach(el=>io.observe(el));
})();

/* ── Filter ── */
function filterMenu(category, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    let count = 0;
    document.querySelectorAll('.category-section').forEach(section => {
        if(category === 'semua' || section.dataset.category === category){
            section.classList.remove('hidden');
            section.querySelectorAll('.menu-card').forEach(card=>{ card.classList.remove('hidden'); count++; });
        } else { section.classList.add('hidden'); }
    });
    document.getElementById('menuCount').textContent = count + ' Menu Tersedia';
}

/* ── Search ── */
function searchMenu(){
    const kw = document.getElementById('searchInput').value.toLowerCase();
    let count = 0;
    document.querySelectorAll('.category-section').forEach(section=>{
        let hit = false;
        section.querySelectorAll('.menu-card').forEach(card=>{
            if(card.dataset.name.includes(kw)){ card.classList.remove('hidden'); hit=true; count++; }
            else card.classList.add('hidden');
        });
        hit ? section.classList.remove('hidden') : section.classList.add('hidden');
    });
    document.getElementById('menuCount').textContent = count + ' Menu Tersedia';
}
</script>

</body>
</html>