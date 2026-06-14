@extends('layouts.admin')
@section('title','Configuración')
@section('page-title','⚙️ Configuración del Sitio')
@section('content')

<div class="max-w-3xl">
    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
        @csrf

        {{-- Radio --}}
        <div class="card-admin p-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1" style="background:linear-gradient(90deg,#00d4aa,#00b4d8);"></div>
            <h2 class="font-black text-gray-800 mb-5">📻 Información de la Radio</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Nombre de la Radio</label>
                    <input name="radio_name" type="text" value="{{ $settings['radio_name'] ?? '' }}" class="input-admin">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Slogan</label>
                    <input name="radio_slogan" type="text" value="{{ $settings['radio_slogan'] ?? '' }}" class="input-admin">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">URL del Stream</label>
                    <input name="radio_stream" type="text" value="{{ $settings['radio_stream'] ?? '' }}"
                           placeholder="https://servidor:8000/radio" class="input-admin">
                    <p class="text-xs text-gray-400 mt-1">URL de tu servidor Icecast o Shoutcast</p>
                </div>
            </div>
        </div>

        {{-- Contacto --}}
        <div class="card-admin p-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1" style="background:linear-gradient(90deg,#f9c74f,#f8961e);"></div>
            <h2 class="font-black text-gray-800 mb-5">📞 Información de Contacto</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Teléfono</label>
                    <input name="contact_phone" type="text" value="{{ $settings['contact_phone'] ?? '' }}" class="input-admin">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Correo Electrónico</label>
                    <input name="contact_email" type="email" value="{{ $settings['contact_email'] ?? '' }}" class="input-admin">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Dirección</label>
                    <input name="contact_address" type="text" value="{{ $settings['contact_address'] ?? '' }}" class="input-admin">
                </div>
            </div>
        </div>

        {{-- Redes sociales --}}
        <div class="card-admin p-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1" style="background:linear-gradient(90deg,#90be6d,#43aa8b);"></div>
            <h2 class="font-black text-gray-800 mb-5">📱 Redes Sociales</h2>
            <div class="space-y-4">
                @foreach([
                    ['facebook',  'Facebook',  '🔵'],
                    ['instagram', 'Instagram', '📸'],
                    ['youtube',   'YouTube',   '▶️'],
                    ['whatsapp',  'WhatsApp',  '💬'],
                    ['tiktok',    'TikTok',    '🎵'],
                ] as [$key, $label, $icon])
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">{{ $icon }} {{ $label }}</label>
                    <input name="{{ $key }}" type="url" value="{{ $settings[$key] ?? '' }}"
                           placeholder="https://{{ strtolower($label) }}.com/tu-perfil" class="input-admin">
                </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn-admin w-full text-center py-3">💾 Guardar Configuración</button>
    </form>
</div>
@endsection