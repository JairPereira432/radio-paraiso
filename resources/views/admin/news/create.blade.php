@extends('layouts.app')
@section('title','Nueva Noticia — Admin')
@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.news.index') }}" class="text-gray-400 hover:text-teal-500 font-semibold transition text-sm">← Volver</a>
        <div>
            <p class="section-title mb-0.5">Panel Admin</p>
            <h1 class="text-3xl font-black text-gray-800">✏️ Nueva Noticia</h1>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data"
          class="card-rp p-8 space-y-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1.5"
             style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>
        @csrf

        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Título *</label>
            <input name="title" type="text" required value="{{ old('title') }}" class="input-rp">
            @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Extracto</label>
            <input name="excerpt" type="text" value="{{ old('excerpt') }}"
                   placeholder="Resumen corto para la lista de noticias" class="input-rp">
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Contenido *</label>
            <textarea name="body" rows="12" required class="input-rp resize-none">{{ old('body') }}</textarea>
            @error('body') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Categoría</label>
                <input name="category" type="text" value="{{ old('category') }}"
                       placeholder="Ej: Música, Noticias, Eventos" class="input-rp">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Estado</label>
                <select name="status" class="select-rp">
                    <option value="draft"     {{ old('status')=='draft'     ? 'selected':'' }}>Borrador</option>
                    <option value="published" {{ old('status')=='published' ? 'selected':'' }}>Publicado</option>
                </select>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <input name="featured" type="checkbox" id="featured" value="1"
                   class="accent-teal-400 w-4 h-4" {{ old('featured') ? 'checked':'' }}>
            <label for="featured" class="text-sm font-semibold text-gray-600">⭐ Noticia destacada</label>
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Imagen de portada</label>
            <input name="image" type="file" accept="image/*"
                   class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-white file:font-bold file:cursor-pointer"
                   style="">
            @error('image') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="flex gap-4 pt-2">
            <button type="submit" class="btn-primary">Publicar Noticia</button>
            <a href="{{ route('admin.news.index') }}"
               class="px-6 py-3 rounded-xl font-bold text-gray-500 border hover:bg-gray-50 transition" style="border-color:#e0faf5;">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection