<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Program, Contact, Slider, Admin};

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'programs' => Program::count(),
            'contacts' => Contact::where('read', false)->count(),
            'sliders'  => Slider::count(),
            'admins'   => Admin::count(),
        ];
        $recent_contacts = Contact::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats','recent_contacts'));
    }
}
