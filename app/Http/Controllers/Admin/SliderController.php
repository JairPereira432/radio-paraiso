<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'nullable|max:255',
            'subtitle'   => 'nullable|max:255',
            'image'      => 'required|string', // URL de Firebase
            'button_text'=> 'nullable|max:100',
            'button_url' => 'nullable|url',
            'order'      => 'nullable|integer',
        ]);

        Slider::create([
            'title'       => $request->title,
            'subtitle'    => $request->subtitle,
            'image'       => $request->image, // URL de Firebase Storage
            'button_text' => $request->button_text,
            'button_url'  => $request->button_url,
            'order'       => $request->order ?? 0,
            'active'      => $request->has('active'),
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider creado correctamente.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title'      => 'nullable|max:255',
            'subtitle'   => 'nullable|max:255',
            'image'      => 'required|string',
            'button_text'=> 'nullable|max:100',
            'button_url' => 'nullable|url',
            'order'      => 'nullable|integer',
        ]);

        $slider->update([
            'title'       => $request->title,
            'subtitle'    => $request->subtitle,
            'image'       => $request->image,
            'button_text' => $request->button_text,
            'button_url'  => $request->button_url,
            'order'       => $request->order ?? 0,
            'active'      => $request->has('active'),
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider actualizado.');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return back()->with('success', 'Slider eliminado.');
    }
}