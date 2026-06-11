@extends('layouts.app')
@section('title', 'Radio Paraíso TV Digital — Los Grandes Clásicos')

@section('content')

{{-- ══ HERO ════════════════════════════════════════════════ --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden"
         style="background: radial-gradient(ellipse at center, #2d0a52 0%, #1a0533 60%, #000 100%);">

    {{-- Partículas decorativas --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        @for($i = 0; $i < 20; $i++)
        <div class="absolute w-1 h-1 bg-gold/30 rounded-full animate-ping"
             style="left: {{ rand(0,100) }}%; top: {{ rand(0,100) }}%;
                    animation-delay: {{ $i * 0.3 }}s; animation-duration: {{ rand(2,5) }}s;"></div>
        @endfor
    </div>

    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
        <p class="text-gold/70 text-sm font-medium uppercase tracking-widest mb-4">🎙 Transmitiendo en vivo</p>
        <h1 class="font-display text-5xl md:text-7xl font-black text-white mb-4 leading-tight">
            Radio Paraíso<br><span class="text-gold">TV Digital</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 mb-2">Los Grandes Clásicos de la Música</p>
        <p class="text-gray-400 mb-10 max-w-2xl mx-auto">
            Un viaje en el tiempo a través de las canciones que marcaron tu vida.
            Escucha en directo la mejor selección de los 70s, 80s y 90s.
        </p>

        {{-- Player principal --}}
        <div class="bg-white/10 backdrop-blur-md border border-gold/30 rounded-2xl p-6 max-w-lg mx-auto mb-8">
            @if($current_program)
            <p class="text-gold text-xs mb-1 uppercase tracking-wider">Ahora en vivo</p>
            <p class="font-display text-xl font-bold mb-1">{{ $current_program->name }}</p>
            <p class="text-gray-400 text-sm mb-4">con {{ $current_program->host }}</p>
            @else
            <p class="text-gold text-xs mb-4 uppercase tracking-wider">Radio en Vivo 24/7</p>
            @endif

            <div class="flex items-center justify-center gap-4">
                <button onclick="togglePlay()"
                    class="w-16 h-16 bg-gold text-radio rounded-full flex items-center justify-center text-2xl hover:bg-gold-dark transition transform hover:scale-105 shadow-lg shadow-gold/30">
                    ▶
                </button>
                <div class="text-left">
                    <p class="text-sm font-medium">Escuchar Ahora</p>
                    <p class="text-xs text-gray-400" id="hero-status">Haz clic para reproducir</p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('radio') }}"
               class="bg-gold text-radio px-8 py-3 rounded-full font-semibold hover:bg-gold-dark transition">
                📻 Radio en Vivo
            </a>
            <a href="{{ route('tv') }}"
               class="border border-gold/50 text-gold px-8 py-3 rounded-full font-semibold hover:bg-gold/10 transition">
                📺 Ver TV/Video
            </a>
        </div>
    </div>
</section>

{{-- ══ NOTICIAS DESTACADAS ══════════════════════════════════ --}}
@if($featured_news->count())
<section class="max-w-7xl mx-auto px-4 py-16">
    <h2 class="font-display text-3xl font-bold text-gold mb-8">Noticias Destacadas</h2>
    <div class="grid md:grid-cols-3 gap-6">
        @foreach($featured_news as $article)
        <a href="{{ route('news.show', $article->slug) }}"
           class="group bg-radio-light border border-gold/20 rounded-xl overflow-hidden hover:border-gold/50 transition">
            @if($article->image)
            <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
                 class="w-full h-44 object-cover group-hover:scale-105 transition duration-500">
            @else
            <div class="w-full h-44 bg-gradient-to-br from-radio-light to-radio flex items-center justify-center text-4xl">🎵</div>
            @endif
            <div class="p-4">
                <span class="text-gold text-xs uppercase tracking-wider">{{ $article->category ?? 'Noticias' }}</span>
                <h3 class="font-display font-bold mt-1 mb-2 group-hover:text-gold transition line-clamp-2">{{ $article->title }}</h3>
                <p class="text-gray-400 text-sm line-clamp-2">{{ $article->excerpt }}</p>
            </div>
        </a>
        @endforeach
    </div>
</section>
@endif

{{-- ══ VIDEOS DESTACADOS ════════════════════════════════════ --}}
@if($featured_videos->count())
<section class="bg-black/30 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="font-display text-3xl font-bold text-gold">📺 Videos Populares</h2>
            <a href="{{ route('tv') }}" class="text-gold text-sm hover:underline">Ver todos →</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($featured_videos as $video)
            <a href="{{ route('tv') }}#video-{{ $video->id }}"
               class="group relative rounded-xl overflow-hidden bg-radio-light border border-gold/20 hover:border-gold/50 transition">
                <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/mqdefault.jpg"
                     alt="{{ $video->title }}" class="w-full h-32 object-cover">
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                    <span class="text-4xl">▶</span>
                </div>
                <div class="p-3">
                    <p class="text-xs font-medium line-clamp-2">{{ $video->title }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══ ÉPOCAS / GÉNEROS ════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-16 text-center">
    <h2 class="font-display text-3xl font-bold mb-10">Un viaje por las décadas doradas</h2>
    <div class="grid grid-cols-3 gap-4 md:gap-8 max-w-2xl mx-auto">
        @foreach([['70s','🪩','Disco, Soul & Funk'],['80s','🎸','Rock, Pop & New Wave'],['90s','💿','Baladas & Grunge']] as [$decade,$icon,$desc])
        <div class="bg-radio-light border border-gold/20 rounded-2xl p-6 hover:border-gold transition cursor-pointer">
            <div class="text-4xl mb-2">{{ $icon }}</div>
            <p class="font-display text-2xl font-black text-gold">{{ $decade }}</p>
            <p class="text-gray-400 text-xs mt-1">{{ $desc }}</p>
        </div>
        @endforeach
    </div>
</section>

@endsection