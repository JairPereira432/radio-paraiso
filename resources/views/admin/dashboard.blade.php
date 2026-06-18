@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','📊 Dashboard')
@section('content')

{{-- Oyentes en vivo --}}
<div class="card-admin p-5 mb-6 relative overflow-hidden flex items-center gap-6">
    <div class="absolute top-0 left-0 right-0 h-1"
         style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#48cae4);"></div>
    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl flex-shrink-0"
         style="background:linear-gradient(135deg,#00d4aa,#48cae4); box-shadow:0 4px 20px #00d4aa33;">🎧</div>
    <div class="flex-1">
        <p class="section-title mb-1">Oyentes en este momento</p>
        <div class="flex items-end gap-3">
            <p class="text-5xl font-black" style="color:#00d4aa;">{{ $stats['listeners'] }}</p>
            <p class="text-gray-400 text-sm mb-2">personas escuchando ahora</p>
        </div>
    </div>
    <div class="text-right">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold"
             style="background:#e0fff8; color:#00a896;">
            <span class="w-2 h-2 rounded-full animate-pulse" style="background:#00d4aa;"></span>
            EN VIVO
        </div>
        <p class="text-gray-400 text-xs mt-2">
            @if($stats['listeners'] == 0)
                Conecta tu servidor de streaming<br>para ver oyentes reales
            @else
                Actualizado en tiempo real
            @endif
        </p>
    </div>
</div>

{{-- Stats --}}
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
    @foreach([
        ['Programas',  $stats['programs'],  '📅', '#00d4aa'],
        ['Mensajes',   $stats['contacts'],  '📬', '#f8961e'],
        ['Sliders',    $stats['sliders'],   '🖼️', '#f9c74f'],
        ['Admins',     $stats['admins'],    '👤', '#90be6d'],
        ['Oyentes',    $stats['listeners'], '🎧', '#48cae4'],
    ] as [$label,$count,$icon,$color])
    <div class="card-admin p-5 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 rounded-t-xl" style="background:{{ $color }};"></div>
        <div class="text-3xl mb-2">{{ $icon }}</div>
        <p class="text-3xl font-black" style="color:{{ $color }};">{{ $count }}</p>
        <p class="text-gray-400 text-sm mt-1 font-semibold">{{ $label }}</p>
    </div>
    @endforeach
</div>

{{-- Accesos rápidos --}}
<div class="grid md:grid-cols-3 gap-4 mb-8">
    <a href="{{ route('admin.programs.create') }}" class="btn-admin text-center">✏️ Nuevo Programa</a>
    <a href="{{ route('admin.programs.index') }}"
       class="card-admin p-4 text-center font-bold text-gray-600 hover:shadow-lg transition block">
        📅 Ver Programas
    </a>
    <a href="{{ route('admin.settings') }}"
       class="card-admin p-4 text-center font-bold text-gray-600 hover:shadow-lg transition block">
        ⚙️ Configuración
    </a>
</div>

{{-- Mensajes recientes --}}
<div class="card-admin p-6 relative overflow-hidden">
    <div class="absolute top-0 left-0 right-0 h-1"
         style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>
    <h2 class="text-base font-black text-gray-800 mb-4">📬 Últimos Mensajes</h2>
    <div class="space-y-3">
        @forelse($recent_contacts as $c)
        <a href="{{ route('admin.contacts.show', $c) }}"
           class="flex items-center justify-between border-b pb-3 hover:bg-gray-50 transition rounded-lg px-2"
           style="border-color:#e0faf5;">
            <div>
                <p class="font-bold text-gray-700 text-sm">
                    {{ $c->name }}
                    @if(!$c->read)
                    <span class="text-xs text-white px-2 py-0.5 rounded-full ml-2 font-bold"
                          style="background:#f8961e;">Nuevo</span>
                    @endif
                </p>
                <p class="text-gray-400 text-xs">{{ $c->subject }} · {{ $c->created_at->diffForHumans() }}</p>
            </div>
            <span class="text-gray-300 text-xs">→</span>
        </a>
        @empty
        <p class="text-gray-400 text-sm">No hay mensajes aún.</p>
        @endforelse
    </div>
</div>
@endsection