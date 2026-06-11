<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsAdminController extends Controller
{
    public function index()
    {
        $news = News::with('user')->latest()->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create() { return view('admin.news.create'); }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|max:255',
            'body'   => 'required',
            'status' => 'in:draft,published',
            'image'  => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title','excerpt','body','status','category','featured']);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        News::create($data);
        return redirect()->route('admin.news.index')->with('success', 'Noticia creada.');
    }

    public function edit(News $news)  { return view('admin.news.edit', compact('news')); }

    public function update(Request $request, News $news)
    {
        $request->validate(['title' => 'required', 'body' => 'required']);
        $data = $request->only(['title','excerpt','body','status','category','featured']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);
        return redirect()->route('admin.news.index')->with('success', 'Noticia actualizada.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return back()->with('success', 'Noticia eliminada.');
    }
}
