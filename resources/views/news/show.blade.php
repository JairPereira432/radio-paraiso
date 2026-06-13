@extends('layouts.app')
@section('title', $article->title . ' — Radio Paraíso')
@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <p class="text-sm text-gray-400 mb-6 font-semibold">
        <a href="{{ route('home') }}" class="hover:text-teal-500 transition">Inicio</a>
        <span class="mx-2">·</span>
        <a href="{{ route('news.index') }}" class="hover:text-teal-500 transition">Noticias</a>
        <span class="mx-2">·</span>
        <span class="text-gray-600">{{ Str::limit($article->title,40) }}</span>
    </p>

    <span class="badge-teal">{{ $article->category ?? 'Noticias' }}</span>
    <h1 class="text-4xl md:text-5xl font-black text-gray-800 mt-3 mb-4 leading-tight">{{ $article->title }}</h1>

    <div class="flex items-center gap-4 text-sm text-gray-400 mb-8 font-semibold">
        <span>✍️ {{ $article->user->name }}</span>
        <span>📅 {{ $article->created_at->format('d \d\e F, Y') }}</span>
        <span>💬 {{ $article->comments->count() }} comentarios</span>
    </div>

    @if($article->image)
    <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
         class="w-full h-72 md:h-96 object-cover rounded-2xl mb-8"
         style="border:1px solid #e0faf5;">
    @endif

    <div class="text-gray-600 leading-relaxed text-base mb-12 space-y-4">
        {!! nl2br(e($article->body)) !!}
    </div>

    <hr style="border-color:#e0faf5;" class="mb-12">

    <section>
        <h2 class="text-2xl font-black text-gray-800 mb-6">💬 Comentarios ({{ $comments->count() }})</h2>
        @forelse($comments as $comment)
        <div class="flex gap-4 mb-5">
            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white flex-shrink-0"
                 style="background:linear-gradient(135deg,#00d4aa,#00b4d8);">
                {{ strtoupper(substr($comment->user->name,0,1)) }}
            </div>
            <div class="flex-1 card-rp p-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-bold text-gray-700 text-sm">{{ $comment->user->name }}</span>
                    <span class="text-gray-400 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-gray-600 text-sm">{{ $comment->body }}</p>
            </div>
        </div>
        @empty
        <p class="text-gray-400 mb-8">Sé el primero en comentar.</p>
        @endforelse

        @auth
        <form method="POST" action="{{ route('news.comment', $article) }}" class="card-rp p-6 mt-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1"
                 style="background:linear-gradient(90deg,#00d4aa,#00b4d8,#f9c74f,#f8961e);"></div>
            @csrf
            <label class="block text-sm font-bold text-gray-600 mb-2">Deja tu comentario</label>
            <textarea name="body" rows="4" required maxlength="500"
                      placeholder="Escribe tu comentario..."
                      class="input-rp resize-none mb-4">{{ old('body') }}</textarea>
            @error('body') <p class="text-red-400 text-xs mb-3">{{ $message }}</p> @enderror
            <button type="submit" class="btn-primary">Publicar Comentario</button>
        </form>
        @else
        <div class="card-rp p-6 text-center mt-6">
            <p class="text-gray-400 text-sm">
                <a href="{{ route('login') }}" class="font-bold" style="color:#00d4aa;">Inicia sesión</a>
                para dejar un comentario.
            </p>
        </div>
        @endauth
    </section>

    @if($related->count())
    <section class="mt-16">
        <h2 class="text-xl font-black text-gray-800 mb-6">También te puede interesar</h2>
        <div class="grid md:grid-cols-3 gap-4">
            @foreach($related as $item)
            <a href="{{ route('news.show', $item->slug) }}"
               class="card-rp overflow-hidden group hover:shadow-xl transition hover:-translate-y-1">
                @if($item->image)
                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}"
                     class="w-full h-36 object-cover">
                @else
                <div class="w-full h-36 flex items-center justify-center text-3xl"
                     style="background:linear-gradient(135deg,#e0fff8,#e0f8ff);">🎵</div>
                @endif
                <div class="p-4">
                    <h3 class="text-sm font-bold text-gray-700 group-hover:text-teal-500 transition line-clamp-2">{{ $item->title }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection