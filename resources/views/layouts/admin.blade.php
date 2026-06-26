<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Admin') — Radio Paraíso</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        .grad-text { background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; font-weight:800; }
        .section-title { font-size:11px; text-transform:uppercase; letter-spacing:2px; font-weight:800; background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .card-admin { background:#fff; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.06); border:1px solid #f0f0f0; }
        .nav-link { display:flex; align-items:center; gap:10px; padding:10px 14px; border-radius:10px; font-size:14px; font-weight:600; color:#64748b; transition:all 0.2s; text-decoration:none; }
        .nav-link:hover { background:#f0fffc; color:#00a896; }
        .nav-link.active { background:linear-gradient(135deg,#00d4aa,#00b4d8); color:#fff; box-shadow:0 4px 15px #00d4aa44; }
        .input-admin { width:100%; background:#f8fffd; border:1.5px solid #b2f0e0; border-radius:8px; padding:10px 14px; font-size:14px; color:#111; outline:none; transition:border-color 0.2s; }
        .input-admin:focus { border-color:#00d4aa; }
        .select-admin { width:100%; background:#f8fffd; border:1.5px solid #b2f0e0; border-radius:8px; padding:10px 14px; font-size:14px; color:#111; outline:none; }
        .btn-admin { background:linear-gradient(135deg,#00d4aa,#00b4d8); color:#fff; border:none; padding:10px 22px; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; transition:transform 0.2s; display:inline-block; text-decoration:none; }
        .btn-admin:hover { transform:translateY(-1px); }
        ::-webkit-scrollbar { width:5px; }
        ::-webkit-scrollbar-thumb { background:#00d4aa; border-radius:3px; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50" x-data="{ sidebarOpen: true }">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r flex flex-col flex-shrink-0 sticky top-0 h-screen"
           style="border-color:#e0faf5;">

        {{-- Logo --}}
        <div class="p-5 border-b" style="border-color:#e0faf5;">
            <img src="{{ asset('images/logo-admin.png') }}" alt="Paraíso TV Admin" class="h-9 w-auto">
        </div>

        {{-- Nav --}}
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">

            <p class="section-title px-3 mb-3">Principal</p>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                📊 Dashboard
            </a>

            <p class="section-title px-3 mb-3 mt-5">Contenido</p>
            <a href="{{ route('admin.sliders.index') }}"
               class="nav-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                🖼️ Sliders
            </a>
            <a href="{{ route('admin.programs.index') }}"
               class="nav-link {{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">
                📅 Programación
            </a>
            <a href="{{ route('admin.contacts.index') }}"
               class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                📬 Mensajes
                @php $unread = \App\Models\Contact::where('read',false)->count(); @endphp
                @if($unread)
                <span class="ml-auto text-xs text-white px-2 py-0.5 rounded-full font-bold"
                      style="background:#f8961e;">{{ $unread }}</span>
                @endif
            </a>

            <p class="section-title px-3 mb-3 mt-5">Sistema</p>
            <a href="{{ route('admin.profile') }}"
               class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                👤 Mi Perfil
            </a>
            <a href="{{ route('admin.settings') }}"
               class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                ⚙️ Configuración
            </a>

        </nav>

        {{-- Footer sidebar --}}
        <div class="p-4 border-t" style="border-color:#e0faf5;">
            <div class="flex items-center gap-2 mb-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold"
                     style="background:linear-gradient(135deg,#00d4aa,#00b4d8);">
                    {{ strtoupper(substr(auth('admin')->user()->name,0,1)) }}
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-700">{{ auth('admin')->user()->name }}</p>
                    <p class="text-xs text-gray-400">{{ auth('admin')->user()->role }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="w-full text-left text-xs text-red-400 hover:text-red-600 font-semibold transition py-1">
                    🚪 Cerrar Sesión
                </button>
            </form>
            <a href="{{ route('home') }}" target="_blank"
               class="block text-xs text-gray-400 hover:text-teal-500 font-semibold transition mt-1">
                🌐 Ver Sitio Web
            </a>
        </div>
    </aside>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="flex-1 overflow-auto">

        {{-- Header --}}
        <div class="bg-white border-b px-6 py-4 flex items-center justify-between sticky top-0 z-10"
             style="border-color:#e0faf5;">
            <h1 class="text-lg font-black text-gray-800">@yield('page-title', 'Dashboard')</h1>
            @if(session('success'))
            <div class="px-4 py-2 rounded-lg text-sm font-semibold"
                 style="background:#e0fff8; color:#00a896; border:1px solid #00d4aa44;">
                ✅ {{ session('success') }}
            </div>
            @endif
        </div>

        <div class="p-6">
            @yield('content')
        </div>
    </main>
</div>

@stack('scripts')
</body>
</html>