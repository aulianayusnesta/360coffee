{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Street 360.coffee</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
:root{
  --navy:#1a2340;--navy2:#0d1526;--navy3:#111b33;
  --gold:#d4a843;--gold2:#f0c96a;--gold3:#a87c28;
  --white:#ffffff;--light:#f5f5f0;--text:#1a1a1a;
  --font:'Poppins',sans-serif;
}
html{scroll-behavior:smooth}
body{font-family:var(--font);color:var(--text);background:var(--white);overflow-x:hidden}

/* ── NAVBAR ── */
.navbar{
  display:flex;align-items:center;justify-content:space-between;
  padding:0 40px;height:62px;
  background:linear-gradient(105deg,#060d1c 0%,#111b33 30%,#1a2340 55%,#0e1828 80%,#060d1c 100%);
  position:sticky;top:0;z-index:100;
  border-bottom:1.5px solid rgba(212,168,67,0.35);
  box-shadow:0 4px 32px rgba(0,0,0,0.55);
}
.navbar::after{content:'';position:absolute;bottom:0;left:0;right:0;height:1.5px;background:linear-gradient(90deg,transparent,rgba(240,201,106,1) 50%,transparent);pointer-events:none;}
.brand{text-decoration:none;display:flex;align-items:center;gap:0}
.b1{font-size:18px;font-weight:900;margin-right:4px;background:linear-gradient(135deg,#fff,#e8dfc4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.b2{font-size:18px;font-weight:900;color:#fff}
.b3{font-size:18px;font-weight:900;background:linear-gradient(135deg,var(--gold2),var(--gold),var(--gold3));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.nav-menu{display:flex;list-style:none;gap:38px}
.nav-menu a{color:rgba(255,255,255,0.75);text-decoration:none;font-size:14px;font-weight:600;position:relative;transition:color .2s;letter-spacing:0.3px}
.nav-menu a::after{content:'';position:absolute;bottom:-4px;left:0;width:0;height:2px;background:linear-gradient(90deg,var(--gold2),var(--gold));transition:width .25s;border-radius:2px}
.nav-menu a:hover::after,.nav-menu a.active::after{width:100%}
.nav-menu a:hover,.nav-menu a.active{color:var(--gold2)}
.btn-login{background:linear-gradient(135deg,#f5ca5e 0%,#d4a843 55%,#b8882a 100%);color:#0d1526;font-size:13px;font-weight:800;padding:9px 26px;border-radius:30px;text-decoration:none;letter-spacing:0.5px;box-shadow:0 2px 12px rgba(212,168,67,0.45);transition:box-shadow .2s,transform .15s;border:none;}
.btn-login:hover{box-shadow:0 4px 22px rgba(212,168,67,0.65);transform:translateY(-1px)}

/* ── HERO ── */
.hero{
  position:relative;min-height:460px;overflow:hidden;
  display:flex;align-items:center;padding:56px 6% 80px;
  background:linear-gradient(135deg,#c5c7c2 0%,#d0d2cc 40%,#c5c7c2 100%);
}
.hero-overlay{
  position:absolute;inset:0;z-index:2;
  background:linear-gradient(90deg,rgba(180,175,165,0.65) 0%,rgba(150,145,132,0.25) 50%,transparent 72%);
  pointer-events:none;
}

/* Biji kopi — 1 gambar jadi background menyebar */
.hero-beans-bg{
  position:absolute;inset:0;width:100%;height:100%;
  object-fit:cover;object-position:center;
  opacity:0.35;pointer-events:none;z-index:1;
}

/* Konten kiri */
.hero-content{flex:1;max-width:48%;z-index:3;position:relative;animation:hIn .9s cubic-bezier(.22,1,.36,1) both}
@keyframes hIn{from{opacity:0;transform:translateX(-28px)}to{opacity:1;transform:translateX(0)}}
.hero-label{display:flex;align-items:center;gap:10px;font-size:13px;font-weight:600;color:#2a2620;margin-bottom:16px}
.lline{display:inline-block;width:36px;height:2px;background:linear-gradient(90deg,var(--gold),var(--gold2));border-radius:2px;flex-shrink:0}
.hero-title{font-size:clamp(30px,4.5vw,58px);font-weight:900;line-height:1.1;color:#1a1a1a;margin-bottom:6px}
.hero-acc{background:linear-gradient(135deg,var(--gold3),var(--gold),var(--gold2));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.hero-desc{font-size:clamp(13px,1.2vw,15px);color:#333;line-height:1.8;margin-top:16px;max-width:400px}

/* Gelas kanan — kecil dan rapi */
.hero-right{
  position:absolute;right:5%;bottom:0;
  width:clamp(260px,32vw,420px);
  height:100%;z-index:3;
  display:flex;align-items:flex-end;justify-content:center;
  animation:hInR 1s cubic-bezier(.22,1,.36,1) .2s both;
}
.hero-cup{
  width:100%;height:auto;
  max-height:95%;
  object-fit:contain;object-position:bottom center;display:block;
  filter:drop-shadow(0 10px 24px rgba(0,0,0,0.32));
}

/* Efek uap */
.steam-wrap{position:absolute;bottom:52%;right:calc(5% + clamp(110px,12vw,170px)*0.5);z-index:4;pointer-events:none;display:flex;gap:8px}
.steam{width:5px;height:36px;background:linear-gradient(to top,rgba(255,255,255,0.5),transparent);border-radius:50px;animation:steamUp 2.4s ease-in-out infinite;filter:blur(2.5px)}
.steam:nth-child(2){animation-delay:.5s;height:26px}
.steam:nth-child(3){animation-delay:1s;height:46px}
@keyframes steamUp{0%{transform:translateY(0) scaleX(1);opacity:0}20%{opacity:0.65}80%{opacity:0.15}100%{transform:translateY(-56px) scaleX(1.7);opacity:0}}

/* ── INFO BAR ── */
.info-wrap{background:linear-gradient(180deg,#c5c7c2 0%,#d0d2cc 25%,#eeede7 100%);padding:0 6% 50px;display:flex;justify-content:center;}
.info-bar{width:100%;max-width:860px;display:flex;align-items:stretch;background:linear-gradient(135deg,#070e1e 0%,#101828 25%,#1a2340 55%,#111b33 80%,#070e1e 100%);border-radius:20px;border:1px solid rgba(212,168,67,0.4);box-shadow:0 12px 48px rgba(0,0,0,0.5),0 0 0 1px rgba(212,168,67,0.08) inset,0 1.5px 0 rgba(240,201,106,0.55) inset;margin-top:-38px;z-index:10;position:relative;overflow:hidden;}
.info-bar::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 38% 110% at 17% 50%,rgba(212,168,67,0.1) 0%,transparent 70%),radial-gradient(ellipse 28% 90% at 50% 50%,rgba(212,168,67,0.07) 0%,transparent 70%),radial-gradient(ellipse 38% 110% at 83% 50%,rgba(212,168,67,0.1) 0%,transparent 70%);pointer-events:none}
.info-bar::after{content:'';position:absolute;top:0;left:8%;right:8%;height:1px;background:linear-gradient(90deg,transparent,rgba(240,201,106,0.9),transparent);pointer-events:none}
.info-item{text-align:center;flex:1;padding:36px 20px;position:relative;transition:background .3s;cursor:default}
.info-item:hover{background:rgba(212,168,67,0.08)}
.info-label{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:3px;text-transform:uppercase;margin-bottom:10px;text-shadow:0 0 14px rgba(212,168,67,0.55)}
.info-value{font-size:18px;font-weight:800;color:#fff;line-height:1.4;letter-spacing:0.5px}
.info-div{width:1px;background:linear-gradient(to bottom,transparent,rgba(212,168,67,0.5) 25%,rgba(212,168,67,0.5) 75%,transparent);margin:14px 0}

/* ── MENU ── */
.menu-section{padding:72px 6%;background:linear-gradient(180deg,#eeede7 0%,#f5f5f0 50%,#eceae4 100%)}
.sec-label{display:flex;align-items:center;gap:10px;font-size:11px;font-weight:700;color:#aaa;letter-spacing:2.5px;text-transform:uppercase;margin-bottom:10px}
.sec-title{font-size:clamp(24px,3vw,40px);font-weight:800;color:var(--text);margin-bottom:8px}
.acc{background:linear-gradient(135deg,var(--gold3),var(--gold),var(--gold2));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.sec-desc{font-size:14px;color:#999;margin-bottom:32px}
.menu-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px;margin-bottom:24px}
@media(min-width:768px){.menu-grid{grid-template-columns:repeat(4,1fr)}}
.menu-card{background:#fff;border-radius:14px;overflow:hidden;position:relative;box-shadow:0 2px 14px rgba(0,0,0,0.09);border:1px solid rgba(0,0,0,0.06);transition:transform .25s,box-shadow .25s;will-change:transform}
.menu-card:hover{transform:translateY(-5px);box-shadow:0 16px 40px rgba(0,0,0,0.14)}
.badge{position:absolute;top:10px;left:10px;font-size:11px;font-weight:700;padding:4px 11px;border-radius:20px;z-index:2}
.badge-best{background:linear-gradient(135deg,var(--gold2),var(--gold));color:var(--navy2)}
.badge-new{background:linear-gradient(135deg,#4dbf6e,#2e9e50);color:#fff}
.menu-img{width:100%;aspect-ratio:1/1;background:#f0f0ec;overflow:hidden;display:flex;align-items:center;justify-content:center}
.menu-img img{width:100%;height:100%;object-fit:cover;display:block}
.no-img{width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#ebebeb}
.menu-info{padding:12px 14px 15px;background:linear-gradient(160deg,#1e2a4a 0%,#1a2340 55%,#101828 100%)}
.menu-name{font-size:14px;font-weight:700;color:#fff;margin-bottom:6px}
.menu-desc{font-size:11px;color:rgba(255,255,255,0.48);line-height:1.55;margin-bottom:10px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.menu-foot{display:flex;align-items:center;justify-content:space-between}
.menu-price{font-size:13px;font-weight:700;background:linear-gradient(135deg,var(--gold2),var(--gold));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.menu-tag{background:rgba(255,255,255,0.1);color:rgba(255,255,255,0.72);font-size:10px;font-weight:600;padding:3px 10px;border-radius:20px;border:1px solid rgba(255,255,255,0.12)}
.btn-all{display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:17px;background:transparent;border:2px solid var(--navy);color:var(--navy);font-family:var(--font);font-size:14px;font-weight:700;letter-spacing:1.5px;border-radius:10px;text-decoration:none;transition:background .2s,color .2s,border-color .2s;overflow:hidden;position:relative}
.btn-all:hover{background:linear-gradient(135deg,var(--navy2),var(--navy));color:#fff;border-color:transparent}

/* ── ABOUT ── */
.about{padding:72px 6%;position:relative;background:linear-gradient(160deg,#080f1f 0%,#101828 20%,#1a2340 50%,#141f38 80%,#080f1f 100%)}
.about::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 55% 45% at 78% 18%,rgba(212,168,67,0.07) 0%,transparent 60%),radial-gradient(ellipse 35% 55% at 8% 82%,rgba(212,168,67,0.05) 0%,transparent 60%);pointer-events:none}
.about::after{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(240,201,106,0.85) 50%,transparent);pointer-events:none}
.about-label{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:2.5px;text-transform:uppercase;margin-bottom:12px;position:relative}
.about-title{font-size:clamp(30px,3.8vw,54px);font-weight:900;color:#fff;line-height:1.15;margin-bottom:28px;position:relative}
.about-text p{font-size:14px;color:rgba(255,255,255,0.68);line-height:1.9;margin-bottom:14px;position:relative}
.about-stats{display:flex;gap:52px;margin:36px 0;position:relative}
.stat-num{font-size:clamp(24px,3vw,40px);font-weight:900;margin-bottom:4px;background:linear-gradient(135deg,#fff,rgba(255,255,255,0.85));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.stat-lbl{font-size:11px;font-weight:700;color:var(--gold);letter-spacing:1.5px;text-transform:uppercase}
.features{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;position:relative}
@media(min-width:768px){.features{grid-template-columns:repeat(4,1fr)}}
.feat{background:rgba(255,255,255,0.055);border:1px solid rgba(212,168,67,0.14);border-radius:12px;padding:20px 16px;transition:background .25s,border-color .25s,transform .25s}
.feat:hover{background:rgba(212,168,67,0.09);border-color:rgba(212,168,67,0.42);transform:translateY(-3px)}
.feat-title{font-size:14px;font-weight:700;color:#fff;margin-bottom:8px}
.feat-desc{font-size:12px;color:rgba(255,255,255,0.55);line-height:1.65}

/* ── FOOTER ── */
.footer{background:linear-gradient(135deg,var(--navy2),var(--navy),var(--navy3));text-align:center;padding:32px 6%;border-top:1px solid rgba(212,168,67,0.2)}
.footer p{font-size:13px;color:rgba(255,255,255,0.4);line-height:1.9}

/* ── ANIMASI ── */
.rv{opacity:0;transform:translateY(24px);transition:opacity .6s ease,transform .6s ease}
.rv.vis{opacity:1;transform:translateY(0)}
.ripple{position:absolute;border-radius:50%;transform:scale(0);background:rgba(255,255,255,0.28);animation:rip .55s linear;pointer-events:none}
@keyframes rip{to{transform:scale(4);opacity:0}}
.cdots{position:absolute;inset:0;pointer-events:none;overflow:hidden;z-index:1}
.dot{position:absolute;border-radius:50%;background:rgba(212,168,67,0.09);animation:dotF linear infinite}
@keyframes dotF{0%{transform:translateY(0);opacity:0.4}50%{opacity:0.7}100%{transform:translateY(-38px);opacity:0}}

/* ── RESPONSIVE ── */
@media(max-width:768px){
  .navbar{padding:0 18px}
  .nav-menu{display:none}
  .hero{flex-direction:column;text-align:center;padding:32px 6% 40px;min-height:auto}
  .hero-content{max-width:100%}
  .hero-label{justify-content:center}
  .hero-right{position:static;width:120px;height:auto;margin:20px auto 0;animation:none}
  .hero-cup{max-height:none;height:auto;width:100%}
  .steam-wrap{display:none}
  .info-bar{flex-wrap:wrap}
  .info-item{flex:1 1 50%}
}
@media(max-width:420px){
  .info-bar{flex-direction:column}
  .info-div{width:100%;height:1px;margin:0}
}
</style>
</head>
<body>

<nav class="navbar">
  <a href="{{ route('home') }}" class="brand">
    <span class="b1">Street</span>
    <span class="b2">360.</span>
    <span class="b3">coffee</span>
  </a>
  <ul class="nav-menu">
    <li><a href="{{ route('home') }}" class="active">Beranda</a></li>
    <li><a href="{{ route('menu.index') }}">Menu</a></li>
    <li><a href="{{ route('tentang') }}">Tentang</a></li>
    <li><a href="{{ route('lokasi') }}">Lokasi</a></li>
  </ul>
  <a href="{{ route('login') }}" class="btn-login">LOGIN</a>
</nav>

<section class="hero" id="home">
  <div class="steam-wrap">
    <div class="steam"></div><div class="steam"></div><div class="steam"></div>
  </div>
  <div class="hero-overlay"></div>

  {{-- Foto biji kopi jadi background menyebar tipis --}}
  <img class="hero-beans-bg" src="{{ asset('hero-beans.png') }}" alt="" aria-hidden="true">

  <div class="hero-content">
    <p class="hero-label"><span class="lline"></span>Kopi Lokal · Est. 2025</p>
    <h1 class="hero-title">Dari biji terbaik<br><span class="hero-acc">Pilihan.</span></h1>
    <p class="hero-desc">Pengalaman ngopi yang jujur dan autentik — diseduh dengan teliti, disajikan dengan hangat. Cek menu kami dan temukan favoritmu.</p>
  </div>

  <div class="hero-right">
    <img class="hero-cup" src="{{ asset('minuman.png') }}" alt="Street 360 Coffee Cup">
  </div>
</section>

<div class="info-wrap">
  <div class="info-bar rv">
    <div class="info-item">
      <p class="info-label">JAM BUKA</p>
      <p class="info-value">17.30 – CLOSE</p>
    </div>
    <div class="info-div"></div>
    <div class="info-item">
      <p class="info-label">PEMBAYARAN</p>
      <p class="info-value">TUNAI &amp; QRIS</p>
    </div>
    <div class="info-div"></div>
    <div class="info-item">
      <p class="info-label">MENU</p>
      <p class="info-value">{{ \App\Models\Menu::where('tersedia', true)->count() }}+ VARIAN</p>
    </div>
  </div>
</div>

<section class="menu-section" id="menu">
  <p class="sec-label rv"><span class="lline" style="background:linear-gradient(90deg,#bbb,#ddd)"></span>PILIHAN KAMI</p>
  <h2 class="sec-title rv">Menu <span class="acc">Unggulan</span></h2>
  <p class="sec-desc rv">Yang paling banyak dipesan pelanggan kami setiap malam.</p>
  <div class="menu-grid">
    @forelse($unggulan as $item)
    <div class="menu-card rv">
      @if($item->badge)
        <span class="badge {{ $item->badge === 'New' ? 'badge-new' : 'badge-best' }}">{{ $item->badge }}</span>
      @endif
      <div class="menu-img">
        @if($item->gambar)
          <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" loading="lazy">
        @else
          <div class="no-img">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.2">
              <rect x="3" y="3" width="18" height="18" rx="2"/>
              <circle cx="8.5" cy="8.5" r="1.5"/>
              <polyline points="21 15 16 10 5 21"/>
            </svg>
          </div>
        @endif
      </div>
      <div class="menu-info">
        <p class="menu-name">{{ $item->nama }}</p>
        @if($item->deskripsi)<p class="menu-desc">{{ $item->deskripsi }}</p>@endif
        <div class="menu-foot">
          <span class="menu-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
          <span class="menu-tag">{{ $item->kategori }}</span>
        </div>
      </div>
    </div>
    @empty
    <div style="grid-column:span 4;text-align:center;color:#aaa;padding:40px 0">Belum ada menu tersedia.</div>
    @endforelse
  </div>
  <a href="{{ route('menu.index') }}" class="btn-all rv">LIHAT SEMUA MENU →</a>
</section>

<section class="about" id="about">
  <div class="cdots" id="coffeeDots"></div>
  <p class="about-label rv">SIAPA KAMI</p>
  <h2 class="about-title rv">Pelopor<br>digital di <span class="acc">Waru.</span></h2>
  <div class="about-text rv">
    <p>Street 360Coffee berdiri tahun 2025 di Waru, Kalimantan Timur. Kami hadir sebagai coffee shop yang fokus menghadirkan kopi berkualitas, sekaligus menjadi pelopor digitalisasi UMKM kuliner di kawasan ini.</p>
    <p>Semua kopi kami bersumber dari petani lokal pilihan — diolah dengan standar tinggi untuk menghadirkan cita rasa yang konsisten di setiap cangkir.</p>
  </div>
  <div class="about-stats">
    <div class="rv"><p class="stat-num">15+</p><p class="stat-lbl">MENU PILIHAN</p></div>
    <div class="rv"><p class="stat-num">2025</p><p class="stat-lbl">BERDIRI SEJAK</p></div>
    <div class="rv"><p class="stat-num">100%</p><p class="stat-lbl">KOPI LOKAL</p></div>
  </div>
  <div class="features">
    <div class="feat rv"><p class="feat-title">Menu Digital</p><p class="feat-desc">Informasi menu tersedia online, mudah diakses kapan saja.</p></div>
    <div class="feat rv"><p class="feat-title">Stok Real-time</p><p class="feat-desc">Menu yang habis langsung diperbarui otomatis dari admin.</p></div>
    <div class="feat rv"><p class="feat-title">Tunai &amp; QRIS</p><p class="feat-desc">Bayar mudah dengan berbagai metode pembayaran pilihanmu.</p></div>
    <div class="feat rv"><p class="feat-title">Kopi Lokal</p><p class="feat-desc">Biji kopi pilihan dari petani lokal pilihan terbaik.</p></div>
  </div>
</section>

<footer class="footer" id="lokasi">
  <p>Waru, Penajam Paser Utara — Kalimantan Timur</p>
  <p>© 2025 Street 360 Coffee. All rights reserved.</p>
</footer>

<script>
(function(){
  const w=document.getElementById('coffeeDots');
  if(!w) return;
  for(let i=0;i<14;i++){
    const d=document.createElement('div');d.className='dot';
    const s=4+Math.random()*10;
    d.style.cssText=`width:${s}px;height:${s}px;left:${Math.random()*100}%;top:${20+Math.random()*70}%;animation-duration:${3+Math.random()*4}s;animation-delay:${Math.random()*3}s`;
    w.appendChild(d);
  }
})();
(function(){
  const io=new IntersectionObserver((entries)=>{
    entries.forEach((e,i)=>{if(e.isIntersecting){setTimeout(()=>e.target.classList.add('vis'),i*70);io.unobserve(e.target);}});
  },{threshold:0.1});
  document.querySelectorAll('.rv').forEach(el=>io.observe(el));
})();
document.querySelectorAll('.btn-login,.btn-all').forEach(btn=>{
  btn.addEventListener('click',e=>{
    const r=document.createElement('span');r.className='ripple';
    const rect=btn.getBoundingClientRect(),s=Math.max(rect.width,rect.height);
    r.style.cssText=`width:${s}px;height:${s}px;left:${e.clientX-rect.left-s/2}px;top:${e.clientY-rect.top-s/2}px`;
    btn.appendChild(r);setTimeout(()=>r.remove(),600);
  });
});
document.querySelectorAll('.menu-card').forEach(card=>{
  card.addEventListener('mousemove',e=>{
    const rect=card.getBoundingClientRect();
    const x=(e.clientX-rect.left)/rect.width-.5,y=(e.clientY-rect.top)/rect.height-.5;
    card.style.transform=`translateY(-5px) rotateX(${-y*5}deg) rotateY(${x*5}deg)`;
  });
  card.addEventListener('mouseleave',()=>card.style.transform='');
});
</script>
</body>
</html>