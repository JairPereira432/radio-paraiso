@extends('layouts.app')
@section('title','Gestionar Noticias — Admin')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-8">
        <div>
            <p class="section-title mb-1">Panel Admin</p>
            <h1 class="text-3xl font-black text-gray-800">📰 Gestionar Noticias</h1>
        </div>
        <a href="{{ route('admin.news.create') }}" class="btn-primary">+ Nueva Noticia</a>
    </div>

    <div class="card-rp overflow-hidden">
        <table class="w-full text-sm">
            <thead style="background:linear-gradient(90deg,#f0fffc,#f0fbff);">
                <tr>
                    <th class="text-left px-6 py-4 text-gray-500 font-bold text-xs uppercase">Título</th>
                    <th class="text-left px-6 py-4 text-gray-500 font-bold text-xs uppercase hidden md:table-cell">Autor</th>
                    <th class="text-left px-6 py-4 text-gray-500 font-bold text-xs uppercase hidden md:table-cell">Estado</th>
                    <th class="text-left px-6 py-4 text-gray-500 font-bold text-xs uppercase hidden md:table-cell">Fecha</th>
                    <th class="text-right px-6 py-4 text-gray-500 font-bold text-xs uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="border-color:#e0faf5;">
                @forelse($news as $article)
                <tr class="hover:bg-teal-50/30 transition">
                    <td class="px-6 py-4">
                        <p class="font-bold text-gray-700 line-clamp-1">{{ $article->title }}</p>
                        @if($article->featured)
                        <span class="text-xs font-bold" style="color:#f8961e;">⭐ Destacada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 hidden md:table-cell text-gray-400 font-semibold">{{ $article->user->name }}</td>
                    <td class="px-6 py-4 hidden md:table-cell">
                        <span class="px-3 py-1 rounded-full text-xs font-bold
                            {{ $article->status==='published' ? '' : 'bg-gray-100 text-gray-500' }}"
                            style="{{ $article->status==='published' ? 'background:#e0fff8; color:#00a896;' : '' }}">
                            {{ $article->status==='published' ? 'Publicado' : 'Borrador' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 hidden md:table-cell text-gray-400 text-xs font-semibold">
                        {{ $article->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.news.edit', $article) }}"
                               class="text-xs px-3 py-1.5 rounded-lg font-bold transition border hover:shadow"
                               style="border-color:#b2f0e0; color:#00a896;">Editar</a>
                            <form method="POST" action="{{ route('admin.news.destroy', $article) }}"
                                  onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="text-xs px-3 py-1.5 rounded-lg font-bold border border-red-200 text-red-400 hover:bg-red-50 transition">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-16 text-gray-400">
                        <p class="text-4xl mb-3">📰</p><p class="font-semibold">No hay noticias aún.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $news->links() }}</div>
</div>
@endsection