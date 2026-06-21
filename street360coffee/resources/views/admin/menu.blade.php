{{-- resources/views/admin/menu.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Admin — Street 360 Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --gold:       #e8b04b;
            --gold-l:     #f5cc7a;
            --gold-dim:   rgba(232,176,75,.13);
            --gold-glow:  rgba(232,176,75,.3);
            --navy:       #080f1e;
            --navy-2:     #0c1628;
            --navy-3:     #111f38;
            --navy-4:     #162440;
            --navy-5:     #1c2e4f;
            --text:       #f0f4ff;
            --muted:      #6b7fa0;
            --muted-2:    #8a9ec0;
            --border:     rgba(255,255,255,.06);
            --border-2:   rgba(255,255,255,.11);
            --green:      #4ade80;
            --green-dim:  rgba(74,222,128,.11);
            --red:        #f87171;
            --red-dim:    rgba(248,113,113,.11);
        }

        html, body { height: 100%; font-family: 'DM Sans', sans-serif; background: var(--navy); color: var(--text); overflow: hidden; }
        .layout { display: flex; height: 100vh; }
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--navy-5); border-radius: 4px; }

        /* ── Sidebar ── */
        .sidebar { width: 256px; min-width: 256px; background: var(--navy-2); display: flex; flex-direction: column; border-right: 1px solid var(--border); overflow-y: auto; position: relative; }
        .sidebar::after { content:''; position:absolute; top:0; right:0; bottom:0; width:1px; background:linear-gradient(180deg,transparent,rgba(232,176,75,.18) 40%,transparent); pointer-events:none; }
        .sidebar-brand { padding: 24px 20px 18px; border-bottom: 1px solid var(--border); }
        .brand-name { font-family:'Plus Jakarta Sans',sans-serif; font-size:20px; font-weight:800; color:#fff; letter-spacing:.04em; text-transform:uppercase; }
        .brand-name span { color: var(--gold); }
        .brand-badge { display:inline-block; margin-top:8px; background:linear-gradient(135deg,var(--gold),var(--gold-l)); color:var(--navy); font-size:10px; font-weight:800; padding:3px 12px; border-radius:20px; letter-spacing:.1em; text-transform:uppercase; }
        .sidebar-user { display:flex; align-items:center; gap:12px; padding:18px 20px; border-bottom:1px solid var(--border); }
        .user-avatar { width:40px; height:40px; background:linear-gradient(135deg,var(--gold),var(--gold-l)); border-radius:12px; display:flex; align-items:center; justify-content:center; font-family:'Plus Jakarta Sans',sans-serif; font-size:16px; font-weight:800; color:var(--navy); flex-shrink:0; }
        .user-name { font-size:14px; font-weight:700; color:#fff; }
        .user-sub  { font-size:11px; color:var(--muted); margin-top:1px; }
        .sidebar-section { padding:20px 20px 6px; font-size:10px; font-weight:700; letter-spacing:.16em; color:var(--muted); text-transform:uppercase; }
        .sidebar-nav { padding:4px 10px; }
        .nav-item { display:flex; align-items:center; gap:11px; padding:10px 13px; border-radius:10px; font-size:13px; font-weight:600; color:var(--muted); cursor:pointer; text-decoration:none; transition:all .18s; margin-bottom:2px; border:none; background:none; width:100%; text-align:left; font-family:'DM Sans',sans-serif; }
        .nav-item:hover { background:rgba(255,255,255,.05); color:var(--text); }
        .nav-item.active { background:var(--gold-dim); color:var(--gold); border-left:2px solid var(--gold); padding-left:11px; }
        .nav-item svg { flex-shrink:0; }

        /* ── Main ── */
        .main { flex:1; overflow-y:auto; padding:30px 32px; background:var(--navy); }

        /* ── Header ── */
        .page-header { display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:22px; }
        .page-eyebrow { font-size:11px; font-weight:600; letter-spacing:.14em; color:var(--gold); margin-bottom:4px; text-transform:uppercase; }
        .page-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:26px; font-weight:800; color:#fff; line-height:1; }
        .btn-tambah { background:linear-gradient(135deg,var(--gold),var(--gold-l)); color:var(--navy); padding:10px 20px; border-radius:11px; font-size:13px; font-weight:800; cursor:pointer; font-family:'DM Sans',sans-serif; border:none; transition:all .2s; display:inline-flex; align-items:center; gap:7px; box-shadow:0 4px 16px var(--gold-glow); }
        .btn-tambah:hover { transform:translateY(-1px); box-shadow:0 6px 24px var(--gold-glow); }

        /* ── Alerts ── */
        .alert-success { background:var(--green-dim); border:1px solid rgba(74,222,128,.25); color:var(--green); padding:12px 18px; border-radius:11px; margin-bottom:18px; font-size:13px; font-weight:600; }
        .alert-error   { background:var(--red-dim);   border:1px solid rgba(248,113,113,.25); color:var(--red);   padding:12px 18px; border-radius:11px; margin-bottom:18px; font-size:13px; font-weight:600; }

        /* ── Filter ── */
        .filter-bar { display:flex; align-items:center; gap:8px; margin-bottom:22px; background:var(--navy-3); border:1px solid var(--border); border-radius:13px; padding:12px 16px; flex-wrap:wrap; }
        .filter-label { font-size:10px; font-weight:700; letter-spacing:.12em; color:var(--muted); text-transform:uppercase; margin-right:4px; }
        .cat-btn { padding:7px 18px; border-radius:8px; border:1px solid var(--border-2); font-family:'DM Sans',sans-serif; font-size:12px; font-weight:700; cursor:pointer; transition:all .18s; background:transparent; color:var(--muted); }
        .cat-btn.active { background:var(--gold); color:var(--navy); border-color:var(--gold); }
        .cat-btn:hover:not(.active) { background:rgba(255,255,255,.06); color:var(--text); }

        /* ── Menu Grid ── */
        .menu-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:14px; }

        .menu-card { background:var(--navy-3); border-radius:14px; overflow:hidden; border:1px solid var(--border); position:relative; transition:all .25s cubic-bezier(.34,1.2,.64,1); }
        .menu-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:linear-gradient(90deg,transparent,var(--gold),var(--gold-l),transparent); border-radius:14px 14px 0 0; transform:scaleX(0); transform-origin:left; transition:transform .3s cubic-bezier(.34,1.2,.64,1); z-index:1; }
        .menu-card:hover { border-color:rgba(232,176,75,.28); transform:translateY(-3px); box-shadow:0 10px 32px rgba(0,0,0,.3),0 0 0 1px rgba(232,176,75,.1); }
        .menu-card:hover::before { transform:scaleX(1); }
        .menu-card.tidak-tersedia { opacity:.5; }

        .menu-card-img { width:100%; height:150px; background:#fff; display:flex; align-items:center; justify-content:center; overflow:hidden; position:relative; }
        .menu-card-img img { width:100%; height:100%; object-fit:cover; transition:transform .3s; }
        .menu-card:hover .menu-card-img img { transform:scale(1.04); }
        .no-img { display:flex; align-items:center; justify-content:center; width:100%; height:100%; background:var(--navy-4); }
        .no-img svg { opacity:.2; }

        .badge-tidak-tersedia { position:absolute; top:8px; left:8px; background:rgba(248,113,113,.9); color:#fff; font-size:10px; font-weight:700; padding:3px 8px; border-radius:20px; z-index:2; }

        .menu-card-body { padding:13px 15px 14px; }
        .menu-card-top { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:4px; gap:8px; }
        .menu-card-name { font-size:14px; font-weight:700; color:#fff; line-height:1.3; }
        .menu-card-price { font-size:13px; font-weight:800; color:var(--gold); white-space:nowrap; flex-shrink:0; }
        .menu-card-meta { display:flex; justify-content:space-between; align-items:center; margin-bottom:4px; }
        .badge-kategori { font-size:11px; color:var(--muted); font-weight:600; }
        .badge-bestseller { background:var(--gold-dim); color:var(--gold); border:1px solid rgba(232,176,75,.2); font-size:10px; font-weight:700; padding:2px 9px; border-radius:20px; }
        .badge-new { background:var(--navy-5); color:var(--muted-2); border:1px solid var(--border-2); font-size:10px; font-weight:700; padding:2px 9px; border-radius:20px; }

        /* Info bahan terhubung */
        .menu-card-bahan { font-size:11px; color:var(--muted); margin-bottom:8px; display:flex; align-items:center; gap:4px; }
        .menu-card-bahan span { color:var(--gold); font-weight:600; }

        .menu-card-desc { font-size:11px; color:var(--muted); line-height:1.5; margin-bottom:12px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; min-height:32px; }

        .menu-card-actions { display:flex; gap:8px; }
        .btn-edit { flex:1; padding:8px; border-radius:8px; border:1px solid var(--border-2); background:transparent; color:var(--muted-2); font-family:'DM Sans',sans-serif; font-size:12px; font-weight:700; cursor:pointer; transition:all .18s; }
        .btn-edit:hover { background:var(--gold-dim); border-color:var(--gold); color:var(--gold); }
        .btn-hapus { flex:1; padding:8px; border-radius:8px; border:1px solid var(--border-2); background:transparent; color:var(--muted-2); font-family:'DM Sans',sans-serif; font-size:12px; font-weight:700; cursor:pointer; transition:all .18s; }
        .btn-hapus:hover { background:var(--red-dim); border-color:var(--red); color:var(--red); }

        .empty-grid { color:var(--muted); font-size:14px; padding:48px 0; text-align:center; grid-column:span 4; }

        /* ── Popup ── */
        .popup-overlay { display:none; position:fixed; inset:0; background:rgba(8,15,30,.88); z-index:9999; align-items:center; justify-content:center; backdrop-filter:blur(6px); }
        .popup-overlay.show { display:flex; }
        .popup-box { background:var(--navy-3); border:1px solid var(--border-2); border-radius:20px; width:100%; max-width:560px; margin:16px; position:relative; animation:popUp .22s cubic-bezier(.34,1.4,.64,1) both; max-height:90vh; overflow-y:auto; box-shadow:0 32px 80px rgba(0,0,0,.5); }
        @keyframes popUp { from{opacity:0;transform:scale(.92) translateY(20px)} to{opacity:1;transform:scale(1) translateY(0)} }

        .popup-head { display:flex; justify-content:space-between; align-items:center; padding:20px 24px; border-bottom:1px solid var(--border); position:sticky; top:0; background:var(--navy-3); z-index:1; border-radius:20px 20px 0 0; }
        .popup-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:17px; font-weight:800; color:#fff; }
        .popup-close { background:rgba(255,255,255,.07); border:1px solid var(--border); color:var(--muted-2); width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:16px; cursor:pointer; transition:all .18s; }
        .popup-close:hover { background:var(--red-dim); border-color:var(--red); color:var(--red); }

        .popup-body { padding:22px 24px 26px; }

        .foto-upload { width:100%; height:130px; background:var(--navy-4); border:1.5px dashed var(--border-2); border-radius:12px; display:flex; align-items:center; justify-content:center; cursor:pointer; margin-bottom:18px; overflow:hidden; position:relative; transition:border-color .18s; }
        .foto-upload:hover { border-color:var(--gold); }
        .foto-upload img { width:100%; height:100%; object-fit:cover; }
        .foto-placeholder { color:var(--muted); font-size:13px; font-weight:600; display:flex; flex-direction:column; align-items:center; gap:6px; }
        .foto-placeholder svg { opacity:.4; }

        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:12px; }
        .form-group { display:flex; flex-direction:column; gap:6px; margin-bottom:12px; }
        .form-group:last-child { margin-bottom:0; }
        .form-label { font-size:12px; font-weight:700; color:var(--muted-2); letter-spacing:.04em; }
        .form-input { background:var(--navy-4); border:1px solid var(--border-2); border-radius:9px; padding:10px 13px; font-family:'DM Sans',sans-serif; font-size:13px; color:#fff; outline:none; transition:border-color .18s,box-shadow .18s; width:100%; }
        .form-input:focus { border-color:var(--gold); box-shadow:0 0 0 3px var(--gold-dim); }
        .form-input::placeholder { color:var(--muted); }
        .form-select { background:var(--navy-4); border:1px solid var(--border-2); border-radius:9px; padding:10px 13px; font-family:'DM Sans',sans-serif; font-size:13px; color:#fff; outline:none; cursor:pointer; transition:border-color .18s; appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7fa0' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 13px center; background-color:var(--navy-4); width:100%; }
        .form-select:focus { border-color:var(--gold); }
        option { background:#162440; }

        /* Info box bahan */
        .bahan-info { background:var(--gold-dim); border:1px solid rgba(232,176,75,.2); border-radius:9px; padding:9px 13px; font-size:12px; color:var(--gold); margin-top:6px; display:none; }

        .btn-simpan { width:100%; padding:12px; background:linear-gradient(135deg,var(--gold),var(--gold-l)); border:none; border-radius:10px; color:var(--navy); font-family:'DM Sans',sans-serif; font-size:14px; font-weight:800; cursor:pointer; margin-top:14px; transition:all .2s; box-shadow:0 4px 16px var(--gold-glow); }
        .btn-simpan:hover { transform:translateY(-1px); box-shadow:0 6px 24px var(--gold-glow); }

        /* Hapus popup */
        .popup-hapus { background:var(--navy-3); border:1px solid var(--border-2); border-radius:20px; width:100%; max-width:360px; padding:28px 26px; text-align:center; animation:popUp .22s cubic-bezier(.34,1.4,.64,1) both; box-shadow:0 32px 80px rgba(0,0,0,.5); }
        .hapus-icon { width:48px; height:48px; background:var(--red-dim); border-radius:14px; display:flex; align-items:center; justify-content:center; margin:0 auto 14px; }
        .hapus-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:18px; font-weight:800; margin-bottom:8px; color:#fff; }
        .hapus-sub { font-size:13px; color:var(--muted); margin-bottom:22px; line-height:1.5; }
        .hapus-actions { display:flex; gap:10px; }
        .btn-batal { flex:1; padding:11px; border-radius:10px; border:1px solid var(--border-2); background:transparent; color:var(--muted-2); font-family:'DM Sans',sans-serif; font-size:13px; font-weight:700; cursor:pointer; transition:all .18s; }
        .btn-batal:hover { background:rgba(255,255,255,.06); color:#fff; }
        .btn-hapus-confirm { flex:1; padding:11px; border-radius:10px; border:none; background:var(--red); color:#fff; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:700; cursor:pointer; transition:all .18s; box-shadow:0 4px 14px rgba(248,113,113,.3); }
        .btn-hapus-confirm:hover { background:#ef4444; }
    </style>
</head>
<body>
<div class="layout">
    @include('admin.partials.sidebar')

    <main class="main">
        <div class="page-header">
            <div>
                <div class="page-eyebrow">Kelola</div>
                <div class="page-title">Menu</div>
            </div>
            <button class="btn-tambah" onclick="bukaPopupTambah()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Menu
            </button>
        </div>

        @if(session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-error">✕ {{ $errors->first() }}</div>
        @endif

        <div class="filter-bar">
            <span class="filter-label">Kategori</span>
            <button class="cat-btn active" data-cat="semua"    onclick="filterCat(this)">Semua</button>
            <button class="cat-btn"        data-cat="kopi"     onclick="filterCat(this)">Kopi</button>
            <button class="cat-btn"        data-cat="non-kopi" onclick="filterCat(this)">Non - Kopi</button>
            <button class="cat-btn"        data-cat="snack"    onclick="filterCat(this)">Snack</button>
        </div>

        <div class="menu-grid" id="menuGrid">
            @forelse($menus as $menu)
            <div class="menu-card {{ !$menu->tersedia ? 'tidak-tersedia' : '' }}" data-cat="{{ $menu->kategori }}">
                <div class="menu-card-img">
                    @if(!$menu->tersedia)
                        <div class="badge-tidak-tersedia">Tidak Tersedia</div>
                    @endif
                    @if($menu->gambar)
                        <img src="{{ asset('storage/'.$menu->gambar) }}" alt="{{ $menu->nama }}">
                    @else
                        <div class="no-img">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        </div>
                    @endif
                </div>
                <div class="menu-card-body">
                    <div class="menu-card-top">
                        <div class="menu-card-name">{{ $menu->nama }}</div>
                        <div class="menu-card-price">Rp {{ number_format($menu->harga,0,',','.') }}</div>
                    </div>
                    <div class="menu-card-meta">
                        <span class="badge-kategori">{{ ucfirst($menu->kategori) }}</span>
                        @if($menu->badge === 'Best Seller')
                            <span class="badge-bestseller">Best Seller</span>
                        @elseif($menu->badge === 'New')
                            <span class="badge-new">New</span>
                        @endif
                    </div>

                    {{-- Info bahan terhubung --}}
                    <div class="menu-card-bahan">
                        @if($menu->stokBahan)
                            Bahan: <span>{{ $menu->stokBahan->nama }}</span>
                            ({{ $menu->stokBahan->stok_saat_ini }} {{ $menu->stokBahan->satuan }})
                        @else
                            <span style="color:var(--muted)">Belum terhubung ke stok</span>
                        @endif
                    </div>

                    <div class="menu-card-desc">{{ $menu->deskripsi ?: '—' }}</div>
                    <div class="menu-card-actions">
                        <button class="btn-edit" onclick="bukaPopupEdit(
                            {{ $menu->id }},
                            '{{ addslashes($menu->nama) }}',
                            {{ $menu->harga }},
                            '{{ addslashes($menu->deskripsi) }}',
                            '{{ $menu->kategori }}',
                            '{{ $menu->badge }}',
                            '{{ $menu->gambar ? asset('storage/'.$menu->gambar) : '' }}',
                            '{{ $menu->stok_bahan_id ?? '' }}'
                        )">Edit</button>
                        <button class="btn-hapus" onclick="bukaPopupHapus({{ $menu->id }},'{{ addslashes($menu->nama) }}')">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-grid">Belum ada menu.</div>
            @endforelse
        </div>
    </main>
</div>

{{-- Popup Tambah/Edit --}}
<div class="popup-overlay" id="popupMenu">
    <div class="popup-box">
        <div class="popup-head">
            <div class="popup-title" id="popupMenuTitle">Tambah Menu</div>
            <button class="popup-close" onclick="tutupPopup()">×</button>
        </div>
        <div class="popup-body">
            <form id="formMenu" method="POST" enctype="multipart/form-data" action="{{ route('admin.menu.store') }}">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                {{-- Foto --}}
                <div class="form-group">
                    <div class="form-label">Foto Menu</div>
                    <div class="foto-upload" onclick="document.getElementById('inputFoto').click()">
                        <img id="previewFoto" src="" style="display:none;width:100%;height:100%;object-fit:cover;">
                        <div class="foto-placeholder" id="fotoPlaceholder">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            Klik untuk pilih foto
                        </div>
                        <input type="file" id="inputFoto" name="gambar" accept="image/*" onchange="previewImage(this)" style="position:absolute;inset:0;opacity:0;cursor:pointer;">
                    </div>
                </div>

                {{-- Nama & Harga --}}
                <div class="form-row">
                    <div class="form-group" style="margin-bottom:0">
                        <div class="form-label">Nama Menu</div>
                        <input type="text" class="form-input" name="nama" id="inputNama" placeholder="Nama menu" value="{{ old('nama') }}" required>
                    </div>
                    <div class="form-group" style="margin-bottom:0">
                        <div class="form-label">Harga (Rp)</div>
                        <input type="number" class="form-input" name="harga" id="inputHarga" placeholder="0" min="0" value="{{ old('harga') }}" required>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <div class="form-label">Deskripsi</div>
                    <textarea class="form-input" name="deskripsi" id="inputDeskripsi" placeholder="Deskripsi menu" rows="3" style="resize:none">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- Kategori & Label --}}
                <div class="form-row">
                    <div class="form-group" style="margin-bottom:0">
                        <div class="form-label">Kategori</div>
                        <select class="form-select" name="kategori" id="inputKategori" required>
                            <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>Pilih Kategori</option>
                            <option value="kopi"     {{ old('kategori') == 'kopi'     ? 'selected' : '' }}>Kopi</option>
                            <option value="non-kopi" {{ old('kategori') == 'non-kopi' ? 'selected' : '' }}>Non - Kopi</option>
                            <option value="snack"    {{ old('kategori') == 'snack'    ? 'selected' : '' }}>Snack</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom:0">
                        <div class="form-label">Label</div>
                        <select class="form-select" name="badge" id="inputBadge">
                            <option value=""            {{ old('badge') == ''            ? 'selected' : '' }}>- Tidak Ada</option>
                            <option value="New"         {{ old('badge') == 'New'         ? 'selected' : '' }}>New</option>
                            <option value="Best Seller" {{ old('badge') == 'Best Seller' ? 'selected' : '' }}>Best Seller</option>
                        </select>
                    </div>
                </div>

                {{-- ✅ Dropdown Bahan Stok --}}
                <div class="form-group">
                    <div class="form-label">Bahan Utama (Stok)</div>
                    <select class="form-select" name="stok_bahan_id" id="inputStokBahan" onchange="tampilInfoBahan(this)">
                        <option value="">— Tidak terhubung ke stok —</option>
                        @foreach($bahans as $bahan)
                            <option value="{{ $bahan->id }}"
                                data-stok="{{ $bahan->stok_saat_ini }}"
                                data-satuan="{{ $bahan->satuan }}"
                                data-status="{{ $bahan->getStatus() }}">
                                {{ $bahan->nama }} — {{ $bahan->stok_saat_ini }} {{ $bahan->satuan }}
                            </option>
                        @endforeach
                    </select>
                    <div class="bahan-info" id="bahanInfo">
                        Stok terhubung: <strong id="bahanInfoText"></strong>
                    </div>
                </div>

                <button type="submit" class="btn-simpan">Simpan Menu</button>
            </form>
        </div>
    </div>
</div>

{{-- Popup Hapus --}}
<div class="popup-overlay" id="popupHapus">
    <div class="popup-hapus">
        <div class="hapus-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f87171" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
        </div>
        <div class="hapus-title">Hapus Menu?</div>
        <div class="hapus-sub" id="hapusNama">Menu ini akan dihapus permanen.</div>
        <div class="hapus-actions">
            <button class="btn-batal" onclick="tutupPopupHapus()">Batal</button>
            <form id="formHapus" method="POST" style="flex:1">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-hapus-confirm" style="width:100%">Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
    const baseMenuUrl = '{{ url('admin/menu') }}';
    const storeUrl    = '{{ route('admin.menu.store') }}';

    @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('popupMenuTitle').textContent = 'Tambah Menu';
            document.getElementById('formMenu').action = storeUrl;
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('popupMenu').classList.add('show');
        });
    @endif

    function filterCat(btn) {
        document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const cat = btn.dataset.cat;
        document.querySelectorAll('.menu-card').forEach(card => {
            card.style.display = (cat === 'semua' || card.dataset.cat === cat) ? '' : 'none';
        });
    }

    function bukaPopupTambah() {
        document.getElementById('popupMenuTitle').textContent = 'Tambah Menu';
        document.getElementById('formMenu').reset();
        document.getElementById('formMenu').action = storeUrl;
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('previewFoto').style.display = 'none';
        document.getElementById('fotoPlaceholder').style.display = '';
        document.getElementById('bahanInfo').style.display = 'none';
        document.getElementById('popupMenu').classList.add('show');
    }

    function bukaPopupEdit(id, nama, harga, deskripsi, kategori, badge, gambarUrl, stokBahanId) {
        document.getElementById('popupMenuTitle').textContent = 'Edit Menu';
        document.getElementById('formMenu').action = baseMenuUrl + '/' + id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('inputNama').value      = nama;
        document.getElementById('inputHarga').value     = harga;
        document.getElementById('inputDeskripsi').value = deskripsi;
        document.getElementById('inputKategori').value  = kategori;
        document.getElementById('inputBadge').value     = badge;
        document.getElementById('inputFoto').value      = '';

        // Set dropdown bahan
        const selectBahan = document.getElementById('inputStokBahan');
        selectBahan.value = stokBahanId || '';
        tampilInfoBahan(selectBahan);

        // Preview foto
        if (gambarUrl) {
            document.getElementById('previewFoto').src = gambarUrl;
            document.getElementById('previewFoto').style.display = 'block';
            document.getElementById('fotoPlaceholder').style.display = 'none';
        } else {
            document.getElementById('previewFoto').style.display = 'none';
            document.getElementById('fotoPlaceholder').style.display = '';
        }

        document.getElementById('popupMenu').classList.add('show');
    }

    // ✅ Tampilkan info stok bahan yang dipilih
    function tampilInfoBahan(select) {
        const opt     = select.options[select.selectedIndex];
        const infoEl  = document.getElementById('bahanInfo');
        const textEl  = document.getElementById('bahanInfoText');

        if (!select.value) {
            infoEl.style.display = 'none';
            return;
        }

        const stok   = opt.dataset.stok;
        const satuan = opt.dataset.satuan;
        const status = opt.dataset.status;

        const warna = status === 'kritis' ? '#f87171' : status === 'hampir_habis' ? '#fbbf24' : '#4ade80';
        textEl.innerHTML = `<span style="color:${warna}">${stok} ${satuan}</span> (${status.replace('_', ' ')})`;
        infoEl.style.display = 'block';
    }

    function tutupPopup() {
        document.getElementById('popupMenu').classList.remove('show');
    }

    function bukaPopupHapus(id, nama) {
        document.getElementById('hapusNama').textContent = '"' + nama + '" akan dihapus permanen.';
        document.getElementById('formHapus').action = baseMenuUrl + '/' + id;
        document.getElementById('popupHapus').classList.add('show');
    }

    function tutupPopupHapus() {
        document.getElementById('popupHapus').classList.remove('show');
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('previewFoto').src = e.target.result;
                document.getElementById('previewFoto').style.display = 'block';
                document.getElementById('fotoPlaceholder').style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('popupMenu').addEventListener('click',  function(e) { if(e.target===this) tutupPopup(); });
    document.getElementById('popupHapus').addEventListener('click', function(e) { if(e.target===this) tutupPopupHapus(); });
    document.addEventListener('keydown', e => { if(e.key==='Escape') { tutupPopup(); tutupPopupHapus(); } });
</script>
</body>
</html>