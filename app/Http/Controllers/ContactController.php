<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key');
        return view('contact', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|max:100',
            'email'   => 'required|email',
            'subject' => 'nullable|max:200',
            'message' => 'required|min:10|max:1000',
        ]);

        Contact::create($request->only('name','email','subject','message'));
        return back()->with('success','¡Mensaje enviado! Te responderemos pronto.');
    }
}