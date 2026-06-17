<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = auth('admin')->user();

        $request->validate([
            'name'             => 'required|max:100',
            'email'            => 'required|email|unique:admins,email,' . $admin->id,
            'password'         => 'nullable|min:8|confirmed',
            'current_password' => 'required_with:password',
        ]);

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $admin->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
            }
        }

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $admin->update($data);

        return back()->with('success', 'Perfil actualizado correctamente.');
    }
}