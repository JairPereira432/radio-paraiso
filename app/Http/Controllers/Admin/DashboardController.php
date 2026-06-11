<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{User, News, Contact, Comment};

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users'    => User::count(),
            'news'     => News::count(),
            'contacts' => Contact::where('read', false)->count(),
            'comments' => Comment::where('approved', false)->count(),
        ];
        $recent_contacts = Contact::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recent_contacts'));
    }
}