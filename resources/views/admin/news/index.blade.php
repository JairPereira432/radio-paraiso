@extends('layouts.app')
@section('title', 'Gestionar Noticias')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-8">
        <h1 class="font-display text-3xl font-bold text-gold">📰 Gestionar Noticias</h1>
        <a href="{{ route('admin.news.create') }}"
           class="bg-gold text-radio px-5 py-2 rounded-full font-semibold hover:bg-gold-dark transition text-sm">
            + Nueva Noticia
        </a>
    </div>

    <div class="bg-radio-light border border-gold/20 rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="border-b border-gold/20 text-gold text-xs uppercase">
                <tr>
                    <th class="text-left px-6 py-4">Título</th>
                    <th class="text-left px-6 py-4 hidden md:table-cell">Autor</th>
                    <th class="text-left px-6 py-4 hidden md:table-cell">Estado</th>
                    <th class="text-left px-6 py-4 hidden md:table-cell">Fecha</th>
                    <th class="text-right px-6 py-4">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gold/10">
                @forelse($news as $article)
                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4">
                        <p class="font-medium line-clamp-1">{{ $article->title }}</p>
                        @if($article->featured)
                        <span class="text-xs text-gold">⭐ Destacada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 hidden md:table-cell text-gray-400">{{ $article->user->name }}</td>
                    <td class="px-6 py-4 hidden md:table-cell">
                        <span class="px-2 py-1 rounded-full text-xs
                            {{ $article->status === 'published' ? 'bg-green-800 text-green-300' : 'bg-gray-700 text-gray-400' }}">
                            {{ $article->status === 'published' ? 'Publicado' : 'Borrador' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 hidden md:table-cell text-gray-400 text-xs">
                        {{ $article->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.news.edit', $article) }}"
                               class="text-xs bg-gold/20 text-gold px-3 py-1 rounded-full hover:bg-gold/30 transition">
                                Editar
                            </a>
                            <form method="POST" action="{{ route('admin.news.destroy', $article) }}"
                                  onsubmit="return confirm('¿Eliminar esta noticia?')">
                                @csrf @method('DELETE')
                                <button class="text-xs bg-red-900/50 text-red-400 px-3 py-1 rounded-full hover:bg-red-900 transition">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-12 text-gray-500">No hay noticias aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $news->links() }}</div>
</div>
@endsection