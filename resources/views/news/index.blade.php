@extends('layouts.app')
@section('title', 'Noticias — Radio Paraíso')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="font-display text-4xl font-bold text-gold mb-2">📰 Noticias</h1>
    <p class="text-gray-400 mb-10">Lo último del mundo de la música y Radio Paraíso</p>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($news as $article)
        <a href="{{ route('news.show', $article->slug) }}"
           class="group bg-radio-light border border-gold/20 rounded-xl overflow-hidden hover:border-gold/50 transition">
            @if($article->image)
            <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
                 class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
            @else
            <div class="w-full h-48 bg-gradient-to-br from-radio-light to-radio flex items-center justify-center text-5xl">🎵</div>
            @endif
            <div class="p-5">
                <span class="text-gold text-xs uppercase tracking-wider">{{ $article->category ?? 'Noticias' }}</span>
                <h2 class="font-display font-bold text-lg mt-1 mb-2 group-hover:text-gold transition line-clamp-2">
                    {{ $article->title }}
                </h2>
                <p class="text-gray-400 text-sm line-clamp-3 mb-4">{{ $article->excerpt }}</p>
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>{{ $article->user->name }}</span>
                    <span>{{ $article->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-3 text-center py-20 text-gray-500">
            <p class="text-5xl mb-4">📰</p>
            <p>No hay noticias publicadas aún.</p>
        </div>
        @endforelse
    </div>

    {{-- Paginación --}}
    <div class="mt-10">
        {{ $news->links() }}
    </div>
</div>
@endsection