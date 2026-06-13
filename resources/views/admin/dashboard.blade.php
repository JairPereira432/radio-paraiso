@extends('layouts.app')
@section('title','Panel Admin — Radio Paraíso')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <p class="section-title mb-1">Administración</p>
    <h1 class="text-3xl font-black text-gray-800 mb-8">⚙️ Panel de Control</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        @foreach([
            ['Usuarios',    $stats['users'],    '👥', '#00d4aa'],
            ['Noticias',    $stats['news'],     '📰', '#f9c74f'],
            ['Sin leer',    $stats['contacts'], '📬', '#f8961e'],
            ['Comentarios', $stats['comments'], '💬', '#90be6d'],
        ] as [$label,$count,$icon,$color])
        <div class="card-rp p-5 text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1" style="background:{{ $color }};"></div>
            <div class="text-3xl mb-2">{{ $icon }}</div>
            <p class="text-3xl font-black" style="color:{{ $color }};">{{ $count }}</p>
            <p class="text-gray-400 text-sm mt-1 font-semibold">{{ $label }}</p>
        </div>
        @endforeach
    </div>

    <div class="grid md:grid-cols-4 gap-4 mb-10">
        <a href="{{ route('admin.news.create') }}" class="btn-primary text-center">✏️ Nueva Noticia</a>
        <a href="{{ route('admin.news.index') }}"
           class="card-rp p-4 text-center font-bold text-gray-600 hover:shadow-lg transition hover:-translate-y-1">
            📋 Noticias
        </a>
        <a href="{{ route('admin.videos.index') }}"
           class="card-rp p-4 text-center font-bold text-gray-600 hover:shadow-lg transition hover:-translate-y-1">
            🎬 Películas
        </a>
        <a href="{{ route('home') }}" target="_blank"
           class="card-rp p-4 text-center font-bold text-gray-600 hover:shadow-lg transition hover:-translate-y-1">
            🌐 Ver Sitio
        </a>
    </div>

    <div class="card-rp p-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1"
             style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>
        <h2 class="text-lg font-black text-gray-800 mb-4">📬 Últimos Mensajes</h2>
        <div class="space-y-3">
            @forelse($recent_contacts as $c)
            <div class="flex items-center justify-between border-b pb-3" style="border-color:#e0faf5;">
                <div>
                    <p class="text-gray-700 font-bold text-sm">
                        {{ $c->name }}
                        @if(!$c->read)
                        <span class="text-xs text-white px-2 py-0.5 rounded-full ml-2 font-bold"
                              style="background:linear-gradient(135deg,#f8961e,#f9c74f);">Nuevo</span>
                        @endif
                    </p>
                    <p class="text-gray-400 text-xs">{{ $c->type }} · {{ $c->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-400 text-sm">No hay mensajes.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection