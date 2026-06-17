<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $settings['radio_name'] ?? 'Paraíso TV Digital')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        body { background: #f8fffd; }
        .grad-text { background: linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; font-weight:800; }
        .card-rp { background:#fff; border-radius:16px; box-shadow:0 4px 20px #00d4aa12; border:1px solid #e0faf5; }
        .btn-primary { background:linear-gradient(135deg,#00d4aa,#00b4d8); color:#fff; border:none; padding:12px 28px; border-radius:10px; font-size:14px; font-weight:700; cursor:pointer; box-shadow:0 4px 20px #00d4aa44; transition:transform 0.2s; display:inline-block; text-decoration:none; }
        .btn-primary:hover { transform:translateY(-2px); }
        .btn-outline { background:transparent; color:#fff; border:2px solid #fff; padding:12px 28px; border-radius:10px; font-size:14px; font-weight:700; cursor:pointer; transition:all 0.2s; display:inline-block; text-decoration:none; }
        .btn-outline:hover { background:#fff; color:#00d4aa; }
        .input-rp { width:100%; background:#f8fffd; border:1.5px solid #b2f0e0; border-radius:10px; padding:12px 16px; font-size:14px; color:#111; outline:none; transition:border-color 0.2s; }
        .input-rp:focus { border-color:#00d4aa; box-shadow:0 0 0 3px #00d4aa18; }
        .select-rp { width:100%; background:#f8fffd; border:1.5px solid #b2f0e0; border-radius:10px; padding:12px 16px; font-size:14px; color:#111; outline:none; }
        .section-title { font-size:11px; text-transform:uppercase; letter-spacing:2px; font-weight:800; background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
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
<div style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#48cae4,#f9c74f,#f8961e);" class="py-1.5 px-4 hidden md:flex justify-center gap-8">
    <span class="text-white text-xs font-semibold">🟢 Señal Online</span>
    <span class="text-white text-xs font-semibold">🎙 128kbps HD</span>
    <span class="text-white text-xs font-semibold">🌍 En vivo 24/7</span>
    <span class="text-white text-xs font-semibold">📡 Radio Digital</span>
</div>

{{-- NAVBAR --}}
<nav class="bg-white sticky top-0 z-50" style="border-bottom:3px solid transparent; border-image:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e) 1; box-shadow:0 2px 20px #00d4aa18;">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.png') }}" alt="{{ $settings['radio_name'] ?? 'Paraíso TV Digital' }}"
                 class="h-10 w-auto flex-shrink-0">
        </a>

        <div class="hidden md:flex items-center gap-8 text-sm">
            <a href="{{ route('home') }}"     class="text-gray-600 hover:text-teal-500 transition font-semibold">Inicio</a>
            <a href="{{ route('programs') }}" class="text-gray-600 hover:text-yellow-500 transition font-semibold">Programación</a>
            <a href="{{ route('contact') }}"  class="text-gray-600 hover:text-orange-500 transition font-semibold">Contacto</a>
        </div>

        <button onclick="togglePlay()"
            class="hidden md:flex items-center gap-2 text-white text-sm font-bold px-4 py-2 rounded-full"
            style="background:linear-gradient(135deg,#f8961e,#f9c74f);">
            <span id="nav-play-icon">▶</span> EN VIVO
        </button>

        <button class="md:hidden text-gray-400" @click="mobileMenu = !mobileMenu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <div x-show="mobileMenu" x-cloak class="md:hidden bg-white border-t px-4 py-3 space-y-1" style="border-color:#e0faf5;">
        <a href="{{ route('home') }}"     class="block py-2 text-gray-600 font-semibold">Inicio</a>
        <a href="{{ route('programs') }}" class="block py-2 text-gray-600 font-semibold">Programación</a>
        <a href="{{ route('contact') }}"  class="block py-2 text-gray-600 font-semibold">Contacto</a>
        <button onclick="togglePlay()" class="w-full text-left py-2 font-bold" style="color:#f8961e;">▶ EN VIVO</button>
    </div>
</nav>

{{-- MINI PLAYER --}}
<div class="fixed bottom-0 left-0 right-0 z-40 bg-white px-4 py-2.5 flex items-center gap-3"
     style="border-top:1px solid #e0faf5; box-shadow:0 -4px 20px #00d4aa0a;">
    <div class="absolute top-0 left-0 right-0 h-1"
         style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e,#90be6d);"></div>
    <button id="play-btn" onclick="togglePlay()"
        class="w-10 h-10 rounded-full flex items-center justify-center text-white text-sm flex-shrink-0"
        style="background:linear-gradient(135deg,#00d4aa,#00b4d8); box-shadow:0 3px 12px #00d4aa44;">▶</button>
    <div class="wave mr-1">
        <div class="wb"></div><div class="wb"></div><div class="wb"></div>
        <div class="wb"></div><div class="wb"></div>
    </div>
    <div class="flex-1 min-w-0">
        <p class="text-xs font-bold" style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
            🎵 EN VIVO — {{ $settings['radio_name'] ?? 'Radio Paraíso' }}
        </p>
        <p class="text-gray-400 text-xs truncate">{{ $settings['radio_slogan'] ?? 'Los Grandes Clásicos' }}</p>
    </div>
    <input type="range" id="volume" min="0" max="1" step="0.05" value="0.8"
           onchange="setVolume(this.value)" class="w-20 hidden sm:block accent-teal-400">
    <audio id="radio-audio" preload="none">
        <source src="{{ $settings['radio_stream'] ?? '' }}" type="audio/mpeg">
    </audio>
</div>

{{-- ALERTS --}}
<main class="pb-20">
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="px-4 py-3 rounded-xl text-sm font-semibold" style="background:#e0fff8; border:1.5px solid #00d4aa55; color:#00a896;">
            ✅ {{ session('success') }}
        </div>
    </div>
    @endif
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="bg-gray-900 text-white pb-20 pt-12" style="border-top:3px solid transparent; border-image:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e) 1;">
    <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-8 mb-8">
        <div>
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14 w-auto mb-3">
            <p class="text-gray-400 text-sm">{{ $settings['radio_slogan'] ?? 'Los Grandes Clásicos de la Música' }}</p>
        </div>
        <div>
            <h3 class="font-bold text-white mb-3 section-title">Navegación</h3>
            <div class="space-y-2">
                <a href="{{ route('home') }}"     class="block text-gray-400 hover:text-teal-400 text-sm transition">Inicio</a>
                <a href="{{ route('programs') }}" class="block text-gray-400 hover:text-yellow-400 text-sm transition">Programación</a>
                <a href="{{ route('contact') }}"  class="block text-gray-400 hover:text-orange-400 text-sm transition">Contacto</a>
            </div>
        </div>
        <div>
            <h3 class="font-bold text-white mb-3 section-title">Síguenos</h3>
            <div class="flex gap-3 flex-wrap">
                @if(!empty($settings['facebook']) && $settings['facebook'] !== '#')
                <a href="{{ $settings['facebook'] }}" target="_blank" class="w-9 h-9 rounded-full flex items-center justify-center text-white text-sm hover:scale-110 transition" style="background:#1877f2;">f</a>
                @endif
                @if(!empty($settings['instagram']) && $settings['instagram'] !== '#')
                <a href="{{ $settings['instagram'] }}" target="_blank" class="w-9 h-9 rounded-full flex items-center justify-center text-white text-sm hover:scale-110 transition" style="background:linear-gradient(135deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);">📸</a>
                @endif
                @if(!empty($settings['youtube']) && $settings['youtube'] !== '#')
                <a href="{{ $settings['youtube'] }}" target="_blank" class="w-9 h-9 rounded-full flex items-center justify-center text-white text-sm hover:scale-110 transition" style="background:#ff0000;">▶</a>
                @endif
                @if(!empty($settings['whatsapp']) && $settings['whatsapp'] !== '#')
                <a href="{{ $settings['whatsapp'] }}" target="_blank" class="w-9 h-9 rounded-full flex items-center justify-center text-white text-sm hover:scale-110 transition" style="background:#25d366;">💬</a>
                @endif
                @if(!empty($settings['tiktok']) && $settings['tiktok'] !== '#')
                <a href="{{ $settings['tiktok'] }}" target="_blank" class="w-9 h-9 rounded-full flex items-center justify-center text-white text-sm hover:scale-110 transition bg-black">🎵</a>
                @endif
            </div>
        </div>
    </div>
    <div class="border-t border-gray-800 pt-6 text-center">
        <p class="text-gray-500 text-xs">© {{ date('Y') }} {{ $settings['radio_name'] ?? 'Radio Paraíso TV Digital' }}. Todos los derechos reservados.</p>
    </div>
</footer>

<script>
const audio = document.getElementById('radio-audio');
const playBtn = document.getElementById('play-btn');
const navIcon = document.getElementById('nav-play-icon');
let playing = false;
function togglePlay() {
    if (playing) {
        audio.pause();
        playBtn.textContent = '▶';
        if(navIcon) navIcon.textContent = '▶';
        playing = false;
    } else {
        audio.play();
        playBtn.textContent = '⏸';
        if(navIcon) navIcon.textContent = '⏸';
        playing = true;
    }
}
function setVolume(v) { audio.volume = parseFloat(v); }
</script>
@stack('scripts')
</body>
</html>