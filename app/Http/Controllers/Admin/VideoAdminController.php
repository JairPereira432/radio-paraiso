<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoAdminController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->paginate(15);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|max:255',
            'youtube_id' => 'required|max:20',
            'category'   => 'nullable|string',
            'thumbnail'  => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title','description','youtube_id','category','featured','status']);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Video::create($data);
        return redirect()->route('admin.videos.index')->with('success', 'Película agregada.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title'      => 'required|max:255',
            'youtube_id' => 'required|max:20',
        ]);

        $data = $request->only(['title','description','youtube_id','category','featured','status']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $video->update($data);
        return redirect()->route('admin.videos.index')->with('success', 'Película actualizada.');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return back()->with('success', 'Película eliminada.');
    }
}