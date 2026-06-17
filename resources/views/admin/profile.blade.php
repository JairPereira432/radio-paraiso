@extends('layouts.admin')
@section('title','Mi Perfil')
@section('page-title','👤 Mi Perfil')
@section('content')

<div class="max-w-2xl space-y-6">

    {{-- Info actual --}}
    <div class="card-admin p-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1"
             style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-white font-black text-2xl flex-shrink-0"
                 style="background:linear-gradient(135deg,#00d4aa,#00b4d8);">
                {{ strtoupper(substr($admin->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="font-black text-gray-800 text-xl">{{ $admin->name }}</h2>
                <p class="text-gray-400 text-sm">{{ $admin->email }}</p>
                <span class="text-xs font-bold text-white px-3 py-1 rounded-full mt-1 inline-block"
                      style="background:linear-gradient(135deg,#00d4aa,#00b4d8);">
                    {{ ucfirst($admin->role) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Formulario --}}
    <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-6">
        @csrf

        {{-- Datos personales --}}
        <div class="card-admin p-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1"
                 style="background:linear-gradient(90deg,#00d4aa,#00b4d8);"></div>
            <h3 class="font-black text-gray-800 mb-5">📋 Datos Personales</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Nombre *</label>
                    <input name="name" type="text" required value="{{ old('name', $admin->name) }}"
                           class="input-admin">
                    @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Email *</label>
                    <input name="email" type="email" required value="{{ old('email', $admin->email) }}"
                           class="input-admin">
                    @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Cambiar contraseña --}}
        <div class="card-admin p-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1"
                 style="background:linear-gradient(90deg,#f9c74f,#f8961e);"></div>
            <h3 class="font-black text-gray-800 mb-1">🔒 Cambiar Contraseña</h3>
            <p class="text-gray-400 text-xs mb-5">Deja en blanco si no quieres cambiarla</p>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Contraseña Actual</label>
                    <input name="current_password" type="password"
                           class="input-admin" placeholder="Tu contraseña actual">
                    @error('current_password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Nueva Contraseña</label>
                    <input name="password" type="password"
                           class="input-admin" placeholder="Mínimo 8 caracteres">
                    @error('password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-1.5">Confirmar Nueva Contraseña</label>
                    <input name="password_confirmation" type="password"
                           class="input-admin" placeholder="Repite la nueva contraseña">
                </div>
            </div>
        </div>

        <button type="submit" class="btn-admin w-full text-center py-3">
            💾 Guardar Cambios
        </button>
    </form>
</div>
@endsection