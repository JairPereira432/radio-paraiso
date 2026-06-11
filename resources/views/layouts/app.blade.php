<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Radio Paraíso TV Digital')</title>
    <meta name="description" content="Los Grandes Clásicos de la Música - 70s, 80s y 90s">

    {{-- TailwindCSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold:  { DEFAULT: '#D4A843', dark: '#B8882A' },
                        radio: { DEFAULT: '#1a0533', light: '#2d0a52' },
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'serif'],
                        body:    ['"Inter"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Alpine.js --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Firebase SDK --}}
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

    @stack('styles')
</head>
<body class="bg-radio text-white font-body" x-data="{ mobileMenu: false }">

{{-- ══ NAVBAR ══════════════════════════════════════════════ --}}
<nav class="bg-radio-light border-b border-gold/30 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="w-10 h-10 bg-gold rounded-full flex items-center justify-center text-radio font-black text-sm">RP</div>
            <span class="font-display text-gold font-bold text-lg hidden sm:block">Radio Paraíso</span>
        </a>

        {{-- Nav Links (desktop) --}}
        <div class="hidden md:flex items-center gap-6 text-sm font-medium">
            <a href="{{ route('home') }}"     class="hover:text-gold transition">Inicio</a>
            <a href="{{ route('radio') }}"    class="hover:text-gold transition">📻 Radio en Vivo</a>
            <a href="{{ route('tv') }}"       class="hover:text-gold transition">📺 TV/Video</a>
            <a href="{{ route('news.index')}}" class="hover:text-gold transition">Noticias</a>
            <a href="{{ route('programs') }}" class="hover:text-gold transition">Programación</a>
            <a href="{{ route('contact') }}"  class="hover:text-gold transition">Contacto</a>
        </div>

        {{-- Auth Buttons --}}
        <div class="hidden md:flex items-center gap-3">
            @guest
                <a href="{{ route('login') }}"    class="text-sm hover:text-gold transition">Entrar</a>
                <a href="{{ route('register') }}" class="bg-gold text-radio px-4 py-1.5 rounded-full text-sm font-semibold hover:bg-gold-dark transition">Registro</a>
            @else
                @if(auth()->user()->isEditor())
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gold hover:underline">Panel Admin</a>
                @endif
                <span class="text-sm text-gray-300">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="text-sm text-red-400 hover:text-red-300">Salir</button>
                </form>
            @endguest
        </div>

        {{-- Hamburger --}}
        <button class="md:hidden" @click="mobileMenu = !mobileMenu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenu" x-cloak class="md:hidden bg-radio-light border-t border-gold/20 px-4 py-3 space-y-2 text-sm">
        <a href="{{ route('home') }}"      class="block py-2 hover:text-gold">Inicio</a>
        <a href="{{ route('radio') }}"     class="block py-2 hover:text-gold">📻 Radio en Vivo</a>
        <a href="{{ route('tv') }}"        class="block py-2 hover:text-gold">📺 TV/Video</a>
        <a href="{{ route('news.index')}}" class="block py-2 hover:text-gold">Noticias</a>
        <a href="{{ route('programs') }}"  class="block py-2 hover:text-gold">Programación</a>
        <a href="{{ route('contact') }}"   class="block py-2 hover:text-gold">Contacto</a>
        @guest
            <a href="{{ route('login') }}"    class="block py-2 hover:text-gold">Entrar</a>
            <a href="{{ route('register') }}" class="block py-2 text-gold font-semibold">Registro</a>
        @endguest
    </div>
</nav>

{{-- ══ MINI PLAYER fijo en el fondo ═══════════════════════ --}}
<div id="mini-player" class="fixed bottom-0 left-0 right-0 bg-radio-light border-t border-gold/30 z-40 px-4 py-2 flex items-center gap-3">
    <button id="play-btn" onclick="togglePlay()"
        class="w-10 h-10 bg-gold text-radio rounded-full flex items-center justify-center font-bold text-lg flex-shrink-0">▶</button>
    <div class="flex-1 min-w-0">
        <p class="text-gold text-xs font-semibold">🎵 EN VIVO — Radio Paraíso</p>
        <p id="now-playing" class="text-gray-300 text-xs truncate">Los Grandes Clásicos</p>
    </div>
    <div class="flex items-center gap-2">
        <input type="range" id="volume" min="0" max="1" step="0.05" value="0.8"
            onchange="setVolume(this.value)"
            class="w-20 accent-gold hidden sm:block">
    </div>
    <audio id="radio-audio" preload="none">
        {{-- Cambia esta URL por tu stream real de Icecast/Shoutcast --}}
        <source src="https://TU_SERVIDOR_STREAMING:8000/radio" type="audio/mpeg">
    </audio>
</div>

{{-- ══ CONTENIDO ══════════════════════════════════════════ --}}
<main class="pb-20">
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-800/50 border border-green-500 text-green-200 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @yield('content')
</main>

{{-- ══ FOOTER ══════════════════════════════════════════════ --}}
<footer class="bg-black/50 border-t border-gold/20 py-10 pb-24 text-center text-sm text-gray-400">
    <p class="font-display text-gold text-xl mb-2">Radio Paraíso TV Digital</p>
    <p class="mb-4">Los Grandes Clásicos de la Música · 70s · 80s · 90s</p>
    <div class="flex justify-center gap-6 mb-4 text-2xl">
        <a href="#" title="Facebook"  class="hover:scale-110 transition">📘</a>
        <a href="#" title="Instagram" class="hover:scale-110 transition">📸</a>
        <a href="#" title="YouTube"   class="hover:scale-110 transition">🎬</a>
        <a href="#" title="WhatsApp"  class="hover:scale-110 transition">💬</a>
    </div>
    <p>© {{ date('Y') }} Radio Paraíso TV Digital. Todos los derechos reservados.</p>
</footer>

{{-- ══ SCRIPTS GLOBALES ════════════════════════════════════ --}}
<script>
const audio = document.getElementById('radio-audio');
const playBtn = document.getElementById('play-btn');
let playing = false;

function togglePlay() {
    if (playing) {
        audio.pause();
        playBtn.textContent = '▶';
        playing = false;
    } else {
        audio.play();
        playBtn.textContent = '⏸';
        playing = true;
    }
}

function setVolume(v) {
    audio.volume = parseFloat(v);
}
</script>

@stack('scripts')
</body>
</html>