<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Program, Contact, Slider, Admin};

class DashboardController extends Controller
{
    public function index()
    {
        $listeners = 0;

        // Cuando tengas el servidor Icecast descomenta esto:
        // try {
        //     $stream_url = \App\Models\SiteSetting::get('radio_stream');
        //     $status_url = str_replace('/radio', '/status-json.xsl', $stream_url);
        //     $json = @file_get_contents($status_url);
        //     if ($json) {
        //         $data = json_decode($json, true);
        //         $listeners = $data['icestats']['source']['listeners'] ?? 0;
        //     }
        // } catch (\Exception $e) {
        //     $listeners = 0;
        // }

        $stats = [
            'programs'  => Program::count(),
            'contacts'  => Contact::where('read', false)->count(),
            'sliders'   => Slider::count(),
            'admins'    => Admin::count(),
            'listeners' => $listeners,
        ];

        $recent_contacts = Contact::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recent_contacts'));
    }
}