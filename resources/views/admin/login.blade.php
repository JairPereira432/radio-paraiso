<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Radio Paraíso</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>* { font-family:'Inter',sans-serif; }</style>
</head>
<body style="background:linear-gradient(135deg,#0a2a1a 0%,#0d3b2e 50%,#1a4a3a 100%); min-height:100vh;" class="flex items-center justify-center p-4">

<div class="w-full max-w-md">
    <div class="text-center mb-8">
        <img src="{{ asset('images/logo-admin.png') }}" alt="Paraíso TV Admin" class="h-20 w-auto mx-auto mb-4">
        <p class="text-white/50 text-sm mt-1">Panel Administrativo</p>
    </div>

    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8">
        <div class="absolute top-0 left-0 right-0 h-1 rounded-t-2xl"
             style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>

        @if($errors->any())
        <div class="mb-4 px-4 py-3 rounded-xl text-sm font-semibold bg-red-500/20 text-red-300 border border-red-500/30">
            ❌ {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-bold text-white/70 mb-1.5">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" required autofocus
                       class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/30 outline-none focus:border-teal-400 focus:bg-white/20 transition text-sm"
                       placeholder="admin@radioparaiso.com">
            </div>
            <div>
                <label class="block text-sm font-bold text-white/70 mb-1.5">Contraseña</label>
                <input name="password" type="password" required
                       class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/30 outline-none focus:border-teal-400 focus:bg-white/20 transition text-sm"
                       placeholder="••••••••">
            </div>
            <div class="flex items-center gap-2">
                <input name="remember" type="checkbox" id="remember" class="accent-teal-400">
                <label for="remember" class="text-sm text-white/60 font-semibold">Mantener sesión</label>
            </div>
            <button type="submit"
                    class="w-full py-3 rounded-xl text-white font-bold text-sm transition hover:opacity-90"
                    style="background:linear-gradient(135deg,#00d4aa,#00b4d8); box-shadow:0 4px 20px #00d4aa44;">
                Ingresar al Panel
            </button>
        </form>
    </div>
    <p class="text-center text-white/30 text-xs mt-6">© {{ date('Y') }} Radio Paraíso TV Digital</p>
</div>
</body>
</html>