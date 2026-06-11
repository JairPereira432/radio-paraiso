<?php
namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Program;
use App\Models\Video;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $featured_news = News::published()->featured()->latest()->take(3)->get();
        $latest_news   = News::published()->latest()->take(6)->get();
        $today         = strtolower(Carbon::now()->locale('es')->dayName);
        $current_program = Program::where('day', $today)
            ->where('start_time', '<=', now()->format('H:i:s'))
            ->where('end_time',   '>=', now()->format('H:i:s'))
            ->first();
        $featured_videos = Video::where('status','published')->where('featured',true)->take(4)->get();

        return view('home', compact('featured_news','latest_news','current_program','featured_videos'));
    }
}