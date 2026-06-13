<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Radio Paraíso TV Digital')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.0/firebase-app.js";
        import { getFirestore }  from "https://www.gstatic.com/firebasejs/10.7.0/firebase-firestore.js";
        const firebaseConfig = {
            apiKey:            "{{ env('FIREBASE_API_KEY') }}",
            authDomain:        "{{ env('FIREBASE_AUTH_DOMAIN') }}",
            projectId:         "{{ env('FIREBASE_PROJECT_ID') }}",
            storageBucket:     "{{ env('FIREBASE_STORAGE_BUCKET') }}",
            messagingSenderId: "{{ env('FIREBASE_MESSAGING_SENDER_ID') }}",
            appId:             "{{ env('FIREBASE_APP_ID') }}"
        };
        window.firebaseApp = initializeApp(firebaseConfig);
        window.db = getFirestore(window.firebaseApp);
    </script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        body { background: #f8fffd; }
        .grad-text { background: linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; font-weight:800; }
        .grad-bg   { background: linear-gradient(135deg,#00d4aa,#00b4d8); }
        .card-rp   { background:#fff; border-radius:16px; box-shadow:0 4px 20px #00d4aa12; border:1px solid #e0faf5; }
        .btn-primary   { background:linear-gradient(135deg,#00d4aa,#00b4d8); color:#fff; border:none; padding:11px 24px; border-radius:10px; font-size:14px; font-weight:700; cursor:pointer; box-shadow:0 4px 20px #00d4aa44; transition:transform 0.2s; display:inline-block; text-decoration:none; }
        .btn-primary:hover { transform:translateY(-2px); }
        .btn-secondary { background:#fff; color:#f8961e; border:2px solid #f9c74f88; padding:11px 24px; border-radius:10px; font-size:14px; font-weight:700; cursor:pointer; transition:all 0.2s; display:inline-block; text-decoration:none; }
        .btn-secondary:hover { background:#fffbf0; border-color:#f8961e; transform:translateY(-2px); }
        .input-rp  { width:100%; background:#f8fffd; border:1.5px solid #b2f0e0; border-radius:10px; padding:12px 16px; font-size:14px; color:#111; outline:none; transition:border-color 0.2s; }
        .input-rp:focus { border-color:#00d4aa; box-shadow:0 0 0 3px #00d4aa18; }
        .select-rp { width:100%; background:#f8fffd; border:1.5px solid #b2f0e0; border-radius:10px; padding:12px 16px; font-size:14px; color:#111; outline:none; }
        .section-title { font-size:11px; text-transform:uppercase; letter-spacing:2px; font-weight:800; background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .badge-teal { background:#e0fff8; color:#00a896; border:1px solid #00d4aa44; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600; }
        .dot-live { width:8px; height:8px; border-radius:50%; background:#00d4aa; box-shadow:0 0 10px #00d4aa; animation:pulse-dot 1.2s infinite; display:inline-block; }
        @keyframes pulse-dot { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.4;transform:scale(0.6)} }
        .wave { display:flex; align-items:center; gap:2px; }
        .wb { width:3px; border-radius:2px; background:linear-gradient(180deg,#00d4aa,#00b4d8); animation:wave 1s ease-in-out infinite; }
        .wb:nth-child(1){height:8px;animation-delay:0s}
        .wb:nth-child(2){height:14px;animation-delay:0.1s}
        .wb:nth-child(3){height:10px;animation-delay:0.2s}
        .wb:nth-child(4){height:16px;animation-delay:0.3s}
        .wb:nth-child(5){height:8px;animation-delay:0.4s}
        @keyframes wave { 0%,100%{transform:scaleY(1)} 50%{transform:scaleY(0.4)} }
        ::-webkit-scrollbar { width:6px; }
        ::-webkit-scrollbar-thumb { background:#00d4aa; border-radius:3px; }
    </style>
    @stack('styles')
</head>
<body x-data="{ mobileMenu: false }">

{{-- TOP BAR --}}
<div style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#48cae4,#f9c74f,#f8961e);"
     class="py-1.5 px-4 hidden md:flex justify-center gap-8">
    <span class="text-white text-xs font-semibold">🟢 Señal Online</span>
    <span class="text-white text-xs font-semibold">🎙 128kbps HD</span>
    <span class="text-white text-xs font-semibold">🌍 En vivo 24/7</span>
    <span class="text-white text-xs font-semibold">📡 Radio Digital</span>
</div>

{{-- NAVBAR --}}
<nav class="bg-white sticky top-0 z-50"
     style="border-bottom:3px solid transparent; border-image:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e) 1; box-shadow:0 2px 20px #00d4aa18;">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-14">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-full flex items-center justify-center text-white text-xs font-black flex-shrink-0"
                 style="background:linear-gradient(135deg,#00d4aa,#00b4d8,#f9c74f); box-shadow:0 4px 15px #00d4aa44;">RP</div>
            <span class="grad-text text-base hidden sm:block">Radio Paraíso</span>
        </a>

        <div class="hidden md:flex items-center gap-5 text-sm">
            <a href="{{ route('home') }}"       class="text-gray-500 hover:text-teal-500 transition font-semibold">Inicio</a>
            <a href="{{ route('radio') }}"      class="text-gray-500 hover:text-teal-500 transition font-semibold">📻 Radio</a>
            <a href="{{ route('tv') }}"         class="text-gray-500 hover:text-yellow-500 transition font-semibold">🎬 Películas</a>
            <a href="{{ route('news.index') }}" class="text-gray-500 hover:text-orange-500 transition font-semibold">Noticias</a>
            <a href="{{ route('programs') }}"   class="text-gray-500 hover:text-cyan-500 transition font-semibold">Programación</a>
            <a href="{{ route('contact') }}"    class="text-gray-500 hover:text-teal-500 transition font-semibold">Contacto</a>
        </div>

        <div class="hidden md:flex items-center gap-3">
            @guest
                <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-teal-500 font-semibold transition">Entrar</a>
                <a href="{{ route('register') }}" class="text-sm text-white px-5 py-2 rounded-full font-bold"
                   style="background:linear-gradient(135deg,#00d4aa,#00b4d8); box-shadow:0 4px 15px #00d4aa44;">✨ Registro</a>
            @else
                @if(auth()->user()->isEditor())
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold" style="color:#00d4aa;">⚙️ Admin</a>
                @endif
                <span class="text-sm text-gray-500 font-semibold">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="text-sm text-red-400 hover:text-red-600 font-semibold transition">Salir</button>
                </form>
            @endguest
        </div>

        <button class="md:hidden text-gray-400" @click="mobileMenu = !mobileMenu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <div x-show="mobileMenu" x-cloak class="md:hidden bg-white border-t px-4 py-3 space-y-1"
         style="border-color:#e0faf5;">
        <a href="{{ route('home') }}"       class="block py-2 text-gray-500 font-semibold">Inicio</a>
        <a href="{{ route('radio') }}"      class="block py-2 text-gray-500 font-semibold">📻 Radio en Vivo</a>
        <a href="{{ route('tv') }}"         class="block py-2 text-gray-500 font-semibold">🎬 Películas</a>
        <a href="{{ route('news.index') }}" class="block py-2 text-gray-500 font-semibold">Noticias</a>
        <a href="{{ route('programs') }}"   class="block py-2 text-gray-500 font-semibold">Programación</a>
        <a href="{{ route('contact') }}"    class="block py-2 text-gray-500 font-semibold">Contacto</a>
        @guest
            <a href="{{ route('login') }}"    class="block py-2 text-gray-500 font-semibold">Entrar</a>
            <a href="{{ route('register') }}" class="block py-2 font-bold" style="color:#00d4aa;">✨ Registro</a>
        @endguest
    </div>
</nav>

{{-- MINI PLAYER --}}
<div class="fixed bottom-0 left-0 right-0 z-40 bg-white px-4 py-2.5 flex items-center gap-3"
     style="border-top:1px solid #e0faf5; box-shadow:0 -4px 20px #00d4aa0a;">
    <div class="absolute top-0 left-0 right-0 h-1"
         style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e,#90be6d);"></div>
    <button id="play-btn" onclick="togglePlay()"
        class="w-9 h-9 rounded-full flex items-center justify-center text-white text-sm flex-shrink-0"
        style="background:linear-gradient(135deg,#00d4aa,#00b4d8); box-shadow:0 3px 12px #00d4aa44;">▶</button>
    <div class="wave mr-1">
        <div class="wb"></div><div class="wb"></div><div class="wb"></div>
        <div class="wb"></div><div class="wb"></div>
    </div>
    <div class="flex-1 min-w-0">
        <p class="text-xs font-bold"
           style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
            🎵 EN VIVO — Radio Paraíso
        </p>
        <p class="text-gray-400 text-xs truncate">Los Grandes Clásicos · 70s · 80s · 90s</p>
    </div>
    <input type="range" id="volume" min="0" max="1" step="0.05" value="0.8"
           onchange="setVolume(this.value)" class="w-20 hidden sm:block accent-teal-400">
    <audio id="radio-audio" preload="none">
        <source src="https://TU_SERVIDOR_STREAMING:8000/radio" type="audio/mpeg">
    </audio>
</div>

{{-- CONTENIDO --}}
<main class="pb-20">
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="px-4 py-3 rounded-xl text-sm font-semibold"
             style="background:#e0fff8; border:1.5px solid #00d4aa55; color:#00a896;">
            ✅ {{ session('success') }}
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="px-4 py-3 rounded-xl text-sm font-semibold"
             style="background:#fff0f0; border:1.5px solid #f8961e55; color:#c8600a;">
            ❌ {{ session('error') }}
        </div>
    </div>
    @endif
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="bg-white border-t pb-20 pt-10 text-center" style="border-color:#e0faf5;">
    <div class="w-14 h-14 rounded-full flex items-center justify-center text-white font-black mx-auto mb-3"
         style="background:linear-gradient(135deg,#00d4aa,#00b4d8,#f9c74f); box-shadow:0 4px 20px #00d4aa33;">RP</div>
    <p class="grad-text text-xl mb-1">Radio Paraíso TV Digital</p>
    <p class="text-gray-400 text-sm mb-5">Los Grandes Clásicos de la Música · 70s · 80s · 90s</p>
    <div class="flex justify-center gap-5 mb-5 text-2xl">
        <a href="#" class="hover:scale-110 transition">📘</a>
        <a href="#" class="hover:scale-110 transition">📸</a>
        <a href="#" class="hover:scale-110 transition">🎬</a>
        <a href="#" class="hover:scale-110 transition">💬</a>
    </div>
    <div class="flex justify-center gap-6 text-xs text-gray-400 mb-4 font-semibold">
        <a href="{{ route('home') }}"       class="hover:text-teal-500 transition">Inicio</a>
        <a href="{{ route('radio') }}"      class="hover:text-teal-500 transition">Radio</a>
        <a href="{{ route('tv') }}"         class="hover:text-yellow-500 transition">Películas</a>
        <a href="{{ route('news.index') }}" class="hover:text-orange-500 transition">Noticias</a>
        <a href="{{ route('contact') }}"    class="hover:text-teal-500 transition">Contacto</a>
    </div>
    <p class="text-gray-300 text-xs">© {{ date('Y') }} Radio Paraíso TV Digital. Todos los derechos reservados.</p>
</footer>

<script>
const audio = document.getElementById('radio-audio');
const playBtn = document.getElementById('play-btn');
let playing = false;
function togglePlay() {
    if (playing) { audio.pause(); playBtn.textContent='▶'; playing=false; }
    else { audio.play(); playBtn.textContent='⏸'; playing=true; }
}
function setVolume(v) { audio.volume = parseFloat(v); }
</script>
@stack('scripts')
</body>
</html>