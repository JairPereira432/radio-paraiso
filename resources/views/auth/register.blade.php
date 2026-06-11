@extends('layouts.app')
@section('title','Registro')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md bg-radio-light border border-gold/20 rounded-2xl p-8">
        <div class="text-center mb-8">
            <h1 class="font-display text-3xl font-bold text-gold">Únete a la Familia</h1>
            <p class="text-gray-400 text-sm mt-1">Radio Paraíso TV Digital</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm text-gold mb-1">Nombre</label>
                <input name="name" type="text" value="{{ old('name') }}" required
                       class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-3 focus:outline-none focus:border-gold @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm text-gold mb-1">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" required
                       class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-3 focus:outline-none focus:border-gold @error('email') border-red-500 @enderror">
                @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm text-gold mb-1">Contraseña <span class="text-gray-500">(mín. 8 caracteres)</span></label>
                <input name="password" type="password" required
                       class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-3 focus:outline-none focus:border-gold">
                @error('password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm text-gold mb-1">Confirmar Contraseña</label>
                <input name="password_confirmation" type="password" required
                       class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-3 focus:outline-none focus:border-gold">
            </div>
            <button type="submit"
                    class="w-full bg-gold text-radio py-3 rounded-xl font-semibold hover:bg-gold-dark transition">
                Crear Cuenta
            </button>
        </form>

        <p class="text-center text-gray-400 text-sm mt-6">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-gold hover:underline">Inicia sesión</a>
        </p>
    </div>
</div>
@endsection