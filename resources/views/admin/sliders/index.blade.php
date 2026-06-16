@extends('layouts.admin')
@section('title','Sliders')
@section('page-title','🖼️ Gestionar Sliders')
@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ count($sliders) }} sliders en total</p>
    <a href="{{ route('admin.sliders.create') }}" class="btn-admin">+ Nuevo Slider</a>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
    @forelse($sliders as $slider)
    <div class="card-admin overflow-hidden">
        <div class="relative">
            <img src="{{ $slider->image }}" alt="{{ $slider->title }}"
                 class="w-full h-40 object-cover">
            <div class="absolute top-2 right-2">
                <span class="text-xs font-bold text-white px-2 py-1 rounded-full"
                      style="{{ $slider->active ? 'background:#00d4aa;' : 'background:#999;' }}">
                    {{ $slider->active ? 'Activo' : 'Inactivo' }}
                </span>
            </div>
            <div class="absolute top-2 left-2">
                <span class="text-xs font-bold text-white px-2 py-1 rounded-full bg-black/50">
                    #{{ $slider->order }}
                </span>
            </div>
        </div>
        <div class="p-4">
            <h3 class="font-black text-gray-800 text-sm mb-1">{{ $slider->title ?? 'Sin título' }}</h3>
            @if($slider->subtitle)
            <p class="text-gray-400 text-xs mb-3">{{ Str::limit($slider->subtitle, 60) }}</p>
            @endif
            @if($slider->button_text)
            <p class="text-xs font-semibold mb-3" style="color:#00a896;">
                Botón: {{ $slider->button_text }}
            </p>
            @endif
            <div class="flex gap-2">
                <a href="{{ route('admin.sliders.edit', $slider) }}"
                   class="flex-1 text-center text-xs px-3 py-2 rounded-lg font-bold border hover:shadow transition"
                   style="border-color:#b2f0e0; color:#00a896;">Editar</a>
                <form method="POST" action="{{ route('admin.sliders.destroy', $slider) }}"
                      onsubmit="return confirm('¿Eliminar este slider?')">
                    @csrf @method('DELETE')
                    <button class="text-xs px-3 py-2 rounded-lg font-bold border border-red-200 text-red-400 hover:bg-red-50 transition">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-16 text-gray-400">
        <p class="text-4xl mb-3">🖼️</p>
        <p class="font-semibold">No hay sliders aún.</p>
        <a href="{{ route('admin.sliders.create') }}" class="btn-admin mt-4 inline-block">+ Crear primer slider</a>
    </div>
    @endforelse
</div>
@endsection