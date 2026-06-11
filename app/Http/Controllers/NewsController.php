<?php
namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Comment;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::published()->with('user')->latest()->paginate(9);
        return view('news.index', compact('news'));
    }

    public function show(string $slug)
    {
        $article  = News::where('slug', $slug)->where('status','published')->firstOrFail();
        $related  = News::published()->where('id','!=',$article->id)->latest()->take(3)->get();
        $comments = $article->comments()->where('approved',true)->with('user')->latest()->get();
        return view('news.show', compact('article','related','comments'));
    }

    public function storeComment(Request $request, News $news)
    {
        $request->validate(['body' => 'required|min:3|max:500']);

        Comment::create([
            'news_id' => $news->id,
            'user_id' => auth()->id(),
            'body'    => $request->body,
        ]);

        return back()->with('success', 'Comentario enviado, pendiente de aprobación.');
    }
}
