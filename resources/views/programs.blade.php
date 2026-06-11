@extends('layouts.app')
@section('title', 'Programación — Radio Paraíso')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="font-display text-4xl font-bold text-gold mb-2">📅 Programación Semanal</h1>
    <p class="text-gray-400 mb-10">Horarios de todos nuestros programas. ¡No te pierdas ninguno!</p>

    {{-- Tabs de días --}}
    <div x-data="{ dia: '{{ strtolower(\Carbon\Carbon::now()->locale('es')->dayName) }}' }">

        {{-- Botones días --}}
        <div class="flex flex-wrap gap-2 mb-8">
            @foreach(['lunes','martes','miércoles','jueves','viernes','sábado','domingo'] as $day)
            <button
                @click="dia = '{{ $day }}'"
                :class="dia === '{{ $day }}' ? 'bg-gold text-radio' : 'border border-gold/30 text-gold hover:bg-gold/10'"
                class="px-4 py-2 rounded-full text-sm font-medium transition capitalize">
                {{ ucfirst($day) }}
            </button>
            @endforeach
        </div>

        {{-- Contenido por día --}}
        @foreach(['lunes','martes','miércoles','jueves','viernes','sábado','domingo'] as $day)
        <div x-show="dia === '{{ $day }}'" x-cloak>

            @php
                $dayPrograms = isset($programs) ? $programs->where('day', $day)->sortBy('start_time') : collect();
            @endphp

            @if($dayPrograms->isEmpty())
            <div class="text-center py-20 text-gray-500">
                <p class="text-5xl mb-4">🎵</p>
                <p class="text-lg">Música continua todo el día</p>
                <p class="text-sm mt-1">Los Grandes Clásicos sin parar</p>
            </div>
            @else
            <div class="space-y-4">
                @foreach($dayPrograms as $program)
                @php
                    $now = \Carbon\Carbon::now();
                    $isNow = $now->format('H:i:s') >= $program->start_time
                          && $now->format('H:i:s') <= $program->end_time
                          && strtolower($now->locale('es')->dayName) === $day;
                @endphp
                <div class="flex gap-4 items-start bg-radio-light border rounded-xl p-5 transition
                    {{ $isNow ? 'border-gold shadow-lg shadow-gold/10' : 'border-gold/20 hover:border-gold/40' }}">

                    {{-- Hora --}}
                    <div class="text-center min-w-[70px]">
                        <p class="text-gold font-bold text-sm">{{ substr($program->start_time, 0, 5) }}</p>
                        <p class="text-gray-500 text-xs">{{ substr($program->end_time, 0, 5) }}</p>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="font-display font-bold text-lg">{{ $program->name }}</h3>
                            @if($isNow)
                            <span class="bg-red-600 text-xs px-2 py-0.5 rounded-full animate-pulse">● EN VIVO</span>
                            @endif
                        </div>
                        @if($program->host)
                        <p class="text-gold/70 text-sm mb-1">con {{ $program->host }}</p>
                        @endif
                        @if($program->description)
                        <p class="text-gray-400 text-sm">{{ $program->description }}</p>
                        @endif
                    </div>

                    {{-- Imagen --}}
                    @if($program->image)
                    <img src="{{ Storage::url($program->image) }}" alt="{{ $program->name }}"
                         class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                    @else
                    <div class="w-16 h-16 bg-gold/10 rounded-lg flex items-center justify-center text-2xl flex-shrink-0">🎙</div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach

    </div>

    {{-- Nota al pie --}}
    <div class="mt-12 bg-radio-light border border-gold/20 rounded-xl p-6 text-center">
        <p class="text-gold font-semibold mb-1">📻 Fuera del horario programado</p>
        <p class="text-gray-400 text-sm">Disfruta de nuestra selección continua de Los Grandes Clásicos de los 70s, 80s y 90s</p>
        <a href="{{ route('radio') }}" class="inline-block mt-4 bg-gold text-radio px-6 py-2 rounded-full font-semibold hover:bg-gold-dark transition text-sm">
            Escuchar Ahora
        </a>
    </div>
</div>
@endsection