{{-- resources/views/kasir/antrian.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian Pesanan — Street 360 Coffee</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --navy:      #1a2d52;
            --navy-deep: #0f1d3a;
            --navy-mid:  #152445;
            --navy-card: #162040;
            --gold-btn:  #e0a83a;
            --white:     #ffffff;
            --green:     #3a8c3f;
            --red-badge: #e53935;
            --bg:        #0d1830;
        }
        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--white);
            overflow: hidden;
        }

        .navbar {
            height: 56px;
            background: var(--navy);
            display: flex; align-items: center;
            padding: 0 24px;
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0,0,0,.4);
        }
        .nav-brand { display: flex; align-items: center; }
        .nav-brand .s1 { font-size: 20px; font-weight: 800; color: var(--white); }
        .nav-brand .s2 { font-size: 20px; font-weight: 800; color: var(--gold-btn); }
        .nav-div { width: 2px; height: 28px; background: var(--gold-btn); margin: 0 16px; }
        .nav-title { font-size: 15px; font-weight: 700; color: var(--gold-btn); }
        .nav-spacer { flex: 1; }

        .btn-nav {
            display: flex; align-items: center; gap: 6px;
            background: var(--navy-deep); color: var(--white);
            border: none; border-radius: 7px; padding: 8px 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 800; letter-spacing: .06em;
            cursor: pointer; text-decoration: none;
            transition: background .2s;
        }
        .btn-nav:hover { background: #08111f; }
        .btn-nav-gold { background: var(--gold-btn); }
        .btn-nav-gold:hover { background: #c89520; }

        .status-bar {
            position: fixed; top: 56px; left: 0; right: 0;
            background: var(--navy-mid); height: 38px;
            display: flex; align-items: center;
            padding: 0 24px; gap: 24px;
            z-index: 99;
            border-bottom: 1px solid rgba(255,255,255,.06);
        }
        .status-pill { display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; }
        .dot { width: 9px; height: 9px; border-radius: 50%; }
        .dot-orange { background: #e0a83a; }
        .dot-green  { background: #3a8c3f; }
        .dot-red    { background: #e53935; }

        .layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            height: calc(100vh - 94px);
            margin-top: 94px;
        }

        .panel {
            display: flex; flex-direction: column;
            overflow: hidden;
            padding: 14px;
        }
        .panel-left { border-right: 1px solid rgba(255,255,255,.06); }

        .section-box {
            background: var(--navy);
            border-radius: 12px;
            display: flex; flex-direction: column;
            overflow: hidden;
            flex: 1;
            min-height: 0;
        }

        .section-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 13px 16px;
            border-bottom: 1px solid rgba(255,255,255,.06);
            flex-shrink: 0;
        }
        .section-header-left { display: flex; align-items: center; gap: 10px; }
        .icon-box {
            width: 34px; height: 34px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .icon-box-orange { background: var(--gold-btn); }
        .icon-box-green  { background: var(--green); }
        .section-title { font-size: 13px; font-weight: 800; letter-spacing: .07em; }

        .btn-hapus-riwayat {
            display: flex; align-items: center; gap: 6px;
            background: rgba(229,57,53,.15);
            border: 1px solid rgba(229,57,53,.35);
            border-radius: 7px; padding: 6px 13px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 700;
            color: #f97676; cursor: pointer;
            transition: background .2s;
        }
        .btn-hapus-riwayat:hover { background: rgba(229,57,53,.28); }

        .counter-bar {
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(255,255,255,.04);
            margin: 10px 12px 6px;
            padding: 10px 14px; border-radius: 8px;
            font-size: 13px; font-weight: 600;
            color: rgba(255,255,255,.45);
            border: 1px solid rgba(255,255,255,.05);
            flex-shrink: 0;
        }
        .counter-num       { font-size: 15px; font-weight: 800; color: var(--gold-btn); }
        .counter-num-green { font-size: 15px; font-weight: 800; color: var(--green); }

        .cards-scroll {
            flex: 1; overflow-y: auto;
            padding: 4px 12px 12px;
        }
        .cards-scroll::-webkit-scrollbar { width: 4px; }
        .cards-scroll::-webkit-scrollbar-track { background: transparent; }
        .cards-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,.12); border-radius: 4px; }

        .order-card {
            background: var(--navy-card);
            border-radius: 10px;
            padding: 12px 13px;
            margin-bottom: 9px;
            border: 1px solid rgba(255,255,255,.05);
            transition: border-color .3s;
        }
        .order-card.urgent {
            border-color: rgba(229,57,53,.4);
            box-shadow: 0 0 0 1px rgba(229,57,53,.15);
        }

        .card-top {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 6px;
        }
        .order-num-wrap { display: flex; align-items: center; gap: 7px; flex-wrap: wrap; }
        .order-num { font-size: 17px; font-weight: 800; color: var(--white); }
        .badge-segera {
            background: var(--red-badge); color: #fff;
            font-size: 10px; font-weight: 800;
            padding: 2px 8px; border-radius: 10px;
            letter-spacing: .06em;
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50%       { opacity: .6; }
        }
        .time-tag {
            background: var(--green); color: #fff;
            font-size: 11px; font-weight: 700;
            padding: 3px 9px; border-radius: 6px;
            white-space: nowrap;
        }
        .time-tag.late { background: var(--red-badge); }

        .order-items-text {
            font-size: 14px; font-weight: 700;
            color: var(--white); margin-bottom: 8px;
        }

        .catatan-box {
            display: flex; align-items: center; gap: 9px;
            background: rgba(255,255,255,.05);
            border-left: 3px solid var(--gold-btn);
            border-radius: 0 6px 6px 0;
            padding: 5px 11px; margin-bottom: 9px;
        }
        .catatan-label {
            font-size: 9px; font-weight: 800;
            letter-spacing: .12em; color: var(--gold-btn);
            white-space: nowrap;
        }
        .catatan-text { font-size: 12px; color: rgba(255,255,255,.5); }

        .card-bottom {
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-bottom-left { display: flex; align-items: center; gap: 7px; }

        .tipe-badge {
            padding: 3px 11px; border-radius: 11px;
            font-size: 11px; font-weight: 700;
        }
        .tipe-dine { background: var(--gold-btn); color: #fff; }
        .tipe-take { background: rgba(255,255,255,.1); color: #fff; border: 1px solid rgba(255,255,255,.18); }

        .item-count-text {
            font-size: 12px; font-weight: 700;
            color: var(--gold-btn);
        }

        .badge-selesai {
            display: flex; align-items: center; gap: 5px;
            background: var(--green); color: #fff;
            font-size: 12px; font-weight: 700;
            padding: 5px 13px; border-radius: 7px;
        }

        .btn-selesai-full {
            width: 100%; margin-top: 10px;
            display: flex; align-items: center; justify-content: center; gap: 7px;
            background: transparent;
            border: 1.5px solid rgba(255,255,255,.15);
            border-radius: 8px; padding: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 700; color: var(--white);
            cursor: pointer; transition: background .2s, border-color .2s;
        }
        .btn-selesai-full:hover { background: rgba(58,140,63,.2); border-color: var(--green); }

        .timer-badge {
            font-size: 11px; font-weight: 700;
            color: rgba(255,255,255,.4);
            margin-left: 4px;
        }
        .timer-badge.late { color: var(--red-badge); }

        .empty-state {
            text-align: center; padding: 34px 0;
            color: rgba(255,255,255,.2); font-size: 13px; font-weight: 600;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="nav-brand">
        <span class="s1">STREET&nbsp;</span>
        <span class="s2">360.COFFEE</span>
    </div>
    <div class="nav-div"></div>
    <span class="nav-title">Antrian Pesanan</span>
    <div class="nav-spacer"></div>
    <a href="{{ route('kasir.pos') }}" class="btn-nav btn-nav-gold">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        KEMBALI KE KASIR
    </a>
</nav>

<div class="status-bar">
    <div class="status-pill">
        <span class="dot dot-orange"></span>
        Antrian <strong style="margin-left:3px">{{ $antrian->count() }}</strong>
    </div>
    <div class="status-pill">
        <span class="dot dot-green"></span>
        Selesai hari ini <strong style="margin-left:3px">{{ $selesai->count() }}</strong>
    </div>
    <div class="status-pill">
        <span class="dot dot-red"></span>
        Urgent <strong style="margin-left:3px" id="urgentCount">{{ $urgent }}</strong>
    </div>
</div>

<div class="layout">

    {{-- ── KIRI: ANTRIAN MASUK ── --}}
    <div class="panel panel-left">
        <div class="section-box">
            <div class="section-header">
                <div class="section-header-left">
                    <div class="icon-box icon-box-orange">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <span class="section-title">ANTRIAN PESANAN MASUK</span>
                </div>
            </div>

            <div class="counter-bar">
                <span>Menunggu Pesanan</span>
                <span class="counter-num">{{ $antrian->count() }}</span>
            </div>

            <div class="cards-scroll">
                @forelse($antrian as $t)
                <div class="order-card {{ $t->is_urgent ? 'urgent' : '' }}"
                     data-created="{{ $t->created_at->timestamp }}"
                     data-urgent="{{ $t->is_urgent ? '1' : '0' }}">

                    <div class="card-top">
                        <div class="order-num-wrap">
                            <span class="order-num">#{{ str_pad($t->nomor, 3, '0', STR_PAD_LEFT) }}</span>
                            @if($t->is_urgent)
                                <span class="badge-segera">SEGERA</span>
                            @endif
                            <span class="timer-badge {{ $t->is_urgent ? 'late' : '' }}" data-timer></span>
                        </div>
                        <span class="time-tag {{ $t->is_urgent ? 'late' : '' }}">{{ $t->created_at->format('H.i') }}</span>
                    </div>

                    <div class="order-items-text">
                        {{ $t->orderItems->pluck('nama_menu')->join(', ') }}
                    </div>

                    <div class="catatan-box">
                        <span class="catatan-label">CATATAN</span>
                        <span class="catatan-text">{{ $t->catatan ?: '-' }}</span>
                    </div>

                    <div class="card-bottom">
                        <div class="card-bottom-left">
                            <span class="tipe-badge {{ $t->tipe === 'dine_in' ? 'tipe-dine' : 'tipe-take' }}">
                                {{ $t->tipe === 'dine_in' ? 'Dine in' : 'Take Away' }}
                            </span>
                            <span class="item-count-text">{{ $t->orderItems->sum('qty') }} item</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('kasir.antrian.selesai', $t->id) }}">
                        @csrf
                        <button type="submit" class="btn-selesai-full">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Tandai Selesai
                        </button>
                    </form>
                </div>
                @empty
                <div class="empty-state">Tidak ada antrian</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ── KANAN: SELESAI ── --}}
    <div class="panel">
        <div class="section-box">
            <div class="section-header">
                <div class="section-header-left">
                    <div class="icon-box icon-box-green">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                    </div>
                    <span class="section-title">SELESAI</span>
                </div>
                <form method="POST" action="{{ route('kasir.antrian.hapus') }}">
                    @csrf
                    <button type="submit" class="btn-hapus-riwayat">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6l-1 14H6L5 6"/>
                            <path d="M10 11v6M14 11v6"/>
                            <path d="M9 6V4h6v2"/>
                        </svg>
                        Hapus Riwayat
                    </button>
                </form>
            </div>

            <div class="counter-bar">
                <span>Pesanan Selesai</span>
                <span class="counter-num-green">{{ $selesai->count() }}</span>
            </div>

            <div class="cards-scroll">
                @forelse($selesai as $t)
                <div class="order-card" style="border-color: rgba(58,140,63,.15); opacity: .78;">
                    <div class="card-top">
                        <div class="order-num-wrap">
                            <span class="order-num" style="font-size:16px; color:rgba(255,255,255,.5)">
                                #{{ str_pad($t->nomor, 3, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                        <span class="time-tag">{{ $t->updated_at->format('H.i') }}</span>
                    </div>

                    <div class="order-items-text" style="font-size:14px; color:rgba(255,255,255,.55); font-weight:700; margin-bottom:8px;">
                        {{ $t->orderItems->pluck('nama_menu')->join(', ') }}
                    </div>

                    @if($t->catatan)
                    <div class="catatan-box">
                        <span class="catatan-label">CATATAN</span>
                        <span class="catatan-text">{{ $t->catatan }}</span>
                    </div>
                    @endif

                    <div class="card-bottom">
                        <div class="card-bottom-left">
                            <span class="tipe-badge {{ $t->tipe === 'dine_in' ? 'tipe-dine' : 'tipe-take' }}" style="opacity:.65">
                                {{ $t->tipe === 'dine_in' ? 'Dine in' : 'Take Away' }}
                            </span>
                            <span class="item-count-text">{{ $t->orderItems->sum('qty') }} item</span>
                        </div>
                        <span class="badge-selesai">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Selesai
                        </span>
                    </div>
                </div>
                @empty
                <div class="empty-state">Belum ada pesanan selesai</div>
                @endforelse
            </div>
        </div>
    </div>

</div>

<script>
const URGENT_MINUTES = 10;
let reloadScheduled = false;

function updateTimers() {
    const now = Date.now();
    let urgentCount = 0;

    document.querySelectorAll('.order-card[data-created]').forEach(card => {
        const created   = parseInt(card.dataset.created) * 1000;
        const diffMs    = now - created;
        const diffMin   = Math.floor(diffMs / 60000);
        const diffSec   = Math.floor((diffMs % 60000) / 1000);
        const wasUrgent = card.dataset.urgent === '1';
        const isLate    = diffMin >= URGENT_MINUTES;

        const timerEl = card.querySelector('[data-timer]');
        if (timerEl) {
            if (diffMin < 60) {
                timerEl.textContent = `(${diffMin}m ${diffSec}s)`;
            } else {
                const h = Math.floor(diffMin / 60);
                const m = diffMin % 60;
                timerEl.textContent = `(${h}j ${m}m)`;
            }
            timerEl.className = 'timer-badge' + (isLate ? ' late' : '');
        }

        const orderNumWrap  = card.querySelector('.order-num-wrap');
        const existingBadge = orderNumWrap ? orderNumWrap.querySelector('.badge-segera') : null;

        if (isLate) {
            if (orderNumWrap && !existingBadge) {
                const badge = document.createElement('span');
                badge.className   = 'badge-segera';
                badge.textContent = 'SEGERA';
                const orderNum = orderNumWrap.querySelector('.order-num');
                if (orderNum && orderNum.nextSibling) {
                    orderNumWrap.insertBefore(badge, orderNum.nextSibling);
                } else {
                    orderNumWrap.appendChild(badge);
                }
            }
            card.classList.add('urgent');
            const timeTag = card.querySelector('.time-tag');
            if (timeTag) timeTag.classList.add('late');

            urgentCount++;

            if (!wasUrgent && !reloadScheduled) {
                reloadScheduled = true;
                setTimeout(() => location.reload(), 1500);
            }
        } else {
            if (existingBadge) existingBadge.remove();
            card.classList.remove('urgent');
        }
    });

    const urgentEl = document.getElementById('urgentCount');
    if (urgentEl) urgentEl.textContent = urgentCount;
}

updateTimers();
setInterval(updateTimers, 1000);

setInterval(() => {
    if (!reloadScheduled) location.reload();
}, 15000);
</script>
</body>
</html>