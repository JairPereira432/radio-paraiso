@extends('layouts.app')
@section('title','Iniciar Sesión')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md bg-radio-light border border-gold/20 rounded-2xl p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-gold rounded-full flex items-center justify-center mx-auto mb-4 font-black text-radio text-2xl">RP</div>
            <h1 class="font-display text-3xl font-bold text-gold">Iniciar Sesión</h1>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm text-gold mb-1">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" required autofocus
                       class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-3 focus:outline-none focus:border-gold @error('email') border-red-500 @enderror">
                @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm text-gold mb-1">Contraseña</label>
                <input name="password" type="password" required
                       class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-3 focus:outline-none focus:border-gold">
            </div>
            <div class="flex items-center gap-2">
                <input name="remember" type="checkbox" id="remember" class="accent-gold">
                <label for="remember" class="text-sm text-gray-400">Recuérdame</label>
            </div>
            <button type="submit"
                    class="w-full bg-gold text-radio py-3 rounded-xl font-semibold hover:bg-gold-dark transition">
                Entrar
            </button>
        </form>

        <p class="text-center text-gray-400 text-sm mt-6">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-gold hover:underline">Regístrate gratis</a>
        </p>
    </div>
</div>
@endsection