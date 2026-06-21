{{-- resources/views/admin/stok.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok — Street 360 Coffee</title>
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
            --yellow:     #fbbf24;
            --yellow-dim: rgba(251,191,36,.11);
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
        .alert-ok  { background:var(--green-dim); border:1px solid rgba(74,222,128,.25); color:var(--green); padding:12px 18px; border-radius:11px; margin-bottom:18px; font-size:13px; font-weight:600; }
        .alert-err { background:var(--red-dim);   border:1px solid rgba(248,113,113,.25); color:var(--red);   padding:12px 18px; border-radius:11px; margin-bottom:18px; font-size:13px; font-weight:600; }

        /* ── Stat Cards ── */
        .stat-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:22px; }
        .stat-card {
            background:var(--navy-3); border:1px solid var(--border); border-radius:16px;
            padding:22px 24px; cursor:pointer; position:relative; overflow:hidden;
            transition:all .25s cubic-bezier(.34,1.2,.64,1);
        }
        .stat-card::before {
            content:''; position:absolute; top:0; left:0; right:0; height:2px;
            border-radius:16px 16px 0 0; transform:scaleX(0); transform-origin:left;
            transition:transform .3s cubic-bezier(.34,1.2,.64,1);
        }
        .stat-card.s-green::before { background:linear-gradient(90deg,transparent,var(--green),transparent); }
        .stat-card.s-yellow::before { background:linear-gradient(90deg,transparent,var(--yellow),transparent); }
        .stat-card.s-red::before { background:linear-gradient(90deg,transparent,var(--red),transparent); }
        .stat-card:hover { transform:translateY(-3px); box-shadow:0 12px 36px rgba(0,0,0,.3); }
        .stat-card.s-green:hover  { border-color:rgba(74,222,128,.3);  }
        .stat-card.s-yellow:hover { border-color:rgba(251,191,36,.3);  }
        .stat-card.s-red:hover    { border-color:rgba(248,113,113,.3); }
        .stat-card:hover::before { transform:scaleX(1); }

        .stat-card-top { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:14px; }
        .stat-icon { width:38px; height:38px; border-radius:10px; display:flex; align-items:center; justify-content:center; }
        .stat-icon.green  { background:var(--green-dim);  } .stat-icon.green  svg { color:var(--green); }
        .stat-icon.yellow { background:var(--yellow-dim); } .stat-icon.yellow svg { color:var(--yellow); }
        .stat-icon.red    { background:var(--red-dim);    } .stat-icon.red    svg { color:var(--red); }
        .stat-hint { font-size:10px; font-weight:700; padding:3px 9px; border-radius:20px; }
        .stat-hint.green  { background:var(--green-dim);  color:var(--green); }
        .stat-hint.yellow { background:var(--yellow-dim); color:var(--yellow); }
        .stat-hint.red    { background:var(--red-dim);    color:var(--red); }

        .stat-label { font-size:10px; font-weight:700; letter-spacing:.12em; color:var(--muted); margin-bottom:6px; text-transform:uppercase; }
        .stat-number { font-family:'Plus Jakarta Sans',sans-serif; font-size:34px; font-weight:800; line-height:1; }
        .stat-number.green  { color:var(--green); }
        .stat-number.yellow { color:var(--yellow); }
        .stat-number.red    { color:var(--red); }
        .stat-footer { display:flex; align-items:center; gap:5px; margin-top:10px; padding-top:10px; border-top:1px solid var(--border); font-size:11px; color:var(--muted); transition:color .2s; }
        .stat-card:hover .stat-footer { color:var(--gold); }

        /* ── Table card ── */
        .table-card { background:var(--navy-3); border:1px solid var(--border); border-radius:14px; overflow:hidden; }
        .table-card-header { display:flex; align-items:center; justify-content:space-between; padding:16px 22px; border-bottom:1px solid var(--border); }
        .table-card-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:14px; font-weight:700; color:#fff; }
        .count-pill { background:var(--gold-dim); color:var(--gold); font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px; font-family:'DM Sans',sans-serif; }

        .stok-table { width:100%; border-collapse:collapse; font-size:13px; }
        .stok-table thead th { background:rgba(0,0,0,.18); color:var(--muted); font-size:10px; letter-spacing:.12em; font-weight:700; padding:10px 20px; text-align:left; border-bottom:1px solid var(--border); text-transform:uppercase; }
        .stok-table tbody tr { border-bottom:1px solid rgba(255,255,255,.03); transition:background .12s; }
        .stok-table tbody tr:last-child { border-bottom:none; }
        .stok-table tbody tr:hover { background:rgba(255,255,255,.03); }
        .stok-table td { padding:13px 20px; vertical-align:middle; }

        .bahan-name { font-weight:700; color:var(--text); font-size:13px; display:flex; align-items:center; gap:8px; }
        .kritis-dot { width:7px; height:7px; background:var(--red); border-radius:50%; flex-shrink:0; animation:blinkDot 1s ease-in-out infinite; }
        @keyframes blinkDot { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.2;transform:scale(.6)} }
        .badge-kritis { background:var(--red-dim); color:var(--red); font-size:10px; font-weight:700; padding:2px 8px; border-radius:20px; }
        .badge-hampir { background:var(--yellow-dim); color:var(--yellow); font-size:10px; font-weight:700; padding:2px 8px; border-radius:20px; }
        .badge-aman   { background:var(--green-dim);  color:var(--green);  font-size:10px; font-weight:700; padding:2px 8px; border-radius:20px; }

        .stok-angka { font-size:13px; font-weight:600; color:var(--text); }
        .stok-edit  { font-size:11px; color:var(--muted); cursor:pointer; margin-top:2px; display:block; transition:color .18s; }
        .stok-edit:hover { color:var(--gold); }

        .progres-wrapper { display:flex; align-items:center; gap:8px; min-width:200px; }
        .btn-adjust { background:var(--navy-4); border:1px solid var(--border-2); color:var(--muted-2); cursor:pointer; width:26px; height:26px; border-radius:7px; display:flex; align-items:center; justify-content:center; padding:0; transition:all .15s; flex-shrink:0; }
        .btn-adjust:hover { background:var(--navy-5); color:#fff; border-color:rgba(255,255,255,.2); }
        .btn-adjust svg { width:14px; height:14px; }
        .bar-wrap { flex:1; }
        .bar-track { height:6px; background:rgba(255,255,255,.08); border-radius:99px; overflow:hidden; margin-bottom:3px; }
        .progres-bar { height:100%; border-radius:99px; transition:width .3s; }
        .bar-aman   { background:var(--green); }
        .bar-hampir { background:var(--yellow); }
        .bar-kritis { background:var(--red); }
        .bar-pct { font-size:10px; color:var(--muted); text-align:right; }

        .aksi-cell { white-space:nowrap; }
        .btn-restok { background:transparent; border:1px solid var(--border-2); color:var(--muted-2); padding:6px 13px; border-radius:8px; font-size:12px; font-family:'DM Sans',sans-serif; cursor:pointer; display:inline-flex; align-items:center; gap:5px; margin-right:6px; transition:all .18s; font-weight:600; }
        .btn-restok:hover { background:var(--gold-dim); border-color:var(--gold); color:var(--gold); }
        .btn-hapus-row { background:transparent; border:1px solid transparent; color:var(--muted); padding:6px; cursor:pointer; display:inline-flex; align-items:center; border-radius:8px; transition:all .18s; }
        .btn-hapus-row:hover { background:var(--red-dim); border-color:var(--red); color:var(--red); }

        .row-kritis { border-left:2px solid var(--red) !important; animation:blinkRow 1.8s ease-in-out infinite; }
        @keyframes blinkRow { 0%,100%{background:transparent} 50%{background:rgba(248,113,113,.05)} }
        .row-kritis:hover { animation:none; background:rgba(248,113,113,.08) !important; }

        .empty-row { text-align:center; padding:48px; color:var(--muted); font-size:13px; }

        /* ── Modal ── */
        .modal-overlay { display:none; position:fixed; inset:0; background:rgba(8,15,30,.88); z-index:9999; align-items:center; justify-content:center; backdrop-filter:blur(6px); }
        .modal-overlay.show { display:flex; }
        .modal-box { background:var(--navy-3); border:1px solid var(--border-2); border-radius:20px; padding:0; width:100%; max-width:420px; margin:16px; animation:popUp .22s cubic-bezier(.34,1.4,.64,1) both; max-height:90vh; overflow-y:auto; box-shadow:0 32px 80px rgba(0,0,0,.5); }
        .modal-box.wide { max-width:500px; }
        @keyframes popUp { from{opacity:0;transform:scale(.92) translateY(20px)} to{opacity:1;transform:scale(1) translateY(0)} }
        .modal-head { display:flex; justify-content:space-between; align-items:center; padding:20px 24px; border-bottom:1px solid var(--border); position:sticky; top:0; background:var(--navy-3); z-index:1; border-radius:20px 20px 0 0; }
        .modal-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:16px; font-weight:800; color:#fff; }
        .modal-close { background:rgba(255,255,255,.07); border:1px solid var(--border); color:var(--muted-2); width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:16px; cursor:pointer; transition:all .18s; }
        .modal-close:hover { background:var(--red-dim); border-color:var(--red); color:var(--red); }
        .modal-body { padding:20px 24px 24px; }

        .form-group { display:flex; flex-direction:column; gap:6px; margin-bottom:12px; }
        .form-label { font-size:11px; font-weight:700; color:var(--muted-2); letter-spacing:.06em; text-transform:uppercase; }
        .form-input { background:var(--navy-4); border:1px solid var(--border-2); border-radius:9px; padding:10px 13px; font-family:'DM Sans',sans-serif; font-size:13px; color:#fff; outline:none; transition:border-color .18s,box-shadow .18s; width:100%; }
        .form-input:focus { border-color:var(--gold); box-shadow:0 0 0 3px var(--gold-dim); }
        .form-input option { background:#162440; }
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }

        .modal-footer { display:flex; justify-content:flex-end; gap:8px; margin-top:16px; }
        .btn-batal { background:transparent; border:1px solid var(--border-2); color:var(--muted-2); padding:9px 20px; border-radius:9px; font-size:13px; font-family:'DM Sans',sans-serif; cursor:pointer; font-weight:600; transition:all .18s; }
        .btn-batal:hover { border-color:rgba(255,255,255,.25); color:#fff; }
        .btn-simpan { background:linear-gradient(135deg,var(--gold),var(--gold-l)); border:none; color:var(--navy); padding:9px 22px; border-radius:9px; font-size:13px; font-weight:800; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all .2s; box-shadow:0 4px 14px var(--gold-glow); }
        .btn-simpan:hover { transform:translateY(-1px); box-shadow:0 6px 20px var(--gold-glow); }

        /* Detail modal items */
        .m-section { font-size:10px; font-weight:700; letter-spacing:.13em; color:var(--muted); text-transform:uppercase; display:flex; align-items:center; gap:8px; margin:16px 0 10px; }
        .m-section:first-child { margin-top:0; }
        .m-section::after { content:''; flex:1; height:1px; background:var(--border); }
        .m-chip-grid { display:grid; grid-template-columns:1fr 1fr; gap:8px; }
        .m-chip { background:var(--navy-4); border:1px solid var(--border); border-radius:11px; padding:11px 14px; }
        .m-chip-label { font-size:10px; font-weight:700; letter-spacing:.1em; color:var(--muted); text-transform:uppercase; margin-bottom:5px; }
        .m-chip-value { font-size:16px; font-weight:800; color:var(--text); }
        .m-chip-value.green  { color:var(--green); }
        .m-chip-value.yellow { color:var(--yellow); }
        .m-chip-value.red    { color:var(--red); }

        .sid-row { display:flex; align-items:center; gap:10px; padding:10px 12px; background:var(--navy-4); border:1px solid var(--border); border-radius:10px; margin-bottom:6px; }
        .sid-name { font-size:13px; font-weight:600; color:var(--text); }
        .sid-qty  { font-size:11px; color:var(--muted); margin-top:1px; }
        .sid-bar  { flex:1; }
        .sid-bar-track { height:5px; background:rgba(255,255,255,.07); border-radius:99px; overflow:hidden; }
        .sid-bar-fill  { height:100%; border-radius:99px; }
        .sid-badge { padding:3px 9px; border-radius:20px; font-size:10px; font-weight:700; white-space:nowrap; flex-shrink:0; }
        .sid-badge.aman         { background:var(--green-dim);  color:var(--green); }
        .sid-badge.hampir_habis { background:var(--yellow-dim); color:var(--yellow); }
        .sid-badge.kritis       { background:var(--red-dim);    color:var(--red); }
    </style>
</head>
<body>
<div class="layout">
    @include('admin.partials.sidebar')

    <main class="main">
        <div class="page-header">
            <div>
                <div class="page-eyebrow">Kelola</div>
                <div class="page-title">Stok Bahan</div>
            </div>
            <button class="btn-tambah" onclick="bukaModal('modalTambah')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Bahan
            </button>
        </div>

        @if(session('success'))
            <div class="alert-ok">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-err">✕ {{ session('error') }}</div>
        @endif

        {{-- Stat Cards --}}
        <div class="stat-grid">
            <div class="stat-card s-green" onclick="bukaDetailStok('aman')">
                <div class="stat-card-top">
                    <div class="stat-icon green">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <span class="stat-hint green">Aman</span>
                </div>
                <div class="stat-label">Stok Aman</div>
                <div class="stat-number green">{{ $aman }}</div>
                <div class="stat-footer">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Klik untuk detail
                </div>
            </div>

            <div class="stat-card s-yellow" onclick="bukaDetailStok('hampir_habis')">
                <div class="stat-card-top">
                    <div class="stat-icon yellow">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <span class="stat-hint yellow">Perhatian</span>
                </div>
                <div class="stat-label">Hampir Habis</div>
                <div class="stat-number yellow">{{ $hampirHabis }}</div>
                <div class="stat-footer">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Klik untuk detail
                </div>
            </div>

            <div class="stat-card s-red" onclick="bukaDetailStok('kritis')">
                <div class="stat-card-top">
                    <div class="stat-icon red">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <span class="stat-hint red">{{ $kritis > 0 ? 'Kritis!' : 'Aman' }}</span>
                </div>
                <div class="stat-label">Stok Kritis</div>
                <div class="stat-number red">{{ $kritis }}</div>
                <div class="stat-footer">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Klik untuk detail
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-card">
            <div class="table-card-header">
                <div class="table-card-title">Daftar Bahan</div>
                <span class="count-pill">{{ $bahans->count() }} bahan</span>
            </div>
            <table class="stok-table">
                <thead>
                    <tr>
                        <th>Bahan</th>
                        <th>Stok / Maks</th>
                        <th>Progres</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bahans as $bahan)
                    @php
                        $persen   = $bahan->getPersen();
                        $barClass = $bahan->getBarClass();
                        $status   = $bahan->getStatus();
                        $isKritis = $status === 'kritis';
                        // Hapus trailing zero: 5.00 → 5, 1.50 → 1.5
                        $stokTampil = $bahan->stok_saat_ini + 0;
                        $maksTampil = $bahan->stok_maks + 0;
                    @endphp
                    <tr id="row-{{ $bahan->id }}" class="{{ $isKritis ? 'row-kritis' : '' }}">
                        <td>
                            <div class="bahan-name">
                                @if($isKritis)<span class="kritis-dot"></span>@endif
                                {{ $bahan->nama }}
                                @if($status === 'kritis')
                                    <span class="badge-kritis">Kritis</span>
                                @elseif($status === 'hampir_habis')
                                    <span class="badge-hampir">Hampir Habis</span>
                                @else
                                    <span class="badge-aman">Aman</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="stok-angka" id="angka-{{ $bahan->id }}">{{ $stokTampil }} / {{ $maksTampil }} {{ $bahan->satuan }}</div>
                            <span class="stok-edit" onclick="bukaEdit({{ $bahan->id }}, {{ $bahan->stok_saat_ini }}, {{ $bahan->stok_maks }})">Edit stok</span>
                        </td>
                        <td>
                            <div class="progres-wrapper">
                                <button class="btn-adjust" onclick="adjustStok({{ $bahan->id }}, -1)" title="Kurangi">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                </button>
                                <div class="bar-wrap">
                                    <div class="bar-track">
                                        <div class="progres-bar {{ $barClass }}" id="bar-{{ $bahan->id }}" style="width:{{ $persen }}%"></div>
                                    </div>
                                    <div class="bar-pct" id="persen-{{ $bahan->id }}">{{ round($persen) }}%</div>
                                </div>
                                <button class="btn-adjust" onclick="adjustStok({{ $bahan->id }}, 1)" title="Tambah">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                </button>
                            </div>
                        </td>
                        <td class="aksi-cell">
                            <form action="{{ route('admin.stok.restok', $bahan->id) }}" method="POST" style="display:inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-restok">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="13" height="13"><path d="M23 4v6h-6"/><path d="M1 20v-6h6"/><path d="M3.51 9a9 9 0 0114.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0020.49 15"/></svg>
                                    Restok
                                </button>
                            </form>
                            <form action="{{ route('admin.stok.destroy', $bahan->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus {{ $bahan->nama }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-hapus-row">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="empty-row">Belum ada bahan. Klik "+ Tambah Bahan" untuk mulai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>

{{-- Modal Tambah --}}
<div class="modal-overlay" id="modalTambah">
    <div class="modal-box">
        <div class="modal-head">
            <div class="modal-title">Tambah Bahan</div>
            <button class="modal-close" onclick="tutupModal('modalTambah')">×</button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.stok.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Bahan</label>
                    <input type="text" name="nama" class="form-input" placeholder="cth: Bubuk Kopi" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Stok Saat Ini</label>
                        <input type="number" name="stok_saat_ini" id="tambahStokSaatIni" class="form-input" min="0" step="0.1" placeholder="0" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stok Maksimal</label>
                        <input type="number" name="stok_maks" id="tambahStokMaks" class="form-input" min="1" step="0.1" placeholder="10" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Satuan</label>
                    <select name="satuan" class="form-input">
                        <option value="kg">kg</option>
                        <option value="liter">liter</option>
                        <option value="gram">gram</option>
                        <option value="ml">ml</option>
                        <option value="pcs">pcs</option>
                        <option value="botol">botol</option>
                        <option value="sachet">sachet</option>
                    </select>
                </div>
                @error('stok_maks')
                    <div style="color:var(--red);font-size:12px;margin-bottom:8px;">{{ $message }}</div>
                @enderror
                <div class="modal-footer">
                    <button type="button" class="btn-batal" onclick="tutupModal('modalTambah')">Batal</button>
                    <button type="submit" class="btn-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal-overlay" id="modalEdit">
    <div class="modal-box">
        <div class="modal-head">
            <div class="modal-title">Edit Stok</div>
            <button class="modal-close" onclick="tutupModal('modalEdit')">×</button>
        </div>
        <div class="modal-body">
            <form id="formEdit" method="POST">
                @csrf @method('PATCH')
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Stok Saat Ini</label>
                        <input type="number" name="stok_saat_ini" id="editStokSaatIni" class="form-input" min="0" step="0.1" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stok Maksimal</label>
                        <input type="number" name="stok_maks" id="editStokMaks" class="form-input" min="1" step="0.1" required>
                    </div>
                </div>
                <div id="editError" style="display:none;color:var(--red);font-size:12px;margin-bottom:8px;"></div>
                <div class="modal-footer">
                    <button type="button" class="btn-batal" onclick="tutupModal('modalEdit')">Batal</button>
                    <button type="submit" class="btn-simpan">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Detail --}}
<div class="modal-overlay" id="modalDetailStok">
    <div class="modal-box wide">
        <div class="modal-head">
            <div class="modal-title" id="detailModalTitle">Detail Stok</div>
            <button class="modal-close" onclick="tutupModal('modalDetailStok')">×</button>
        </div>
        <div class="modal-body" id="detailModalBody"></div>
    </div>
</div>

@php
$bahansData = $bahans->map(fn($b) => [
    'id'     => $b->id,
    'nama'   => $b->nama,
    'stok'   => $b->stok_saat_ini + 0,
    'maks'   => $b->stok_maks + 0,
    'satuan' => $b->satuan,
    'persen' => round($b->getPersen()),
    'status' => $b->getStatus(),
]);
@endphp

<script>
const bahansData = {!! json_encode($bahansData) !!};
const barColors  = { aman:'var(--green)', hampir_habis:'var(--yellow)', kritis:'var(--red)' };
const badgeLabel = { aman:'Aman', hampir_habis:'Hampir Habis', kritis:'Kritis' };
const titleMap   = { aman:'🟢 Stok Aman', hampir_habis:'🟡 Hampir Habis', kritis:'🔴 Stok Kritis' };
const colorMap   = { aman:'green', hampir_habis:'yellow', kritis:'red' };

/* Hapus trailing zero: 5.00 → 5, 1.50 → 1.5 */
function fmt(n) { return parseFloat(n); }

/* ── Modal helpers ── */
function bukaModal(id)  { document.getElementById(id).classList.add('show'); }
function tutupModal(id) { document.getElementById(id).classList.remove('show'); }

document.querySelectorAll('.modal-overlay').forEach(el => {
    el.addEventListener('click', function(e) { if (e.target === this) this.classList.remove('show'); });
});
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') document.querySelectorAll('.modal-overlay.show').forEach(m => m.classList.remove('show'));
});

/* ── Buka modal edit dengan data bahan ── */
function bukaEdit(id, stok, maks) {
    document.getElementById('editStokSaatIni').value = stok;
    document.getElementById('editStokMaks').value    = maks;
    document.getElementById('formEdit').action       = `/admin/stok/${id}/edit`;
    document.getElementById('editError').style.display = 'none';
    bukaModal('modalEdit');
}

/* ── Validasi client-side form edit sebelum submit ── */
document.getElementById('formEdit').addEventListener('submit', function(e) {
    const saat_ini = parseFloat(document.getElementById('editStokSaatIni').value);
    const maks     = parseFloat(document.getElementById('editStokMaks').value);
    const errEl    = document.getElementById('editError');

    if (saat_ini > maks) {
        e.preventDefault();
        errEl.textContent = 'Stok saat ini tidak boleh melebihi stok maksimal.';
        errEl.style.display = 'block';
        return;
    }
    errEl.style.display = 'none';
});

/* ── Adjust stok ±1 via AJAX ── */
async function adjustStok(id, delta) {
    try {
        const res  = await fetch(`/admin/stok/${id}/adjust`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ delta })
        });
        const data = await res.json();
        if (!data.success) return;

        /* Update teks stok / maks (tanpa trailing zero) */
        document.getElementById(`angka-${id}`).textContent = `${fmt(data.stok)} / ${fmt(data.maks)} ${data.satuan}`;

        /* Update progress bar */
        const bar = document.getElementById(`bar-${id}`);
        bar.style.width = data.persen + '%';
        bar.className   = 'progres-bar ' + data.bar_class;

        /* Update persentase */
        document.getElementById(`persen-${id}`).textContent = Math.round(data.persen) + '%';

        /* Update animasi baris kritis */
        const row = document.getElementById(`row-${id}`);
        if (data.bar_class === 'bar-kritis') row.classList.add('row-kritis');
        else row.classList.remove('row-kritis');

        /* Sinkronisasi bahansData agar modal detail tidak stale */
        const idx = bahansData.findIndex(b => b.id === id);
        if (idx !== -1) {
            bahansData[idx].stok   = fmt(data.stok);
            bahansData[idx].maks   = fmt(data.maks);
            bahansData[idx].persen = Math.round(data.persen);
            bahansData[idx].status = data.status;
        }

    } catch (e) { console.error(e); }
}

/* ── Modal detail per kategori ── */
function bukaDetailStok(filter) {
    const items = bahansData.filter(b => b.status === filter);
    document.getElementById('detailModalTitle').textContent = titleMap[filter];
    const col = colorMap[filter];

    let html = '<div class="m-section">Ringkasan</div>'
        + '<div class="m-chip-grid">'
        + `<div class="m-chip"><div class="m-chip-label">Kategori Ini</div><div class="m-chip-value ${col}">${items.length} bahan</div></div>`
        + `<div class="m-chip"><div class="m-chip-label">Total Bahan</div><div class="m-chip-value">${bahansData.length}</div></div>`
        + '</div>';

    if (items.length === 0) {
        html += '<div style="text-align:center;padding:28px 0;color:var(--muted);font-size:13px">Tidak ada bahan di kategori ini.</div>';
    } else {
        html += '<div class="m-section">Daftar Bahan</div>';
        items.forEach(b => {
            html += `<div class="sid-row">
                <div style="min-width:120px">
                    <div class="sid-name">${b.nama}</div>
                    <div class="sid-qty">${fmt(b.stok)} / ${fmt(b.maks)} ${b.satuan} · ${b.persen}%</div>
                </div>
                <div class="sid-bar">
                    <div class="sid-bar-track">
                        <div class="sid-bar-fill" style="width:${b.persen}%;background:${barColors[b.status]}"></div>
                    </div>
                </div>
                <span class="sid-badge ${b.status}">${badgeLabel[b.status]}</span>
            </div>`;
        });
    }

    document.getElementById('detailModalBody').innerHTML = html;
    bukaModal('modalDetailStok');
}
</script>
</body>
</html>