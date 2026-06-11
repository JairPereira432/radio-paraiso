<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() { return view('contact'); }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'type'    => 'required|in:peticion_musical,denuncia,nota_voz,contacto_general',
            'message' => 'required|min:10|max:1000',
            'audio'   => 'nullable|file|mimes:mp3,wav,ogg,m4a|max:10240',
        ]);

        $audio_path = null;
        if ($request->hasFile('audio')) {
            $audio_path = $request->file('audio')->store('audios', 'public');
        }

        Contact::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'type'       => $request->type,
            'message'    => $request->message,
            'audio_file' => $audio_path,
        ]);

        return back()->with('success', '¡Mensaje enviado! Te responderemos pronto.');
    }
}