{{-- resources/views/admin/ketersediaan.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketersediaan — Street 360 Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --gold:      #e8b04b;
            --gold-l:    #f5cc7a;
            --gold-dim:  rgba(232,176,75,.13);
            --gold-glow: rgba(232,176,75,.3);
            --navy:      #080f1e;
            --navy-2:    #0c1628;
            --navy-3:    #111f38;
            --navy-4:    #162440;
            --navy-5:    #1c2e4f;
            --text:      #f0f4ff;
            --muted:     #6b7fa0;
            --muted-2:   #8a9ec0;
            --border:    rgba(255,255,255,.06);
            --border-2:  rgba(255,255,255,.11);
            --green:     #4ade80;
            --green-dim: rgba(74,222,128,.11);
            --red:       #f87171;
            --red-dim:   rgba(248,113,113,.11);
        }

        html, body { height: 100%; font-family: 'DM Sans', sans-serif; background: var(--navy); color: var(--text); overflow: hidden; }
        .layout { display: flex; height: 100vh; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--navy-5); border-radius: 4px; }

        /* ── Sidebar ── */
        .sidebar { width: 256px; min-width: 256px; background: var(--navy-2); display: flex; flex-direction: column; border-right: 1px solid var(--border); overflow-y: auto; position: relative; }
        .sidebar::after { content:''; position:absolute; top:0; right:0; bottom:0; width:1px; background:linear-gradient(180deg,transparent,rgba(232,176,75,.18) 40%,transparent); pointer-events:none; }
        .sidebar-brand { padding: 24px 20px 18px; border-bottom: 1px solid var(--border); }
        .brand-name { font-family:'Plus Jakarta Sans',sans-serif; font-size:20px; font-weight:800; color:#fff; letter-spacing:.06em; text-transform:uppercase; }
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
        .main { flex: 1; overflow-y: auto; padding: 28px; background: var(--navy); }

        /* ── Page Title (sama seperti kode 1) ── */
        .page-title { font-family:'Plus Jakarta Sans',sans-serif; font-size:26px; font-weight:800; margin-bottom:10px; color:#fff; }

        /* ── Info box ── */
        .info-box {
            background: var(--navy-3);
            border: 1px solid var(--border);
            border-left: 3px solid var(--gold);
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 24px;
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .info-box svg { flex-shrink:0; color:var(--gold); }

        /* ── Filter row (sama layout kode 1) ── */
        .filter-row { display: flex; align-items: center; gap: 10px; margin-bottom: 16px; flex-wrap: wrap; }
        .cat-btn { padding: 8px 20px; border-radius: 9px; border: 1px solid var(--border-2); font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700; cursor: pointer; background: transparent; color: var(--muted); transition: all .18s; letter-spacing:.02em; }
        .cat-btn.active { background: var(--gold); color: var(--navy); border-color: var(--gold); box-shadow: 0 4px 16px var(--gold-glow); }
        .cat-btn:hover:not(.active) { background: rgba(255,255,255,.06); color: var(--text); border-color: rgba(255,255,255,.18); }

        /* ── Bulk row (sama layout kode 1) ── */
        .bulk-row { display: flex; gap: 10px; margin-bottom: 24px; }
        .btn-aktifkan { display:flex; align-items:center; gap:8px; padding:9px 20px; border-radius:9px; border:1px solid rgba(74,222,128,.3); background:var(--green-dim); color:var(--green); font-family:'DM Sans',sans-serif; font-size:13px; font-weight:700; cursor:pointer; transition:all .2s; }
        .btn-aktifkan:hover { background:rgba(74,222,128,.2); border-color:var(--green); box-shadow:0 0 16px rgba(74,222,128,.2); transform:translateY(-1px); }
        .btn-nonaktifkan { display:flex; align-items:center; gap:8px; padding:9px 20px; border-radius:9px; border:1px solid rgba(248,113,113,.3); background:var(--red-dim); color:var(--red); font-family:'DM Sans',sans-serif; font-size:13px; font-weight:700; cursor:pointer; transition:all .2s; }
        .btn-nonaktifkan:hover { background:rgba(248,113,113,.2); border-color:var(--red); box-shadow:0 0 16px rgba(248,113,113,.2); transform:translateY(-1px); }

        /* ── Grid (sama layout kode 1) ── */
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 14px; }

        /* ── Card ── */
        .menu-item-card {
            background: var(--navy-3);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 16px 18px;
            transition: all .25s cubic-bezier(.34,1.2,.64,1);
            position: relative;
            overflow: hidden;
        }
        .menu-item-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 2px;
            border-radius: 14px 14px 0 0;
            transform: scaleX(0); transform-origin: left;
            transition: transform .3s ease;
        }
        .menu-item-card.aktif::before  { background: linear-gradient(90deg, transparent, var(--green), transparent); }
        .menu-item-card.nonaktif::before { background: linear-gradient(90deg, transparent, var(--red), transparent); }
        .menu-item-card:hover::before  { transform: scaleX(1); }
        .menu-item-card:hover { border-color: rgba(255,255,255,.14); transform: translateY(-2px); box-shadow: 0 10px 32px rgba(0,0,0,.3); }
        .menu-item-card.nonaktif { opacity: .6; }
        .menu-item-card.nonaktif:hover { opacity: .8; }

        /* card-top: sama seperti kode 1 */
        .card-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 4px; }
        .card-nama  { font-size: 15px; font-weight: 700; color: #fff; margin-bottom: 2px; }
        .card-harga { font-size: 13px; font-weight: 700; color: var(--gold); margin-bottom: 6px; }
        .badge-kat  { display:inline-block; font-size:10px; font-weight:700; padding:2px 9px; border-radius:20px; background:var(--navy-5); color:var(--muted-2); border:1px solid var(--border-2); margin-bottom:6px; }

        /* status row: sama seperti kode 1 */
        .status-row { display: flex; justify-content: flex-end; margin-bottom: 10px; }
        .status-label { font-size: 12px; font-weight: 700; display:inline-flex; align-items:center; gap:5px; padding:3px 10px; border-radius:20px; }
        .status-label::before { content:''; width:5px; height:5px; border-radius:50%; flex-shrink:0; }
        .status-label.tersedia { color: var(--green); background: var(--green-dim); border:1px solid rgba(74,222,128,.2); }
        .status-label.tersedia::before { background: var(--green); }
        .status-label.habis    { color: var(--red);   background: var(--red-dim);   border:1px solid rgba(248,113,113,.2); }
        .status-label.habis::before    { background: var(--red); }

        /* Toggle switch — lebih menyala */
        .toggle-wrap { position: relative; width: 46px; height: 26px; flex-shrink: 0; display: inline-block; cursor: pointer; }
        .toggle-wrap input { opacity: 0; width: 100%; height: 100%; position: absolute; top: 0; left: 0; z-index: 2; cursor: pointer; margin: 0; }
        .toggle-slider { position: absolute; inset: 0; border-radius: 99px; background: var(--red-dim); border: 1px solid rgba(248,113,113,.35); transition: all .3s; pointer-events: none; }
        .toggle-slider::before { content: ''; position: absolute; width: 20px; height: 20px; left: 2px; top: 2px; background: var(--red); border-radius: 50%; transition: all .3s; box-shadow: 0 0 8px rgba(248,113,113,.5); }
        .toggle-wrap input:checked + .toggle-slider { background: var(--green-dim); border-color: rgba(74,222,128,.35); }
        .toggle-wrap input:checked + .toggle-slider::before { transform: translateX(20px); background: var(--green); box-shadow: 0 0 8px rgba(74,222,128,.5); }

        /* keterangan: sama seperti kode 1 */
        .card-ket { display: flex; gap: 8px; font-size: 12px; color: var(--muted); line-height: 1.5; padding-top: 10px; border-top: 1px solid var(--border); margin-top: 4px; }
        .card-ket-label { font-weight: 700; color: var(--muted-2); flex-shrink: 0; }

        /* ── Toast ── */
        .toast { position: fixed; bottom: 28px; right: 28px; background: var(--navy-3); border: 1px solid var(--border-2); border-radius: 12px; padding: 12px 20px; font-size: 13px; font-weight: 600; color: #fff; z-index: 9999; opacity: 0; transform: translateY(12px); transition: all .28s; pointer-events: none; display:flex; align-items:center; gap:8px; box-shadow:0 8px 32px rgba(0,0,0,.4); }
        .toast.show { opacity: 1; transform: translateY(0); }
        .toast.ok  { border-color: rgba(74,222,128,.4);  color: var(--green); }
        .toast.err { border-color: rgba(248,113,113,.4); color: var(--red); }
        .toast-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
        .toast.ok  .toast-dot { background: var(--green); box-shadow: 0 0 8px rgba(74,222,128,.6); }
        .toast.err .toast-dot { background: var(--red);   box-shadow: 0 0 8px rgba(248,113,113,.6); }
    </style>
</head>
<body>
<div class="layout">

    @include('admin.partials.sidebar')

    <main class="main">
        <div class="page-title">Ketersediaan</div>

        <div class="info-box">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Atur ketersediaan menu secara cepat. Menu yang dinonaktifkan akan otomatis tampil sebagai
            <strong style="color:#fff">Habis</strong> di halaman pengunjung dan kasir.
        </div>

        <!-- Filter Kategori -->
        <div class="filter-row">
            <button class="cat-btn active" data-cat="semua"    onclick="filterKat(this)">Semua</button>
            <button class="cat-btn"        data-cat="kopi"     onclick="filterKat(this)">Kopi</button>
            <button class="cat-btn"        data-cat="non-kopi" onclick="filterKat(this)">Non - Kopi</button>
            <button class="cat-btn"        data-cat="snack"    onclick="filterKat(this)">Snack</button>
        </div>

        <!-- Bulk Actions -->
        <div class="bulk-row">
            <button class="btn-aktifkan" onclick="bulkToggle('aktif')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                Aktifkan Semua
            </button>
            <button class="btn-nonaktifkan" onclick="bulkToggle('nonaktif')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                Nonaktifkan Semua
            </button>
        </div>

        <!-- Menu Grid -->
        <div class="menu-grid" id="menuGrid">
            @foreach($menus as $menu)
            <div class="menu-item-card {{ $menu->tersedia ? 'aktif' : 'nonaktif' }}"
                 data-cat="{{ $menu->kategori }}"
                 data-id="{{ $menu->id }}"
                 id="card-{{ $menu->id }}">

                <div class="card-top">
                    <div>
                        <div class="card-nama">{{ $menu->nama }}</div>
                        <div class="card-harga">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                        <span class="badge-kat">{{ ucfirst($menu->kategori) }}</span>
                    </div>
                    <label class="toggle-wrap">
                        <input type="checkbox"
                               {{ $menu->tersedia ? 'checked' : '' }}
                               onchange="toggleMenu({{ $menu->id }}, this)">
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="status-row">
                    <span class="status-label {{ $menu->tersedia ? 'tersedia' : 'habis' }}"
                          id="status-{{ $menu->id }}">
                        {{ $menu->tersedia ? 'Tersedia' : 'Tidak Tersedia' }}
                    </span>
                </div>

                <div class="card-ket">
                    <span class="card-ket-label">Keterangan:</span>
                    <span>{{ $menu->deskripsi ?: '-' }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</div>

<!-- Toast -->
<div class="toast" id="toast">
    <span class="toast-dot"></span>
    <span id="toastMsg"></span>
</div>

<script>
const csrfToken = '{{ csrf_token() }}';
const baseUrl   = '{{ url('admin/ketersediaan') }}';
let aktivKat    = 'semua';

function filterKat(btn) {
    document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    aktivKat = btn.dataset.cat;
    document.querySelectorAll('.menu-item-card').forEach(card => {
        card.style.display = (aktivKat === 'semua' || card.dataset.cat === aktivKat) ? '' : 'none';
    });
}

async function toggleMenu(id, checkbox) {
    try {
        const res  = await fetch(`${baseUrl}/${id}/toggle`, {
            method: 'PATCH',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' }
        });
        const data = await res.json();
        if (!data.success) { checkbox.checked = !checkbox.checked; return; }

        const card   = document.getElementById('card-' + id);
        const status = document.getElementById('status-' + id);

        if (data.tersedia) {
            card.classList.remove('nonaktif'); card.classList.add('aktif');
            status.textContent = 'Tersedia';
            status.className   = 'status-label tersedia';
            showToast(data.nama + ' — Tersedia', 'ok');
        } else {
            card.classList.remove('aktif'); card.classList.add('nonaktif');
            status.textContent = 'Tidak Tersedia';
            status.className   = 'status-label habis';
            showToast(data.nama + ' — Tidak Tersedia', 'err');
        }
    } catch(e) {
        checkbox.checked = !checkbox.checked;
        showToast('Gagal memperbarui', 'err');
    }
}

async function bulkToggle(aksi) {
    const url   = aksi === 'aktif'
        ? '{{ route('admin.ketersediaan.aktifkan') }}'
        : '{{ route('admin.ketersediaan.nonaktifkan') }}';
    const aktif = aksi === 'aktif';

    try {
        await fetch(url, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' },
            body: JSON.stringify({ kategori: aktivKat })
        });

        document.querySelectorAll('.menu-item-card').forEach(card => {
            if (card.style.display === 'none') return;
            const id       = card.dataset.id;
            const checkbox = card.querySelector('input[type=checkbox]');
            const status   = document.getElementById('status-' + id);

            checkbox.checked = aktif;
            if (aktif) {
                card.classList.remove('nonaktif'); card.classList.add('aktif');
                status.textContent = 'Tersedia';
                status.className   = 'status-label tersedia';
            } else {
                card.classList.remove('aktif'); card.classList.add('nonaktif');
                status.textContent = 'Tidak Tersedia';
                status.className   = 'status-label habis';
            }
        });

        showToast(aktif ? 'Semua menu diaktifkan' : 'Semua menu dinonaktifkan', aktif ? 'ok' : 'err');
    } catch(e) {
        showToast('Gagal memperbarui', 'err');
    }
}

let toastTimer;
function showToast(msg, type = 'ok') {
    document.getElementById('toastMsg').textContent = msg;
    const t = document.getElementById('toast');
    t.className = 'toast show ' + type;
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => t.className = 'toast', 2800);
}
</script>
</body>
</html>