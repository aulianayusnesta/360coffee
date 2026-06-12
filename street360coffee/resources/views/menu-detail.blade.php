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
            --gold: #d4a843;
            --white: #ffffff;
            --light: #f5f5f0;
            --text: #1a1a1a;
            --font: 'Poppins', sans-serif;
        }
        body { font-family: var(--font); background: var(--light); color: var(--text); overflow-x: hidden; }

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

        .menu-hero { background: var(--navy); padding: 36px 6% 28px; }
        .hero-title { font-size: clamp(24px, 4vw, 38px); font-weight: 900; color: var(--white); margin-bottom: 6px; }
        .hero-sub   { font-size: 13px; color: var(--gold); font-weight: 600; }

        .filter-wrap {
            background: var(--navy); padding: 0 6% 20px;
            display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
        }
        .filter-btn {
            padding: 8px 20px; border-radius: 20px;
            border: 2px solid rgba(255,255,255,0.2);
            background: transparent; color: rgba(255,255,255,0.7);
            font-family: var(--font); font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all .2s;
        }
        .filter-btn:hover  { border-color: var(--gold); color: var(--gold); }
        .filter-btn.active { background: var(--gold); border-color: var(--gold); color: var(--navy); }
        .menu-count { margin-left: auto; font-size: 12px; color: rgba(255,255,255,0.5); font-weight: 600; }

        .search-wrap { padding: 20px 6% 10px; background: var(--light); }
        .search-input {
            width: 100%; padding: 14px 18px; border-radius: 10px;
            border: 2px solid #e0e0e0; background: var(--white);
            font-family: var(--font); font-size: 14px; color: var(--text);
            outline: none; transition: border-color .2s;
        }
        .search-input:focus { border-color: var(--gold); }

        .menu-content { padding: 10px 6% 60px; }

        .category-section { margin-bottom: 32px; }
        .category-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 16px; padding-bottom: 10px;
            border-bottom: 2px solid var(--navy);
        }
        .category-name {
            display: flex; align-items: center; gap: 10px;
            font-size: 15px; font-weight: 800; color: var(--navy);
            text-transform: uppercase; letter-spacing: 1px;
        }
        .category-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--gold); }
        .category-count { font-size: 12px; color: #aaa; font-weight: 600; }

        .items-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }
        @media (min-width: 768px) { .items-grid { grid-template-columns: repeat(4, 1fr); } }

        .menu-card {
            background: var(--navy); border-radius: 14px; overflow: hidden;
            position: relative; box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            transition: transform .25s, box-shadow .25s;
        }
        .menu-card:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(0,0,0,0.25); }
        .menu-card.unavailable { opacity: 0.55; }

        .menu-badge {
            position: absolute; top: 8px; left: 8px;
            font-size: 9px; font-weight: 700;
            padding: 3px 9px; border-radius: 20px; z-index: 2;
        }
        .badge-best  { background: var(--gold);  color: var(--navy); }
        .badge-new   { background: #3daa5c;       color: var(--white); }
        .badge-habis { background: #e53935;        color: var(--white); }

        .menu-img-wrap {
            width: 100%; aspect-ratio: 1/1;
            background: #ffffff; /* ← DIUBAH jadi putih */
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
        }
        .menu-img-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .no-img { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; }

        .menu-info { padding: 10px 12px 14px; }
        .menu-name  { font-size: 14px; font-weight: 700; color: var(--white); margin-bottom: 6px; }

        .menu-desc {
            font-size: 11px;
            color: rgba(255,255,255,0.5);
            line-height: 1.5;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .menu-footer { display: flex; align-items: center; justify-content: space-between; }
        .menu-price  { font-size: 13px; font-weight: 700; color: var(--white); }
        .menu-tag { font-size: 9px; font-weight: 700; padding: 3px 10px; border-radius: 20px; }
        .tag-kopi    { background: var(--gold);  color: var(--navy); }
        .tag-nonkopi { background: #2e7d32;       color: var(--white); }
        .tag-snack   { background: #e65100;       color: var(--white); }

        .hidden { display: none !important; }

        .footer { background: var(--navy); text-align: center; padding: 28px 6%; }
        .footer p { font-size: 12px; color: rgba(255,255,255,0.45); line-height: 1.8; }

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
        <li><a href="{{ route('menu.index') }}" class="active">Menu</a></li>
        <li><a href="{{ route('tentang') }}">Tentang</a></li>
        <li><a href="{{ route('lokasi') }}">Lokasi</a></li>
    </ul>
    <a href="{{ route('login') }}" class="btn-login">LOGIN</a>
</nav>

<div class="menu-hero">
    <h1 class="hero-title">Menu Kami</h1>
    <p class="hero-sub">Kopi lokal · Minuman segar · Snack pendamping</p>
</div>

<div class="filter-wrap">
    <button class="filter-btn active" onclick="filterMenu('semua', this)">Semua</button>
    <button class="filter-btn" onclick="filterMenu('kopi', this)">Kopi</button>
    <button class="filter-btn" onclick="filterMenu('non-kopi', this)">Non-Kopi</button>
    <button class="filter-btn" onclick="filterMenu('snack', this)">Snack</button>
    <span class="menu-count" id="menuCount">{{ $total }} Menu Tersedia</span>
</div>

<div class="search-wrap">
    <input type="text" class="search-input" placeholder="Cari Menu ....." id="searchInput" oninput="searchMenu()">
</div>

<div class="menu-content">

    @php
        $kategoriList = [
            'kopi'     => 'KOPI',
            'non-kopi' => 'NON-KOPI',
            'snack'    => 'SNACK',
        ];
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
                        <span class="menu-badge {{ $item->badge === 'New' ? 'badge-new' : 'badge-best' }}">
                            {{ $item->badge }}
                        </span>
                    @endif

                    <div class="menu-img-wrap">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                        @else
                            <div class="no-img">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="1">
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
    function filterMenu(category, btn) {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const sections = document.querySelectorAll('.category-section');
        let count = 0;

        sections.forEach(section => {
            if (category === 'semua' || section.dataset.category === category) {
                section.classList.remove('hidden');
                section.querySelectorAll('.menu-card').forEach(card => {
                    card.classList.remove('hidden');
                    count++;
                });
            } else {
                section.classList.add('hidden');
            }
        });

        document.getElementById('menuCount').textContent = count + ' Menu Tersedia';
    }

    function searchMenu() {
        const keyword = document.getElementById('searchInput').value.toLowerCase();
        let count = 0;

        document.querySelectorAll('.category-section').forEach(section => {
            let sectionHasResult = false;
            section.querySelectorAll('.menu-card').forEach(card => {
                const name = card.dataset.name;
                if (name.includes(keyword)) {
                    card.classList.remove('hidden');
                    sectionHasResult = true;
                    count++;
                } else {
                    card.classList.add('hidden');
                }
            });
            sectionHasResult ? section.classList.remove('hidden') : section.classList.add('hidden');
        });

        document.getElementById('menuCount').textContent = count + ' Menu Tersedia';
    }
</script>

</body>
</html>