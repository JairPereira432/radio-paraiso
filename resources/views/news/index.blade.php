@extends('layouts.app')
@section('title','Noticias — Radio Paraíso')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <p class="section-title mb-1">Blog</p>
    <h1 class="text-3xl font-black text-gray-800 mb-2">📰 Noticias</h1>
    <p class="text-gray-400 mb-10">Lo último del mundo de la música y Radio Paraíso</p>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($news as $article)
        <a href="{{ route('news.show', $article->slug) }}"
           class="card-rp overflow-hidden group hover:shadow-xl transition hover:-translate-y-1">
            @if($article->image)
            <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
                 class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
            @else
            <div class="w-full h-48 flex items-center justify-center text-5xl"
                 style="background:linear-gradient(135deg,#e0fff8,#e0f8ff);">🎵</div>
            @endif
            <div class="p-5">
                <span class="badge-teal">{{ $article->category ?? 'Noticias' }}</span>
                <h2 class="font-bold text-gray-800 mt-2 mb-2 group-hover:text-teal-500 transition line-clamp-2">{{ $article->title }}</h2>
                <p class="text-gray-400 text-sm line-clamp-2 mb-4">{{ $article->excerpt }}</p>
                <div class="flex justify-between text-xs text-gray-400 border-t pt-3 font-semibold" style="border-color:#e0faf5;">
                    <span>{{ $article->user->name }}</span>
                    <span>{{ $article->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-3 text-center py-20">
            <p class="text-5xl mb-4">📰</p>
            <p class="text-gray-500 font-semibold">No hay noticias publicadas aún.</p>
        </div>
        @endforelse
    </div>
    <div class="mt-10">{{ $news->links() }}</div>
</div>
@endsection