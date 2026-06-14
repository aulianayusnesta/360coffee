{{-- resources/views/admin/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — Street 360 Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            --blue:       #60a5fa;
            --blue-dim:   rgba(96,165,250,.11);
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
        .page-header { margin-bottom:22px; }
        .page-eyebrow { font-size:11px; font-weight:600; letter-spacing:.14em; color:var(--gold); margin-bottom:4px; text-transform:uppercase; }
        .page-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:26px; font-weight:800; color:#fff; line-height:1; }

        /* ── Alert ── */
        .alert-kritis { display:flex; align-items:center; gap:10px; background:rgba(248,113,113,.08); border:1px solid rgba(248,113,113,.25); border-radius:12px; padding:12px 18px; margin-bottom:20px; font-size:13px; font-weight:600; color:var(--red); }
        .alert-dot { width:8px; height:8px; background:var(--red); border-radius:50%; flex-shrink:0; animation:pulse 1.5s infinite; }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.3} }
        .alert-label { color:var(--muted); margin-right:4px; }

        /* ── Stat Cards ── */
        .stat-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:20px; }
        .stat-card { background:var(--navy-3); border:1px solid var(--border); border-radius:16px; padding:20px 22px; cursor:pointer; position:relative; overflow:hidden; transition:all .25s cubic-bezier(.34,1.2,.64,1); text-decoration:none; display:block; }
        .stat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:linear-gradient(90deg,transparent,var(--gold),var(--gold-l),transparent); border-radius:16px 16px 0 0; transform:scaleX(0); transform-origin:left; transition:transform .3s cubic-bezier(.34,1.2,.64,1); }
        .stat-card::after { content:''; position:absolute; inset:0; border-radius:16px; background:radial-gradient(ellipse at 30% 0%,rgba(232,176,75,.09) 0%,transparent 65%); opacity:0; transition:opacity .25s; }
        .stat-card:hover { border-color:rgba(232,176,75,.3); transform:translateY(-3px); box-shadow:0 12px 36px rgba(0,0,0,.3),0 0 0 1px rgba(232,176,75,.12); }
        .stat-card:hover::before { transform:scaleX(1); }
        .stat-card:hover::after  { opacity:1; }
        .stat-card-top { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:14px; position:relative; z-index:1; }
        .stat-icon { width:38px; height:38px; border-radius:10px; background:var(--gold-dim); border:1px solid rgba(232,176,75,.18); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .stat-icon svg { color:var(--gold); }
        .stat-icon.red-icon   { background:var(--red-dim);   border-color:rgba(248,113,113,.18); } .stat-icon.red-icon svg   { color:var(--red); }
        .stat-icon.green-icon { background:var(--green-dim); border-color:rgba(74,222,128,.18);  } .stat-icon.green-icon svg { color:var(--green); }
        .stat-icon.blue-icon  { background:var(--blue-dim);  border-color:rgba(96,165,250,.18);  } .stat-icon.blue-icon svg  { color:var(--blue); }
        .stat-badge { font-size:10px; font-weight:700; padding:3px 9px; border-radius:20px; }
        .stat-badge.green { background:var(--green-dim); color:var(--green); }
        .stat-badge.red   { background:var(--red-dim);   color:var(--red); }
        .stat-badge.yellow{ background:var(--yellow-dim);color:var(--yellow); }
        .stat-label { font-size:10px; font-weight:700; letter-spacing:.12em; color:var(--muted); margin-bottom:6px; text-transform:uppercase; position:relative; z-index:1; }
        .stat-value { font-family:'Plus Jakarta Sans',sans-serif; font-size:28px; font-weight:800; color:#fff; line-height:1; position:relative; z-index:1; }
        .stat-value.rp { font-size:20px; color:var(--gold); }
        .stat-value.red-val { color:var(--red); }
        .stat-footer { display:flex; align-items:center; gap:5px; margin-top:10px; padding-top:10px; border-top:1px solid var(--border); font-size:11px; color:var(--muted); position:relative; z-index:1; transition:color .2s; }
        .stat-card:hover .stat-footer { color:var(--gold); }

        /* ── Mid row ── */
        .mid-row { display:grid; grid-template-columns:1fr 320px; gap:14px; margin-bottom:14px; }
        .bot-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; }

        /* ── Cards ── */
        .card { background:var(--navy-3); border-radius:14px; border:1px solid var(--border); padding:20px 22px; }
        .card-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
        .card-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:14px; font-weight:700; color:#fff; }
        .toggle-group { display:flex; gap:5px; }
        .toggle-btn { padding:5px 13px; border-radius:7px; border:none; font-family:'DM Sans',sans-serif; font-size:11px; font-weight:700; cursor:pointer; background:var(--navy-4); color:var(--muted); transition:all .18s; }
        .toggle-btn.active { background:var(--gold); color:var(--navy); }

        /* Stok bars */
        .stok-item { margin-bottom:13px; }
        .stok-item:last-child { margin-bottom:0; }
        .stok-row { display:flex; justify-content:space-between; font-size:12px; margin-bottom:5px; }
        .stok-name { font-weight:600; color:var(--text); }
        .stok-qty  { color:var(--muted); font-size:11px; }
        .stok-bar  { height:5px; background:rgba(255,255,255,.08); border-radius:3px; overflow:hidden; }
        .stok-fill { height:100%; border-radius:3px; transition:width .4s; }
        .fill-green  { background:var(--green); }
        .fill-yellow { background:var(--yellow); }
        .fill-red    { background:var(--red); }

        /* Menu terlaris */
        .menu-item { display:flex; align-items:center; gap:12px; padding:10px 0; border-bottom:1px solid var(--border); }
        .menu-item:last-child { border-bottom:none; }
        .menu-rank { width:26px; height:26px; background:linear-gradient(135deg,var(--gold),var(--gold-l)); color:var(--navy); border-radius:8px; font-size:12px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .menu-rank.r2 { background:var(--navy-5); color:var(--muted-2); }
        .menu-rank.r3 { background:var(--navy-4); color:var(--muted); }
        .menu-info { flex:1; }
        .menu-nm { font-size:13px; font-weight:600; color:var(--text); }
        .menu-pr { font-size:11px; color:var(--muted); margin-top:1px; }
        .menu-qty { font-size:13px; font-weight:700; color:var(--gold); white-space:nowrap; }

        /* Transaksi table */
        .trx-table { width:100%; border-collapse:collapse; font-size:12px; }
        .trx-table th { text-align:left; font-size:10px; font-weight:700; letter-spacing:.1em; color:var(--muted); padding:0 8px 10px; border-bottom:1px solid var(--border); text-transform:uppercase; }
        .trx-table td { padding:10px 8px; border-bottom:1px solid rgba(255,255,255,.03); color:var(--text); font-weight:500; }
        .trx-table tr:last-child td { border-bottom:none; }

        /* Badges */
        .badge { display:inline-flex; align-items:center; gap:4px; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:700; white-space:nowrap; }
        .badge::before { content:''; width:5px; height:5px; border-radius:50%; flex-shrink:0; }
        .badge-tunai { background:var(--green-dim); color:var(--green); } .badge-tunai::before { background:var(--green); }
        .badge-qris  { background:var(--gold-dim);  color:var(--gold);  } .badge-qris::before  { background:var(--gold); }

        .empty-state { color:var(--muted); font-size:13px; padding:20px 0; text-align:center; }

        /* ── Modal ── */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(8,15,30,.82);
            z-index: 9999;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; pointer-events: none;
            transition: opacity .2s;
            backdrop-filter: blur(5px);
        }
        .modal-overlay.open { opacity: 1; pointer-events: all; }

        .modal-box {
            background: var(--navy-3);
            border: 1px solid var(--border-2);
            border-radius: 18px;
            width: 400px; max-width: 94vw;
            max-height: 80vh; overflow-y: auto;
            transform: translateY(14px) scale(.96);
            transition: transform .22s cubic-bezier(.34,1.2,.64,1);
            box-shadow: 0 28px 70px rgba(0,0,0,.5);
        }
        .modal-overlay.open .modal-box { transform: none; }

        /* Header modal */
        .modal-head {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            position: sticky; top: 0;
            background: var(--navy-3);
            border-radius: 18px 18px 0 0;
            z-index: 1;
        }
        .modal-head-left { display: flex; align-items: center; gap: 10px; }
        .modal-head-icon {
            width: 30px; height: 30px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .modal-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px; font-weight: 800; color: #fff;
        }
        .modal-close {
            width: 28px; height: 28px; border-radius: 8px;
            border: 1px solid var(--border-2);
            background: transparent; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: var(--muted); font-size: 16px; line-height: 1;
            transition: all .15s;
        }
        .modal-close:hover { background: var(--red-dim); border-color: var(--red); color: var(--red); }

        /* Body */
        .modal-body { padding: 18px 20px 22px; }

        /* Chips ringkasan */
        .m-chips { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 18px; }
        .m-chip { background: var(--navy-4); border: 1px solid var(--border); border-radius: 11px; padding: 12px 14px; }
        .m-chip-lbl { font-size: 10px; font-weight: 700; letter-spacing: .08em; color: var(--muted); margin-bottom: 5px; text-transform: uppercase; }
        .m-chip-val { font-size: 18px; font-weight: 800; color: var(--text); }
        .m-chip-val.gold   { color: var(--gold); }
        .m-chip-val.green  { color: var(--green); }
        .m-chip-val.red    { color: var(--red); }
        .m-chip-val.yellow { color: var(--yellow); }

        /* Label seksi */
        .m-sec {
            font-size: 10px; font-weight: 700; letter-spacing: .1em;
            color: var(--muted); text-transform: uppercase;
            margin: 16px 0 8px;
            display: flex; align-items: center; gap: 8px;
        }
        .m-sec::after { content:''; flex:1; height:1px; background: var(--border); }

        /* Baris flat (pendapatan harian, menu) */
        .m-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,.04);
        }
        .m-row:last-child { border-bottom: none; }
        .m-lbl { font-size: 13px; color: var(--muted-2); }
        .m-val { font-size: 13px; font-weight: 700; color: var(--text); }
        .m-val.gold   { color: var(--gold); }
        .m-val.green  { color: var(--green); }
        .m-val.red    { color: var(--red); }
        .m-val.yellow { color: var(--yellow); }

        /* Baris transaksi */
        .mt-row {
            display: flex; align-items: flex-start; justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,.04);
        }
        .mt-row:last-child { border-bottom: none; }
        .mt-nomor { font-size: 13px; font-weight: 700; color: var(--text); }
        .mt-waktu { font-size: 11px; color: var(--muted); margin-top: 2px; }
        .mt-menu  { font-size: 11px; color: var(--muted-2); margin-top: 3px; max-width: 200px; }
        .mt-total { font-size: 13px; font-weight: 700; color: var(--gold); text-align: right; }

        /* Baris stok */
        .ms-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 9px 0;
            border-bottom: 1px solid rgba(255,255,255,.04);
        }
        .ms-row:last-child { border-bottom: none; }
        .ms-nm  { font-size: 13px; font-weight: 600; color: var(--text); }
        .ms-qty { font-size: 11px; color: var(--muted); margin-top: 2px; }

        /* Rank badge menu */
        .mm-rank {
            width: 24px; height: 24px; border-radius: 7px;
            background: linear-gradient(135deg,var(--gold),var(--gold-l));
            color: var(--navy); font-size: 11px; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; margin-right: 10px;
        }
        .mm-rank.r2 { background: var(--navy-5); color: var(--muted-2); }
        .mm-rank.r3 { background: var(--navy-4); color: var(--muted); }

        /* Pill/badge status */
        .m-pill {
            display: inline-block; font-size: 10px; font-weight: 700;
            padding: 3px 10px; border-radius: 20px; white-space: nowrap;
        }
        .pill-green  { background: var(--green-dim);  color: var(--green); }
        .pill-amber  { background: var(--gold-dim);   color: var(--gold); }
        .pill-red    { background: var(--red-dim);    color: var(--red); }
        .pill-yellow { background: var(--yellow-dim); color: var(--yellow); }

        /* Total baris bawah */
        .m-total-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 12px 14px; margin-top: 12px;
            background: linear-gradient(135deg,rgba(232,176,75,.1),rgba(245,204,122,.04));
            border: 1px solid rgba(232,176,75,.22);
            border-radius: 11px;
        }
        .m-total-lbl { font-size: 11px; font-weight: 700; color: var(--muted); letter-spacing: .05em; text-transform: uppercase; }
        .m-total-val { font-family:'Plus Jakarta Sans',sans-serif; font-size: 18px; font-weight: 800; color: var(--gold); }

        .m-empty { font-size: 13px; color: var(--muted); padding: 18px 0; text-align: center; }
    </style>
</head>
<body>
<div class="layout">
    @include('admin.partials.sidebar')

    <main class="main">
        <div class="page-header">
            <div class="page-eyebrow">Selamat Datang</div>
            <div class="page-title">Dashboard</div>
        </div>

        @if($stokKritis->count() > 0)
        <div class="alert-kritis">
            <div class="alert-dot"></div>
            <span class="alert-label">Stok Kritis:</span>
            {{ $stokKritis->pluck('nama')->join(', ') }} — Segera lakukan restock!
        </div>
        @endif

        {{-- Stat Cards --}}
        <div class="stat-grid">
            <div class="stat-card" onclick="bukaModal('modalPendapatan')">
                <div class="stat-card-top">
                    <div class="stat-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                    </div>
                    <span class="stat-badge green">Hari ini</span>
                </div>
                <div class="stat-label">Pendapatan</div>
                <div class="stat-value rp">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
                <div class="stat-footer">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Klik untuk detail
                </div>
            </div>

            <div class="stat-card" onclick="bukaModal('modalTransaksi')">
                <div class="stat-card-top">
                    <div class="stat-icon blue-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                    </div>
                    <span class="stat-badge green">Hari ini</span>
                </div>
                <div class="stat-label">Transaksi</div>
                <div class="stat-value">{{ $transaksiHariIni }}</div>
                <div class="stat-footer">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Klik untuk detail
                </div>
            </div>

            <div class="stat-card" onclick="bukaModal('modalItem')">
                <div class="stat-card-top">
                    <div class="stat-icon green-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                    </div>
                    <span class="stat-badge green">Hari ini</span>
                </div>
                <div class="stat-label">Item Terjual</div>
                <div class="stat-value">{{ $itemTerjual }}</div>
                <div class="stat-footer">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Klik untuk detail
                </div>
            </div>

            <div class="stat-card" onclick="bukaModal('modalStok')">
                <div class="stat-card-top">
                    <div class="stat-icon {{ $stokKritisCount > 0 ? 'red-icon' : 'green-icon' }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
                    </div>
                    <span class="stat-badge {{ $stokKritisCount > 0 ? 'red' : 'green' }}">
                        {{ $stokKritisCount > 0 ? 'Perhatian' : 'Aman' }}
                    </span>
                </div>
                <div class="stat-label">Stok Kritis</div>
                <div class="stat-value {{ $stokKritisCount > 0 ? 'red-val' : '' }}">{{ $stokKritisCount }}</div>
                <div class="stat-footer">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Klik untuk detail
                </div>
            </div>
        </div>

        <div class="mid-row">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Grafik Penjualan</div>
                    <div class="toggle-group">
                        <button class="toggle-btn active" onclick="toggleChart(this,'harian')">Harian</button>
                        <button class="toggle-btn" onclick="toggleChart(this,'mingguan')">Mingguan</button>
                    </div>
                </div>
                <canvas id="chartPenjualan" height="140"></canvas>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Stok Bahan</div>
                </div>
                @forelse($bahans as $bahan)
                @php
                    $persen   = $bahan->getPersen();
                    $barClass = match($bahan->getStatus()) {
                        'kritis'       => 'fill-red',
                        'hampir_habis' => 'fill-yellow',
                        default        => 'fill-green',
                    };
                @endphp
                <div class="stok-item">
                    <div class="stok-row">
                        <span class="stok-name">{{ $bahan->nama }}</span>
                        <span class="stok-qty">{{ $bahan->stok_saat_ini }}/{{ $bahan->stok_maks }} {{ $bahan->satuan }}</span>
                    </div>
                    <div class="stok-bar">
                        <div class="stok-fill {{ $barClass }}" style="width:{{ $persen }}%"></div>
                    </div>
                </div>
                @empty
                <div class="empty-state">Belum ada data stok.</div>
                @endforelse
            </div>
        </div>

        <div class="bot-row">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Menu Terlaris</div>
                    <span style="font-size:11px;color:var(--muted);font-weight:600">Hari ini</span>
                </div>
                @forelse($menuTerlaris as $i => $item)
                <div class="menu-item">
                    <div class="menu-rank {{ $i === 1 ? 'r2' : ($i === 2 ? 'r3' : '') }}">{{ $i + 1 }}</div>
                    <div class="menu-info">
                        <div class="menu-nm">{{ $item->nama_menu }}</div>
                        <div class="menu-pr">Rp {{ number_format($item->menu->harga ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="menu-qty">{{ $item->total_terjual }} terjual</div>
                </div>
                @empty
                <div class="empty-state">Belum ada transaksi hari ini.</div>
                @endforelse
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Transaksi Terbaru</div>
                </div>
                <table class="trx-table">
                    <thead>
                        <tr><th>#</th><th>Waktu</th><th>Item</th><th>Total</th><th>Bayar</th></tr>
                    </thead>
                    <tbody>
                        @forelse($transaksiTerbaru as $trx)
                        <tr>
                            <td style="font-weight:700">{{ $trx->nomor }}</td>
                            <td style="color:var(--muted)">{{ $trx->created_at->format('H:i') }}</td>
                            <td style="color:var(--muted-2)">
                                {{ is_array($trx->items) && count($trx->items) > 0 ? ($trx->items[0]['nama'] ?? '-') : '-' }}
                                @if(is_array($trx->items) && count($trx->items) > 1)
                                    <span style="color:var(--muted);font-size:11px">+{{ count($trx->items)-1 }}</span>
                                @endif
                            </td>
                            <td style="color:var(--gold);font-weight:700">Rp {{ number_format($trx->total,0,',','.') }}</td>
                            <td><span class="badge badge-{{ $trx->metode === 'tunai' ? 'tunai' : 'qris' }}">{{ ucfirst($trx->metode) }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="empty-state">Belum ada transaksi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

{{-- ===== MODAL PENDAPATAN ===== --}}
<div class="modal-overlay" id="modalPendapatan" onclick="tutupModalKlik(event,'modalPendapatan')">
    <div class="modal-box">
        <div class="modal-head">
            <div class="modal-head-left">
                <div class="modal-head-icon" style="background:#FAEEDA;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#854F0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                </div>
                <span class="modal-title">Pendapatan</span>
            </div>
            <button class="modal-close" onclick="tutupModal('modalPendapatan')">×</button>
        </div>
        <div class="modal-body">

            <div class="m-chips">
                <div class="m-chip">
                    <div class="m-chip-lbl">Total hari ini</div>
                    <div class="m-chip-val gold">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
                </div>
                <div class="m-chip">
                    <div class="m-chip-lbl">Rata-rata / transaksi</div>
                    <div class="m-chip-val">
                        Rp {{ $transaksiHariIni > 0 ? number_format($pendapatanHariIni / $transaksiHariIni, 0, ',', '.') : '0' }}
                    </div>
                </div>
            </div>

            <div class="m-sec">7 Hari Terakhir</div>
            @php $totalMinggu = array_sum(array_column($harian, 'total')); @endphp
            @foreach($harian as $h)
            <div class="m-row">
                <span class="m-lbl">{{ $h['label'] }}</span>
                <span class="m-val">Rp {{ number_format($h['total'], 0, ',', '.') }}</span>
            </div>
            @endforeach

            <div class="m-total-row">
                <span class="m-total-lbl">Total 7 hari</span>
                <span class="m-total-val">Rp {{ number_format($totalMinggu, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

{{-- ===== MODAL TRANSAKSI ===== --}}
<div class="modal-overlay" id="modalTransaksi" onclick="tutupModalKlik(event,'modalTransaksi')">
    <div class="modal-box">
        <div class="modal-head">
            <div class="modal-head-left">
                <div class="modal-head-icon" style="background:#E6F1FB;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#185FA5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                </div>
                <span class="modal-title">Transaksi Hari Ini</span>
            </div>
            <button class="modal-close" onclick="tutupModal('modalTransaksi')">×</button>
        </div>
        <div class="modal-body">

            @php
                $tunaiCount = $transaksiTerbaru->where('metode', 'tunai')->count();
                $qrisCount  = $transaksiTerbaru->where('metode', '!=', 'tunai')->count();
            @endphp

            <div class="m-chips">
                <div class="m-chip">
                    <div class="m-chip-lbl">Total transaksi</div>
                    <div class="m-chip-val">{{ $transaksiHariIni }}</div>
                </div>
                <div class="m-chip">
                    <div class="m-chip-lbl">Bayar tunai / QRIS</div>
                    <div class="m-chip-val">{{ $tunaiCount }} / {{ $qrisCount }}</div>
                </div>
            </div>

            <div class="m-sec">5 Transaksi Terbaru</div>
            @forelse($transaksiTerbaru as $trx)
            <div class="mt-row">
                <div>
                    <div class="mt-nomor">{{ $trx->nomor }}</div>
                    <div class="mt-waktu">{{ $trx->created_at->format('H:i') }} WIB</div>
                    <div class="mt-menu">
                        @if(is_array($trx->items) && count($trx->items) > 0)
                            {{ collect($trx->items)->pluck('nama')->join(', ') }}
                        @else —
                        @endif
                    </div>
                </div>
                <div style="text-align:right">
                    <div class="mt-total">Rp {{ number_format($trx->total, 0, ',', '.') }}</div>
                    <div style="margin-top:5px">
                        <span class="badge badge-{{ $trx->metode === 'tunai' ? 'tunai' : 'qris' }}">
                            {{ $trx->metode === 'tunai' ? 'Tunai' : 'QRIS' }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="m-empty">Belum ada transaksi hari ini.</div>
            @endforelse
        </div>
    </div>
</div>

{{-- ===== MODAL ITEM TERJUAL ===== --}}
<div class="modal-overlay" id="modalItem" onclick="tutupModalKlik(event,'modalItem')">
    <div class="modal-box">
        <div class="modal-head">
            <div class="modal-head-left">
                <div class="modal-head-icon" style="background:#EAF3DE;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#3B6D11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                </div>
                <span class="modal-title">Item Terjual Hari Ini</span>
            </div>
            <button class="modal-close" onclick="tutupModal('modalItem')">×</button>
        </div>
        <div class="modal-body">

            <div class="m-chips">
                <div class="m-chip">
                    <div class="m-chip-lbl">Total item terjual</div>
                    <div class="m-chip-val green">{{ $itemTerjual }} item</div>
                </div>
                <div class="m-chip">
                    <div class="m-chip-lbl">Rata-rata / transaksi</div>
                    <div class="m-chip-val">
                        {{ $transaksiHariIni > 0 ? number_format($itemTerjual / $transaksiHariIni, 1) : '0' }} item
                    </div>
                </div>
            </div>

            <div class="m-sec">Semua Menu Hari Ini</div>
            @forelse($menuTerlaris as $i => $item)
            <div class="m-row">
                <span class="m-lbl" style="display:flex;align-items:center;gap:8px">
                    <span class="mm-rank {{ $i===1?'r2':($i===2?'r3':'') }}">{{ $i+1 }}</span>
                    {{ $item->nama_menu }}
                </span>
                <span class="m-val">{{ $item->total_terjual }} item</span>
            </div>
            @empty
            <div class="m-empty">Belum ada item terjual hari ini.</div>
            @endforelse
        </div>
    </div>
</div>

{{-- ===== MODAL STOK BAHAN ===== --}}
<div class="modal-overlay" id="modalStok" onclick="tutupModalKlik(event,'modalStok')">
    <div class="modal-box">
        <div class="modal-head">
            <div class="modal-head-left">
                <div class="modal-head-icon" style="background:#FCEBEB;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#A32D2D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
                </div>
                <span class="modal-title">Stok Bahan</span>
            </div>
            <button class="modal-close" onclick="tutupModal('modalStok')">×</button>
        </div>
        <div class="modal-body">

            @php
                $kritisModal      = $bahans->filter(fn($b) => $b->getStatus() === 'kritis');
                $hampirHabisModal = $bahans->filter(fn($b) => $b->getStatus() === 'hampir_habis');
                $amanModal        = $bahans->filter(fn($b) => $b->getStatus() === 'aman');
            @endphp

            <div class="m-chips">
                <div class="m-chip">
                    <div class="m-chip-lbl">Total bahan</div>
                    <div class="m-chip-val">{{ $bahans->count() }} bahan</div>
                </div>
                <div class="m-chip">
                    <div class="m-chip-lbl">Perlu diisi ulang</div>
                    <div class="m-chip-val red">{{ $kritisModal->count() + $hampirHabisModal->count() }} bahan</div>
                </div>
            </div>

            @if($kritisModal->count())
            <div class="m-sec">Perlu Diisi Ulang Sekarang</div>
            @foreach($kritisModal as $b)
            <div class="ms-row">
                <div>
                    <div class="ms-nm">{{ $b->nama }}</div>
                    <div class="ms-qty">Sisa {{ $b->stok_saat_ini }} dari {{ $b->stok_maks }} {{ $b->satuan }}</div>
                </div>
                <span class="m-pill pill-red">Hampir habis</span>
            </div>
            @endforeach
            @endif

            @if($hampirHabisModal->count())
            <div class="m-sec">Perlu Diperhatikan</div>
            @foreach($hampirHabisModal as $b)
            <div class="ms-row">
                <div>
                    <div class="ms-nm">{{ $b->nama }}</div>
                    <div class="ms-qty">Sisa {{ $b->stok_saat_ini }} dari {{ $b->stok_maks }} {{ $b->satuan }}</div>
                </div>
                <span class="m-pill pill-yellow">Segera isi</span>
            </div>
            @endforeach
            @endif

            @if($amanModal->count())
            <div class="m-sec">Stok Aman</div>
            @foreach($amanModal as $b)
            <div class="ms-row">
                <div>
                    <div class="ms-nm">{{ $b->nama }}</div>
                    <div class="ms-qty">Sisa {{ $b->stok_saat_ini }} dari {{ $b->stok_maks }} {{ $b->satuan }}</div>
                </div>
                <span class="m-pill pill-green">Aman</span>
            </div>
            @endforeach
            @endif

            @if($bahans->isEmpty())
            <div class="m-empty">Belum ada data stok bahan.</div>
            @endif
        </div>
    </div>
</div>

<script>
const harian   = { labels: {!! json_encode(array_column($harian,   'label')) !!}, data: {!! json_encode(array_column($harian,   'total')) !!} };
const mingguan = { labels: {!! json_encode(array_column($mingguan, 'label')) !!}, data: {!! json_encode(array_column($mingguan, 'total')) !!} };

const ctx = document.getElementById('chartPenjualan').getContext('2d');
let chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: harian.labels,
        datasets: [{
            data: harian.data,
            backgroundColor: harian.data.map((v,i) => i === harian.data.length-1 ? '#e8b04b' : 'rgba(255,255,255,.1)'),
            borderRadius: 8, borderSkipped: false
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, ticks: { color: '#6b7fa0', font: { size: 11 } } },
            y: { display: false, grid: { display: false } }
        }
    }
});

function toggleChart(btn, type) {
    document.querySelectorAll('.toggle-btn').forEach(b => { if(b.closest('.card')===btn.closest('.card')) b.classList.remove('active'); });
    btn.classList.add('active');
    const d = type === 'harian' ? harian : mingguan;
    chart.data.labels = d.labels;
    chart.data.datasets[0].data = d.data;
    chart.data.datasets[0].backgroundColor = d.data.map((v,i) => i===d.data.length-1 ? '#e8b04b' : 'rgba(255,255,255,.1)');
    chart.update();
}

function bukaModal(id)  { document.getElementById(id).classList.add('open'); document.body.style.overflow = 'hidden'; }
function tutupModal(id) { document.getElementById(id).classList.remove('open'); document.body.style.overflow = ''; }
function tutupModalKlik(e, id) { if (e.target === document.getElementById(id)) tutupModal(id); }
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay.open').forEach(m => m.classList.remove('open'));
        document.body.style.overflow = '';
    }
});
</script>
</body>
</html>