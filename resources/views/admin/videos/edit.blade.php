@extends('layouts.app')
@section('title','Editar Película — Admin')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.videos.index') }}" class="text-gray-400 hover:text-teal-500 font-semibold transition text-sm">← Volver</a>
        <div>
            <p class="section-title mb-0.5">Panel Admin</p>
            <h1 class="text-3xl font-black text-gray-800">✏️ Editar Película</h1>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.videos.update', $video) }}" enctype="multipart/form-data"
          class="card-rp p-8 space-y-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1.5"
             style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Título *</label>
            <input name="title" type="text" required value="{{ old('title',$video->title) }}" class="input-rp">
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">ID de YouTube *</label>
            <input name="youtube_id" type="text" required value="{{ old('youtube_id',$video->youtube_id) }}" class="input-rp">
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Descripción</label>
            <textarea name="description" rows="3" class="input-rp resize-none">{{ old('description',$video->description) }}</textarea>
        </div>
        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Categoría</label>
                <select name="category" class="select-rp">
                    <option value="">Sin categoría</option>
                    <option value="accion"  {{ old('category',$video->category)=='accion'  ? 'selected':'' }}>Acción</option>
                    <option value="comedia" {{ old('category',$video->category)=='comedia' ? 'selected':'' }}>Comedia</option>
                    <option value="drama"   {{ old('category',$video->category)=='drama'   ? 'selected':'' }}>Drama</option>
                    <option value="romance" {{ old('category',$video->category)=='romance' ? 'selected':'' }}>Romance</option>
                    <option value="terror"  {{ old('category',$video->category)=='terror'  ? 'selected':'' }}>Terror</option>
                    <option value="clasica" {{ old('category',$video->category)=='clasica' ? 'selected':'' }}>Clásica</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Estado</label>
                <select name="status" class="select-rp">
                    <option value="published" {{ old('status',$video->status)=='published' ? 'selected':'' }}>Publicado</option>
                    <option value="draft"     {{ old('status',$video->status)=='draft'     ? 'selected':'' }}>Borrador</option>
                </select>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <input name="featured" type="checkbox" id="featured" value="1"
                   class="accent-teal-400 w-4 h-4" {{ old('featured',$video->featured) ? 'checked':'' }}>
            <label for="featured" class="text-sm font-semibold text-gray-600">⭐ Película destacada en el inicio</label>
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Imagen poster</label>
            <img src="{{ $video->thumbnail ? Storage::url($video->thumbnail) : 'https://img.youtube.com/vi/'.$video->youtube_id.'/mqdefault.jpg' }}"
                 class="w-32 h-20 object-cover rounded-xl mb-3">
            <input name="thumbnail" type="file" accept="image/*"
                   class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-white file:font-bold file:cursor-pointer">
        </div>
        <div class="flex gap-4 pt-2">
            <button type="submit" class="btn-primary">Guardar Cambios</button>
            <a href="{{ route('admin.videos.index') }}"
               class="px-6 py-3 rounded-xl font-bold text-gray-500 border hover:bg-gray-50 transition" style="border-color:#e0faf5;">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection