<?php
namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\SiteSetting;

class ProgramController extends Controller
{
    public function index()
    {
        $all      = Program::where('active', true)->orderBy('start_time')->get();
        $lv       = $all->whereIn('day_type', ['lunes_viernes','todos']);
        $sabados  = $all->whereIn('day_type', ['sabados','todos']);
        $domingos = $all->whereIn('day_type', ['domingos','todos']);
        $settings = SiteSetting::pluck('value', 'key');
        return view('programs', compact('all','lv','sabados','domingos','settings'));
    }
}