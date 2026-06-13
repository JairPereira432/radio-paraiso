@extends('layouts.app')
@section('title','Iniciar Sesión — Radio Paraíso')
@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md card-rp p-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1.5"
             style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-full flex items-center justify-center text-white font-black mx-auto mb-4 text-xl"
                 style="background:linear-gradient(135deg,#00d4aa,#00b4d8,#f9c74f); box-shadow:0 4px 20px #00d4aa33;">RP</div>
            <h1 class="text-2xl font-black text-gray-800">Iniciar Sesión</h1>
            <p class="text-gray-400 text-sm mt-1">Radio Paraíso TV Digital</p>
        </div>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" required autofocus class="input-rp">
                @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-600 mb-1.5">Contraseña</label>
                <input name="password" type="password" required class="input-rp">
            </div>
            <div class="flex items-center gap-2">
                <input name="remember" type="checkbox" id="remember" class="accent-teal-400">
                <label for="remember" class="text-sm text-gray-500 font-semibold">Recuérdame</label>
            </div>
            <button type="submit" class="btn-primary w-full text-center">Entrar</button>
        </form>
        <p class="text-center text-gray-400 text-sm mt-6">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="font-bold" style="color:#00d4aa;">Regístrate gratis</a>
        </p>
    </div>
</div>
@endsection