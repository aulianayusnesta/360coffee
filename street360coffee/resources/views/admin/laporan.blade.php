{{-- resources/views/admin/laporan.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan — Street 360 Coffee</title>
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
            --blue:       #60a5fa;
            --red:        #f87171;
        }
        html, body { height:100%; font-family:'DM Sans',sans-serif; background:var(--navy); color:var(--text); overflow:hidden; }
        .layout { display:flex; height:100vh; }
        ::-webkit-scrollbar { width:4px; height:4px; }
        ::-webkit-scrollbar-track { background:transparent; }
        ::-webkit-scrollbar-thumb { background:var(--navy-5); border-radius:4px; }

        /* ── Sidebar ── */
        .sidebar { width:256px; min-width:256px; background:var(--navy-2); display:flex; flex-direction:column; border-right:1px solid var(--border); overflow-y:auto; position:relative; }
        .sidebar::after { content:''; position:absolute; top:0; right:0; bottom:0; width:1px; background:linear-gradient(180deg,transparent,rgba(232,176,75,.18) 40%,transparent); pointer-events:none; }
        .sidebar-brand { padding:24px 20px 18px; border-bottom:1px solid var(--border); }
        .brand-name { font-family:'Plus Jakarta Sans',sans-serif; font-size:20px; font-weight:800; color:#fff; letter-spacing:.06em; text-transform:uppercase; }
        .brand-name span { color:var(--gold); }
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
        .main { flex:1; overflow-y:auto; padding:32px 36px; background:var(--navy); }

        /* ── Page Header ── */
        .page-header { margin-bottom:28px; }
        .page-eyebrow { font-size:11px; font-weight:600; letter-spacing:.14em; color:var(--gold); margin-bottom:5px; text-transform:uppercase; }
        .page-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:30px; font-weight:800; color:#fff; line-height:1; }
        .page-date { display:flex; align-items:center; gap:10px; margin-top:10px; flex-wrap:wrap; }
        .page-date-chip { background:var(--navy-3); border:1px solid rgba(232,176,75,.3); border-radius:9px; padding:6px 14px; font-size:12px; font-weight:700; color:var(--gold); display:inline-flex; align-items:center; gap:7px; }
        .page-date-time { font-size:12px; color:var(--muted); font-weight:500; }

        /* ── Filter ── */
        .filter-section { background:var(--navy-3); border:1px solid var(--border); border-radius:14px; padding:16px 20px; margin-bottom:26px; }
        .filter-top { display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
        .filter-label { font-size:10px; font-weight:700; letter-spacing:.14em; color:var(--muted); text-transform:uppercase; margin-right:4px; }
        .periode-btn { padding:8px 18px; border-radius:9px; border:1px solid var(--border-2); font-family:'DM Sans',sans-serif; font-size:12px; font-weight:700; cursor:pointer; background:transparent; color:var(--muted); transition:all .18s; text-decoration:none; letter-spacing:.04em; }
        .periode-btn.active { background:var(--gold-dim); color:var(--gold); border-color:rgba(232,176,75,.35); }
        .periode-btn:hover:not(.active) { background:rgba(255,255,255,.05); color:var(--text); }
        .filter-divider { width:1px; height:24px; background:var(--border-2); }
        .filter-input { background:var(--navy-4); border:1px solid var(--border-2); border-radius:9px; padding:8px 13px; font-family:'DM Sans',sans-serif; font-size:13px; color:var(--text); outline:none; transition:border-color .18s; }
        .filter-input:focus { border-color:var(--gold); box-shadow:0 0 0 3px var(--gold-dim); }
        .btn-tampil { background:linear-gradient(135deg,var(--gold),var(--gold-l)); color:var(--navy); padding:8px 20px; border-radius:9px; font-size:12px; font-weight:800; cursor:pointer; font-family:'DM Sans',sans-serif; border:none; transition:all .2s; display:inline-flex; align-items:center; gap:6px; }
        .btn-tampil:hover { transform:translateY(-1px); box-shadow:0 6px 20px var(--gold-glow); }
        .periode-badge { display:inline-flex; align-items:center; gap:8px; background:var(--navy-4); border:1px solid var(--border-2); border-radius:9px; padding:8px 14px; font-size:12px; color:var(--muted-2); font-weight:600; margin-top:12px; flex-wrap:wrap; }
        .periode-badge strong { color:var(--gold); }

        /* ── Summary Cards ── */
        .summary-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:26px; }
        .summary-card { position:relative; overflow:hidden; cursor:pointer; background:var(--navy-3); border:1px solid var(--border); border-radius:18px; padding:22px 22px 18px; transition:all .28s cubic-bezier(.34,1.2,.64,1); display:block; border:none; width:100%; text-align:left; font-family:'DM Sans',sans-serif; }
        .summary-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:linear-gradient(90deg,transparent,var(--gold),var(--gold-l),transparent); border-radius:18px 18px 0 0; transform:scaleX(0); transform-origin:left; transition:transform .35s cubic-bezier(.34,1.2,.64,1); }
        .summary-card::after { content:''; position:absolute; inset:0; border-radius:18px; background:radial-gradient(ellipse at 30% 0%,rgba(232,176,75,.1) 0%,transparent 65%); opacity:0; transition:opacity .28s; }
        .summary-card:hover { border-color:rgba(232,176,75,.35); transform:translateY(-4px); box-shadow:0 16px 44px rgba(0,0,0,.35),0 0 0 1px rgba(232,176,75,.15); }
        .summary-card:hover::before { transform:scaleX(1); }
        .summary-card:hover::after  { opacity:1; }
        .card-icon-wrap { width:38px; height:38px; border-radius:10px; background:var(--gold-dim); border:1px solid rgba(232,176,75,.2); display:flex; align-items:center; justify-content:center; margin-bottom:14px; position:relative; z-index:1; }
        .card-icon-wrap svg { color:var(--gold); }
        .summary-label { font-size:10px; font-weight:700; letter-spacing:.14em; color:var(--muted); margin-bottom:6px; text-transform:uppercase; position:relative; z-index:1; }
        .summary-value { font-family:'Plus Jakarta Sans',sans-serif; font-size:28px; font-weight:800; color:#fff; line-height:1.1; position:relative; z-index:1; }
        .summary-value.rp { font-size:20px; color:var(--gold); }
        .summary-value.nm { font-size:15px; color:#fff; }
        .card-hint { display:flex; align-items:center; gap:5px; margin-top:10px; padding-top:10px; border-top:1px solid var(--border); font-size:11px; color:var(--muted); position:relative; z-index:1; transition:color .2s; }
        .summary-card:hover .card-hint { color:var(--gold); }

        /* ── Tabs ── */
        .tab-row { display:flex; align-items:center; gap:6px; margin-bottom:16px; }
        .tab-btn { padding:8px 18px; border-radius:9px; border:1px solid var(--border-2); font-family:'DM Sans',sans-serif; font-size:12px; font-weight:700; cursor:pointer; background:transparent; color:var(--muted); transition:all .18s; }
        .tab-btn.active { background:var(--gold-dim); color:var(--gold); border-color:rgba(232,176,75,.35); }
        .tab-btn:hover:not(.active) { background:rgba(255,255,255,.05); color:var(--text); }
        .tab-content { display:none; }
        .tab-content.show { display:block; }

        /* ── Table shared ── */
        .table-card { background:var(--navy-3); border:1px solid var(--border); border-radius:16px; overflow:hidden; }
        .table-card-header { display:flex; align-items:center; justify-content:space-between; padding:18px 24px; border-bottom:1px solid var(--border); }
        .table-card-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:15px; font-weight:700; color:#fff; display:flex; align-items:center; gap:10px; }
        .count-pill { background:var(--gold-dim); color:var(--gold); font-family:'DM Sans',sans-serif; font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px; }

        /* ── Tabel Menu ── */
        .lap-table { width:100%; border-collapse:collapse; font-size:13px; }
        .lap-table thead th { background:rgba(0,0,0,.18); color:var(--muted); font-size:10px; letter-spacing:.12em; font-weight:700; padding:11px 20px; text-align:left; border-bottom:1px solid var(--border); text-transform:uppercase; white-space:nowrap; }
        .lap-table tbody tr { border-bottom:1px solid rgba(255,255,255,.03); transition:background .12s; }
        .lap-table tbody tr:last-child { border-bottom:none; }
        .lap-table tbody tr:hover { background:rgba(232,176,75,.04); }
        .lap-table td { padding:14px 20px; vertical-align:middle; color:var(--muted-2); font-weight:500; }
        .rank-badge { display:inline-flex; align-items:center; justify-content:center; width:30px; height:30px; border-radius:8px; font-family:'Plus Jakarta Sans',sans-serif; font-size:14px; font-weight:800; }
        .rank-1 { background:linear-gradient(135deg,#f5cc7a,#e8b04b); color:var(--navy); }
        .rank-2 { background:rgba(192,192,210,.15); color:#c0c0d2; border:1px solid rgba(192,192,210,.2); }
        .rank-3 { background:rgba(205,127,50,.15); color:#cd7f32; border:1px solid rgba(205,127,50,.2); }
        .rank-other { background:var(--navy-4); color:var(--muted); border:1px solid var(--border); font-size:12px; }
        .menu-name-td { font-weight:700; color:#fff; font-size:14px; }
        .terjual-val { font-size:14px; font-weight:700; color:var(--text); }
        .terjual-sub { font-size:11px; color:var(--muted); margin-top:1px; }
        .pendapatan-val { color:var(--gold); font-weight:800; font-size:14px; }
        .td-tgl { font-size:13px; font-weight:700; color:var(--text); }
        .td-jam { font-size:12px; color:var(--muted); margin-top:2px; }

        /* ── Tabel Transaksi ── */
        .trx-table { width:100%; border-collapse:collapse; font-size:13px; }
        .trx-table thead th { background:rgba(0,0,0,.18); color:var(--muted); font-size:10px; letter-spacing:.12em; font-weight:700; padding:11px 20px; text-align:left; border-bottom:1px solid var(--border); text-transform:uppercase; white-space:nowrap; }
        .trx-table tbody tr { border-bottom:1px solid rgba(255,255,255,.03); transition:background .12s; }
        .trx-table tbody tr:last-child { border-bottom:none; }
        .trx-table tbody tr:hover { background:rgba(232,176,75,.04); }
        .trx-table td { padding:12px 20px; vertical-align:middle; }
        .trx-nomor { font-family:'Plus Jakarta Sans',sans-serif; font-size:14px; font-weight:800; color:#fff; }
        .trx-tipe { display:inline-flex; align-items:center; gap:5px; padding:4px 10px; border-radius:20px; font-size:11px; font-weight:700; }
        .trx-tipe-dine  { background:rgba(232,176,75,.12); color:var(--gold); border:1px solid rgba(232,176,75,.2); }
        .trx-tipe-take  { background:rgba(255,255,255,.05); color:var(--muted-2); border:1px solid var(--border-2); }
        .trx-total-td { font-size:14px; font-weight:800; color:var(--gold); }
        .trx-metode { display:inline-flex; align-items:center; gap:5px; padding:4px 10px; border-radius:20px; font-size:11px; font-weight:700; }
        .trx-metode-qris  { background:rgba(96,165,250,.12); color:var(--blue); border:1px solid rgba(96,165,250,.2); }
        .trx-metode-tunai { background:rgba(74,222,128,.12); color:var(--green); border:1px solid rgba(74,222,128,.2); }
        .trx-items-col { font-size:12px; color:var(--muted-2); max-width:180px; }
        .trx-status { display:inline-flex; align-items:center; gap:4px; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:700; }
        .trx-status::before { content:''; width:5px; height:5px; border-radius:50%; }
        .trx-status-selesai { background:rgba(74,222,128,.11); color:#4ade80; } .trx-status-selesai::before { background:#4ade80; }
        .trx-status-antrian { background:rgba(251,191,36,.11); color:#fbbf24; } .trx-status-antrian::before { background:#fbbf24; }
        .trx-status-arsip   { background:rgba(255,255,255,.06); color:var(--muted); } .trx-status-arsip::before { background:var(--muted); }

        .empty-state { text-align:center; padding:64px; color:var(--muted); font-size:14px; }

        /* ── Popup ── */
        .popup-overlay { display:none; position:fixed; inset:0; background:rgba(8,15,30,.72); z-index:9999; align-items:center; justify-content:center; backdrop-filter:blur(6px); }
        .popup-overlay.show { display:flex; }
        .popup-box { background:var(--navy-3); border:1px solid var(--border-2); border-radius:20px; width:100%; max-width:440px; margin:16px; max-height:86vh; overflow-y:auto; animation:slideUp .22s cubic-bezier(.34,1.4,.64,1) both; }
        @keyframes slideUp { from{opacity:0;transform:translateY(20px) scale(.96)} to{opacity:1;transform:none} }
        .popup-head { display:flex; justify-content:space-between; align-items:center; padding:20px 22px 18px; border-bottom:1px solid var(--border); position:sticky; top:0; background:var(--navy-3); z-index:1; border-radius:20px 20px 0 0; }
        .popup-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:16px; font-weight:800; color:#fff; }
        .popup-meta  { font-size:12px; color:var(--muted); margin-top:3px; }
        .popup-close { width:30px; height:30px; border-radius:50%; background:rgba(255,255,255,.06); border:1px solid var(--border); color:var(--muted-2); display:flex; align-items:center; justify-content:center; font-size:18px; cursor:pointer; transition:all .15s; flex-shrink:0; line-height:1; }
        .popup-close:hover { background:rgba(248,113,113,.15); border-color:var(--red); color:var(--red); }
        .popup-body { padding:20px 22px 26px; }
        .p-chips { display:grid; grid-template-columns:1fr 1fr; gap:8px; margin-bottom:0; }
        .p-chip { background:var(--navy-4); border:1px solid var(--border); border-radius:10px; padding:10px 14px; }
        .p-chip-label { font-size:10px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px; }
        .p-chip-value { font-size:13px; font-weight:700; color:var(--text); }
        .p-chip-value.gold { color:var(--gold); font-size:16px; font-family:'Plus Jakarta Sans',sans-serif; font-weight:800; }
        .p-section { font-size:10px; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:var(--muted); display:flex; align-items:center; gap:10px; margin:16px 0 10px; }
        .p-section::after { content:''; flex:1; height:1px; background:var(--border); }
        .p-menu-list { display:flex; flex-direction:column; gap:5px; }
        .p-menu-row { display:flex; justify-content:space-between; align-items:center; padding:10px 14px; background:var(--navy-4); border:1px solid var(--border); border-radius:10px; gap:8px; }
        .p-menu-name { font-size:13px; font-weight:600; color:var(--text); }
        .p-menu-qty  { font-size:11px; color:var(--muted); margin-top:2px; }
        .p-menu-val  { font-size:13px; font-weight:800; color:var(--gold); white-space:nowrap; }
    </style>
</head>
<body>
<div class="layout">
    @include('admin.partials.sidebar')

    <main class="main">

        @php
            $namaBulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            $namaHari  = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];

            if ($periode === 'hari') {
                $tgl = \Carbon\Carbon::parse(request('tanggal', now()->toDateString()));
                $labelTanggal = $namaHari[$tgl->dayOfWeek] . ', ' . $tgl->format('d') . ' ' . $namaBulan[(int)$tgl->format('m')] . ' ' . $tgl->format('Y');
                $labelWaktu   = 'Laporan harian · ' . now()->format('d/m/Y H:i') . ' WIB';
            } elseif ($periode === 'bulan') {
                $blnObj = \Carbon\Carbon::createFromFormat('Y-m', request('bulan', now()->format('Y-m')));
                $labelTanggal = $namaBulan[(int)$blnObj->format('m')] . ' ' . $blnObj->format('Y');
                $labelWaktu   = 'Laporan bulanan · dibuat ' . now()->format('d/m/Y H:i') . ' WIB';
            } else {
                $labelTanggal = 'Tahun ' . request('tahun', now()->year);
                $labelWaktu   = 'Laporan tahunan · dibuat ' . now()->format('d/m/Y H:i') . ' WIB';
            }

            $menusJson = $penjualanPerMenu->map(function($m) {
                return [
                    'nama'       => $m->nama_menu,
                    'qty'        => $m->total_terjual,
                    'pendapatan' => number_format($m->total_pendapatan, 0, ',', '.'),
                ];
            })->values();
        @endphp

        {{-- Page Header --}}
        <div class="page-header">
            <div class="page-eyebrow">Analitik</div>
            <div class="page-title">Laporan Penjualan</div>
            <div class="page-date">
                <span class="page-date-chip">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    {{ $labelTanggal }}
                </span>
                <span class="page-date-time">{{ $labelWaktu }}</span>
            </div>
        </div>

        {{-- Filter --}}
        <div class="filter-section">
            <form method="GET" action="{{ route('admin.laporan') }}">
                <div class="filter-top">
                    <span class="filter-label">Periode</span>
                    <a href="{{ route('admin.laporan', ['periode'=>'hari','tanggal'=>now()->toDateString()]) }}"
                       class="periode-btn {{ $periode==='hari' ? 'active':'' }}">Hari Ini</a>
                    <a href="{{ route('admin.laporan', ['periode'=>'bulan','bulan'=>now()->format('Y-m')]) }}"
                       class="periode-btn {{ $periode==='bulan' ? 'active':'' }}">Bulan Ini</a>
                    <a href="{{ route('admin.laporan', ['periode'=>'tahun','tahun'=>now()->year]) }}"
                       class="periode-btn {{ $periode==='tahun' ? 'active':'' }}">Tahun Ini</a>
                    <div class="filter-divider"></div>

                    @if($periode==='hari')
                        <input type="hidden" name="periode" value="hari">
                        <input type="date"   name="tanggal" class="filter-input" value="{{ request('tanggal', now()->toDateString()) }}">
                    @elseif($periode==='bulan')
                        <input type="hidden" name="periode" value="bulan">
                        <input type="month"  name="bulan"   class="filter-input" value="{{ request('bulan', now()->format('Y-m')) }}">
                    @else
                        <input type="hidden" name="periode"  value="tahun">
                        <input type="number" name="tahun"    class="filter-input" style="width:110px"
                               value="{{ request('tahun', now()->year) }}" min="2020" max="{{ now()->year }}">
                    @endif

                    <button type="submit" class="btn-tampil">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        Tampilkan
                    </button>
                </div>
                <div class="periode-badge">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Menampilkan data untuk: <strong>{{ $labelTanggal }}</strong>
                    &nbsp;·&nbsp; <strong>{{ $totalTransaksi }}</strong> transaksi tercatat
                    &nbsp;·&nbsp; {{ now()->format('H:i') }} WIB
                </div>
            </form>
        </div>

        {{-- Summary Cards --}}
        <div class="summary-grid">

            <button class="summary-card" onclick="bukaPopup('pendapatan')">
                <div class="card-icon-wrap">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                </div>
                <div class="summary-label">Total Pendapatan</div>
                <div class="summary-value rp">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                <div class="card-hint">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Semua transaksi · klik detail
                </div>
            </button>

            <button class="summary-card" onclick="bukaPopup('rata')">
                <div class="card-icon-wrap">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                </div>
                <div class="summary-label">Rata-rata / Transaksi</div>
                <div class="summary-value rp">Rp {{ number_format($rataRata, 0, ',', '.') }}</div>
                <div class="card-hint">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Per transaksi · klik detail
                </div>
            </button>

            <button class="summary-card" onclick="bukaPopup('terlaris')">
                <div class="card-icon-wrap">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <div class="summary-label">Menu Terlaris</div>
                <div class="summary-value nm">{{ $menuTerlaris ? $menuTerlaris->nama_menu : '-' }}</div>
                <div class="card-hint">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    {{ $menuTerlaris ? $menuTerlaris->total_terjual.' cup terjual' : 'Belum ada data' }} · klik detail
                </div>
            </button>

            <button class="summary-card" onclick="bukaPopup('transaksi')">
                <div class="card-icon-wrap">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                </div>
                <div class="summary-label">Total Transaksi</div>
                <div class="summary-value">{{ $totalTransaksi }}</div>
                <div class="card-hint">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Semua status · klik detail
                </div>
            </button>

        </div>

        {{-- Tab --}}
        <div class="tab-row">
            <button class="tab-btn active" onclick="switchTab('menu', this)">Penjualan Per Menu</button>
            <button class="tab-btn"        onclick="switchTab('waktu', this)">Riwayat Transaksi &amp; Waktu</button>
        </div>

        {{-- Tab 1: Per Menu --}}
        <div class="tab-content show" id="tab-menu">
            <div class="table-card">
                <div class="table-card-header">
                    <div class="table-card-title">
                        Penjualan Per Menu
                        <span class="count-pill">{{ count($penjualanPerMenu) }} menu</span>
                    </div>
                    <span style="font-size:11px;color:var(--muted);">{{ $labelTanggal }}</span>
                </div>
                <table class="lap-table">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Menu</th>
                            <th>Terjual</th>
                            <th>Pertama Dipesan</th>
                            <th>Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penjualanPerMenu as $i => $item)
                        @php
                            $rank    = $i + 1;
                            $pertama = $item->pertama_terjual ? \Carbon\Carbon::parse($item->pertama_terjual) : null;
                        @endphp
                        <tr>
                            <td>
                                <span class="rank-badge {{ $rank===1?'rank-1':($rank===2?'rank-2':($rank===3?'rank-3':'rank-other')) }}">
                                    {{ $rank <= 3 ? ['🥇','🥈','🥉'][$rank-1] : $rank }}
                                </span>
                            </td>
                            <td class="menu-name-td">{{ $item->nama_menu }}</td>
                            <td>
                                <div class="terjual-val">{{ $item->total_terjual }}</div>
                                <div class="terjual-sub">cup terjual</div>
                            </td>
                            <td>
                                @if($pertama)
                                    <div class="td-tgl">{{ $pertama->format('d/m/Y') }}</div>
                                    <div class="td-jam">{{ $pertama->format('H:i') }}</div>
                                @else
                                    <span style="color:var(--muted);font-size:12px;">—</span>
                                @endif
                            </td>
                            <td class="pendapatan-val">Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="empty-state">Belum ada data penjualan untuk periode ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tab 2: Riwayat Transaksi --}}
        <div class="tab-content" id="tab-waktu">
            <div class="table-card">
                <div class="table-card-header">
                    <div class="table-card-title">
                        Riwayat Transaksi
                        <span class="count-pill">{{ $transaksiDenganWaktu->count() }} transaksi</span>
                    </div>
                    <span style="font-size:11px;color:var(--muted);">{{ $labelTanggal }}</span>
                </div>
                <table class="trx-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal / Waktu</th>
                            <th>Item</th>
                            <th>Tipe</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksiDenganWaktu as $trx)
                        <tr>
                            <td class="trx-nomor">#{{ str_pad($trx->nomor, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="td-tgl">{{ $trx->created_at->format('d/m/Y') }}</div>
                                <div class="td-jam">{{ $trx->created_at->format('H:i') }}</div>
                            </td>
                            <td class="trx-items-col">{{ $trx->getNamaItems() }}</td>
                            <td>
                                <span class="trx-tipe {{ $trx->tipe === 'dine_in' ? 'trx-tipe-dine' : 'trx-tipe-take' }}">
                                    {{ $trx->tipe === 'dine_in' ? 'Dine In' : 'Take Away' }}
                                </span>
                            </td>
                            <td>
                                <span class="trx-metode {{ $trx->metode === 'qris' ? 'trx-metode-qris' : 'trx-metode-tunai' }}">
                                    {{ strtoupper($trx->metode) }}
                                </span>
                            </td>
                            <td>
                                @php $st = $trx->status === 'arsip' ? 'selesai' : $trx->status; @endphp
                                <span class="trx-status trx-status-{{ $st }}">{{ ucfirst($st) }}</span>
                            </td>
                            <td class="trx-total-td">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="empty-state">Belum ada data transaksi untuk periode ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

{{-- Popup --}}
<div class="popup-overlay" id="popupOverlay">
    <div class="popup-box">
        <div class="popup-head">
            <div>
                <div class="popup-title" id="popTitle">—</div>
                <div class="popup-meta"  id="popMeta">—</div>
            </div>
            <button class="popup-close" id="btnTutup">×</button>
        </div>
        <div class="popup-body" id="popBody"></div>
    </div>
</div>

<script>
var DATA = {
    periodeLabel:    @json($labelTanggal),
    totalPendapatan: "Rp {{ number_format($totalPendapatan, 0, ',', '.') }}",
    rataRata:        "Rp {{ number_format($rataRata, 0, ',', '.') }}",
    totalTransaksi:  "{{ $totalTransaksi }}",
    menuTerlaris:    @json($menuTerlaris ? $menuTerlaris->nama_menu : '-'),
    menus:           @json($menusJson)
};

function switchTab(id, btn) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('show'));
    document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
    document.getElementById('tab-' + id).classList.add('show');
    btn.classList.add('active');
}

function chips(arr) {
    return '<div class="p-chips">' + arr.map(function(c) {
        return '<div class="p-chip"><div class="p-chip-label">' + c[0] + '</div>'
             + '<div class="p-chip-value' + (c[2] ? ' ' + c[2] : '') + '">' + c[1] + '</div></div>';
    }).join('') + '</div>';
}

function bukaPopup(id) {
    var title, meta, body = '';

    if (id === 'pendapatan') {
        title = 'Total Pendapatan';
        meta  = DATA.periodeLabel;
        body  = chips([
            ['Total Pendapatan', DATA.totalPendapatan, 'gold'],
            ['Total Transaksi',  DATA.totalTransaksi + ' transaksi', ''],
            ['Rata-rata / Trx',  DATA.rataRata, 'gold'],
            ['Menu Terlaris',    DATA.menuTerlaris, ''],
        ]);

    } else if (id === 'rata') {
        title = 'Rata-rata per Transaksi';
        meta  = DATA.periodeLabel;
        body  = chips([
            ['Rata-rata',        DATA.rataRata, 'gold'],
            ['Total Transaksi',  DATA.totalTransaksi + ' transaksi', ''],
            ['Total Pendapatan', DATA.totalPendapatan, 'gold'],
            ['Periode',          DATA.periodeLabel, ''],
        ]);

    } else if (id === 'terlaris') {
        title = 'Menu Terlaris';
        meta  = DATA.periodeLabel + ' · ' + DATA.menus.length + ' menu';
        var medals = ['🥇','🥈','🥉'];
        body = '<div class="p-section">Semua Menu</div><div class="p-menu-list">';
        if (DATA.menus.length) {
            DATA.menus.forEach(function(m, i) {
                var prefix = i < 3 ? medals[i] + ' ' : (i + 1) + '. ';
                body += '<div class="p-menu-row">'
                      + '<div><div class="p-menu-name">' + prefix + m.nama + '</div>'
                      + '<div class="p-menu-qty">' + m.qty + ' cup terjual</div></div>'
                      + '<div class="p-menu-val">Rp ' + m.pendapatan + '</div></div>';
            });
        } else {
            body += '<div style="color:var(--muted);font-size:13px;padding:14px;text-align:center">Belum ada data menu.</div>';
        }
        body += '</div>';

    } else if (id === 'transaksi') {
        title = 'Total Transaksi';
        meta  = DATA.periodeLabel;
        body  = chips([
            ['Jumlah Transaksi', DATA.totalTransaksi + ' transaksi', ''],
            ['Total Pendapatan', DATA.totalPendapatan, 'gold'],
            ['Rata-rata / Trx',  DATA.rataRata, 'gold'],
            ['Menu Terlaris',    DATA.menuTerlaris, ''],
        ]);
    }

    document.getElementById('popTitle').textContent = title;
    document.getElementById('popMeta').textContent  = meta;
    document.getElementById('popBody').innerHTML    = body;
    document.getElementById('popupOverlay').classList.add('show');
}

function tutupPopup() {
    document.getElementById('popupOverlay').classList.remove('show');
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('btnTutup').addEventListener('click', tutupPopup);
    document.getElementById('popupOverlay').addEventListener('click', function(e) {
        if (e.target === this) tutupPopup();
    });
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') tutupPopup();
});
</script>
</body>
</html>