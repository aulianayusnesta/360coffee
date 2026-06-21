<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street 360.coffee</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --navy2: #0f1f55;
            --gold:  #d4a843;
            --gold2: #f0c96a;
            --gold3: #a87c28;
            --white: #ffffff;
            --font:  'Poppins', sans-serif;
        }
        html, body { height: 100%; font-family: var(--font); overflow: hidden; }
        body {
            background:
                radial-gradient(ellipse 100% 55% at 50% 0%,   #253a9a 0%, transparent 65%),
                radial-gradient(ellipse 55%  45% at 5%  100%, #1a2d6b 0%, transparent 60%),
                radial-gradient(ellipse 55%  45% at 95% 80%,  #0f1f55 0%, transparent 60%),
                linear-gradient(170deg, #1e3080 0%, #162360 35%, #0e1a50 70%, #090f35 100%);
            color: var(--white); position: relative;
        }

        .stars { position:fixed; inset:0; pointer-events:none; z-index:0; }
        .star  { position:absolute; border-radius:50%; background:rgba(255,255,255,0.8); animation:twinkle ease-in-out infinite; }
        @keyframes twinkle { 0%,100%{opacity:.15;transform:scale(1)} 50%{opacity:1;transform:scale(1.5)} }

        .particles { position:fixed; inset:0; pointer-events:none; z-index:0; overflow:hidden; }
        .p { position:absolute; border-radius:50%; background:rgba(212,168,67,0.13); animation:pF linear infinite; }
        @keyframes pF { 0%{transform:translateY(110vh);opacity:0} 10%{opacity:.5} 90%{opacity:.2} 100%{transform:translateY(-10vh);opacity:0} }

        .ambient {
            position:fixed; top:-80px; left:50%; transform:translateX(-50%);
            width:700px; height:340px;
            background:radial-gradient(ellipse,rgba(80,120,255,.18) 0%,transparent 70%);
            pointer-events:none; z-index:0; animation:ambP 5s ease-in-out infinite;
        }
        @keyframes ambP { 0%,100%{opacity:.5} 50%{opacity:1} }

        .splash {
            min-height:100dvh; display:flex; flex-direction:column;
            align-items:center; justify-content:center;
            padding:clamp(20px,4vh,44px) 32px; text-align:center; gap:0;
            position:relative; z-index:1;
        }

        /* ── LOGO ── */
        .logo-wrap {
            width:clamp(150px,26vh,210px);
            height:clamp(150px,26vh,210px);
            margin-bottom:clamp(20px,3vh,36px);
            animation:fadeDown .9s cubic-bezier(.22,1,.36,1) both;
            position:relative;
            display:flex; align-items:center; justify-content:center;
        }
        .logo-wrap::before {
            content:''; position:absolute; inset:-18px; border-radius:50%;
            background:radial-gradient(circle,rgba(140,170,255,.22) 0%,transparent 68%);
            animation:glowP 3.5s ease-in-out infinite;
            z-index:0;
        }
        @keyframes glowP { 0%,100%{transform:scale(1);opacity:.6} 50%{transform:scale(1.18);opacity:1} }
        .logo-wrap img {
            width:100%; height:100%; object-fit:contain;
            position:relative; z-index:1;
            filter:drop-shadow(0 8px 20px rgba(0,0,0,0.45));
        }

        /* ── WELCOME ── */
        .welcome-row {
            display:flex; align-items:center; gap:14px;
            margin-bottom:clamp(8px,1.5vh,14px);
            animation:fadeUp .8s .2s cubic-bezier(.22,1,.36,1) both;
        }
        .welcome-line { flex:1; height:1px; background:linear-gradient(90deg,transparent,var(--gold2),transparent); max-width:70px; }
        .welcome-text { font-size:11px; font-weight:700; color:var(--gold2); letter-spacing:4px; text-transform:uppercase; }

        /* ── BRAND ── */
        .brand {
            margin-bottom:clamp(8px,1.5vh,14px); line-height:1;
            animation:fadeUp .8s .35s cubic-bezier(.22,1,.36,1) both;
        }
        .brand-street {
            display:block; font-size:clamp(36px,8vw,58px); font-weight:900;
            color:var(--white); letter-spacing:5px; text-transform:uppercase;
            text-shadow:0 2px 20px rgba(255,255,255,.15);
        }
        .brand-360 {
            display:block; font-size:clamp(40px,9vw,64px); font-weight:900;
            background:linear-gradient(135deg,var(--gold2) 0%,var(--gold) 50%,var(--gold3) 100%);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
            letter-spacing:5px; text-transform:uppercase;
            filter:drop-shadow(0 2px 14px rgba(212,168,67,.5));
        }

        /* ── TAGLINE ── */
        .tagline {
            font-size:clamp(13px,3vw,15px); font-weight:500;
            color:rgba(255,255,255,.6); line-height:1.75; max-width:300px;
            margin-bottom:clamp(16px,2.5vh,28px);
            animation:fadeUp .8s .5s cubic-bezier(.22,1,.36,1) both;
        }

        /* ── DIVIDER ── */
        .divider {
            display:flex; align-items:center; gap:12px;
            margin-bottom:clamp(20px,3.5vh,36px); width:100%; max-width:300px;
            animation:fadeUp .8s .6s cubic-bezier(.22,1,.36,1) both;
        }
        .divider-line { flex:1; height:1px; background:linear-gradient(90deg,transparent,rgba(212,168,67,.55),transparent); }
        .divider-dot {
            width:8px; height:8px; background:var(--gold2); border-radius:50%;
            animation:dotP 2s ease-in-out infinite;
        }
        @keyframes dotP { 0%,100%{box-shadow:0 0 8px rgba(240,201,106,.5)} 50%{box-shadow:0 0 22px rgba(240,201,106,1)} }

        /* ── BUTTON ── */
        .btn-wrap { width:100%; max-width:360px; animation:fadeUp .8s .75s cubic-bezier(.22,1,.36,1) both; }
        .btn-start {
            display:block; width:100%; padding:20px;
            background:linear-gradient(135deg,#f5ca5e 0%,#d4a843 55%,#b8882a 100%);
            color:var(--navy2); font-family:var(--font);
            font-size:17px; font-weight:900; letter-spacing:3px; text-transform:uppercase;
            text-decoration:none; border-radius:14px; margin-bottom:16px;
            box-shadow:0 6px 30px rgba(212,168,67,.5),0 1px 0 rgba(255,255,255,.2) inset;
            transition:transform .2s,box-shadow .2s; position:relative; overflow:hidden;
        }
        .btn-start::before {
            content:''; position:absolute; top:0; left:-120%; width:60%; height:100%;
            background:linear-gradient(90deg,transparent,rgba(255,255,255,.35),transparent);
            animation:shimmer 2.8s ease-in-out infinite;
        }
        @keyframes shimmer { 0%{left:-120%} 55%,100%{left:160%} }
        .btn-start:hover { transform:translateY(-3px); box-shadow:0 14px 40px rgba(212,168,67,.65); }
        .btn-start:active { transform:scale(.97); }

        .tap-text {
            font-size:13px; font-weight:500; color:rgba(255,255,255,.4);
            display:flex; align-items:center; justify-content:center; gap:8px;
        }
        .tap-arrow { display:inline-block; animation:slideR 1.4s ease-in-out infinite; }
        @keyframes slideR   { 0%,100%{transform:translateX(0)} 50%{transform:translateX(7px)} }
        @keyframes fadeDown { from{opacity:0;transform:translateY(-30px)} to{opacity:1;transform:translateY(0)} }
        @keyframes fadeUp   { from{opacity:0;transform:translateY(24px)}  to{opacity:1;transform:translateY(0)} }

        @media(min-width:768px){
            .logo-wrap{width:clamp(180px,24vh,220px);height:clamp(180px,24vh,220px);}
        }
    </style>
</head>
<body>

<div class="ambient"></div>
<div class="stars"     id="stars"></div>
<div class="particles" id="particles"></div>

<div class="splash">

    <div class="logo-wrap">
        <img src="{{ asset('logo-360.png') }}" alt="Street 360 Coffee">
    </div>

    <div class="welcome-row">
        <span class="welcome-line"></span>
        <span class="welcome-text">Selamat Datang</span>
        <span class="welcome-line"></span>
    </div>

    <div class="brand">
        <span class="brand-street">STREET</span>
        <span class="brand-360">360.COFFEE</span>
    </div>

    <p class="tagline">Menyajikan kopi lokal dengan rasa yang nikmat sejak 2025</p>

    <div class="divider">
        <span class="divider-line"></span>
        <span class="divider-dot"></span>
        <span class="divider-line"></span>
    </div>

    <div class="btn-wrap">
        <a href="{{ route('home') }}" class="btn-start">GET STARTED</a>
        <p class="tap-text">Tap Untuk Masuk <span class="tap-arrow">→</span></p>
    </div>

</div>

<script>
(function(){
    var w=document.getElementById('stars');
    [[3,8,12,2.5],[2,18,7,3],[4,28,15,1.8],[2,38,5,3.5],[3,48,18,2],
     [2,55,9,4],[3,65,14,2.2],[2,75,6,3.8],[4,85,11,1.5],[2,92,16,3],
     [3,15,85,2.8],[2,25,78,4],[4,42,90,1.9],[2,58,82,3.2],[3,72,88,2.5],
     [2,82,75,3.7],[3,5,55,2],[2,95,60,4.2],[3,35,42,2.6],[2,88,35,3.4],
     [3,50,70,1.7],[2,20,50,4.5],[2,70,30,2.3],[2,10,30,3.6]
    ].forEach(function(d){
        var s=document.createElement('div'); s.className='star';
        s.style.cssText='width:'+d[0]+'px;height:'+d[0]+'px;left:'+d[1]+'%;top:'+d[2]+'%;'
            +'animation-duration:'+d[3]+'s;animation-delay:'+(Math.random()*3)+'s';
        w.appendChild(s);
    });
})();
(function(){
    var w=document.getElementById('particles');
    [6,10,8,14,5,11,7,15,9,10,6,8,12].forEach(function(s,i){
        var d=document.createElement('div'); d.className='p';
        d.style.cssText='width:'+s+'px;height:'+s+'px;'
            +'left:'+[5,12,20,30,40,50,60,70,78,86,22,45,65][i]+'%;'
            +'animation-duration:'+[7,10,9,12,8,11,13,9,8,10,14,7,11][i]+'s;'
            +'animation-delay:'+[0,1.5,3,0.5,2,4,1,3.5,2.5,0.8,1.8,4.5,2.2][i]+'s';
        w.appendChild(d);
    });
})();
</script>
</body>
</html>