<?php
namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Program;
use App\Models\SiteSetting;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('active', true)->orderBy('order')->get();

        $now     = Carbon::now();
        $hour    = $now->format('H:i:s');
        $dayName = strtolower($now->locale('es')->dayName);

        $dayType = match(true) {
            in_array($dayName, ['lunes','martes','miércoles','jueves','viernes']) => 'lunes_viernes',
            $dayName === 'sábado'  => 'sabados',
            $dayName === 'domingo' => 'domingos',
            default => 'todos'
        };

        $current_program = Program::where('active', true)
            ->whereIn('day_type', [$dayType, 'todos'])
            ->where('start_time', '<=', $hour)
            ->where('end_time',   '>=', $hour)
            ->first();

        $settings = SiteSetting::pluck('value', 'key');
        return view('home', compact('sliders','current_program','settings'));
    }
}