{{-- resources/views/admin/transaksi.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi — Street 360 Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --gold:        #e8b04b;
            --gold-l:      #f5cc7a;
            --gold-dim:    rgba(232,176,75,.13);
            --gold-glow:   rgba(232,176,75,.3);
            --navy:        #080f1e;
            --navy-2:      #0c1628;
            --navy-3:      #111f38;
            --navy-4:      #162440;
            --navy-5:      #1c2e4f;
            --text:        #f0f4ff;
            --muted:       #6b7fa0;
            --muted-2:     #8a9ec0;
            --border:      rgba(255,255,255,.06);
            --border-2:    rgba(255,255,255,.11);
            --green:       #4ade80;
            --green-dim:   rgba(74,222,128,.11);
            --yellow:      #fbbf24;
            --yellow-dim:  rgba(251,191,36,.11);
            --blue:        #60a5fa;
            --blue-dim:    rgba(96,165,250,.11);
            --purple:      #c084fc;
            --purple-dim:  rgba(192,132,252,.11);
            --red:         #f87171;
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
        .brand-name { font-family: 'Plus Jakarta Sans', sans-serif; font-size:20px; font-weight:800; color:#fff; letter-spacing:.06em; text-transform:uppercase; }
        .brand-name span { color: var(--gold); }
        .brand-badge { display:inline-block; margin-top:8px; background:linear-gradient(135deg,var(--gold),var(--gold-l)); color:var(--navy); font-size:10px; font-weight:800; padding:3px 12px; border-radius:20px; letter-spacing:.1em; text-transform:uppercase; }
        .sidebar-user { display:flex; align-items:center; gap:12px; padding:18px 20px; border-bottom:1px solid var(--border); }
        .user-avatar { width:40px; height:40px; background:linear-gradient(135deg,var(--gold),var(--gold-l)); border-radius:12px; display:flex; align-items:center; justify-content:center; font-family: 'Plus Jakarta Sans', sans-serif; font-size:16px; font-weight:800; color:var(--navy); flex-shrink:0; }
        .user-name { font-size:14px; font-weight:700; color:#fff; }
        .user-sub  { font-size:11px; color:var(--muted); margin-top:1px; }
        .sidebar-section { padding:20px 20px 6px; font-size:10px; font-weight:700; letter-spacing:.16em; color:var(--muted); text-transform:uppercase; }
        .sidebar-nav { padding:4px 10px; }
        .nav-item { display:flex; align-items:center; gap:11px; padding:10px 13px; border-radius:10px; font-size:13px; font-weight:600; color:var(--muted); cursor:pointer; text-decoration:none; transition:all .18s; margin-bottom:2px; border:none; background:none; width:100%; text-align:left; font-family:'DM Sans',sans-serif; }
        .nav-item:hover { background:rgba(255,255,255,.05); color:var(--text); }
        .nav-item.active { background:var(--gold-dim); color:var(--gold); border-left:2px solid var(--gold); padding-left:11px; }
        .nav-item svg { flex-shrink:0; }

        /* ── Main ── */
        .main { flex:1; overflow-y:auto; padding:32px 36px; background:var(--navy); }

        /* ── Header ── */
        .page-header { display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:28px; }
        .page-eyebrow { font-size:11px; font-weight:600; letter-spacing:.14em; color:var(--gold); margin-bottom:5px; text-transform:uppercase; }
        .page-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size:30px; font-weight:800; color:#fff; line-height:1; }
        .btn-export { background:linear-gradient(135deg,var(--gold),var(--gold-l)); color:var(--navy); padding:11px 24px; border-radius:12px; font-size:13px; font-weight:800; cursor:pointer; font-family:'DM Sans',sans-serif; text-decoration:none; transition:all .2s; display:inline-flex; align-items:center; gap:8px; border:none; box-shadow:0 4px 20px var(--gold-glow); }
        .btn-export:hover { transform:translateY(-1px); box-shadow:0 8px 28px var(--gold-glow); }

        /* ── Filter ── */
        .filter-bar { display:flex; gap:10px; margin-bottom:26px; flex-wrap:wrap; align-items:center; background:var(--navy-3); border:1px solid var(--border); border-radius:14px; padding:14px 20px; }
        .filter-label { font-size:11px; font-weight:700; color:var(--muted); letter-spacing:.1em; text-transform:uppercase; }
        .filter-input, .filter-select { background:var(--navy-4); border:1px solid var(--border-2); border-radius:9px; padding:8px 13px; font-family:'DM Sans',sans-serif; font-size:13px; color:var(--text); outline:none; transition:border-color .18s,box-shadow .18s; }
        .filter-input:focus, .filter-select:focus { border-color:var(--gold); box-shadow:0 0 0 3px var(--gold-dim); }
        .filter-select { cursor:pointer; }
        .filter-select option { background:#162440; }
        .btn-filter { background:var(--navy-5); border:1px solid var(--border-2); color:var(--text); padding:8px 18px; border-radius:9px; font-size:13px; font-weight:700; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all .18s; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
        .btn-filter:hover { background:var(--gold-dim); border-color:var(--gold); color:var(--gold); }
        .btn-reset { background:transparent; border:1px solid rgba(255,255,255,.08); color:var(--muted); padding:8px 14px; border-radius:9px; font-size:12px; font-weight:600; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all .18s; text-decoration:none; display:inline-flex; align-items:center; gap:5px; }
        .btn-reset:hover { color:var(--red); border-color:var(--red); background:rgba(248,113,113,.08); }

        /* ── Summary Cards ── */
        .summary-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:26px; }

        .summary-card {
            position:relative; overflow:hidden; cursor:pointer;
            text-decoration:none; display:block;
            background:var(--navy-3);
            border:1px solid var(--border);
            border-radius:18px; padding:24px 26px 20px;
            transition:all .28s cubic-bezier(.34,1.2,.64,1);
        }
        .summary-card::before {
            content:''; position:absolute; top:0; left:0; right:0; height:2px;
            background:linear-gradient(90deg, transparent, var(--gold), var(--gold-l), transparent);
            border-radius:18px 18px 0 0;
            transform:scaleX(0); transform-origin:left;
            transition:transform .35s cubic-bezier(.34,1.2,.64,1);
        }
        .summary-card::after {
            content:''; position:absolute; inset:0; border-radius:18px;
            background:radial-gradient(ellipse at 30% 0%, rgba(232,176,75,.1) 0%, transparent 65%);
            opacity:0; transition:opacity .28s;
        }
        .summary-card:hover { border-color:rgba(232,176,75,.35); transform:translateY(-4px); box-shadow:0 16px 44px rgba(0,0,0,.35), 0 0 0 1px rgba(232,176,75,.15); }
        .summary-card:hover::before { transform:scaleX(1); }
        .summary-card:hover::after  { opacity:1; }
        .summary-card.active-filter { border-color:var(--gold); box-shadow:0 0 0 1px var(--gold), 0 12px 36px var(--gold-glow); }
        .summary-card.active-filter::before { transform:scaleX(1); }
        .summary-card.active-filter::after  { opacity:1; }

        .card-top { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px; position:relative; z-index:1; }
        .card-icon { width:42px; height:42px; border-radius:11px; background:var(--gold-dim); border:1px solid rgba(232,176,75,.2); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .card-icon svg { color:var(--gold); }
        .card-trend { font-size:11px; font-weight:700; color:var(--green); background:var(--green-dim); padding:4px 9px; border-radius:20px; display:flex; align-items:center; gap:3px; }

        .summary-label { font-size:10px; font-weight:700; letter-spacing:.14em; color:var(--muted); margin-bottom:7px; text-transform:uppercase; position:relative; z-index:1; }
        .summary-value { font-family: 'Plus Jakarta Sans', sans-serif; font-size:34px; font-weight:800; color:#fff; line-height:1; position:relative; z-index:1; }
        .summary-value.rp { font-size:24px; color:var(--gold); }

        .card-footer { display:flex; align-items:center; gap:5px; margin-top:12px; padding-top:12px; border-top:1px solid var(--border); font-size:11px; color:var(--muted); position:relative; z-index:1; transition:color .2s; }
        .summary-card:hover .card-footer { color:var(--gold); }
        .card-footer svg { flex-shrink:0; }

        /* ── Table ── */
        .table-card { background:var(--navy-3); border:1px solid var(--border); border-radius:16px; overflow:hidden; }
        .table-card-header { display:flex; align-items:center; justify-content:space-between; padding:18px 24px; border-bottom:1px solid var(--border); }
        .table-card-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size:15px; font-weight:700; color:#fff; display:flex; align-items:center; gap:10px; }
        .count-pill { background:var(--gold-dim); color:var(--gold); font-family:'DM Sans',sans-serif; font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px; }
        .active-filter-tag { background:rgba(232,176,75,.1); border:1px solid rgba(232,176,75,.25); color:var(--gold); font-size:11px; font-weight:600; padding:3px 10px; border-radius:20px; display:none; align-items:center; gap:5px; cursor:pointer; font-family:'DM Sans',sans-serif; }
        .active-filter-tag.show { display:inline-flex; }
        .active-filter-tag:hover { background:rgba(248,113,113,.1); border-color:var(--red); color:var(--red); }

        .trx-table { width:100%; border-collapse:collapse; font-size:13px; }
        .trx-table thead th { background:rgba(0,0,0,.18); color:var(--muted); font-size:10px; letter-spacing:.12em; font-weight:700; padding:11px 20px; text-align:left; border-bottom:1px solid var(--border); text-transform:uppercase; white-space:nowrap; }
        .trx-table tbody tr { border-bottom:1px solid rgba(255,255,255,.03); transition:background .12s; cursor:pointer; }
        .trx-table tbody tr:last-child { border-bottom:none; }
        .trx-table tbody tr:hover { background:rgba(232,176,75,.05); }
        .trx-table td { padding:13px 20px; vertical-align:middle; color:var(--muted-2); font-weight:500; }
        .td-nomor { font-family: 'Plus Jakarta Sans', sans-serif; font-size:14px; font-weight:700; color:#fff; }
        .td-date { font-weight:600; color:var(--text); font-size:13px; }
        .td-time { font-size:11px; color:var(--muted); margin-top:2px; }
        .td-item { max-width:170px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:var(--muted); font-size:12px; }
        .td-total { color:var(--gold); font-weight:800; font-size:14px; white-space:nowrap; }
        .td-kembalian { white-space:nowrap; }

        /* Badges */
        .badge { display:inline-flex; align-items:center; gap:5px; padding:4px 11px; border-radius:20px; font-size:11px; font-weight:700; letter-spacing:.02em; white-space:nowrap; }
        .badge::before { content:''; width:5px; height:5px; border-radius:50%; flex-shrink:0; }
        .badge-tunai    { background:var(--green-dim);  color:var(--green);  } .badge-tunai::before    { background:var(--green); }
        .badge-qris     { background:var(--gold-dim);   color:var(--gold);   } .badge-qris::before     { background:var(--gold); }
        .badge-selesai  { background:var(--green-dim);  color:var(--green);  } .badge-selesai::before  { background:var(--green); }
        .badge-antrian  { background:var(--yellow-dim); color:var(--yellow); } .badge-antrian::before  { background:var(--yellow); }
        .badge-dinein   { background:var(--blue-dim);   color:var(--blue);   } .badge-dinein::before   { background:var(--blue); }
        .badge-takeaway { background:var(--purple-dim); color:var(--purple); } .badge-takeaway::before { background:var(--purple); }

        .empty-state { text-align:center; padding:64px; color:var(--muted); }
        .empty-icon  { font-size:40px; margin-bottom:14px; opacity:.4; }
        .empty-text  { font-size:14px; font-weight:600; }
        .empty-sub   { font-size:12px; margin-top:4px; }

        /* ── Popup ── */
        .popup-overlay { display:none; position:fixed; inset:0; background:rgba(8,15,30,.88); z-index:9999; align-items:center; justify-content:center; backdrop-filter:blur(8px); }
        .popup-overlay.show { display:flex; }
        .popup-box { background:var(--navy-3); border:1px solid var(--border-2); border-radius:22px; width:100%; max-width:520px; margin:16px; animation:popUp .24s cubic-bezier(.34,1.4,.64,1) both; max-height:90vh; overflow-y:auto; box-shadow:0 32px 80px rgba(0,0,0,.6), 0 0 0 1px rgba(232,176,75,.08); }
        @keyframes popUp { from{opacity:0;transform:scale(.9) translateY(24px)} to{opacity:1;transform:scale(1) translateY(0)} }

        .popup-head { display:flex; justify-content:space-between; align-items:center; padding:22px 26px; border-bottom:1px solid var(--border); position:sticky; top:0; background:var(--navy-3); z-index:1; border-radius:22px 22px 0 0; }
        .popup-head-left {}
        .popup-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size:18px; font-weight:800; color:#fff; }
        .popup-sub { font-size:12px; color:var(--gold); font-weight:600; margin-top:3px; }
        .popup-close { background:rgba(255,255,255,.07); border:1px solid var(--border); color:var(--muted-2); width:34px; height:34px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:18px; cursor:pointer; transition:all .18s; flex-shrink:0; }
        .popup-close:hover { background:rgba(248,113,113,.15); border-color:var(--red); color:var(--red); }

        .popup-body { padding:24px 26px 28px; }

        .info-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:4px; }
        .info-chip { background:var(--navy-4); border:1px solid var(--border); border-radius:12px; padding:12px 16px; }
        .info-chip-label { font-size:10px; font-weight:700; letter-spacing:.12em; color:var(--muted); text-transform:uppercase; margin-bottom:6px; }
        .info-chip-value { font-size:14px; font-weight:700; color:var(--text); }

        .section-title { font-size:10px; font-weight:700; letter-spacing:.14em; color:var(--muted); text-transform:uppercase; display:flex; align-items:center; gap:10px; margin:20px 0 12px; }
        .section-title::after { content:''; flex:1; height:1px; background:var(--border); }

        .items-list { display:flex; flex-direction:column; gap:6px; }
        .item-row { display:flex; justify-content:space-between; align-items:center; padding:12px 16px; background:var(--navy-4); border-radius:12px; gap:12px; border:1px solid var(--border); transition:border-color .15s; }
        .item-row:hover { border-color:rgba(232,176,75,.2); }
        .item-nama { color:var(--text); font-weight:600; font-size:13px; }
        .item-qty  { color:var(--muted); font-size:11px; margin-top:2px; }
        .item-sub  { color:var(--gold); font-weight:800; font-size:14px; white-space:nowrap; }

        .pay-grid { display:grid; grid-template-columns:1fr 1fr 1fr; gap:10px; margin-top:4px; }
        .pay-chip { background:var(--navy-4); border:1px solid var(--border); border-radius:12px; padding:12px 16px; text-align:center; }
        .pay-chip-label { font-size:10px; font-weight:700; letter-spacing:.1em; color:var(--muted); text-transform:uppercase; margin-bottom:6px; }
        .pay-chip-value { font-size:13px; font-weight:700; color:var(--text); }

        .total-block { background:linear-gradient(135deg,rgba(232,176,75,.13),rgba(245,204,122,.05)); border:1px solid rgba(232,176,75,.28); border-radius:14px; padding:18px 20px; display:flex; justify-content:space-between; align-items:center; margin-top:14px; }
        .total-label { font-size:11px; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.1em; }
        .total-value { font-family: 'Plus Jakarta Sans', sans-serif; font-size:26px; font-weight:800; color:var(--gold); }

        .catatan-block { background:var(--navy-4); border:1px solid var(--border); border-radius:12px; padding:12px 16px; font-size:13px; color:var(--muted-2); font-style:italic; margin-top:4px; }
    </style>
</head>
<body>
<div class="layout">
    @include('admin.partials.sidebar')

    <main class="main">
        <div class="page-header">
            <div>
                <div class="page-eyebrow">Laporan</div>
                <div class="page-title">Transaksi</div>
            </div>
            <a href="{{ route('admin.transaksi.export') }}?{{ http_build_query(request()->only('tanggal','metode','status')) }}" class="btn-export">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Export CSV
            </a>
        </div>

        {{-- Filter --}}
        <form method="GET" action="{{ route('admin.transaksi') }}" class="filter-bar">
            <span class="filter-label">Filter</span>
            <input type="date" name="tanggal" class="filter-input" value="{{ request('tanggal') }}">
            <select name="metode" class="filter-select">
                <option value="semua" {{ request('metode','semua')==='semua' ? 'selected':'' }}>Semua Metode</option>
                <option value="tunai" {{ request('metode')==='tunai' ? 'selected':'' }}>Tunai</option>
                <option value="qris"  {{ request('metode')==='qris'  ? 'selected':'' }}>QRIS</option>
            </select>
            <select name="status" class="filter-select">
                <option value="semua"   {{ request('status','semua')==='semua'   ? 'selected':'' }}>Semua Status</option>
                <option value="selesai" {{ request('status')==='selesai' ? 'selected':'' }}>Selesai</option>
                <option value="antrian" {{ request('status')==='antrian' ? 'selected':'' }}>Antrian</option>
            </select>
            <button type="submit" class="btn-filter">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                Terapkan
            </button>
            @if(request('tanggal') || (request('metode') && request('metode') !== 'semua') || (request('status') && request('status') !== 'semua'))
                <a href="{{ route('admin.transaksi') }}" class="btn-reset">✕ Reset</a>
            @endif
        </form>

        {{-- Summary Cards --}}
        @php
            $selesaiCount = $transaksis->where('status','selesai')->count();
            $antriCount   = $transaksis->where('status','antrian')->count();
        @endphp
        <div class="summary-grid">

            <a href="{{ route('admin.transaksi') }}{{ request('tanggal') ? '?tanggal='.request('tanggal') : '' }}"
               class="summary-card {{ (!request('status') || request('status') === 'semua') && !request('tanggal') && (!request('metode') || request('metode')==='semua') ? 'active-filter' : '' }}">
                <div class="card-top">
                    <div class="card-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                    </div>
                    <div class="card-trend">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
                        Semua
                    </div>
                </div>
                <div class="summary-label">Total Transaksi</div>
                <div class="summary-value">{{ $transaksis->count() }}</div>
                <div class="card-footer">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Klik untuk lihat semua
                </div>
            </a>

            <a href="{{ route('admin.transaksi') }}?status=selesai{{ request('tanggal') ? '&tanggal='.request('tanggal') : '' }}{{ request('metode') && request('metode') !== 'semua' ? '&metode='.request('metode') : '' }}"
               class="summary-card {{ request('status') === 'selesai' ? 'active-filter' : '' }}">
                <div class="card-top">
                    <div class="card-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                    </div>
                    <div class="card-trend">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ $selesaiCount }} selesai
                    </div>
                </div>
                <div class="summary-label">Total Pendapatan</div>
                <div class="summary-value rp">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                <div class="card-footer">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    Klik untuk filter selesai
                </div>
            </a>

            <a href="{{ route('admin.transaksi') }}?status=antrian{{ request('tanggal') ? '&tanggal='.request('tanggal') : '' }}{{ request('metode') && request('metode') !== 'semua' ? '&metode='.request('metode') : '' }}"
               class="summary-card {{ request('status') === 'antrian' ? 'active-filter' : '' }}">
                <div class="card-top">
                    <div class="card-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="card-trend" style="background:var(--yellow-dim);color:var(--yellow)">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        {{ $antriCount }} antrian
                    </div>
                </div>
                <div class="summary-label">Rata-rata Transaksi</div>
                <div class="summary-value rp">
                    Rp {{ $selesaiCount > 0 ? number_format($totalPendapatan / $selesaiCount, 0, ',', '.') : '0' }}
                </div>
                <div class="card-footer">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Klik untuk filter antrian
                </div>
            </a>

        </div>

        {{-- Table --}}
        <div class="table-card">
            <div class="table-card-header">
                <div class="table-card-title">
                    Riwayat Transaksi
                    <span class="count-pill">{{ $transaksis->count() }} data</span>
                    @if(request('status') && request('status') !== 'semua')
                    <span class="active-filter-tag show" onclick="window.location='{{ route('admin.transaksi') }}'">
                        {{ ucfirst(request('status')) }} ✕
                    </span>
                    @endif
                </div>
            </div>
            <table class="trx-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Waktu</th>
                        <th>Item</th>
                        <th>Tipe</th>
                        <th>Total</th>
                        <th>Bayar</th>
                        <th>Kembalian</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $trx)
                    <tr onclick="bukaDetail({{ $trx->id }})">
                        <td class="td-nomor">{{ $trx->nomor }}</td>
                        <td>
                            <div class="td-date">{{ $trx->created_at->format('d/m/Y') }}</div>
                            <div class="td-time">{{ $trx->created_at->format('H:i') }}</div>
                        </td>
                        <td class="td-item" title="{{ $trx->getNamaItems() }}">
                            {{ Str::limit($trx->getNamaItems() ?: '—', 35) }}
                        </td>
                        <td>
                            @if($trx->tipe === 'dine_in')
                                <span class="badge badge-dinein">Dine In</span>
                            @else
                                <span class="badge badge-takeaway">Take Away</span>
                            @endif
                        </td>
                        <td class="td-total">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                        <td>
                            @if($trx->metode === 'tunai')
                                <span class="badge badge-tunai">Tunai</span>
                            @else
                                <span class="badge badge-qris">QRIS</span>
                            @endif
                        </td>
                        <td class="td-kembalian">Rp {{ number_format($trx->kembalian, 0, ',', '.') }}</td>
                        <td>
                            @if($trx->status === 'selesai')
                                <span class="badge badge-selesai">Selesai</span>
                            @else
                                <span class="badge badge-antrian">Antrian</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="empty-state">
                            <div class="empty-icon">📭</div>
                            <div class="empty-text">Tidak ada transaksi</div>
                            <div class="empty-sub">Coba ubah filter atau reset pencarian</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>

{{-- Popup --}}
<div class="popup-overlay" id="popupDetail">
    <div class="popup-box">
        <div class="popup-head">
            <div class="popup-head-left">
                <div class="popup-title">Detail Transaksi</div>
                <div class="popup-sub" id="detailSub"></div>
            </div>
            <button class="popup-close" onclick="tutupDetail()">×</button>
        </div>
        <div class="popup-body" id="detailContent"></div>
    </div>
</div>

<script>
var TRX = {};
@foreach($transaksis as $trx)
@php
    $rawItems = $trx->items;
    if (is_string($rawItems)) $rawItems = json_decode($rawItems, true);
    if (is_string($rawItems)) $rawItems = json_decode($rawItems, true);
    if (!is_array($rawItems)) $rawItems = [];
    $itemsMapped = collect($rawItems)->map(fn($i) => [
        'nama'     => $i['nama']     ?? '',
        'qty'      => $i['qty']      ?? 1,
        'harga'    => number_format($i['harga']    ?? 0, 0, ',', '.'),
        'subtotal' => number_format(($i['harga'] ?? 0) * ($i['qty'] ?? 1), 0, ',', '.'),
    ])->values();
@endphp
TRX[{{ $trx->id }}] = {
    nomor:     "{{ $trx->nomor }}",
    waktu:     "{{ $trx->created_at->format('d/m/Y') }}",
    jam:       "{{ $trx->created_at->format('H:i') }}",
    tipe:      "{{ $trx->tipe === 'dine_in' ? 'Dine In' : 'Take Away' }}",
    metode:    "{{ ucfirst($trx->metode) }}",
    total:     "{{ number_format($trx->total, 0, ',', '.') }}",
    uang:      "{{ number_format($trx->uang, 0, ',', '.') }}",
    kembalian: "{{ number_format($trx->kembalian, 0, ',', '.') }}",
    status:    "{{ ucfirst($trx->status) }}",
    catatan:   "{{ addslashes($trx->catatan ?: '') }}",
    items:     {!! json_encode($itemsMapped) !!}
};
@endforeach

function bukaDetail(id) {
    var t = TRX[id];
    if (!t) return;

    document.getElementById('detailSub').textContent = 'No. ' + t.nomor + '  ·  ' + t.waktu + '  ' + t.jam;

    var statusCls  = t.status.toLowerCase() === 'selesai' ? 'badge badge-selesai' : 'badge badge-antrian';
    var tipeCls    = t.tipe === 'Dine In' ? 'badge badge-dinein' : 'badge badge-takeaway';
    var metodeCls  = t.metode.toLowerCase() === 'tunai' ? 'badge badge-tunai' : 'badge badge-qris';

    var html = '<div class="info-grid">'
        + chip('Tipe',   '<span class="' + tipeCls   + '">' + t.tipe   + '</span>')
        + chip('Status', '<span class="' + statusCls + '">' + t.status + '</span>')
        + '</div>';

    if (t.catatan) {
        html += '<div class="section-title">Catatan</div>'
             + '<div class="catatan-block">' + t.catatan + '</div>';
    }

    html += '<div class="section-title">Item Pesanan</div><div class="items-list">';
    if (t.items && t.items.length) {
        t.items.forEach(function(i) {
            html += '<div class="item-row">'
                + '<div><div class="item-nama">' + i.nama + '</div><div class="item-qty">× ' + i.qty + ' &nbsp;·&nbsp; @Rp ' + i.harga + '</div></div>'
                + '<div class="item-sub">Rp ' + i.subtotal + '</div>'
                + '</div>';
        });
    } else {
        html += '<div style="color:var(--muted);font-size:13px;padding:12px;text-align:center">Tidak ada item.</div>';
    }
    html += '</div>';

    html += '<div class="section-title">Pembayaran</div>'
         + '<div class="pay-grid">'
         + payChip('Metode',    '<span class="' + metodeCls + '">' + t.metode + '</span>')
         + payChip('Dibayar',   'Rp ' + t.uang)
         + payChip('Kembalian', 'Rp ' + t.kembalian)
         + '</div>'
         + '<div class="total-block"><div class="total-label">Total</div><div class="total-value">Rp ' + t.total + '</div></div>';

    document.getElementById('detailContent').innerHTML = html;
    document.getElementById('popupDetail').classList.add('show');
}

function chip(label, value) {
    return '<div class="info-chip"><div class="info-chip-label">' + label + '</div><div class="info-chip-value">' + value + '</div></div>';
}
function payChip(label, value) {
    return '<div class="pay-chip"><div class="pay-chip-label">' + label + '</div><div class="pay-chip-value">' + value + '</div></div>';
}
function tutupDetail() { document.getElementById('popupDetail').classList.remove('show'); }
document.getElementById('popupDetail').addEventListener('click', function(e) { if (e.target === this) tutupDetail(); });
document.addEventListener('keydown', function(e) { if (e.key === 'Escape') tutupDetail(); });
</script>
</body>
</html>