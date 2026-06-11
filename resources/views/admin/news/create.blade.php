@extends('layouts.app')
@section('title', 'Nueva Noticia')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.news.index') }}" class="text-gray-400 hover:text-gold">← Volver</a>
        <h1 class="font-display text-3xl font-bold text-gold">✏️ Nueva Noticia</h1>
    </div>

    <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data"
          class="bg-radio-light border border-gold/20 rounded-2xl p-8 space-y-6">
        @csrf

        <div>
            <label class="block text-sm text-gold mb-1">Título *</label>
            <input name="title" type="text" required value="{{ old('title') }}"
                   class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-3 focus:outline-none focus:border-gold">
            @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-gold mb-1">Extracto</label>
            <input name="excerpt" type="text" value="{{ old('excerpt') }}"
                   placeholder="Resumen corto para la lista de noticias"
                   class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-3 focus:outline-none focus:border-gold">
        </div>

        <div>
            <label class="block text-sm text-gold mb-1">Contenido *</label>
            <textarea name="body" rows="12" required
                      class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-3 focus:outline-none focus:border-gold resize-none">{{ old('body') }}</textarea>
            @error('body') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm text-gold mb-1">Categoría</label>
                <input name="category" type="text" value="{{ old('category') }}"
                       placeholder="Ej: Música, Noticias, Eventos"
                       class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-3 focus:outline-none focus:border-gold">
            </div>
            <div>
                <label class="block text-sm text-gold mb-1">Estado</label>
                <select name="status"
                        class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-3 focus:outline-none focus:border-gold">
                    <option value="draft"     {{ old('status')=='draft'     ? 'selected':'' }}>Borrador</option>
                    <option value="published" {{ old('status')=='published' ? 'selected':'' }}>Publicado</option>
                </select>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <input name="featured" type="checkbox" id="featured" value="1"
                   class="accent-gold w-4 h-4" {{ old('featured') ? 'checked':'' }}>
            <label for="featured" class="text-sm text-gray-300">⭐ Marcar como noticia destacada</label>
        </div>

        <div>
            <label class="block text-sm text-gold mb-1">Imagen de portada</label>
            <input name="image" type="file" accept="image/*"
                   class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-gold file:text-radio file:font-semibold hover:file:bg-gold-dark">
            @error('image') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-4 pt-2">
            <button type="submit"
                    class="bg-gold text-radio px-8 py-3 rounded-xl font-semibold hover:bg-gold-dark transition">
                Publicar Noticia
            </button>
            <a href="{{ route('admin.news.index') }}"
               class="border border-gold/30 text-gold px-8 py-3 rounded-xl hover:bg-gold/10 transition">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection