@extends('layouts.app')
@section('title','Radio Paraíso TV Digital — Los Grandes Clásicos')
@section('content')

{{-- HERO --}}
<section class="relative py-20 text-center overflow-hidden"
         style="background:linear-gradient(160deg,#fff 0%,#f0fffc 40%,#f0fbff 70%,#fffde7 100%);">
    <div class="absolute rounded-full pointer-events-none"
         style="background:radial-gradient(circle,#00d4aa18,transparent 70%); width:300px; height:300px; top:-80px; left:-80px;"></div>
    <div class="absolute rounded-full pointer-events-none"
         style="background:radial-gradient(circle,#f9c74f18,transparent 70%); width:260px; height:260px; top:-60px; right:-60px;"></div>

    <div class="relative z-10 max-w-3xl mx-auto px-4">
        <div class="inline-flex items-center gap-2 bg-white px-5 py-2 rounded-full mb-6 text-sm font-semibold"
             style="border:2px solid #00d4aa55; color:#00a896; box-shadow:0 4px 15px #00d4aa18;">
            <span class="dot-live"></span> Transmitiendo en vivo 24/7
        </div>
        <h1 class="grad-text text-5xl md:text-6xl mb-3 leading-tight">Radio Paraíso TV Digital</h1>
        <p class="text-gray-600 text-xl mb-2 font-bold">🎵 Los Grandes Clásicos de la Música</p>
        <p class="text-gray-400 mb-10">Un viaje en el tiempo · 70s · 80s · 90s · En inglés y español</p>

        <div class="card-rp max-w-md mx-auto p-6 mb-8 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1.5"
                 style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>
            @if(isset($current_program) && $current_program)
                <p class="section-title mb-1">Ahora en vivo</p>
                <p class="font-black text-gray-800 text-lg mb-1">{{ $current_program->name }}</p>
                <p class="text-gray-400 text-sm mb-4">con {{ $current_program->host }}</p>
            @else
                <p class="section-title mb-4">Radio en Vivo 24/7</p>
            @endif
            <div class="flex items-center justify-center gap-4 mb-4">
                <button onclick="togglePlay()"
                    class="w-16 h-16 rounded-full text-white text-2xl flex items-center justify-center"
                    style="background:linear-gradient(135deg,#00d4aa,#00b4d8); box-shadow:0 6px 25px #00d4aa55;">▶</button>
                <div class="text-left">
                    <p class="text-sm font-bold text-gray-700">Escuchar Ahora</p>
                    <p class="text-xs text-gray-400">Haz clic para reproducir</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-gray-300">🔈</span>
                <input type="range" min="0" max="1" step="0.05" value="0.8"
                       onchange="setVolume(this.value)" class="flex-1 accent-teal-400">
                <span class="text-gray-300">🔊</span>
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('radio') }}" class="btn-primary">📻 Radio en Vivo</a>
            <a href="{{ route('tv') }}" class="btn-secondary">🎬 Ver Películas</a>
        </div>
    </div>
</section>

{{-- DÉCADAS --}}
<section class="bg-white border-y" style="border-color:#e0faf5;">
    <div class="max-w-7xl mx-auto grid grid-cols-3 divide-x" style="--tw-divide-opacity:1; border-color:#e0faf5;">
        <div class="py-6 text-center hover:bg-teal-50 transition cursor-pointer">
            <div class="text-2xl mb-2">🪩</div>
            <p class="text-3xl font-black" style="background:linear-gradient(135deg,#00d4aa,#48cae4); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">70s</p>
            <p class="text-gray-400 text-xs mt-1 font-semibold">Disco · Soul · Funk</p>
        </div>
        <div class="py-6 text-center hover:bg-yellow-50 transition cursor-pointer border-x" style="border-color:#e0faf5;">
            <div class="text-2xl mb-2">🎸</div>
            <p class="text-3xl font-black" style="background:linear-gradient(135deg,#f9c74f,#f8961e); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">80s</p>
            <p class="text-gray-400 text-xs mt-1 font-semibold">Rock · Pop · New Wave</p>
        </div>
        <div class="py-6 text-center hover:bg-green-50 transition cursor-pointer">
            <div class="text-2xl mb-2">💿</div>
            <p class="text-3xl font-black" style="background:linear-gradient(135deg,#90be6d,#43aa8b); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">90s</p>
            <p class="text-gray-400 text-xs mt-1 font-semibold">Baladas · Grunge</p>
        </div>
    </div>
</section>

{{-- NOTICIAS DESTACADAS --}}
@if(isset($featured_news) && $featured_news->count())
<section class="max-w-7xl mx-auto px-4 py-14">
    <div class="flex justify-between items-center mb-8">
        <div>
            <p class="section-title mb-1">Lo más reciente</p>
            <h2 class="text-2xl font-black text-gray-800">Noticias Destacadas</h2>
        </div>
        <a href="{{ route('news.index') }}" class="text-sm font-bold" style="color:#00d4aa;">Ver todas →</a>
    </div>
    <div class="grid md:grid-cols-3 gap-5">
        @foreach($featured_news as $article)
        <a href="{{ route('news.show', $article->slug) }}"
           class="card-rp overflow-hidden group hover:shadow-xl transition hover:-translate-y-1">
            @if($article->image)
            <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
                 class="w-full h-44 object-cover group-hover:scale-105 transition duration-500">
            @else
            <div class="w-full h-44 flex items-center justify-center text-5xl"
                 style="background:linear-gradient(135deg,#e0fff8,#e0f8ff);">🎵</div>
            @endif
            <div class="p-5">
                <span class="badge-teal">{{ $article->category ?? 'Noticias' }}</span>
                <h3 class="font-bold text-gray-800 mt-2 mb-2 group-hover:text-teal-500 transition line-clamp-2">{{ $article->title }}</h3>
                <p class="text-gray-400 text-sm line-clamp-2">{{ $article->excerpt }}</p>
            </div>
        </a>
        @endforeach
    </div>
</section>
@endif

{{-- PELÍCULAS DESTACADAS --}}
@if(isset($featured_videos) && $featured_videos->count())
<section class="bg-white border-t py-14" style="border-color:#e0faf5;">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="section-title mb-1">Videoteca</p>
                <h2 class="text-2xl font-black text-gray-800">🎬 Películas Destacadas</h2>
            </div>
            <a href="{{ route('tv') }}" class="text-sm font-bold" style="color:#f8961e;">Ver todas →</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            @foreach($featured_videos as $video)
            <a href="{{ route('tv') }}" class="card-rp overflow-hidden group hover:shadow-xl transition hover:-translate-y-1">
                <div class="relative">
                    <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/mqdefault.jpg"
                         alt="{{ $video->title }}" class="w-full h-32 object-cover">
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition"
                         style="background:rgba(0,212,170,0.3);">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-white"
                             style="background:linear-gradient(135deg,#00d4aa,#00b4d8);">▶</div>
                    </div>
                </div>
                <div class="p-3">
                    <p class="text-xs text-gray-700 font-semibold line-clamp-2">{{ $video->title }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- SECCIONES --}}
<section class="max-w-7xl mx-auto px-4 py-14">
    <p class="section-title text-center mb-2">¿Qué quieres hacer hoy?</p>
    <h2 class="text-2xl font-black text-gray-800 text-center mb-10">Explora Radio Paraíso</h2>
    <div class="grid md:grid-cols-3 gap-5">
        <a href="{{ route('radio') }}" class="card-rp p-6 text-center hover:shadow-xl transition hover:-translate-y-1 group">
            <div class="text-5xl mb-4">📻</div>
            <h3 class="font-black text-gray-800 text-lg mb-2 group-hover:text-teal-500 transition">Radio en Vivo</h3>
            <p class="text-gray-400 text-sm">Escucha en directo con chat en tiempo real</p>
        </a>
        <a href="{{ route('tv') }}" class="card-rp p-6 text-center hover:shadow-xl transition hover:-translate-y-1 group">
            <div class="text-5xl mb-4">🎬</div>
            <h3 class="font-black text-gray-800 text-lg mb-2 group-hover:text-yellow-500 transition">Películas</h3>
            <p class="text-gray-400 text-sm">Nuestra selección de películas clásicas</p>
        </a>
        <a href="{{ route('programs') }}" class="card-rp p-6 text-center hover:shadow-xl transition hover:-translate-y-1 group">
            <div class="text-5xl mb-4">📅</div>
            <h3 class="font-black text-gray-800 text-lg mb-2 group-hover:text-orange-500 transition">Programación</h3>
            <p class="text-gray-400 text-sm">Horarios de todos nuestros programas</p>
        </a>
    </div>
</section>
@endsection