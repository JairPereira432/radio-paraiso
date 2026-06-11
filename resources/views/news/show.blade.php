@extends('layouts.app')
@section('title', $article->title . ' — Radio Paraíso')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">

    {{-- Breadcrumb --}}
    <p class="text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-gold">Inicio</a> /
        <a href="{{ route('news.index') }}" class="hover:text-gold">Noticias</a> /
        <span class="text-gray-400">{{ Str::limit($article->title, 40) }}</span>
    </p>

    {{-- Categoría --}}
    <span class="text-gold text-xs uppercase tracking-widest">{{ $article->category ?? 'Noticias' }}</span>

    {{-- Título --}}
    <h1 class="font-display text-4xl md:text-5xl font-black mt-2 mb-4 leading-tight">
        {{ $article->title }}
    </h1>

    {{-- Meta --}}
    <div class="flex items-center gap-4 text-sm text-gray-400 mb-8">
        <span>✍️ {{ $article->user->name }}</span>
        <span>📅 {{ $article->created_at->format('d \d\e F, Y') }}</span>
        <span>💬 {{ $article->comments->count() }} comentarios</span>
    </div>

    {{-- Imagen --}}
    @if($article->image)
    <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
         class="w-full h-72 md:h-96 object-cover rounded-2xl mb-8">
    @endif

    {{-- Cuerpo --}}
    <div class="prose prose-invert prose-lg max-w-none mb-12 text-gray-300 leading-relaxed">
        {!! nl2br(e($article->body)) !!}
    </div>

    <hr class="border-gold/20 mb-12">

    {{-- Comentarios --}}
    <section>
        <h2 class="font-display text-2xl font-bold text-gold mb-6">
            💬 Comentarios ({{ $comments->count() }})
        </h2>

        @forelse($comments as $comment)
        <div class="flex gap-4 mb-6">
            <div class="w-10 h-10 bg-gold/20 rounded-full flex items-center justify-center font-bold text-gold flex-shrink-0">
                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
            </div>
            <div class="flex-1 bg-radio-light border border-gold/20 rounded-xl p-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold text-sm">{{ $comment->user->name }}</span>
                    <span class="text-gray-500 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-gray-300 text-sm">{{ $comment->body }}</p>
            </div>
        </div>
        @empty
        <p class="text-gray-500 mb-8">Sé el primero en comentar.</p>
        @endforelse

        {{-- Formulario de comentario --}}
        @auth
        <form method="POST" action="{{ route('news.comment', $article) }}"
              class="bg-radio-light border border-gold/20 rounded-xl p-6 mt-6">
            @csrf
            <label class="block text-sm text-gold mb-2">Deja tu comentario</label>
            <textarea name="body" rows="4" required maxlength="500"
                      placeholder="Escribe tu comentario..."
                      class="w-full bg-black/30 border border-gold/20 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-gold resize-none mb-4">{{ old('body') }}</textarea>
            @error('body') <p class="text-red-400 text-xs mb-3">{{ $message }}</p> @enderror
            <button type="submit"
                    class="bg-gold text-radio px-6 py-2 rounded-full font-semibold hover:bg-gold-dark transition text-sm">
                Publicar Comentario
            </button>
        </form>
        @else
        <div class="bg-radio-light border border-gold/20 rounded-xl p-6 text-center mt-6">
            <p class="text-gray-400 text-sm">
                <a href="{{ route('login') }}" class="text-gold hover:underline">Inicia sesión</a>
                para dejar un comentario.
            </p>
        </div>
        @endauth
    </section>

    {{-- Noticias relacionadas --}}
    @if($related->count())
    <section class="mt-16">
        <h2 class="font-display text-2xl font-bold text-gold mb-6">También te puede interesar</h2>
        <div class="grid md:grid-cols-3 gap-4">
            @foreach($related as $item)
            <a href="{{ route('news.show', $item->slug) }}"
               class="group bg-radio-light border border-gold/20 rounded-xl overflow-hidden hover:border-gold/50 transition">
                @if($item->image)
                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}"
                     class="w-full h-36 object-cover">
                @else
                <div class="w-full h-36 bg-radio flex items-center justify-center text-3xl">🎵</div>
                @endif
                <div class="p-4">
                    <h3 class="text-sm font-semibold group-hover:text-gold transition line-clamp-2">{{ $item->title }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

</div>
@endsection