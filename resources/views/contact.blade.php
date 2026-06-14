@extends('layouts.app')
@section('title', 'Contacto — ' . ($settings['radio_name'] ?? 'Radio Paraíso'))
@section('content')

{{-- HERO --}}
<section class="py-16 text-center relative overflow-hidden"
         style="background:linear-gradient(135deg,#0a2a1a 0%,#0d3b2e 100%);">
    <div class="absolute inset-0 opacity-20"
         style="background:radial-gradient(circle at 30% 50%,#00d4aa,transparent 60%),radial-gradient(circle at 70% 50%,#f9c74f,transparent 60%);"></div>
    <div class="relative z-10">
        <p class="section-title mb-2">Contáctenos</p>
        <h1 class="text-4xl md:text-5xl font-black text-white mb-3">ESTAMOS PARA ESCUCHARTE</h1>
        <p class="text-white/60">Escríbenos, llámanos o visítanos. Somos tu emisora.</p>
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 py-16">
    <div class="grid md:grid-cols-2 gap-12">

        {{-- Info --}}
        <div>
            <div class="flex items-center gap-3 mb-6">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white font-black text-lg"
                     style="background:linear-gradient(135deg,#00d4aa,#00b4d8,#f9c74f);">RP</div>
                <div>
                    <p class="font-black text-gray-800">{{ $settings['radio_name'] ?? 'Radio Paraíso' }}</p>
                    <p class="text-sm font-semibold" style="color:#00d4aa;">Online · EN VIVO 24/7</p>
                </div>
            </div>

            <h3 class="font-black text-gray-800 text-lg mb-5">INFORMACIÓN DE CONTACTO</h3>

            <div class="space-y-4">
                @if(!empty($settings['contact_phone']))
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white flex-shrink-0"
                         style="background:linear-gradient(135deg,#00d4aa,#00b4d8);">📞</div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold">Teléfono</p>
                        <p class="text-gray-700 font-bold">{{ $settings['contact_phone'] }}</p>
                    </div>
                </div>
                @endif

                @if(!empty($settings['contact_email']))
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white flex-shrink-0"
                         style="background:linear-gradient(135deg,#f9c74f,#f8961e);">✉️</div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold">Correo Electrónico</p>
                        <p class="text-gray-700 font-bold">{{ $settings['contact_email'] }}</p>
                    </div>
                </div>
                @endif

                @if(!empty($settings['contact_address']))
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white flex-shrink-0"
                         style="background:linear-gradient(135deg,#90be6d,#43aa8b);">📍</div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold">Dirección</p>
                        <p class="text-gray-700 font-bold">{{ $settings['contact_address'] }}</p>
                    </div>
                </div>
                @endif
            </div>

            {{-- Redes sociales --}}
            <div class="mt-8">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-3">Síguenos</p>
                <div class="flex gap-3 flex-wrap">
                    @if(!empty($settings['facebook']) && $settings['facebook'] !== '#')
                    <a href="{{ $settings['facebook'] }}" target="_blank"
                       class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-bold hover:scale-110 transition"
                       style="background:#1877f2;">f</a>
                    @endif
                    @if(!empty($settings['instagram']) && $settings['instagram'] !== '#')
                    <a href="{{ $settings['instagram'] }}" target="_blank"
                       class="w-10 h-10 rounded-xl flex items-center justify-center text-white hover:scale-110 transition"
                       style="background:linear-gradient(135deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);">📸</a>
                    @endif
                    @if(!empty($settings['youtube']) && $settings['youtube'] !== '#')
                    <a href="{{ $settings['youtube'] }}" target="_blank"
                       class="w-10 h-10 rounded-xl flex items-center justify-center text-white hover:scale-110 transition"
                       style="background:#ff0000;">▶</a>
                    @endif
                    @if(!empty($settings['whatsapp']) && $settings['whatsapp'] !== '#')
                    <a href="{{ $settings['whatsapp'] }}" target="_blank"
                       class="w-10 h-10 rounded-xl flex items-center justify-center text-white hover:scale-110 transition"
                       style="background:#25d366;">💬</a>
                    @endif
                    @if(!empty($settings['tiktok']) && $settings['tiktok'] !== '#')
                    <a href="{{ $settings['tiktok'] }}" target="_blank"
                       class="w-10 h-10 rounded-xl flex items-center justify-center text-white hover:scale-110 transition bg-black">🎵</a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Formulario --}}
        <div class="card-rp p-8 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1.5"
                 style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-1.5">Nombre *</label>
                        <input name="name" type="text" required value="{{ old('name') }}"
                               placeholder="Tu nombre" class="input-rp">
                        @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-1.5">Email *</label>
                        <input name="email" type="email" required value="{{ old('email') }}"
                               placeholder="tu@email.com" class="input-rp">
                        @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Asunto</label>
                    <select name="subject" class="select-rp">
                        <option value="Publicidad">Publicidad</option>
                        <option value="Petición Musical">Petición Musical</option>
                        <option value="Información">Información</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Mensaje *</label>
                    <textarea name="message" rows="5" required placeholder="Escribe tu mensaje aquí..."
                              class="input-rp resize-none">{{ old('message') }}</textarea>
                    @error('message') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="btn-primary w-full text-center">
                    ✉️ Enviar Mensaje
                </button>
            </form>
        </div>
    </div>
</section>
@endsection