@extends('layouts.app')
@section('title','Radio en Vivo — Radio Paraíso')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <p class="section-title mb-1">Transmisión en directo</p>
    <h1 class="text-3xl font-black text-gray-800 mb-8">📻 Radio en Vivo</h1>

    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="card-rp p-8 text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1.5"
                     style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>
                <div class="w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-5"
                     style="background:linear-gradient(135deg,#e0fff8,#e0f8ff); border:3px solid #00d4aa55; box-shadow:0 4px 20px #00d4aa22;">
                    <span class="text-5xl">🎙</span>
                </div>
                <div class="inline-flex items-center gap-2 bg-white px-4 py-1.5 rounded-full mb-4 text-sm font-bold"
                     style="border:1.5px solid #00d4aa55; color:#00a896;">
                    <span class="dot-live"></span> EN VIVO
                </div>
                <h2 class="text-2xl font-black text-gray-800 mb-1">Radio Paraíso TV Digital</h2>
                <p class="text-gray-400 mb-6">Los Grandes Clásicos · 70s · 80s · 90s</p>

                <div class="rounded-xl p-4 mb-6 flex items-center gap-4"
                     style="background:#f8fffd; border:1.5px solid #e0faf5;">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center text-2xl flex-shrink-0"
                         style="background:linear-gradient(135deg,#e0fff8,#e0f8ff);">🎵</div>
                    <div class="text-left">
                        <p class="section-title text-xs mb-1">Sonando ahora</p>
                        <p class="text-gray-800 font-bold">Radio Paraíso en Vivo</p>
                        <p class="text-gray-400 text-sm">Los Grandes Clásicos</p>
                    </div>
                </div>

                <div class="flex justify-center mb-6">
                    <button onclick="togglePlay()"
                        class="w-20 h-20 rounded-full text-white text-3xl flex items-center justify-center"
                        style="background:linear-gradient(135deg,#00d4aa,#00b4d8); box-shadow:0 8px 30px #00d4aa55;">▶</button>
                </div>
                <div class="flex items-center gap-3 max-w-xs mx-auto">
                    <span class="text-gray-300">🔈</span>
                    <input type="range" min="0" max="1" step="0.05" value="0.8"
                           onchange="setVolume(this.value)" class="flex-1 accent-teal-400">
                    <span class="text-gray-300">🔊</span>
                </div>
            </div>

            <div class="card-rp p-6">
                <h2 class="text-lg font-black text-gray-800 mb-4">📅 Programación de Hoy</h2>
                <p class="text-gray-400 text-sm">Cargando horario...</p>
            </div>
        </div>

        <div class="card-rp flex flex-col relative overflow-hidden" style="height:600px;">
            <div class="absolute top-0 left-0 right-0 h-1"
                 style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>
            <div class="p-4 border-b" style="border-color:#e0faf5;">
                <h2 class="text-lg font-black text-gray-800">💬 Chat en Vivo</h2>
                <p class="text-gray-400 text-xs mt-0.5">Comenta con la audiencia</p>
            </div>
            <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-3 text-sm">
                <p class="text-gray-300 text-xs text-center">Cargando mensajes...</p>
            </div>
            <div class="p-4 border-t" style="border-color:#e0faf5;">
                @auth
                <div class="flex gap-2">
                    <input id="chat-input" type="text" placeholder="Escribe un mensaje..."
                           maxlength="200" onkeypress="if(event.key==='Enter') sendChat()"
                           class="input-rp flex-1 py-2 text-sm">
                    <button onclick="sendChat()"
                        class="px-4 rounded-xl text-white text-sm font-bold"
                        style="background:linear-gradient(135deg,#00d4aa,#00b4d8);">Enviar</button>
                </div>
                @else
                <p class="text-center text-gray-400 text-xs">
                    <a href="{{ route('login') }}" class="font-bold" style="color:#00d4aa;">Inicia sesión</a> para chatear
                </p>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="module">
import { collection, addDoc, query, orderBy, limit, onSnapshot, serverTimestamp }
    from "https://www.gstatic.com/firebasejs/10.7.0/firebase-firestore.js";
const db = window.db;
const chatRef = collection(db,'radio_chat');
const q = query(chatRef, orderBy('createdAt','desc'), limit(50));
onSnapshot(q, (snapshot) => {
    const container = document.getElementById('chat-messages');
    const msgs = [];
    snapshot.forEach(doc => msgs.push(doc.data()));
    msgs.reverse();
    container.innerHTML = msgs.map(m => `
        <div class="flex gap-2 items-start">
            <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0"
                 style="background:linear-gradient(135deg,#00d4aa,#00b4d8);">${(m.user||'A')[0].toUpperCase()}</div>
            <div><span class="text-xs font-bold" style="color:#00a896;">${m.user||'Oyente'}</span>
            <p class="text-gray-600 text-sm">${m.text}</p></div>
        </div>`).join('');
    container.scrollTop = container.scrollHeight;
});
window.sendChat = async function() {
    const input = document.getElementById('chat-input');
    const text = input.value.trim();
    if (!text) return;
    await addDoc(chatRef, { text, user: '{{ auth()->user()?->name ?? "Oyente" }}', createdAt: serverTimestamp() });
    input.value = '';
};
</script>
@endpush