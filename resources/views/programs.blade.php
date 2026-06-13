@extends('layouts.app')
@section('title','Programación — Radio Paraíso')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <p class="section-title mb-1">Horarios</p>
    <h1 class="text-3xl font-black text-gray-800 mb-2">📅 Programación Semanal</h1>
    <p class="text-gray-400 mb-10">Todos nuestros programas y sus horarios</p>

    <div x-data="{ dia: '{{ strtolower(\Carbon\Carbon::now()->locale('es')->dayName) }}' }">
        <div class="flex flex-wrap gap-2 mb-8">
            @foreach(['lunes','martes','miércoles','jueves','viernes','sábado','domingo'] as $day)
            <button @click="dia = '{{ $day }}'"
                :class="dia === '{{ $day }}' ? 'text-white' : 'text-gray-500 bg-white hover:border-teal-400'"
                :style="dia === '{{ $day }}' ? 'background:linear-gradient(135deg,#00d4aa,#00b4d8);border-color:transparent;box-shadow:0 4px 15px #00d4aa44;' : ''"
                class="px-4 py-2 rounded-full text-sm font-bold transition border capitalize"
                style="border-color:#e0faf5;">
                {{ ucfirst($day) }}
            </button>
            @endforeach
        </div>

        @foreach(['lunes','martes','miércoles','jueves','viernes','sábado','domingo'] as $day)
        <div x-show="dia === '{{ $day }}'" x-cloak>
            @php
                $dayPrograms = isset($programs) ? $programs->where('day',$day)->sortBy('start_time') : collect();
            @endphp
            @if($dayPrograms->isEmpty())
            <div class="text-center py-20">
                <p class="text-5xl mb-4">🎵</p>
                <p class="text-gray-600 text-lg font-bold">Música continua todo el día</p>
                <p class="text-gray-400 text-sm mt-1">Los Grandes Clásicos sin parar</p>
            </div>
            @else
            <div class="space-y-3">
                @foreach($dayPrograms as $program)
                @php
                    $now = \Carbon\Carbon::now();
                    $isNow = $now->format('H:i:s') >= $program->start_time
                          && $now->format('H:i:s') <= $program->end_time
                          && strtolower($now->locale('es')->dayName) === $day;
                @endphp
                <div class="card-rp flex gap-4 items-center p-5 transition hover:shadow-lg
                    {{ $isNow ? 'ring-2' : '' }}"
                    style="{{ $isNow ? 'ring-color:#00d4aa; border-top:3px solid #00d4aa;' : '' }}">
                    <div class="text-center min-w-[70px] flex-shrink-0">
                        <p class="font-bold text-sm" style="color:#00a896;">{{ substr($program->start_time,0,5) }}</p>
                        <p class="text-gray-400 text-xs">{{ substr($program->end_time,0,5) }}</p>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="font-black text-gray-800">{{ $program->name }}</h3>
                            @if($isNow)
                            <span class="inline-flex items-center gap-1 text-xs font-bold px-3 py-1 rounded-full text-white"
                                  style="background:linear-gradient(135deg,#00d4aa,#00b4d8);">
                                <span class="dot-live" style="width:6px;height:6px;"></span> EN VIVO
                            </span>
                            @endif
                        </div>
                        @if($program->host)
                        <p class="text-sm mt-0.5 font-semibold" style="color:#00a896;">con {{ $program->host }}</p>
                        @endif
                        @if($program->description)
                        <p class="text-gray-400 text-sm mt-1">{{ $program->description }}</p>
                        @endif
                    </div>
                    @if($program->image)
                    <img src="{{ Storage::url($program->image) }}" alt="{{ $program->name }}"
                         class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
                    @else
                    <div class="w-16 h-16 rounded-xl flex items-center justify-center text-2xl flex-shrink-0"
                         style="background:linear-gradient(135deg,#e0fff8,#e0f8ff);">🎙</div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>

    <div class="card-rp mt-12 p-6 text-center">
        <p class="section-title mb-1">Fuera del horario programado</p>
        <p class="text-gray-400 text-sm mb-4">Los Grandes Clásicos de los 70s, 80s y 90s sin parar</p>
        <a href="{{ route('radio') }}" class="btn-primary">📻 Escuchar Ahora</a>
    </div>
</div>
@endsection