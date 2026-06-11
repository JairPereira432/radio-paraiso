@extends('layouts.app')
@section('title', 'TV y Videos — Radio Paraíso')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="font-display text-4xl font-bold text-gold mb-2">📺 Videoteca</h1>
    <p class="text-gray-400 mb-8">Programas especiales, clips y los mejores momentos</p>

    {{-- Filtros --}}
    <div class="flex flex-wrap gap-2 mb-8" x-data="{ cat: 'todos' }">
        @foreach(['todos','programa','especial','clip'] as $cat)
        <button @click="cat = '{{ $cat }}'"
                :class="cat === '{{ $cat }}' ? 'bg-gold text-radio' : 'border border-gold/30 text-gold hover:bg-gold/10'"
                class="px-5 py-2 rounded-full text-sm font-medium transition capitalize">
            {{ $cat === 'todos' ? 'Todos' : ucfirst($cat) }}
        </button>
        @endforeach
    </div>

    {{-- Grid de videos --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($videos ?? [] as $video)
        <div id="video-{{ $video->id }}"
             class="bg-radio-light border border-gold/20 rounded-xl overflow-hidden hover:border-gold/50 transition group cursor-pointer"
             onclick="openVideo('{{ $video->youtube_id }}', '{{ addslashes($video->title) }}')">
            <div class="relative">
                <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/mqdefault.jpg"
                     alt="{{ $video->title }}" class="w-full h-44 object-cover">
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                    <div class="w-14 h-14 bg-gold rounded-full flex items-center justify-center text-radio text-2xl">▶</div>
                </div>
                <span class="absolute top-2 right-2 bg-black/70 text-xs px-2 py-1 rounded">{{ $video->category }}</span>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-sm line-clamp-2 mb-1">{{ $video->title }}</h3>
                <p class="text-gray-400 text-xs">{{ $video->views }} vistas</p>
            </div>
        </div>
        @empty
        {{-- Demo cuando no hay videos --}}
        @foreach([
            ['dQw4w9WgXcQ','Never Gonna Give You Up','Rick Astley','clip'],
            ['9bZkp7q19f0','Gangnam Style','PSY','clip'],
            ['hTWKbfoikeg','Smells Like Teen Spirit','Nirvana','programa'],
        ] as [$yt,$title,$artist,$cat])
        <div class="bg-radio-light border border-gold/20 rounded-xl overflow-hidden hover:border-gold/50 transition group cursor-pointer"
             onclick="openVideo('{{ $yt }}', '{{ $title }}')">
            <div class="relative">
                <img src="https://img.youtube.com/vi/{{ $yt }}/mqdefault.jpg" alt="{{ $title }}"
                     class="w-full h-44 object-cover">
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                    <div class="w-14 h-14 bg-gold rounded-full flex items-center justify-center text-radio text-2xl">▶</div>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-sm">{{ $title }}</h3>
                <p class="text-gray-400 text-xs">{{ $artist }}</p>
            </div>
        </div>
        @endforeach
        @endforelse
    </div>
</div>

{{-- Modal de video --}}
<div id="video-modal" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4"
     onclick="closeVideo(event)">
    <div class="w-full max-w-4xl" onclick="event.stopPropagation()">
        <div class="flex justify-between items-center mb-3">
            <h3 id="modal-title" class="font-display text-xl text-gold"></h3>
            <button onclick="closeVideo()" class="text-gray-400 hover:text-white text-2xl">✕</button>
        </div>
        <div class="relative" style="padding-top:56.25%">
            <iframe id="yt-frame" class="absolute inset-0 w-full h-full rounded-xl"
                    frameborder="0" allowfullscreen
                    allow="autoplay; encrypted-media"></iframe>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openVideo(ytId, title) {
    document.getElementById('yt-frame').src = `https://www.youtube.com/embed/${ytId}?autoplay=1`;
    document.getElementById('modal-title').textContent = title;
    const modal = document.getElementById('video-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}
function closeVideo(e) {
    if (e && e.target !== document.getElementById('video-modal') && !e.target.closest('button[onclick="closeVideo()"]')) return;
    document.getElementById('yt-frame').src = '';
    const modal = document.getElementById('video-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endpush