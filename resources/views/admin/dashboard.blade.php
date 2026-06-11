@extends('layouts.app')
@section('title', 'Panel Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="font-display text-3xl font-bold text-gold mb-8">⚙️ Panel de Administración</h1>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        @foreach([
            ['Usuarios',    $stats['users'],    '👥', 'blue'],
            ['Noticias',    $stats['news'],     '📰', 'green'],
            ['Sin leer',    $stats['contacts'], '📬', 'yellow'],
            ['Comentarios', $stats['comments'], '💬', 'purple'],
        ] as [$label,$count,$icon,$color])
        <div class="bg-radio-light border border-gold/20 rounded-xl p-5 text-center">
            <div class="text-3xl mb-2">{{ $icon }}</div>
            <p class="font-display text-3xl font-black text-gold">{{ $count }}</p>
            <p class="text-gray-400 text-sm">{{ $label }}</p>
        </div>
        @endforeach
    </div>

    {{-- Quick Links --}}
    <div class="grid md:grid-cols-3 gap-4 mb-10">
        <a href="{{ route('admin.news.create') }}"
           class="bg-gold text-radio rounded-xl p-5 font-semibold hover:bg-gold-dark transition text-center">
            ✏️ Nueva Noticia
        </a>
        <a href="{{ route('admin.news.index') }}"
           class="bg-radio-light border border-gold/30 rounded-xl p-5 font-semibold hover:border-gold transition text-center">
            📋 Gestionar Noticias
        </a>
        <a href="{{ route('home') }}" target="_blank"
           class="bg-radio-light border border-gold/30 rounded-xl p-5 font-semibold hover:border-gold transition text-center">
            🌐 Ver Sitio
        </a>
    </div>

    {{-- Mensajes recientes --}}
    <div class="bg-radio-light border border-gold/20 rounded-2xl p-6">
        <h2 class="font-display text-xl font-bold text-gold mb-4">📬 Últimos Mensajes</h2>
        <div class="space-y-3">
            @forelse($recent_contacts as $c)
            <div class="flex items-center justify-between border-b border-gold/10 pb-3">
                <div>
                    <p class="font-medium">{{ $c->name }}
                        @if(!$c->read) <span class="text-xs bg-red-600 px-2 py-0.5 rounded-full ml-2">Nuevo</span> @endif
                    </p>
                    <p class="text-gray-400 text-sm">{{ $c->type }} · {{ $c->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-400">No hay mensajes.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection