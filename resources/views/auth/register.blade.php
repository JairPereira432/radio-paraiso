@extends('layouts.app')
@section('title','Registro — Radio Paraíso')
@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md card-rp p-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1.5"
             style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>
        <div class="text-center mb-8">
            <h1 class="text-2xl font-black text-gray-800">Únete a la Familia</h1>
            <p class="text-gray-400 text-sm mt-1">Radio Paraíso TV Digital</p>
        </div>
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Nombre</label>
                <input name="name" type="text" value="{{ old('name') }}" required class="input-rp">
                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" required class="input-rp">
                @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Contraseña <span class="text-gray-400 font-normal">(mín. 8 caracteres)</span></label>
                <input name="password" type="password" required class="input-rp">
                @error('password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Confirmar Contraseña</label>
                <input name="password_confirmation" type="password" required class="input-rp">
            </div>
            <button type="submit" class="btn-primary w-full text-center">Crear Cuenta ✨</button>
        </form>
        <p class="text-center text-gray-400 text-sm mt-6">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="font-bold" style="color:#00d4aa;">Inicia sesión</a>
        </p>
    </div>
</div>
@endsection