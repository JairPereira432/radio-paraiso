<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth('admin')->check()) {
            return redirect()->route('admin.login');
        }
        if (!auth('admin')->user()->active) {
            auth('admin')->logout();
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'Cuenta desactivada.']);
        }
        return $next($request);
    }
}