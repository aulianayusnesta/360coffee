<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Street.360.Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
        }
        body {
            min-width: 1280px;
            overflow-x: auto;
        }
    </style>
    <script>
        (function () {
            function fixZoom() {
                var scale = 1 / (window.devicePixelRatio || 1);
                // hanya aktif kalau user zoom browser (bukan layar HiDPI biasa)
                if (window.outerWidth && window.innerWidth) {
                    var browserZoom = window.outerWidth / window.innerWidth;
                    if (browserZoom !== 1) {
                        document.body.style.transform = 'scale(' + (1 / browserZoom) + ')';
                        document.body.style.transformOrigin = 'top left';
                        document.body.style.width = (window.innerWidth * browserZoom) + 'px';
                    } else {
                        document.body.style.transform = '';
                        document.body.style.width = '';
                    }
                }
            }

            window.addEventListener('resize', fixZoom);
            window.addEventListener('load', fixZoom);
        })();
    </script>
</head>
<body class="bg-gray-100">

<nav class="bg-amber-900 text-white px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">☕ Street.360.Coffee</h1>
    <div class="flex gap-4">
        @auth
            <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
            @if(auth()->user()->role == 'admin')
                <a href="/admin/menus" class="hover:underline">Admin</a>
            @elseif(auth()->user()->role == 'kasir')
                <a href="/kasir/pos" class="hover:underline">POS</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="hover:underline">Logout</button>
            </form>
        @else
            <a href="/login" class="hover:underline">Login</a>
        @endauth
    </div>
</nav>

<main class="p-6">
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>

</body>
</html>