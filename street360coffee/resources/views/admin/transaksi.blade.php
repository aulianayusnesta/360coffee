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
            --gold:       #e8b04b;
            --gold-l:     #f5cc7a;
            --gold-dim:   rgba(232,176,75,.12);
            --gold-glow:  rgba(232,176,75,.28);
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
            --blue:       #60a5fa;
            --blue-dim:   rgba(96,165,250,.11);
            --purple:     #c084fc;
            --purple-dim: rgba(192,132,252,.11);
            --red:        #f87171;
            --red-dim:    rgba(248,113,113,.11);
        }

        html, body { height: 100%; font-family: 'DM Sans', sans-serif; background: var(--navy); color: var(--text); overflow: hidden; }
        .layout { display: flex; height: 100vh; }
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--navy-5); border-radius: 4px; }

        /* ─── Sidebar ─── */
        .sidebar { width: 256px; min-width: 256px; background: var(--navy-2); display: flex; flex-direction: column; border-right: 1px solid var(--border); overflow-y: auto; position: relative; }
        .sidebar::after { content:''; position:absolute; top:0; right:0; bottom:0; width:1px; background:linear-gradient(180deg,transparent,rgba(232,176,75,.18) 40%,transparent); pointer-events:none; }
        .sidebar-brand { padding: 24px 20px 18px; border-bottom: 1px solid var(--border); }
        .brand-name { font-family: 'Plus Jakarta Sans', sans-serif; font-size:20px; font-weight:800; color:#fff; letter-spacing:.06em; text-transform:uppercase; }
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

        /* ─── Main ─── */
        .main { flex:1; overflow-y:auto; padding:32px 36px; background:var(--navy); }

        /* ─── Header ─── */
        .page-header { display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:28px; }
        .page-eyebrow { font-size:11px; font-weight:600; letter-spacing:.14em; color:var(--gold); margin-bottom:5px; text-transform:uppercase; }
        .page-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:30px; font-weight:800; color:#fff; line-height:1; }
        .btn-export { background:linear-gradient(135deg,var(--gold),var(--gold-l)); color:var(--navy); padding:11px 24px; border-radius:12px; font-size:13px; font-weight:800; cursor:pointer; font-family:'DM Sans',sans-serif; text-decoration:none; transition:all .2s; display:inline-flex; align-items:center; gap:8px; border:none; box-shadow:0 4px 20px var(--gold-glow); }
        .btn-export:hover { transform:translateY(-1px); box-shadow:0 8px 28px var(--gold-glow); }

        /* ─── Filter ─── */
        .filter-bar { display:flex; gap:10px; margin-bottom:26px; flex-wrap:wrap; align-items:center; background:var(--navy-3); border:1px solid var(--border); border-radius:14px; padding:14px 20px; }
        .filter-label { font-size:11px; font-weight:700; color:var(--muted); letter-spacing:.1em; text-transform:uppercase; }
        .filter-input, .filter-select { background:var(--navy-4); border:1px solid var(--border-2); border-radius:9px; padding:8px 13px; font-family:'DM Sans',sans-serif; font-size:13px; color:var(--text); outline:none; transition:border-color .18s,box-shadow .18s; }
        .filter-input:focus, .filter-select:focus { border-color:var(--gold); box-shadow:0 0 0 3px var(--gold-dim); }
        .filter-select { cursor:pointer; }
        .filter-select option { background:#162440; }
        .btn-filter { background:var(--navy-5); border:1px solid var(--border-2); color:var(--text); padding:8px 18px; border-radius:9px; font-size:13px; font-weight:700; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all .18s; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
        .btn-filter:hover { background:var(--gold-dim); border-color:var(--gold); color:var(--gold); }
        .btn-reset { background:transparent; border:1px solid rgba(255,255,255,.08); color:var(--muted); padding:8px 14px; border-radius:9px; font-size:12px; font-weight:600; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all .18s; text-decoration:none; display:inline-flex; align-items:center; gap:5px; }
        .btn-reset:hover { color:var(--red); border-color:var(--red); background:var(--red-dim); }

        /* ─── Summary Cards ─── */
        .summary-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:26px; }
        .summary-card { position:relative; overflow:hidden; cursor:pointer; text-decoration:none; display:block; background:var(--navy-3); border:1px solid var(--border); border-radius:18px; padding:24px 26px 20px; transition:all .28s cubic-bezier(.34,1.2,.64,1); }
        .summary-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:linear-gradient(90deg,transparent,var(--gold),var(--gold-l),transparent); border-radius:18px 18px 0 0; transform:scaleX(0); transform-origin:left; transition:transform .35s cubic-bezier(.34,1.2,.64,1); }
        .summary-card::after { content:''; position:absolute; inset:0; border-radius:18px; background:radial-gradient(ellipse at 30% 0%,rgba(232,176,75,.1) 0%,transparent 65%); opacity:0; transition:opacity .28s; }
        .summary-card:hover { border-color:rgba(232,176,75,.35); transform:translateY(-4px); box-shadow:0 16px 44px rgba(0,0,0,.35),0 0 0 1px rgba(232,176,75,.15); }
        .summary-card:hover::before { transform:scaleX(1); }
        .summary-card:hover::after  { opacity:1; }
        .card-top { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px; position:relative; z-index:1; }
        .card-icon { width:42px; height:42px; border-radius:11px; background:var(--gold-dim); border:1px solid rgba(232,176,75,.2); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .card-icon svg { color:var(--gold); }
        .card-trend { font-size:11px; font-weight:700; color:var(--green); background:var(--green-dim); padding:4px 9px; border-radius:20px; display:flex; align-items:center; gap:3px; }
        .summary-label { font-size:10px; font-weight:700; letter-spacing:.14em; color:var(--muted); margin-bottom:7px; text-transform:uppercase; position:relative; z-index:1; }
        .summary-value { font-family:'Plus Jakarta Sans',sans-serif; font-size:34px; font-weight:800; color:#fff; line-height:1; position:relative; z-index:1; }
        .summary-value.rp { font-size:24px; color:var(--gold); }
        .card-footer { display:flex; align-items:center; gap:5px; margin-top:12px; padding-top:12px; border-top:1px solid var(--border); font-size:11px; color:var(--muted); position:relative; z-index:1; transition:color .2s; }
        .summary-card:hover .card-footer { color:var(--gold); }

        /* ─── Table ─── */
        .table-card { background:var(--navy-3); border:1px solid var(--border); border-radius:16px; overflow:hidden; }
        .table-card-header { display:flex; align-items:center; justify-content:space-between; padding:18px 24px; border-bottom:1px solid var(--border); }
        .table-card-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:15px; font-weight:700; color:#fff; display:flex; align-items:center; gap:10px; }
        .count-pill { background:var(--gold-dim); color:var(--gold); font-family:'DM Sans',sans-serif; font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px; }
        .active-filter-tag { background:rgba(232,176,75,.1); border:1px solid rgba(232,176,75,.25); color:var(--gold); font-size:11px; font-weight:600; padding:3px 10px; border-radius:20px; display:none; align-items:center; gap:5px; cursor:pointer; font-family:'DM Sans',sans-serif; }
        .active-filter-tag.show { display:inline-flex; }
        .active-filter-tag:hover { background:var(--red-dim); border-color:var(--red); color:var(--red); }

        .trx-table { width:100%; border-collapse:collapse; font-size:13px; }
        .trx-table thead th { background:rgba(0,0,0,.18); color:var(--muted); font-size:10px; letter-spacing:.12em; font-weight:700; padding:11px 20px; text-align:left; border-bottom:1px solid var(--border); text-transform:uppercase; white-space:nowrap; }
        .trx-table tbody tr { border-bottom:1px solid rgba(255,255,255,.03); transition:background .12s; cursor:pointer; }
        .trx-table tbody tr:last-child { border-bottom:none; }
        .trx-table tbody tr:hover { background:rgba(232,176,75,.05); }
        .trx-table td { padding:13px 20px; vertical-align:middle; color:var(--muted-2); font-weight:500; }
        .td-nomor { font-family:'Plus Jakarta Sans',sans-serif; font-size:14px; font-weight:700; color:#fff; }
        .td-date { font-weight:600; color:var(--text); font-size:13px; }
        .td-time { font-size:11px; color:var(--muted); margin-top:2px; }
        .td-item { max-width:170px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:var(--muted); font-size:12px; }
        .td-total { color:var(--gold); font-weight:800; font-size:14px; white-space:nowrap; }
        .td-kembalian { white-space:nowrap; }

        /* Badges */
        .badge { display:inline-flex; align-items:center; gap:5px; padding:4px 11px; border-radius:20px; font-size:11px; font-weight:700; white-space:nowrap; }
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

        /* ─── Popup ─── */
        .popup-overlay { display:none; position:fixed; inset:0; background:rgba(8,15,30,.72); z-index:9999; align-items:center; justify-content:center; backdrop-filter:blur(6px); }
        .popup-overlay.show { display:flex; }
        .popup-box { background:var(--navy-3); border:1px solid var(--border-2); border-radius:20px; width:100%; max-width:440px; margin:16px; max-height:86vh; overflow-y:auto; animation:slideUp .22s cubic-bezier(.34,1.4,.64,1) both; }
        @keyframes slideUp { from{opacity:0;transform:translateY(20px) scale(.96)} to{opacity:1;transform:none} }
        .popup-head { display:flex; justify-content:space-between; align-items:center; padding:20px 22px 18px; border-bottom:1px solid var(--border); position:sticky; top:0; background:var(--navy-3); z-index:1; border-radius:20px 20px 0 0; }
        .popup-nomor { font-family:'Plus Jakarta Sans',sans-serif; font-size:16px; font-weight:800; color:#fff; letter-spacing:.02em; }
        .popup-waktu { font-size:12px; color:var(--muted); margin-top:3px; }
        .popup-close { width:30px; height:30px; border-radius:50%; background:rgba(255,255,255,.06); border:1px solid var(--border); color:var(--muted-2); display:flex; align-items:center; justify-content:center; font-size:18px; cursor:pointer; transition:all .15s; line-height:1; flex-shrink:0; }
        .popup-close:hover { background:var(--red-dim); border-color:var(--red); color:var(--red); }
        .popup-body { padding:20px 22px 26px; }
        .popup-chips { display:grid; grid-template-columns:1fr 1fr; gap:8px; margin-bottom:18px; }
        .p-chip { background:var(--navy-4); border:1px solid var(--border); border-radius:10px; padding:10px 14px; }
        .p-chip-label { font-size:10px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px; }
        .p-chip-value { font-size:13px; font-weight:600; color:var(--text); }
        .popup-section { font-size:10px; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:var(--muted); display:flex; align-items:center; gap:10px; margin:16px 0 10px; }
        .popup-section::after { content:''; flex:1; height:1px; background:var(--border); }
        .popup-items { display:flex; flex-direction:column; gap:5px; }
        .popup-item { display:flex; justify-content:space-between; align-items:center; padding:10px 14px; background:var(--navy-4); border:1px solid var(--border); border-radius:10px; gap:12px; transition:border-color .15s; }
        .popup-item:hover { border-color:rgba(232,176,75,.2); }
        .pi-nama { font-size:13px; font-weight:600; color:var(--text); }
        .pi-qty  { font-size:11px; color:var(--muted); margin-top:2px; }
        .pi-sub  { font-size:13px; font-weight:800; color:var(--gold); white-space:nowrap; }
        .popup-pay { display:grid; grid-template-columns:repeat(3,1fr); gap:8px; margin-top:4px; }
        .pp-chip { background:var(--navy-4); border:1px solid var(--border); border-radius:10px; padding:10px 12px; text-align:center; }
        .pp-label { font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--muted); margin-bottom:5px; }
        .pp-value { font-size:12px; font-weight:700; color:var(--text); }
        .popup-total { background:var(--gold-dim); border:1px solid rgba(232,176,75,.22); border-radius:12px; padding:14px 18px; display:flex; justify-content:space-between; align-items:center; margin-top:12px; }
        .pt-label { font-size:11px; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.1em; }
        .pt-value { font-family:'Plus Jakarta Sans',sans-serif; font-size:22px; font-weight:800; color:var(--gold); }
        .popup-catatan { background:var(--navy-4); border:1px solid var(--border); border-radius:10px; padding:11px 14px; font-size:13px; color:var(--muted-2); font-style:italic; }
    </style>
</head>
<body>
<div class="layout">
    @include('admin.partials.sidebar')

    <main class="main">

        {{-- ── Page Header ── --}}
        <div class="page-header">
            <div>
                <div class="page-eyebrow">Laporan</div>
                <div class="page-title">Transaksi</div>
            </div>
            <a href="{{ route('admin.transaksi.export') }}?{{ http_build_query(request()->only('tanggal','metode','status')) }}"
               class="btn-export">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                Export CSV
            </a>
        </div>

        {{-- ── Filter ── --}}
        <form method="GET" action="{{ route('admin.transaksi') }}" class="filter-bar">
            <span class="filter-label">Filter</span>
            <input type="date" name="tanggal" class="filter-input" value="{{ request('tanggal') }}">
            <select name="metode" class="filter-select">
                <option value="semua" {{ request('metode','semua')==='semua' ? 'selected':'' }}>Semua Metode</option>
                <option value="tunai" {{ request('metode')==='tunai'  ? 'selected':'' }}>Tunai</option>
                <option value="qris"  {{ request('metode')==='qris'   ? 'selected':'' }}>QRIS</option>
            </select>
            <select name="status" class="filter-select">
                <option value="semua"   {{ request('status','semua')==='semua'   ? 'selected':'' }}>Semua Status</option>
                <option value="selesai" {{ request('status')==='selesai' ? 'selected':'' }}>Selesai</option>
                <option value="antrian" {{ request('status')==='antrian' ? 'selected':'' }}>Antrian</option>
            </select>
            <button type="submit" class="btn-filter">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                Terapkan
            </button>
            @if(request('tanggal') || (request('metode') && request('metode') !== 'semua') || (request('status') && request('status') !== 'semua'))
                <a href="{{ route('admin.transaksi') }}" class="btn-reset">✕ Reset</a>
            @endif
        </form>

        {{-- ── Summary Cards ── --}}
        @php
            $selesaiCount = $transaksis->whereIn('status', ['selesai', 'arsip'])->count();
            $antriCount   = $transaksis->where('status', 'antrian')->count();
            $totalCount   = $transaksis->count();
        @endphp
        <div class="summary-grid">

            <a href="{{ route('admin.transaksi') }}{{ request('tanggal') ? '?tanggal='.request('tanggal') : '' }}"
               class="summary-card">
                <div class="card-top">
                    <div class="card-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="5" width="20" height="14" rx="2"/>
                            <line x1="2" y1="10" x2="22" y2="10"/>
                        </svg>
                    </div>
                    <div class="card-trend">Semua</div>
                </div>
                <div class="summary-label">Total Transaksi</div>
                <div class="summary-value">{{ $totalCount }}</div>
                <div class="card-footer">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    Klik untuk lihat semua
                </div>
            </a>

            <a href="{{ route('admin.transaksi') }}?status=selesai{{ request('tanggal') ? '&tanggal='.request('tanggal') : '' }}{{ request('metode') && request('metode') !== 'semua' ? '&metode='.request('metode') : '' }}"
               class="summary-card">
                <div class="card-top">
                    <div class="card-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23"/>
                            <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
                        </svg>
                    </div>
                    <div class="card-trend">{{ $selesaiCount }} selesai</div>
                </div>
                <div class="summary-label">Total Pendapatan</div>
                <div class="summary-value rp">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                <div class="card-footer">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Klik untuk filter selesai
                </div>
            </a>

            <a href="{{ route('admin.transaksi') }}?status=antrian{{ request('tanggal') ? '&tanggal='.request('tanggal') : '' }}{{ request('metode') && request('metode') !== 'semua' ? '&metode='.request('metode') : '' }}"
               class="summary-card">
                <div class="card-top">
                    <div class="card-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div class="card-trend" style="background:var(--yellow-dim);color:var(--yellow)">{{ $antriCount }} antrian</div>
                </div>
                <div class="summary-label">Rata-rata Transaksi</div>
                <div class="summary-value rp">
                    Rp {{ $totalCount > 0 ? number_format($totalPendapatan / $totalCount, 0, ',', '.') : '0' }}
                </div>
                <div class="card-footer">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    Klik untuk filter antrian
                </div>
            </a>

        </div>

        {{-- ── Table ── --}}
        <div class="table-card">
            <div class="table-card-header">
                <div class="table-card-title">
                    Riwayat Transaksi
                    <span class="count-pill">{{ $totalCount }} data</span>
                    @if(request('status') && request('status') !== 'semua')
                        <span class="active-filter-tag show"
                              onclick="window.location='{{ route('admin.transaksi') }}'">
                            {{ ucfirst(request('status')) }} ✕
                        </span>
                    @endif
                </div>
            </div>
            <table class="trx-table" id="trxTable">
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
                    @php
                        $rawItems = $trx->items;
                        if (is_string($rawItems)) $rawItems = json_decode($rawItems, true);
                        if (is_string($rawItems)) $rawItems = json_decode($rawItems, true);
                        if (!is_array($rawItems)) $rawItems = [];
                        $namaItems = collect($rawItems)->pluck('nama')->filter()->join(', ');
                    @endphp
                    <tr data-trxid="{{ (string) $trx->id }}" style="cursor:pointer">
                        <td class="td-nomor">{{ $trx->nomor }}</td>
                        <td>
                            <div class="td-date">{{ $trx->created_at->format('d/m/Y') }}</div>
                            <div class="td-time">{{ $trx->created_at->format('H:i') }}</div>
                        </td>
                        <td class="td-item" title="{{ $namaItems }}">
                            {{ Str::limit($namaItems ?: '—', 35) }}
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
                        <td class="td-kembalian">Rp {{ number_format($trx->kembalian ?? 0, 0, ',', '.') }}</td>
                        <td>
                            @if($trx->status === 'selesai' || $trx->status === 'arsip')
                                <span class="badge badge-selesai">Selesai</span>
                            @else
                                <span class="badge badge-antrian">Antrian</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-icon">📭</div>
                                <div class="empty-text">Tidak ada transaksi</div>
                                <div class="empty-sub">Coba ubah filter atau reset pencarian</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>
</div>

{{-- ── Popup Detail ── --}}
<div class="popup-overlay" id="popupDetail">
    <div class="popup-box">
        <div class="popup-head">
            <div>
                <div class="popup-nomor" id="popNomor">—</div>
                <div class="popup-waktu" id="popWaktu">—</div>
            </div>
            <button class="popup-close" id="btnTutup" aria-label="Tutup">×</button>
        </div>
        <div class="popup-body" id="popBody">
            <div style="text-align:center;padding:40px;color:var(--muted)">Memuat…</div>
        </div>
    </div>
</div>

<script id="trxData" type="application/json">
{!! json_encode(
    $transaksis->mapWithKeys(function($trx) {
        $raw = $trx->items;
        if (is_string($raw)) $raw = json_decode($raw, true);
        if (is_string($raw)) $raw = json_decode($raw, true);
        if (!is_array($raw)) $raw = [];

        $items = collect($raw)->map(function($i) {
            return [
                'nama'     => (string)($i['nama']  ?? ''),
                'qty'      => (int)   ($i['qty']   ?? 1),
                'harga'    => (int)   ($i['harga'] ?? 0),
                'subtotal' => (int)($i['harga'] ?? 0) * (int)($i['qty'] ?? 1),
            ];
        })->values()->toArray();

        $statusLabel = in_array($trx->status, ['selesai', 'arsip']) ? 'Selesai' : ucfirst($trx->status);

        return [(string)$trx->id => [
            'nomor'     => (string)$trx->nomor,
            'waktu'     => $trx->created_at->format('d/m/Y'),
            'jam'       => $trx->created_at->format('H:i'),
            'tipe'      => $trx->tipe === 'dine_in' ? 'Dine In' : 'Take Away',
            'metode'    => ucfirst($trx->metode),
            'total'     => (int)$trx->total,
            'uang'      => (int)($trx->uang      ?? 0),
            'kembalian' => (int)($trx->kembalian ?? 0),
            'status'    => $statusLabel,
            'catatan'   => (string)($trx->catatan ?? ''),
            'items'     => $items,
        ]];
    }),
    JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP
) !!}
</script>

<script>
var TRX = {};
try {
    TRX = JSON.parse(document.getElementById('trxData').textContent.trim());
} catch(e) {
    console.error('Gagal parse TRX:', e);
}

function rp(n) {
    return 'Rp ' + parseInt(n || 0).toLocaleString('id-ID');
}
function esc(str) {
    var d = document.createElement('div');
    d.appendChild(document.createTextNode(String(str || '')));
    return d.innerHTML;
}

function bukaPopup(id) {
    var t = TRX[String(id)];
    if (!t) return;

    document.getElementById('popNomor').textContent = t.nomor;
    document.getElementById('popWaktu').textContent = t.waktu + ' · ' + t.jam;

    var tipeCls   = t.tipe === 'Dine In' ? 'badge badge-dinein' : 'badge badge-takeaway';
    var statusCls = t.status.toLowerCase() === 'selesai' ? 'badge badge-selesai' : 'badge badge-antrian';
    var metodeCls = t.metode.toLowerCase() === 'tunai'   ? 'badge badge-tunai'   : 'badge badge-qris';

    var html = '<div class="popup-chips">'
        + '<div class="p-chip"><div class="p-chip-label">Tipe</div>'
        + '<div class="p-chip-value"><span class="' + tipeCls + '">' + esc(t.tipe) + '</span></div></div>'
        + '<div class="p-chip"><div class="p-chip-label">Status</div>'
        + '<div class="p-chip-value"><span class="' + statusCls + '">' + esc(t.status) + '</span></div></div>'
        + '</div>';

    if (t.catatan && t.catatan.trim()) {
        html += '<div class="popup-section">Catatan</div>'
              + '<div class="popup-catatan">' + esc(t.catatan) + '</div>';
    }

    html += '<div class="popup-section">Item Pesanan</div><div class="popup-items">';
    if (t.items && t.items.length) {
        t.items.forEach(function(i) {
            html += '<div class="popup-item">'
                  + '<div><div class="pi-nama">' + esc(i.nama) + '</div>'
                  + '<div class="pi-qty">× ' + i.qty + ' &nbsp;·&nbsp; ' + rp(i.harga) + '</div></div>'
                  + '<div class="pi-sub">' + rp(i.subtotal) + '</div>'
                  + '</div>';
        });
    } else {
        html += '<div style="color:var(--muted);font-size:13px;padding:14px;text-align:center">Tidak ada item tercatat</div>';
    }
    html += '</div>';

    html += '<div class="popup-section">Pembayaran</div>'
          + '<div class="popup-pay">'
          + '<div class="pp-chip"><div class="pp-label">Metode</div>'
          + '<div class="pp-value"><span class="' + metodeCls + '">' + esc(t.metode) + '</span></div></div>'
          + '<div class="pp-chip"><div class="pp-label">Dibayar</div>'
          + '<div class="pp-value">' + rp(t.uang) + '</div></div>'
          + '<div class="pp-chip"><div class="pp-label">Kembalian</div>'
          + '<div class="pp-value">' + rp(t.kembalian) + '</div></div>'
          + '</div>';

    html += '<div class="popup-total">'
          + '<div class="pt-label">Total</div>'
          + '<div class="pt-value">' + rp(t.total) + '</div>'
          + '</div>';

    document.getElementById('popBody').innerHTML = html;
    document.getElementById('popupDetail').classList.add('show');
}

function tutupPopup() {
    document.getElementById('popupDetail').classList.remove('show');
}

document.addEventListener('DOMContentLoaded', function () {
    var tbody = document.querySelector('#trxTable tbody');
    if (tbody) {
        tbody.addEventListener('click', function (e) {
            var row = e.target.closest('tr[data-trxid]');
            if (row) bukaPopup(row.getAttribute('data-trxid'));
        });
    }
    document.getElementById('btnTutup').addEventListener('click', tutupPopup);
    document.getElementById('popupDetail').addEventListener('click', function (e) {
        if (e.target === this) tutupPopup();
    });
});

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') tutupPopup();
});
</script>
</body>
</html>