@extends('layouts.app')
@section('title', 'Contacto — Radio Paraíso')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <h1 class="font-display text-4xl font-bold text-gold mb-2">Contáctanos</h1>
    <p class="text-gray-400 mb-8">Pide tu canción, envía una denuncia o déjanos una nota de voz</p>

    <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-radio-light border border-gold/20 rounded-2xl p-8 space-y-5">
        @csrf

        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm text-gold mb-1">Nombre *</label>
                <input name="name" type="text" required value="{{ old('name') }}"
                       class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold">
                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm text-gold mb-1">Email *</label>
                <input name="email" type="email" required value="{{ old('email') }}"
                       class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold">
                @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm text-gold mb-1">Teléfono</label>
            <input name="phone" type="tel" value="{{ old('phone') }}"
                   class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold">
        </div>

        <div>
            <label class="block text-sm text-gold mb-1">Tipo de mensaje *</label>
            <select name="type" required
                    class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold">
                <option value="">Selecciona...</option>
                <option value="peticion_musical"  {{ old('type')=='peticion_musical'  ? 'selected':'' }}>🎵 Petición Musical</option>
                <option value="denuncia"          {{ old('type')=='denuncia'          ? 'selected':'' }}>📢 Denuncia Ciudadana</option>
                <option value="nota_voz"          {{ old('type')=='nota_voz'          ? 'selected':'' }}>🎤 Nota de Voz</option>
                <option value="contacto_general"  {{ old('type')=='contacto_general'  ? 'selected':'' }}>📧 Contacto General</option>
            </select>
        </div>

        <div>
            <label class="block text-sm text-gold mb-1">Mensaje *</label>
            <textarea name="message" rows="5" required
                      class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold resize-none">{{ old('message') }}</textarea>
            @error('message') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-gold mb-1">Nota de voz (opcional · MP3/WAV/OGG · máx 10MB)</label>
            <input name="audio" type="file" accept=".mp3,.wav,.ogg,.m4a"
                   class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-gold file:text-radio file:font-semibold hover:file:bg-gold-dark">
            @error('audio') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
                class="w-full bg-gold text-radio py-3 rounded-xl font-semibold hover:bg-gold-dark transition text-lg">
            Enviar Mensaje ✉️
        </button>
    </form>
</div>
@endsection