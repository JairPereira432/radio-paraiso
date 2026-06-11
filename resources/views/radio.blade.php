@extends('layouts.app')
@section('title', 'Radio en Vivo — Radio Paraíso')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid lg:grid-cols-3 gap-8">

        {{-- ── Player Principal ── --}}
        <div class="lg:col-span-2">
            <div class="bg-radio-light border border-gold/30 rounded-2xl p-8 text-center">
                <div class="w-24 h-24 bg-gold/20 border-2 border-gold rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
                    <span class="text-5xl">🎙</span>
                </div>
                <span class="inline-block bg-red-600 text-xs px-3 py-1 rounded-full mb-3 animate-pulse">● EN VIVO</span>
                <h1 class="font-display text-3xl font-bold text-gold mb-1">Radio Paraíso TV Digital</h1>
                <p class="text-gray-400 mb-6">Los Grandes Clásicos · 70s · 80s · 90s</p>

                <div id="now-playing-card"
                     class="bg-black/30 rounded-xl p-4 mb-6 text-left flex items-center gap-4">
                    <div class="w-14 h-14 bg-gold/20 rounded-lg flex items-center justify-center text-2xl flex-shrink-0">🎵</div>
                    <div>
                        <p class="text-xs text-gold/70 uppercase tracking-wider mb-1">Sonando ahora</p>
                        <p id="song-title"  class="font-semibold">Radio Paraíso en Vivo</p>
                        <p id="song-artist" class="text-gray-400 text-sm">Los Grandes Clásicos</p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-6 mb-6">
                    <button onclick="togglePlay()" id="main-play-btn"
                        class="w-20 h-20 bg-gold text-radio rounded-full flex items-center justify-center text-3xl hover:bg-gold-dark transition shadow-xl shadow-gold/20">▶</button>
                </div>

                <div class="flex items-center gap-3 max-w-xs mx-auto">
                    <span class="text-lg">🔈</span>
                    <input type="range" min="0" max="1" step="0.05" value="0.8"
                           onchange="setVolume(this.value)"
                           class="flex-1 accent-gold">
                    <span class="text-lg">🔊</span>
                </div>
            </div>

            {{-- Horario del día --}}
            <div class="mt-6 bg-radio-light border border-gold/20 rounded-2xl p-6">
                <h2 class="font-display text-xl font-bold text-gold mb-4">📅 Programación Hoy</h2>
                <div id="today-schedule" class="space-y-2">
                    <p class="text-gray-400 text-sm">Cargando horario...</p>
                </div>
            </div>
        </div>

        {{-- ── Chat en Vivo (Firebase) ── --}}
        <div class="bg-radio-light border border-gold/20 rounded-2xl flex flex-col h-[600px]">
            <div class="p-4 border-b border-gold/20">
                <h2 class="font-display text-lg font-bold text-gold">💬 Chat en Vivo</h2>
                <p class="text-xs text-gray-400">Comenta con la audiencia</p>
            </div>

            <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-3 text-sm">
                <p class="text-gray-500 text-xs text-center">Cargando mensajes...</p>
            </div>

            <div class="p-4 border-t border-gold/20">
                @auth
                <div class="flex gap-2">
                    <input id="chat-input" type="text" placeholder="Escribe un mensaje..."
                           class="flex-1 bg-black/30 border border-gold/20 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-gold"
                           maxlength="200" onkeypress="if(event.key==='Enter') sendChat()">
                    <button onclick="sendChat()"
                        class="bg-gold text-radio px-4 rounded-lg font-semibold hover:bg-gold-dark transition text-sm">
                        Enviar
                    </button>
                </div>
                @else
                <p class="text-center text-gray-400 text-xs">
                    <a href="{{ route('login') }}" class="text-gold hover:underline">Inicia sesión</a> para chatear
                </p>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="module">
import { getFirestore, collection, addDoc, query, orderBy, limit, onSnapshot, serverTimestamp }
    from "https://www.gstatic.com/firebasejs/10.7.0/firebase-firestore.js";

const db = window.db;
const chatRef = collection(db, 'radio_chat');
const q = query(chatRef, orderBy('createdAt', 'desc'), limit(50));

// Escucha mensajes en tiempo real
onSnapshot(q, (snapshot) => {
    const container = document.getElementById('chat-messages');
    const msgs = [];
    snapshot.forEach(doc => msgs.push(doc.data()));
    msgs.reverse();
    container.innerHTML = msgs.map(m => `
        <div class="flex gap-2 items-start">
            <div class="w-7 h-7 bg-gold/20 rounded-full flex items-center justify-center text-xs flex-shrink-0 font-bold text-gold">
                ${(m.user || 'A')[0].toUpperCase()}
            </div>
            <div>
                <span class="text-gold text-xs font-semibold">${m.user || 'Anónimo'}</span>
                <p class="text-gray-200">${m.text}</p>
            </div>
        </div>
    `).join('');
    container.scrollTop = container.scrollHeight;
});

window.sendChat = async function() {
    const input = document.getElementById('chat-input');
    const text = input.value.trim();
    if (!text) return;

    await addDoc(chatRef, {
        text: text,
        user: '{{ auth()->user()?->name ?? "Oyente" }}',
        createdAt: serverTimestamp()
    });
    input.value = '';
};
</script>
@endpush