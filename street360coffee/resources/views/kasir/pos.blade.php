{{-- resources/views/kasir/pos.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir POS — Street 360 Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:       #1a2d52;
            --navy-deep:  #0f1d3a;
            --navy-mid:   #152445;
            --navy-light: #2a4070;
            --navy-ghost: rgba(26,45,82,0.18);
            --navy-ghost2: rgba(26,45,82,0.10);
            --gold:       #c8922a;
            --gold-btn:   #e0a83a;
            --white:      #ffffff;
            --bg-main:    #d4d8e4;
            --bg-panel:   #d0d4de;
            --bg-card:    #ffffff;
            --text-dark:  #1a2d52;
            --text-muted: #6b7ba4;
            --green:      #3a8c3f;
            --border:     rgba(0,0,0,.10);
        }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: #f0f2f7;
            color: var(--text-dark);
            overflow: hidden;
        }

        /* ══ NAVBAR ══ */
        .navbar {
            height: 52px;
            background: linear-gradient(90deg, #0f1d3a 0%, #1a2d52 40%, #1e3460 70%, #162848 100%);
            display: flex;
            align-items: center;
            padding: 0 20px;
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 100;
            box-shadow: 0 2px 18px rgba(0,0,0,.4);
        }
        .nav-brand { display: flex; align-items: center; gap: 0; }
        .nav-brand .street { font-size: 18px; font-weight: 800; color: var(--white); letter-spacing: .04em; }
        .nav-brand .coffee { font-size: 18px; font-weight: 800; color: var(--gold-btn); letter-spacing: .04em; }
        .nav-divider { width: 2px; height: 28px; background: var(--gold-btn); margin: 0 16px; }
        .nav-role { font-size: 15px; font-weight: 800; color: var(--gold-btn); letter-spacing: .1em; }
        .nav-spacer { flex: 1; }

        /* ADMIN — kotak border putih/navy seperti gambar 1 */
        .btn-admin {
            display: flex; align-items: center; gap: 6px;
            background: transparent;
            color: var(--white);
            border: 1.5px solid rgba(255,255,255,0.35);
            border-radius: 6px; padding: 7px 14px;
            font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 700;
            letter-spacing: .06em; cursor: pointer; text-decoration: none;
            transition: background .2s, border-color .2s;
        }
        .btn-admin:hover { background: rgba(255,255,255,0.10); border-color: rgba(255,255,255,0.6); }

        /* LOGOUT — samakan dengan ADMIN, border putih transparan */
        .btn-logout {
            background: transparent;
            color: var(--white);
            border: 1.5px solid rgba(255,255,255,0.35);
            border-radius: 6px; padding: 7px 16px;
            font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 700;
            letter-spacing: .06em; cursor: pointer; margin-left: 8px;
            transition: background .2s, border-color .2s;
        }
        .btn-logout:hover { background: rgba(255,255,255,0.10); border-color: rgba(255,255,255,0.6); }

        /* ══ LAYOUT ══ */
        .main-layout { display: flex; height: calc(100vh - 52px); margin-top: 52px; }

        /* ══ MENU PANEL ══ */
        .menu-panel {
            flex: 1;
            background: #f0f2f7;
            overflow-y: auto; padding: 16px 16px;
        }

        .search-box { position: relative; margin-bottom: 14px; }
        .search-box input {
            width: 100%; background: var(--bg-card);
            border: 1.5px solid rgba(0,0,0,.08); border-radius: 10px;
            padding: 11px 16px 11px 44px;
            font-family: 'DM Sans', sans-serif; font-size: 14px; color: var(--text-dark);
            outline: none; box-shadow: 0 2px 8px rgba(0,0,0,.06); transition: box-shadow .2s;
        }
        .search-box input:focus { box-shadow: 0 0 0 2px rgba(200,146,42,.3); }
        .search-box input::placeholder { color: #aab0c5; }
        .search-box svg { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #aab0c5; }

        /* KATEGORI — biru samar/ghost */
        .cat-row { display: flex; gap: 8px; margin-bottom: 14px; flex-wrap: wrap; }
        .cat-btn {
            padding: 8px 20px; border-radius: 24px;
            border: 1.5px solid rgba(26,45,82,0.20);
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700;
            cursor: pointer; transition: background .2s, color .2s, border-color .2s;
            background: #ffffff;
            color: var(--navy);
        }
        .cat-btn.active {
            background: var(--gold-btn);
            border-color: var(--gold-btn);
            color: var(--white);
        }
        .cat-btn:hover:not(.active) {
            background: rgba(26,45,82,0.20);
            border-color: rgba(26,45,82,0.5);
        }

        .menu-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(170px, 1fr)); gap: 12px; }

        .menu-card {
            background: var(--bg-card); border-radius: 10px; overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,.08); transition: transform .15s, box-shadow .15s;
        }
        .menu-card:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(0,0,0,.13); }

        .menu-card-img { position: relative; width: 100%; height: 120px; background: #dde1ec; overflow: hidden; }
        .menu-card-img img { width: 100%; height: 100%; object-fit: cover; }

        .badge-pill { position: absolute; top: 8px; left: 8px; padding: 4px 11px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .badge-bestseller { background: var(--gold-btn); color: #fff; }
        .badge-new        { background: var(--navy); color: #fff; }

        .habis-overlay {
            position: absolute; inset: 0; background: rgba(255,255,255,.6);
            display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px;
        }
        .habis-overlay .habis-text { font-size: 16px; font-weight: 800; color: #555; }
        .habis-overlay .habis-sub  { font-size: 12px; color: #888; }

        /* CARD BODY — biru navy seperti gambar 3, nama putih */
        .menu-card-body { background: var(--navy); padding: 8px 11px 6px; }
        .menu-card-body .item-name  { font-size: 13px; font-weight: 700; color: var(--white); }
        .menu-card-body .item-price { font-size: 12px; color: var(--gold-btn); margin-top: 1px; font-weight: 600; }

        .menu-card-footer {
            background: var(--navy); padding: 0 11px 10px;
            display: flex; align-items: center; justify-content: space-between; gap: 5px;
        }
        .badge-tersedia {
            background: var(--navy-mid); color: var(--white);
            font-size: 10px; font-weight: 600; padding: 4px 9px; border-radius: 10px; white-space: nowrap;
        }
        .btn-tambah {
            background: var(--green); color: #fff; border: none; border-radius: 6px;
            padding: 5px 11px; font-family: 'DM Sans', sans-serif; font-size: 11px; font-weight: 700;
            cursor: pointer; white-space: nowrap; transition: background .2s;
        }
        .btn-tambah:hover { background: #2e7233; }
        .btn-stok-habis {
            background: linear-gradient(135deg, #e57373 0%, #c0392b 100%);
            color: #fff; border: none; border-radius: 6px;
            padding: 5px 11px; font-size: 11px; font-weight: 700;
            cursor: default; white-space: nowrap;
            box-shadow: 0 2px 6px rgba(192,57,43,0.25);
        }

        /* ══ ORDER PANEL ══ */
        .order-panel {
            width: 440px; min-width: 420px;
            background: #f0f2f7;
            border-left: 1px solid rgba(0,0,0,.08);
            display: flex; flex-direction: column; overflow: hidden;
        }

        .order-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 22px; background: #f0f2f7;
            border-bottom: 1px solid var(--border); gap: 10px;
        }
        .order-header-left { display: flex; align-items: center; gap: 10px; flex: 1; min-width: 0; }
        .order-title {
            display: flex; align-items: center; gap: 8px;
            font-size: 18px; font-weight: 800; color: var(--navy); letter-spacing: .05em;
        }
        .arrow-box {
            background: #b0b8cc; border-radius: 5px; width: 28px; height: 28px;
            display: flex; align-items: center; justify-content: center;
        }
        .btn-antrian {
            background: var(--bg-card); border: 1.5px solid rgba(0,0,0,.12);
            border-radius: 7px; padding: 8px 16px;
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700;
            color: var(--text-dark); cursor: pointer; transition: background .2s;
            text-decoration: none; white-space: nowrap;
        }
        .btn-antrian:hover { background: #dde0ea; }

        /* DINE IN / TAKE AWAY — kecil rata kanan di bawah header */
        .dine-row {
            display: inline-flex;
            border-radius: 7px; overflow: hidden;
            border: 1.5px solid rgba(26,45,82,0.15);
            background: #ffffff;
        }
        .dine-btn {
            padding: 7px 18px; border: none;
            background: #ffffff;
            font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 700;
            color: var(--text-muted); cursor: pointer; transition: background .2s, color .2s;
            white-space: nowrap;
        }
        .dine-btn:hover:not(.active) {
            background: rgba(26,45,82,0.20);
            color: var(--navy);
        }
        .dine-btn.active {
            background: var(--gold-btn);
            color: #fff;
        }

        .order-items { flex: 1; overflow-y: auto; padding: 14px 22px; }
        .empty-order {
            display: flex; align-items: center; justify-content: center;
            height: 100%; font-size: 18px; color: #a0a8bc; font-weight: 600;
        }

        .order-item {
            display: flex; align-items: center; gap: 10px;
            background: var(--bg-card); border-radius: 9px;
            padding: 10px 13px; margin-bottom: 8px;
            box-shadow: 0 1px 5px rgba(0,0,0,.07);
        }
        .oi-info { flex: 1; display: flex; flex-direction: column; gap: 2px; min-width: 0; }
        .oi-name  { font-size: 14px; font-weight: 700; color: var(--navy); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .oi-price { font-size: 12px; color: var(--gold); font-weight: 700; }

        .qty-ctrl { display: flex; align-items: center; gap: 6px; flex-shrink: 0; }
        .qty-btn {
            width: 28px; height: 28px;
            background: var(--navy); color: #fff;
            border: none; border-radius: 50%;
            font-size: 18px; font-weight: 700; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            line-height: 1; transition: background .15s;
        }
        .qty-btn:hover { background: #243360; }
        .qty-num { font-size: 15px; font-weight: 700; min-width: 20px; text-align: center; color: var(--navy); }

        .btn-hapus {
            background: none; border: none; cursor: pointer; color: #9aa3b8;
            padding: 5px; display: flex; align-items: center; justify-content: center;
            border-radius: 6px; transition: color .15s, background .15s; flex-shrink: 0;
        }
        .btn-hapus:hover { color: #c0392b; background: #fdecea; }

        /* ══ ORDER BOTTOM ══ */
        .order-bottom {
            padding: 13px 22px;
            border-top: 1.5px solid rgba(0,0,0,.08);
            background: #f0f2f7;
        }

        .note-row  { display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px; }
        .note-label { font-size: 13px; font-weight: 800; letter-spacing: .06em; color: var(--text-dark); }
        .note-opt   { font-size: 11px; color: var(--text-muted); }
        .note-input {
            width: 100%; background: var(--bg-card);
            border: 1.5px solid rgba(0,0,0,.09); border-radius: 7px;
            padding: 9px 13px; font-family: 'DM Sans', sans-serif;
            font-size: 13px; color: var(--text-dark); resize: none; height: 52px; outline: none;
        }
        .note-input:focus { box-shadow: 0 0 0 2px rgba(200,146,42,.25); border-color: var(--gold); }
        .note-input::placeholder { color: #aab0c2; }

        .summary-row {
            display: flex; justify-content: space-between; align-items: center;
            margin-top: 10px; font-size: 13px; color: var(--text-muted); font-weight: 600;
        }
        .total-row { display: flex; justify-content: space-between; align-items: center; margin-top: 5px; }
        .total-label { font-size: 17px; font-weight: 800; color: var(--navy); }
        .total-value { font-size: 17px; font-weight: 800; color: var(--navy); }

        /* ══ PAY SECTION ══ */
        .pay-section { margin-top: 12px; }

        .pay-header-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 6px;
        }
        .pay-label {
            font-size: 12px; font-weight: 800; letter-spacing: .07em; color: var(--text-dark);
        }

        .pay-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .btn-pay {
            width: 100%; padding: 11px; border: none; border-radius: 9px;
            font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 800;
            letter-spacing: .06em; cursor: pointer; transition: opacity .2s, box-shadow .2s, background .2s;
        }
        .btn-pay:hover { opacity: .9; }

        /* TUNAI — biru samar saat tidak aktif */
        .btn-tunai {
            background: rgba(26,45,82,0.18);
            color: var(--navy);
            border: 2px solid rgba(26,45,82,0.30);
        }
        .btn-tunai.active {
            background: var(--navy);
            color: var(--white);
            border-color: var(--navy);
        }

        /* QRIS — biru samar saat tidak aktif */
        .btn-qris {
            background: rgba(26,45,82,0.10);
            border: 2px solid rgba(26,45,82,0.25);
            color: var(--navy);
            opacity: 0.7;
        }
        .btn-qris.active {
            background: rgba(26,45,82,0.15);
            border: 2.5px solid var(--gold-btn);
            color: var(--gold-btn);
            opacity: 1;
        }

        .uang-input {
            width: 100%; background: var(--bg-card);
            border: 1.5px solid rgba(0,0,0,.1); border-radius: 9px;
            padding: 11px 13px; font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 700; color: var(--text-dark); outline: none;
        }
        .uang-input:focus { box-shadow: 0 0 0 2px rgba(200,146,42,.3); border-color: var(--gold); }

        .btn-proses {
            width: 100%; border: none;
            border-radius: 9px; padding: 11px;
            font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 800;
            letter-spacing: .08em; color: var(--white);
            background: var(--navy);
            cursor: pointer; transition: background .2s;
        }
        .btn-proses:hover { background: var(--navy-deep); }

        .kembalian-info {
            font-size: 12px; margin-top: 6px; font-weight: 600; min-height: 18px;
        }

        /* ══ POPUP STRUK ══ */
        .popup-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,.75);
            z-index: 999;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
        }
        .popup-overlay.show { display: flex; }

        .struk {
            background: #ffffff;
            border-radius: 20px;
            width: 100%; max-width: 380px;
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(0,0,0,.55);
            animation: popUp .35s cubic-bezier(.22,1,.36,1) both;
            margin: 16px;
        }
        @keyframes popUp {
            from { opacity:0; transform: scale(.88) translateY(28px); }
            to   { opacity:1; transform: scale(1)  translateY(0); }
        }

        .struk-header {
            background: var(--navy);
            padding: 24px 28px 20px;
            text-align: center;
        }
        .struk-brand { font-size: 20px; font-weight: 800; color: var(--white); letter-spacing: .06em; margin-bottom: 4px; }
        .struk-brand span { color: var(--gold-btn); }
        .struk-alamat { font-size: 10px; color: rgba(255,255,255,.4); letter-spacing: .14em; text-transform: uppercase; }

        .struk-body { background: #ffffff; padding: 18px 24px 14px; }

        .struk-meta {
            display: grid; grid-template-columns: auto 1fr;
            gap: 6px 16px; margin-bottom: 14px;
            padding-bottom: 14px; border-bottom: 1.5px dashed #d8dce8;
        }
        .struk-meta-key { font-size: 13px; color: #8a93b0; font-weight: 600; }
        .struk-meta-val { font-size: 13px; color: #1a2d52; font-weight: 700; text-align: right; }

        .struk-divider { border: none; border-top: 1.5px dashed #d8dce8; margin: 12px 0; }

        .struk-item-row {
            display: flex; justify-content: space-between; align-items: center;
            font-size: 14px; font-weight: 700; color: #1a2d52; margin-bottom: 8px;
        }
        .struk-item-qty { color: #8a93b0; font-weight: 600; margin-left: 4px; }

        .struk-total-row {
            display: flex; justify-content: space-between; align-items: center;
            font-size: 15px; font-weight: 800; color: #1a2d52;
            margin-top: 10px; padding-top: 11px; border-top: 2px solid #1a2d52;
        }

        .struk-bayar-row {
            display: flex; justify-content: space-between; align-items: center;
            font-size: 13px; font-weight: 700; color: #1a2d52; margin-top: 9px;
        }
        .struk-kembalian-row {
            display: flex; justify-content: space-between; align-items: center;
            font-size: 14px; font-weight: 800; color: #3a8c3f; margin-top: 5px;
        }

        .struk-footer {
            background: #f5f7fb; border-top: 1.5px dashed #d8dce8;
            padding: 14px 24px 16px; text-align: center;
        }
        .struk-terima { font-size: 18px; font-weight: 800; color: #1a2d52; margin-bottom: 3px; }
        .struk-sub { font-size: 12px; color: #8a93b0; letter-spacing: .03em; }

        .btn-transaksi-baru {
            display: block; width: calc(100% - 48px);
            margin: 16px 24px 20px;
            background: var(--navy); color: var(--white);
            border: none; border-radius: 10px; padding: 15px;
            font-family: 'DM Sans', sans-serif; font-size: 15px; font-weight: 800;
            letter-spacing: .06em; cursor: pointer;
            transition: background .2s, transform .1s;
            text-align: center;
        }
        .btn-transaksi-baru:hover { background: #0f1d3a; transform: translateY(-1px); }
        .btn-transaksi-baru:active { transform: translateY(0); }
    </style>
</head>
<body>

{{-- ══ NAVBAR ══ --}}
<nav class="navbar">
    <div class="nav-brand">
        <span class="street">STREET&nbsp;</span>
        <span class="coffee">360.COFFEE</span>
    </div>
    <div class="nav-divider"></div>
    <span class="nav-role">KASIR</span>
    <div class="nav-spacer"></div>

    {{-- ✅ Tombol ADMIN muncul untuk role admin DAN kasir --}}
    @if(in_array(auth()->user()->role, ['admin', 'kasir']))
        <a href="{{ route('admin.dashboard') }}" class="btn-admin">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            ADMIN
        </a>
    @endif

    <form method="POST" action="{{ route('logout') }}" style="margin:0">
        @csrf
        <button type="submit" class="btn-logout">LOG OUT</button>
    </form>
</nav>

{{-- ══ POPUP STRUK ══ --}}
<div class="popup-overlay" id="popupStruk">
    <div class="struk">
        <div class="struk-header">
            <div class="struk-brand">STREET <span>360.COFFEE</span></div>
            <div class="struk-alamat">Waru, Penajam Paser Utara</div>
        </div>
        <div class="struk-body">
            <div class="struk-meta">
                <span class="struk-meta-key">No.</span>
                <span class="struk-meta-val" id="strukNo"></span>
                <span class="struk-meta-key">Waktu</span>
                <span class="struk-meta-val" id="strukWaktu"></span>
                <span class="struk-meta-key">Tipe</span>
                <span class="struk-meta-val" id="strukTipe"></span>
                <span class="struk-meta-key">Catatan</span>
                <span class="struk-meta-val" id="strukCatatan" style="color:#8a93b0;font-weight:600"></span>
            </div>
            <div id="strukItems"></div>
            <div class="struk-total-row">
                <span>Total</span>
                <span id="strukTotal"></span>
            </div>
            <hr class="struk-divider">
            <div class="struk-bayar-row">
                <span id="strukMetodeLabel">Bayar (Tunai)</span>
                <span id="strukUang"></span>
            </div>
            <div class="struk-kembalian-row" id="kembalianRow">
                <span>Kembalian</span>
                <span id="strukKembalian"></span>
            </div>
        </div>
        <div class="struk-footer">
            <div class="struk-terima">Pesanan Masuk Antrian! ✓</div>
            <div class="struk-sub">Selamat Menikmati Kopi Anda</div>
        </div>
        <button onclick="transaksiBaru()" class="btn-transaksi-baru">+ Transaksi Baru</button>
    </div>
</div>

{{-- ══ MAIN LAYOUT ══ --}}
<div class="main-layout">

    {{-- LEFT: MENU PANEL --}}
    <div class="menu-panel">
        <div class="search-box">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="text" id="searchInput" placeholder="Cari Menu....." oninput="filterMenu()">
        </div>

        <div class="cat-row">
            <button class="cat-btn active" data-cat="semua"    onclick="filterCat(this)">Semua</button>
            <button class="cat-btn"        data-cat="kopi"     onclick="filterCat(this)">Kopi</button>
            <button class="cat-btn"        data-cat="non-kopi" onclick="filterCat(this)">Non - Kopi</button>
            <button class="cat-btn"        data-cat="snack"    onclick="filterCat(this)">Snack</button>
        </div>

        <div class="menu-grid" id="menuGrid">
            @foreach($menus as $menu)
            <div class="menu-card"
                 data-cat="{{ $menu->kategori }}"
                 data-name="{{ strtolower($menu->nama) }}">
                <div class="menu-card-img">
                    @if($menu->gambar)
                        <img src="{{ asset('storage/'.$menu->gambar) }}" alt="{{ $menu->nama }}">
                    @else
                        <div style="width:100%;height:100%;background:#ccd0de;display:flex;align-items:center;justify-content:center;">
                            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#8a9ab8" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                        </div>
                    @endif
                    @if($menu->badge)
                        <span class="badge-pill {{ $menu->badge === 'Best Seller' ? 'badge-bestseller' : 'badge-new' }}">
                            {{ $menu->badge }}
                        </span>
                    @endif
                    @if(!$menu->tersedia)
                    <div class="habis-overlay">
                        <span class="habis-text">Habis</span>
                        <span class="habis-sub">Tidak Tersedia</span>
                    </div>
                    @endif
                </div>
                <div class="menu-card-body">
                    <div class="item-name">{{ $menu->nama }}</div>
                    <div class="item-price">Rp. {{ number_format($menu->harga, 0, ',', '.') }}</div>
                </div>
                <div class="menu-card-footer">
                    @if(!$menu->tersedia)
                        <span class="badge-tersedia" style="background:rgba(229,115,115,0.18);color:#e57373;">Habis</span>
                        <button class="btn-stok-habis" disabled>Stok Habis</button>
                    @else
                        <span class="badge-tersedia">Tersedia</span>
                        <button class="btn-tambah"
                            onclick="tambahItem({{ $menu->id }}, '{{ addslashes($menu->nama) }}', {{ $menu->harga }})">
                            + Tambahkan
                        </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- RIGHT: ORDER PANEL --}}
    <div class="order-panel">
        <div class="order-header">
            <div class="order-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 01-8 0"/>
                </svg>
                PESANAN
            </div>
            <a href="{{ route('kasir.antrian') }}" class="btn-antrian">Antrian Pesanan</a>
        </div>

        <div style="display:flex; justify-content:flex-end; padding: 6px 22px 0;">
            <div class="dine-row">
                <button class="dine-btn" id="dineIn"   onclick="setDine('dine_in')">Dine In</button>
                <button class="dine-btn" id="takeAway" onclick="setDine('take_away')">Take Away</button>
            </div>
        </div>

        <div class="order-items" id="orderItems">
            <div class="empty-order">Belum Ada Pesanan</div>
        </div>

        <div class="order-bottom">
            <div class="note-row">
                <span class="note-label">CATATAN PESANAN</span>
                <span class="note-opt">Optional</span>
            </div>
            <textarea class="note-input" id="orderNote" placeholder="Contoh : Less ice, extra shot..."></textarea>

            <div class="summary-row">
                <span id="itemCount">0 item</span>
                <span id="subTotal">Rp. 0</span>
            </div>
            <div class="total-row">
                <span class="total-label">Total</span>
                <span class="total-value" id="totalPrice">Rp. 0</span>
            </div>

            <div class="pay-section">
                <div class="pay-header-row">
                    <div class="pay-label">METODE PEMBAYARAN</div>
                    <div class="pay-label">UANG DITERIMA</div>
                </div>

                <div class="pay-grid">
                    <button class="btn-pay btn-tunai active" id="btnTunai" onclick="setPay('tunai')">TUNAI</button>
                    <input type="number" class="uang-input" id="uangDiterima" placeholder="0" oninput="hitungKembalian()">

                    <button class="btn-pay btn-qris" id="btnQris" onclick="setPay('qris')">QRIS</button>
                    <button class="btn-proses" onclick="prosesPembayaran()">PROSES PEMBAYARAN</button>
                </div>

                <div class="kembalian-info" id="kembalianInfo"></div>
            </div>
        </div>
    </div>
</div>

<script>
let cart      = [];
let payMethod = 'tunai';
let dineType  = 'dine_in';

@if(session('struk'))
window.addEventListener('DOMContentLoaded', () => {
    const s = @json(session('struk'));
    tampilkanStruk(s);
});
@endif

function tampilkanStruk(s) {
    document.getElementById('strukNo').textContent      = '#' + s.nomor;
    document.getElementById('strukWaktu').textContent   = s.waktu;
    document.getElementById('strukTipe').textContent    = s.tipe;
    document.getElementById('strukCatatan').textContent = s.catatan || '-';
    document.getElementById('strukMetodeLabel').textContent =
        'Bayar (' + (s.metode === 'tunai' ? 'Tunai' : 'QRIS') + ')';
    document.getElementById('strukUang').textContent  = 'Rp. ' + formatRp(s.uang);
    document.getElementById('strukTotal').textContent = 'Rp. ' + formatRp(s.total);

    let itemsHtml = '';
    s.items.forEach(i => {
        itemsHtml += `<div class="struk-item-row">
            <span>${i.nama}<span class="struk-item-qty"> x${i.qty}</span></span>
            <span>Rp. ${formatRp(i.harga * i.qty)}</span>
        </div>`;
    });
    document.getElementById('strukItems').innerHTML = itemsHtml;

    if (s.metode === 'tunai') {
        document.getElementById('kembalianRow').style.display = '';
        document.getElementById('strukKembalian').textContent = 'Rp. ' + formatRp(s.kembalian);
    } else {
        document.getElementById('kembalianRow').style.display = 'none';
    }

    document.getElementById('popupStruk').classList.add('show');
}

function transaksiBaru() {
    document.getElementById('popupStruk').classList.remove('show');
    cart = []; payMethod = 'tunai'; dineType = 'dine_in';
    renderCart();
    document.getElementById('orderNote').value           = '';
    document.getElementById('uangDiterima').value        = '';
    document.getElementById('kembalianInfo').textContent = '';
    document.getElementById('btnTunai').classList.add('active');
    document.getElementById('btnQris').classList.remove('active');
    document.getElementById('dineIn').classList.add('active');
    document.getElementById('takeAway').classList.remove('active');
    document.getElementById('uangDiterima').disabled = false;
}

function tambahItem(id, nama, harga) {
    const existing = cart.find(i => i.id === id);
    if (existing) { existing.qty++; }
    else { cart.push({ id, nama, harga, qty: 1 }); }
    renderCart();
}

function ubahQty(id, delta) {
    const idx = cart.findIndex(i => i.id === id);
    if (idx === -1) return;
    cart[idx].qty += delta;
    if (cart[idx].qty <= 0) cart.splice(idx, 1);
    renderCart();
}

function hapusItem(id) {
    cart = cart.filter(i => i.id !== id);
    renderCart();
}

function renderCart() {
    const container = document.getElementById('orderItems');
    if (cart.length === 0) {
        container.innerHTML = '<div class="empty-order">Belum Ada Pesanan</div>';
        updateTotals();
        return;
    }
    container.innerHTML = cart.map(item => `
        <div class="order-item">
            <div class="oi-info">
                <div class="oi-name">${item.nama}</div>
                <div class="oi-price">Rp. ${formatRp(item.harga * item.qty)}</div>
            </div>
            <div class="qty-ctrl">
                <button class="qty-btn" onclick="ubahQty(${item.id}, -1)">−</button>
                <span class="qty-num">${item.qty}</span>
                <button class="qty-btn" onclick="ubahQty(${item.id}, 1)">+</button>
            </div>
            <button class="btn-hapus" onclick="hapusItem(${item.id})" title="Hapus Item">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                    <path d="M10 11v6M14 11v6"/>
                    <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                </svg>
            </button>
        </div>
    `).join('');
    updateTotals();
}

function updateTotals() {
    const total     = cart.reduce((s, i) => s + i.harga * i.qty, 0);
    const itemCount = cart.reduce((s, i) => s + i.qty, 0);
    document.getElementById('itemCount').textContent  = itemCount + ' item';
    document.getElementById('subTotal').textContent   = 'Rp. ' + formatRp(total);
    document.getElementById('totalPrice').textContent = 'Rp. ' + formatRp(total);
    hitungKembalian();
}

function hitungKembalian() {
    const total = cart.reduce((s, i) => s + i.harga * i.qty, 0);
    const uang  = parseInt(document.getElementById('uangDiterima').value) || 0;
    const el    = document.getElementById('kembalianInfo');
    if (payMethod === 'tunai' && uang > 0) {
        const k = uang - total;
        el.textContent = k >= 0
            ? 'Kembalian: Rp. ' + formatRp(k)
            : 'Kurang: Rp. '    + formatRp(Math.abs(k));
        el.style.color = k >= 0 ? '#3a8c3f' : '#c0392b';
    } else {
        el.textContent = '';
    }
}

function setPay(method) {
    payMethod = method;
    document.getElementById('btnTunai').classList.toggle('active', method === 'tunai');
    document.getElementById('btnQris').classList.toggle('active',  method === 'qris');
    const uangInput = document.getElementById('uangDiterima');
    uangInput.disabled = method !== 'tunai';
    if (method !== 'tunai') {
        uangInput.value = '';
        document.getElementById('kembalianInfo').textContent = '';
    }
}

function setDine(type) {
    dineType = type;
    document.getElementById('dineIn').classList.toggle('active',   type === 'dine_in');
    document.getElementById('takeAway').classList.toggle('active', type === 'take_away');
}

function filterCat(btn) {
    document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const cat = btn.dataset.cat;
    document.querySelectorAll('.menu-card').forEach(card => {
        card.style.display = (cat === 'semua' || card.dataset.cat === cat) ? '' : 'none';
    });
}

function filterMenu() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('.menu-card').forEach(card => {
        card.style.display = card.dataset.name.includes(q) ? '' : 'none';
    });
}

function prosesPembayaran() {
    if (cart.length === 0) { alert('Belum ada pesanan!'); return; }
    const total = cart.reduce((s, i) => s + i.harga * i.qty, 0);
    if (payMethod === 'tunai') {
        const uang = parseInt(document.getElementById('uangDiterima').value) || 0;
        if (uang < total) { alert('Uang yang diterima kurang!'); return; }
    }

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("kasir.pos.proses") }}';

    const fields = {
        '_token':  '{{ csrf_token() }}',
        'cart':    JSON.stringify(cart),
        'metode':  payMethod,
        'tipe':    dineType,
        'catatan': document.getElementById('orderNote').value,
        'uang':    document.getElementById('uangDiterima').value || '0',
    };

    Object.entries(fields).forEach(([name, value]) => {
        const input = document.createElement('input');
        input.type  = 'hidden';
        input.name  = name;
        input.value = value;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}

function formatRp(n) {
    return Number(n).toLocaleString('id-ID');
}
</script>
</body>
</html>