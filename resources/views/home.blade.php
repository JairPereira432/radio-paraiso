@extends('layouts.app')
@section('title', ($settings['radio_name'] ?? 'Radio Paraíso') . ' — Los Grandes Clásicos')
@section('content')

{{-- SLIDER HERO --}}
<section class="relative overflow-hidden" style="min-height:90vh;"
         x-data="{ current: 0, total: {{ max(count($sliders), 1) }}, autoplay: null }"
         x-init="autoplay = setInterval(() => current = (current + 1) % total, 5000)">

    @if($sliders->count())
        @foreach($sliders as $i => $slide)
        <div x-show="current === {{ $i }}" x-cloak
             class="absolute inset-0 transition-opacity duration-1000"
             style="background: url('{{ Storage::url($slide->image) }}') center/cover no-repeat;">
            <div class="absolute inset-0" style="background:linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 60%, transparent 100%);"></div>
        </div>
        @endforeach
    @else
        <div class="absolute inset-0" style="background:linear-gradient(135deg,#0a2a1a 0%,#0d3b2e 40%,#1a4a3a 100%);"></div>
        <div class="absolute inset-0 opacity-10" style="background:radial-gradient(circle at 30% 50%, #00d4aa, transparent 60%), radial-gradient(circle at 70% 50%, #f9c74f, transparent 60%);"></div>
    @endif

    {{-- Contenido del hero --}}
    <div class="relative z-10 max-w-7xl mx-auto px-4 flex items-center" style="min-height:90vh;">
        <div class="max-w-2xl">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur px-4 py-2 rounded-full mb-6 text-sm font-semibold text-white border border-white/20">
                <span class="dot-live"></span> ONLINE · EN VIVO 24/7
            </div>

            @if($sliders->count())
                @foreach($sliders as $i => $slide)
                <div x-show="current === {{ $i }}" x-cloak>
                    <h1 class="text-6xl md:text-7xl font-black text-white mb-4 leading-tight">
                        {!! nl2br(e($slide->title ?? ($settings['radio_name'] ?? 'Radio Paraíso'))) !!}
                    </h1>
                    @if($slide->subtitle)
                    <p class="text-white/80 text-lg mb-8">{{ $slide->subtitle }}</p>
                    @endif
                    <div class="flex flex-wrap gap-3">
                        <button onclick="togglePlay()" class="btn-primary">🎙 Escuchar Radio</button>
                        @if($slide->button_text && $slide->button_url)
                        <a href="{{ $slide->button_url }}" class="btn-outline">{{ $slide->button_text }}</a>
                        @else
                        <a href="{{ route('programs') }}" class="btn-outline">📅 Ver Programación</a>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
            <h1 class="text-6xl md:text-7xl font-black text-white mb-4 leading-tight">
                <span style="color:#00d4aa;">RADIO</span><br>
                <span style="background:linear-gradient(90deg,#f9c74f,#f8961e); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">PARAÍSO</span>
            </h1>
            <p class="text-white/80 text-xl mb-2 font-semibold">{{ $settings['radio_slogan'] ?? 'Los Grandes Clásicos de la Música' }}</p>
            <p class="text-white/60 text-base mb-8">Un viaje en el tiempo · 70s · 80s · 90s</p>
            <div class="flex flex-wrap gap-3">
                <button onclick="togglePlay()" class="btn-primary">🎙 Escuchar Radio</button>
                <a href="{{ route('programs') }}" class="btn-outline">📅 Ver Programación</a>
            </div>
            @endif
        </div>

        {{-- Player card --}}
        <div class="hidden lg:block ml-auto">
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 w-72">
                <p class="text-white/60 text-xs font-bold uppercase tracking-widest mb-3">🎵 Transmitiendo Ahora</p>
                <div class="wave justify-center mb-4" style="height:40px;">
                    <div class="wb" style="height:20px;"></div>
                    <div class="wb" style="height:35px;"></div>
                    <div class="wb" style="height:25px;"></div>
                    <div class="wb" style="height:40px;"></div>
                    <div class="wb" style="height:30px;"></div>
                    <div class="wb" style="height:40px;"></div>
                    <div class="wb" style="height:20px;"></div>
                    <div class="wb" style="height:35px;"></div>
                </div>
                <div class="flex items-center gap-3 bg-white/10 rounded-xl p-3 mb-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl flex-shrink-0"
                         style="background:linear-gradient(135deg,#00d4aa,#00b4d8);">📻</div>
                    <div>
                        <p class="text-white font-bold text-sm">{{ $settings['radio_name'] ?? 'Radio Paraíso' }}</p>
                        <p class="text-white/60 text-xs">Online · EN VIVO</p>
                        @if($current_program)
                        <p class="text-teal-300 text-xs mt-0.5">{{ $current_program->name }}</p>
                        @endif
                    </div>
                </div>
                <button onclick="togglePlay()"
                    class="w-full py-3 rounded-xl text-white font-bold text-sm transition hover:opacity-90"
                    style="background:linear-gradient(135deg,#00d4aa,#00b4d8);">
                    ▶ Escuchar Ahora
                </button>
            </div>
        </div>
    </div>

    {{-- Controles del slider --}}
    @if($sliders->count() > 1)
    <button @click="current = (current - 1 + total) % total"
            class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white hover:bg-white/40 transition">‹</button>
    <button @click="current = (current + 1) % total"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white hover:bg-white/40 transition">›</button>
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex gap-2">
        @foreach($sliders as $i => $slide)
        <button @click="current = {{ $i }}"
                :class="current === {{ $i }} ? 'w-8 opacity-100' : 'w-2 opacity-50'"
                class="h-2 rounded-full transition-all duration-300"
                style="background:#00d4aa;"></button>
        @endforeach
    </div>
    @endif
</section>

{{-- QUIÉNES SOMOS --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-12 items-center">
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2 rounded-2xl p-6 text-white relative overflow-hidden"
                 style="background:linear-gradient(135deg,#f8961e,#f9c74f);">
                <div class="text-4xl mb-3">📻</div>
                <p class="font-black text-xl mb-1">DESDE 2004</p>
                <p class="text-white/80 text-sm">Conectando corazones a través de la música</p>
            </div>
            <div class="rounded-2xl p-5 text-white relative overflow-hidden"
                 style="background:linear-gradient(135deg,#00d4aa,#00b4d8);">
                <div class="text-3xl mb-2">🎯</div>
                <p class="font-black text-sm mb-1">MISIÓN</p>
                <p class="text-white/80 text-xs">Conectar comunidades a través de la música y el entretenimiento de calidad.</p>
            </div>
            <div class="rounded-2xl p-5 text-white relative overflow-hidden"
                 style="background:linear-gradient(135deg,#90be6d,#43aa8b);">
                <div class="text-3xl mb-2">🔭</div>
                <p class="font-black text-sm mb-1">VISIÓN</p>
                <p class="text-white/80 text-xs">Ser la emisora de referencia, reconocida por su calidad e innovación.</p>
            </div>
        </div>
        <div>
            <p class="section-title mb-2">Quiénes Somos</p>
            <h2 class="text-4xl font-black text-gray-800 mb-4 leading-tight">
                LA VOZ DE <span style="color:#f8961e;">NUESTRA</span> COMUNIDAD
            </h2>
            <p class="text-gray-500 mb-4 leading-relaxed">
                Somos la emisora líder de la región, con más de 20 años llevando la mejor música,
                noticias y entretenimiento a todos los hogares.
            </p>
            <ul class="space-y-2 mb-6">
                @foreach(['Programación variada para toda la familia','Los Grandes Clásicos de los 70s, 80s y 90s','Música en vivo las 24 horas del día','Transmisión online en alta calidad','Comprometidos con nuestra comunidad'] as $item)
                <li class="flex items-center gap-2 text-gray-600 text-sm">
                    <span class="w-2 h-2 rounded-full flex-shrink-0" style="background:#00d4aa;"></span>
                    {{ $item }}
                </li>
                @endforeach
            </ul>
            <a href="{{ route('contact') }}" class="btn-primary">📞 Contáctanos</a>
        </div>
    </div>
</section>

{{-- PROGRAMA ACTUAL --}}
@if($current_program)
<section class="py-12" style="background:linear-gradient(135deg,#f0fffc,#fffde7);">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <p class="section-title mb-2">Ahora en vivo</p>
        <h2 class="text-3xl font-black text-gray-800 mb-2">{{ $current_program->name }}</h2>
        @if($current_program->host)
        <p class="text-gray-500 mb-1">con <span class="font-bold" style="color:#00d4aa;">{{ $current_program->host }}</span></p>
        @endif
        <p class="text-gray-400 text-sm mb-6">{{ substr($current_program->start_time,0,5) }} — {{ substr($current_program->end_time,0,5) }}</p>
        <button onclick="togglePlay()" class="btn-primary">🎙 Escuchar Ahora</button>
    </div>
</section>
@endif

{{-- DÉCADAS --}}
<section class="bg-white border-y py-16" style="border-color:#e0faf5;">
    <div class="max-w-7xl mx-auto px-4">
        <p class="section-title text-center mb-2">Nuestra Música</p>
        <h2 class="text-3xl font-black text-gray-800 text-center mb-10">Las Décadas Doradas</h2>
        <div class="grid grid-cols-3 gap-5">
            <div class="card-rp p-6 text-center hover:shadow-xl transition hover:-translate-y-1 cursor-pointer">
                <div class="text-4xl mb-3">🪩</div>
                <p class="text-4xl font-black mb-2" style="background:linear-gradient(135deg,#00d4aa,#48cae4); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">70s</p>
                <p class="text-gray-400 text-sm font-semibold">Disco · Soul · Funk</p>
            </div>
            <div class="card-rp p-6 text-center hover:shadow-xl transition hover:-translate-y-1 cursor-pointer">
                <div class="text-4xl mb-3">🎸</div>
                <p class="text-4xl font-black mb-2" style="background:linear-gradient(135deg,#f9c74f,#f8961e); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">80s</p>
                <p class="text-gray-400 text-sm font-semibold">Rock · Pop · New Wave</p>
            </div>
            <div class="card-rp p-6 text-center hover:shadow-xl transition hover:-translate-y-1 cursor-pointer">
                <div class="text-4xl mb-3">💿</div>
                <p class="text-4xl font-black mb-2" style="background:linear-gradient(135deg,#90be6d,#43aa8b); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">90s</p>
                <p class="text-gray-400 text-sm font-semibold">Baladas · Grunge</p>
            </div>
        </div>
    </div>
</section>

@endsection