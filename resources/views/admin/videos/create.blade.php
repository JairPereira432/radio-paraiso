@extends('layouts.app')
@section('title','Agregar Película — Admin')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.videos.index') }}" class="text-gray-400 hover:text-teal-500 font-semibold transition text-sm">← Volver</a>
        <div>
            <p class="section-title mb-0.5">Panel Admin</p>
            <h1 class="text-3xl font-black text-gray-800">🎬 Agregar Película</h1>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.videos.store') }}" enctype="multipart/form-data"
          class="card-rp p-8 space-y-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1.5"
             style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>
        @csrf

        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Título *</label>
            <input name="title" type="text" required value="{{ old('title') }}" class="input-rp">
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">ID de YouTube *</label>
            <input name="youtube_id" type="text" required value="{{ old('youtube_id') }}"
                   placeholder="Ej: dQw4w9WgXcQ" class="input-rp">
            <p class="text-gray-400 text-xs mt-1">En youtube.com/watch?v=<span class="font-bold" style="color:#00a896;">dQw4w9WgXcQ</span> — copia solo esa parte</p>
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Descripción</label>
            <textarea name="description" rows="3" class="input-rp resize-none">{{ old('description') }}</textarea>
        </div>
        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Categoría</label>
                <select name="category" class="select-rp">
                    <option value="">Sin categoría</option>
                    <option value="accion"  {{ old('category')=='accion'  ? 'selected':'' }}>Acción</option>
                    <option value="comedia" {{ old('category')=='comedia' ? 'selected':'' }}>Comedia</option>
                    <option value="drama"   {{ old('category')=='drama'   ? 'selected':'' }}>Drama</option>
                    <option value="romance" {{ old('category')=='romance' ? 'selected':'' }}>Romance</option>
                    <option value="terror"  {{ old('category')=='terror'  ? 'selected':'' }}>Terror</option>
                    <option value="clasica" {{ old('category')=='clasica' ? 'selected':'' }}>Clásica</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Estado</label>
                <select name="status" class="select-rp">
                    <option value="published">Publicado</option>
                    <option value="draft">Borrador</option>
                </select>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <input name="featured" type="checkbox" id="featured" value="1" class="accent-teal-400 w-4 h-4">
            <label for="featured" class="text-sm font-semibold text-gray-600">⭐ Película destacada en el inicio</label>
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Imagen poster (opcional)</label>
            <input name="thumbnail" type="file" accept="image/*"
                   class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-white file:font-bold file:cursor-pointer">
            <p class="text-gray-400 text-xs mt-1">Si no subes una, se usará la miniatura de YouTube automáticamente.</p>
        </div>
        <div class="flex gap-4 pt-2">
            <button type="submit" class="btn-primary">Agregar Película</button>
            <a href="{{ route('admin.videos.index') }}"
               class="px-6 py-3 rounded-xl font-bold text-gray-500 border hover:bg-gray-50 transition" style="border-color:#e0faf5;">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection