<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street 360.Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #27325c;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .gold-text {
            color: #d8a032;
        }
        
        .gold-bg {
            background-color: #dca331;
        }

        .gold-border {
            border-color: #dca331;
        }
        
        /* Drop shadow around logo */
        .logo-shadow {
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.5));
        }

    </style>
</head>
<body class="relative">

    <div class="flex flex-col items-center justify-center w-full px-6 max-w-sm mt-12 mx-auto">
        
        <!-- Logo Element -->
        <div class="mb-14 relative logo-shadow">
            <!-- Custom SVG to mimic the 360 logo -->
            <svg width="200" height="200" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Outer bold circle -->
                <circle cx="100" cy="100" r="92" stroke="#dcdcdc" stroke-width="12" />
                <!-- Inner curved arrow simulating 360 -->
                <path d="M 60 150 C 20 100 40 40 100 30 L 100 55 L 140 20 L 100 -15 L 100 10 C 10 20 -15 100 40 165 Z" fill="#dcdcdc" transform="scale(0.8) translate(15, 25)" />
                <path d="M 160 45 C 190 90 170 160 90 175 C 120 160 140 120 135 80 Z" fill="#dcdcdc" transform="scale(0.85) translate(8, 15)"/>
                <!-- Texts inside logo -->
                <text x="100" y="110" font-family="Inter" font-weight="900" font-size="44" fill="white" text-anchor="middle">360</text>
                <text x="143" y="85" font-family="Inter" font-weight="700" font-size="16" fill="white" text-anchor="middle">O</text>
                <text x="100" y="140" font-family="Inter" font-weight="700" font-size="18" fill="white" text-anchor="middle">Coffee</text>
            </svg>
        </div>

        <!-- SELAMAT DATANG header -->
        <div class="flex items-center gap-3 mb-4 w-full justify-center">
            <div class="h-[1px] w-12 gold-bg"></div>
            <p class="text-sm tracking-widest font-normal">SELAMAT DATANG</p>
            <div class="h-[1px] w-12 gold-bg"></div>
        </div>

        <!-- TITLE -->
        <h1 class="text-center font-black leading-tight flex flex-col mb-4">
            <span class="text-4xl text-white tracking-wide">STREET</span>
            <span class="text-[34px] gold-text tracking-wide">360.COFFEE</span>
        </h1>

        <!-- Description -->
        <p class="text-center text-[15px] font-normal leading-snug text-gray-100 mb-8 max-w-[280px]">
            Menyajikan kopi lokal dengan rasa yang nikmat sejak 2025
        </p>

        <!-- Divider bar -->
        <div class="flex items-center justify-center gap-3 w-full mb-10">
            <div class="h-[3px] w-24 gold-bg"></div>
            <div class="w-4 h-4 rounded-full gold-bg"></div>
            <div class="h-[3px] w-24 gold-bg"></div>
        </div>

        <!-- Button -->
        <a href="{{ route('home') }}" class="w-full gold-bg text-[#27325c] font-black text-xl py-4 rounded-md shadow-lg text-center mb-3">
            GET STARTED
        </a>

        <!-- Tap text -->
        <a href="{{ route('home') }}" class="text-[#8890ad] text-sm font-medium flex items-center gap-2 hover:text-white transition-colors">
            Tap Untuk Masuk 
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
        </a>
    </div>

</body>
</html>
