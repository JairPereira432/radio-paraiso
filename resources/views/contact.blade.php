@extends('layouts.app')
@section('title','Contacto — Radio Paraíso')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <p class="section-title mb-1">Escríbenos</p>
    <h1 class="text-3xl font-black text-gray-800 mb-2">Contáctanos</h1>
    <p class="text-gray-400 mb-8">Pide tu canción, envía una denuncia o déjanos una nota de voz</p>

    <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data"
          class="card-rp p-8 space-y-5 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1.5"
             style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>
        @csrf

        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Nombre *</label>
                <input name="name" type="text" required value="{{ old('name') }}" class="input-rp">
                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Email *</label>
                <input name="email" type="email" required value="{{ old('email') }}" class="input-rp">
                @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Teléfono</label>
            <input name="phone" type="tel" value="{{ old('phone') }}" class="input-rp">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Tipo de mensaje *</label>
            <select name="type" required class="select-rp">
                <option value="">Selecciona...</option>
                <option value="peticion_musical" {{ old('type')=='peticion_musical' ? 'selected':'' }}>🎵 Petición Musical</option>
                <option value="denuncia"         {{ old('type')=='denuncia'         ? 'selected':'' }}>📢 Denuncia Ciudadana</option>
                <option value="nota_voz"         {{ old('type')=='nota_voz'         ? 'selected':'' }}>🎤 Nota de Voz</option>
                <option value="contacto_general" {{ old('type')=='contacto_general' ? 'selected':'' }}>📧 Contacto General</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Mensaje *</label>
            <textarea name="message" rows="5" required class="input-rp resize-none">{{ old('message') }}</textarea>
            @error('message') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-600 mb-1.5">Nota de voz (MP3/WAV · máx 10MB)</label>
            <input name="audio" type="file" accept=".mp3,.wav,.ogg,.m4a"
                   class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-white file:font-bold file:cursor-pointer"
                   style="--file-bg:linear-gradient(135deg,#00d4aa,#00b4d8);">
        </div>

        <button type="submit" class="btn-primary w-full text-center">Enviar Mensaje ✉️</button>
    </form>
</div>
@endsection