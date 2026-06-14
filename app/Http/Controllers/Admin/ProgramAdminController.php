<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramAdminController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('start_time')->paginate(15);
        return view('admin.programs.index', compact('programs'));
    }

    public function create() { return view('admin.programs.create'); }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|max:255',
            'start_time' => 'required',
            'end_time'   => 'required',
            'day_type'   => 'required',
        ]);
        Program::create($request->all());
        return redirect()->route('admin.programs.index')->with('success','Programa creado.');
    }

    public function edit(Program $program) { return view('admin.programs.edit', compact('program')); }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name'       => 'required',
            'start_time' => 'required',
            'end_time'   => 'required',
        ]);
        $program->update($request->all());
        return redirect()->route('admin.programs.index')->with('success','Programa actualizado.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return back()->with('success','Programa eliminado.');
    }
}