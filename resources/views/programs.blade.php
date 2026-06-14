@extends('layouts.app')
@section('title', 'Programación — ' . ($settings['radio_name'] ?? 'Radio Paraíso'))
@section('content')

{{-- HERO --}}
<section class="py-16 text-center relative overflow-hidden"
         style="background:linear-gradient(135deg,#0a2a1a 0%,#0d3b2e 100%);">
    <div class="absolute inset-0 opacity-20"
         style="background:radial-gradient(circle at 30% 50%,#00d4aa,transparent 60%),radial-gradient(circle at 70% 50%,#f9c74f,transparent 60%);"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-4">
        <p class="section-title mb-2">Programación</p>
        <h1 class="text-4xl md:text-5xl font-black text-white mb-3">NUESTRA PARRILLA DE CONTENIDOS</h1>
        <p class="text-white/60">Encuentra tu programa favorito y no te pierdas ningún momento</p>
    </div>
</section>

{{-- PROGRAMACIÓN --}}
<section class="max-w-4xl mx-auto px-4 py-14" x-data="{ tab: 'lv' }">

    {{-- Tabs --}}
    <div class="flex flex-wrap justify-center gap-3 mb-10">
        <button @click="tab='lv'"
            :class="tab==='lv' ? 'text-white shadow-lg' : 'bg-white text-gray-500 border border-gray-200'"
            :style="tab==='lv' ? 'background:linear-gradient(135deg,#00d4aa,#00b4d8);' : ''"
            class="px-6 py-2.5 rounded-full text-sm font-bold transition">
            Lunes a Viernes
        </button>
        <button @click="tab='sab'"
            :class="tab==='sab' ? 'text-white shadow-lg' : 'bg-white text-gray-500 border border-gray-200'"
            :style="tab==='sab' ? 'background:linear-gradient(135deg,#f9c74f,#f8961e);' : ''"
            class="px-6 py-2.5 rounded-full text-sm font-bold transition">
            Sábados
        </button>
        <button @click="tab='dom'"
            :class="tab==='dom' ? 'text-white shadow-lg' : 'bg-white text-gray-500 border border-gray-200'"
            :style="tab==='dom' ? 'background:linear-gradient(135deg,#90be6d,#43aa8b);' : ''"
            class="px-6 py-2.5 rounded-full text-sm font-bold transition">
            Domingos
        </button>
        <button @click="tab='all'"
            :class="tab==='all' ? 'text-white shadow-lg' : 'bg-white text-gray-500 border border-gray-200'"
            :style="tab==='all' ? 'background:linear-gradient(135deg,#48cae4,#00b4d8);' : ''"
            class="px-6 py-2.5 rounded-full text-sm font-bold transition">
            Todos
        </button>
    </div>

    {{-- Lunes a Viernes --}}
    <div x-show="tab==='lv'" x-cloak class="space-y-4">
        @forelse($lv as $program)
        <div class="card-rp flex gap-4 items-center p-5 hover:shadow-lg transition"
             style="border-left:4px solid {{ $program->color }};">
            <div class="text-center min-w-[80px] flex-shrink-0">
                <p class="font-black text-sm" style="color:{{ $program->color }};">{{ substr($program->start_time,0,5) }}</p>
                <p class="text-gray-400 text-xs">{{ substr($program->end_time,0,5) }}</p>
            </div>
            <div class="flex-1">
                <h3 class="font-black text-gray-800 text-base">{{ $program->name }}</h3>
                @if($program->host)
                <p class="text-sm font-semibold mt-0.5" style="color:{{ $program->color }};">🎙 {{ $program->host }}</p>
                @endif
                @if($program->description)
                <p class="text-gray-400 text-sm mt-1">{{ $program->description }}</p>
                @endif
            </div>
            <span class="text-xs font-bold text-white px-3 py-1.5 rounded-full flex-shrink-0"
                  style="background:{{ $program->color }};">
                {{ $program->day_label }}
            </span>
        </div>
        @empty
        <div class="text-center py-16 text-gray-400">
            <p class="text-4xl mb-3">📅</p>
            <p class="font-semibold">No hay programas configurados.</p>
        </div>
        @endforelse
    </div>

    {{-- Sábados --}}
    <div x-show="tab==='sab'" x-cloak class="space-y-4">
        @forelse($sabados as $program)
        <div class="card-rp flex gap-4 items-center p-5 hover:shadow-lg transition"
             style="border-left:4px solid {{ $program->color }};">
            <div class="text-center min-w-[80px] flex-shrink-0">
                <p class="font-black text-sm" style="color:{{ $program->color }};">{{ substr($program->start_time,0,5) }}</p>
                <p class="text-gray-400 text-xs">{{ substr($program->end_time,0,5) }}</p>
            </div>
            <div class="flex-1">
                <h3 class="font-black text-gray-800 text-base">{{ $program->name }}</h3>
                @if($program->host)
                <p class="text-sm font-semibold mt-0.5" style="color:{{ $program->color }};">🎙 {{ $program->host }}</p>
                @endif
                @if($program->description)
                <p class="text-gray-400 text-sm mt-1">{{ $program->description }}</p>
                @endif
            </div>
            <span class="text-xs font-bold text-white px-3 py-1.5 rounded-full flex-shrink-0"
                  style="background:{{ $program->color }};">
                {{ $program->day_label }}
            </span>
        </div>
        @empty
        <div class="text-center py-16 text-gray-400">
            <p class="text-4xl mb-3">📅</p>
            <p class="font-semibold">No hay programas para sábados.</p>
        </div>
        @endforelse
    </div>

    {{-- Domingos --}}
    <div x-show="tab==='dom'" x-cloak class="space-y-4">
        @forelse($domingos as $program)
        <div class="card-rp flex gap-4 items-center p-5 hover:shadow-lg transition"
             style="border-left:4px solid {{ $program->color }};">
            <div class="text-center min-w-[80px] flex-shrink-0">
                <p class="font-black text-sm" style="color:{{ $program->color }};">{{ substr($program->start_time,0,5) }}</p>
                <p class="text-gray-400 text-xs">{{ substr($program->end_time,0,5) }}</p>
            </div>
            <div class="flex-1">
                <h3 class="font-black text-gray-800 text-base">{{ $program->name }}</h3>
                @if($program->host)
                <p class="text-sm font-semibold mt-0.5" style="color:{{ $program->color }};">🎙 {{ $program->host }}</p>
                @endif
                @if($program->description)
                <p class="text-gray-400 text-sm mt-1">{{ $program->description }}</p>
                @endif
            </div>
            <span class="text-xs font-bold text-white px-3 py-1.5 rounded-full flex-shrink-0"
                  style="background:{{ $program->color }};">
                {{ $program->day_label }}
            </span>
        </div>
        @empty
        <div class="text-center py-16 text-gray-400">
            <p class="text-4xl mb-3">📅</p>
            <p class="font-semibold">No hay programas para domingos.</p>
        </div>
        @endforelse
    </div>

    {{-- Todos --}}
    <div x-show="tab==='all'" x-cloak class="space-y-4">
        @forelse($all as $program)
        <div class="card-rp flex gap-4 items-center p-5 hover:shadow-lg transition"
             style="border-left:4px solid {{ $program->color }};">
            <div class="text-center min-w-[80px] flex-shrink-0">
                <p class="font-black text-sm" style="color:{{ $program->color }};">{{ substr($program->start_time,0,5) }}</p>
                <p class="text-gray-400 text-xs">{{ substr($program->end_time,0,5) }}</p>
            </div>
            <div class="flex-1">
                <h3 class="font-black text-gray-800 text-base">{{ $program->name }}</h3>
                @if($program->host)
                <p class="text-sm font-semibold mt-0.5" style="color:{{ $program->color }};">🎙 {{ $program->host }}</p>
                @endif
                @if($program->description)
                <p class="text-gray-400 text-sm mt-1">{{ $program->description }}</p>
                @endif
            </div>
            <span class="text-xs font-bold text-white px-3 py-1.5 rounded-full flex-shrink-0"
                  style="background:{{ $program->color }};">
                {{ $program->day_label }}
            </span>
        </div>
        @empty
        <div class="text-center py-16 text-gray-400">
            <p class="text-4xl mb-3">📅</p>
            <p class="font-semibold">No hay programas configurados.</p>
        </div>
        @endforelse
    </div>
</section>
@endsection