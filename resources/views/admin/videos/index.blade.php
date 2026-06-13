@extends('layouts.app')
@section('title','Gestionar Películas — Admin')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-8">
        <div>
            <p class="section-title mb-1">Panel Admin</p>
            <h1 class="text-3xl font-black text-gray-800">🎬 Gestionar Películas</h1>
        </div>
        <a href="{{ route('admin.videos.create') }}" class="btn-primary">+ Agregar Película</a>
    </div>

    <div class="card-rp overflow-hidden">
        <table class="w-full text-sm">
            <thead style="background:linear-gradient(90deg,#f0fffc,#fffbf0);">
                <tr>
                    <th class="text-left px-6 py-4 text-gray-500 font-bold text-xs uppercase">Película</th>
                    <th class="text-left px-6 py-4 text-gray-500 font-bold text-xs uppercase hidden md:table-cell">Categoría</th>
                    <th class="text-left px-6 py-4 text-gray-500 font-bold text-xs uppercase hidden md:table-cell">Estado</th>
                    <th class="text-right px-6 py-4 text-gray-500 font-bold text-xs uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="border-color:#e0faf5;">
                @forelse($videos as $video)
                <tr class="hover:bg-yellow-50/30 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/default.jpg"
                                 class="w-16 h-10 object-cover rounded-lg">
                            <div>
                                <p class="font-bold text-gray-700">{{ $video->title }}</p>
                                <p class="text-gray-400 text-xs">ID: {{ $video->youtube_id }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 hidden md:table-cell text-gray-400 font-semibold capitalize">{{ $video->category ?? '—' }}</td>
                    <td class="px-6 py-4 hidden md:table-cell">
                        <span class="px-3 py-1 rounded-full text-xs font-bold"
                              style="{{ $video->status==='published' ? 'background:#e0fff8; color:#00a896;' : 'background:#f5f5f5; color:#999;' }}">
                            {{ $video->status==='published' ? 'Publicado' : 'Borrador' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.videos.edit', $video) }}"
                               class="text-xs px-3 py-1.5 rounded-lg font-bold border hover:shadow transition"
                               style="border-color:#b2f0e0; color:#00a896;">Editar</a>
                            <form method="POST" action="{{ route('admin.videos.destroy', $video) }}"
                                  onsubmit="return confirm('¿Eliminar esta película?')">
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
                    <td colspan="4" class="text-center py-16 text-gray-400">
                        <p class="text-4xl mb-3">🎬</p><p class="font-semibold">No hay películas aún.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $videos->links() }}</div>
</div>
@endsection