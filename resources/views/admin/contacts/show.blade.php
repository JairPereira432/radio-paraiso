@extends('layouts.admin')
@section('title','Ver Mensaje')
@section('page-title','📬 Detalle del Mensaje')
@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.contacts.index') }}" class="text-gray-400 hover:text-teal-500 font-semibold text-sm mb-6 inline-block">← Volver</a>

    <div class="card-admin p-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1"
             style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>

        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="font-black text-gray-800 text-lg">{{ $contact->name }}</h2>
                <p class="text-gray-400 text-sm">{{ $contact->email }}</p>
            </div>
            <span class="text-xs text-gray-400 font-semibold">{{ $contact->created_at->format('d/m/Y H:i') }}</span>
        </div>

        <div class="mb-4">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Asunto</p>
            <p class="font-bold text-gray-700">{{ $contact->subject ?? 'Sin asunto' }}</p>
        </div>

        <div class="mb-6">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Mensaje</p>
            <div class="rounded-xl p-4 text-gray-600 text-sm leading-relaxed"
                 style="background:#f8fffd; border:1.5px solid #e0faf5;">
                {{ $contact->message }}
            </div>
        </div>

        <div class="flex gap-3">
            <a href="mailto:{{ $contact->email }}" class="btn-admin">✉️ Responder por Email</a>
            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                  onsubmit="return confirm('¿Eliminar este mensaje?')">
                @csrf @method('DELETE')
                <button class="px-5 py-2.5 rounded-lg font-bold border border-red-200 text-red-400 hover:bg-red-50 transition text-sm">
                    Eliminar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection