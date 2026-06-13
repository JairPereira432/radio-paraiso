@extends('layouts.app')
@section('title','Películas — Radio Paraíso')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <p class="section-title mb-1">Videoteca</p>
    <h1 class="text-3xl font-black text-gray-800 mb-2">🎬 Películas</h1>
    <p class="text-gray-400 mb-8">Disfruta nuestra selección de películas clásicas</p>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">
        @forelse($videos as $video)
        <div class="card-rp overflow-hidden group cursor-pointer hover:shadow-xl transition hover:-translate-y-1"
             onclick="openVideo('{{ $video->youtube_id }}','{{ addslashes($video->title) }}','{{ addslashes($video->description) }}')">
            <div class="relative">
                <img src="{{ $video->thumbnail ? Storage::url($video->thumbnail) : 'https://img.youtube.com/vi/'.$video->youtube_id.'/mqdefault.jpg' }}"
                     alt="{{ $video->title }}" class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition"
                     style="background:rgba(0,212,170,0.25);">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center text-white text-2xl"
                         style="background:linear-gradient(135deg,#00d4aa,#00b4d8); box-shadow:0 4px 20px #00d4aa55;">▶</div>
                </div>
                @if($video->category)
                <span class="absolute top-2 left-2 text-xs font-bold text-white px-2 py-1 rounded-full"
                      style="background:linear-gradient(135deg,#f9c74f,#f8961e);">{{ ucfirst($video->category) }}</span>
                @endif
            </div>
            <div class="p-4">
                <h3 class="font-bold text-gray-800 text-sm line-clamp-2 group-hover:text-teal-500 transition">{{ $video->title }}</h3>
                @if($video->description)
                <p class="text-gray-400 text-xs mt-1 line-clamp-1">{{ $video->description }}</p>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-5 text-center py-24">
            <p class="text-6xl mb-4">🎬</p>
            <p class="text-gray-500 text-lg font-semibold">No hay películas disponibles aún.</p>
            <p class="text-gray-400 text-sm mt-1">El administrador agregará contenido próximamente.</p>
        </div>
        @endforelse
    </div>

    @if(isset($videos) && $videos->hasPages())
    <div class="mt-10">{{ $videos->links() }}</div>
    @endif
</div>

{{-- Modal --}}
<div id="video-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
     style="background:rgba(0,0,0,0.85);" onclick="closeVideo(event)">
    <div class="w-full max-w-5xl" onclick="event.stopPropagation()">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 id="modal-title" class="grad-text text-2xl"></h3>
                <p id="modal-desc" class="text-gray-400 text-sm mt-1"></p>
            </div>
            <button onclick="forceCloseVideo()"
                    class="text-white text-3xl leading-none ml-4 hover:opacity-70">✕</button>
        </div>
        <div class="relative rounded-2xl overflow-hidden" style="padding-top:56.25%;">
            <iframe id="yt-frame" class="absolute inset-0 w-full h-full"
                    frameborder="0" allowfullscreen allow="autoplay; encrypted-media;"></iframe>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
function openVideo(ytId, title, desc) {
    document.getElementById('yt-frame').src = `https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0`;
    document.getElementById('modal-title').textContent = title;
    document.getElementById('modal-desc').textContent = desc;
    const m = document.getElementById('video-modal');
    m.classList.remove('hidden'); m.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function forceCloseVideo() {
    document.getElementById('yt-frame').src = '';
    const m = document.getElementById('video-modal');
    m.classList.add('hidden'); m.classList.remove('flex');
    document.body.style.overflow = '';
}
function closeVideo(e) { if (e.target === document.getElementById('video-modal')) forceCloseVideo(); }
</script>
@endpush