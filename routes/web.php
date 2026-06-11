<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsAdminController;
use App\Models\Program;
use App\Models\Video;

// ─────────────────────────────────────────────
// PÁGINAS PÚBLICAS
// ─────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/radio', fn() => view('radio'))->name('radio');

Route::get('/tv', function () {
    $videos = Video::where('status', 'published')->latest()->paginate(12);
    return view('tv', compact('videos'));
})->name('tv');

Route::get('/programacion', function () {
    $programs = Program::where('active', true)->get();
    return view('programs', compact('programs'));
})->name('programs');

// ─────────────────────────────────────────────
// NOTICIAS
// ─────────────────────────────────────────────
Route::get('/noticias', [NewsController::class, 'index'])->name('news.index');
Route::get('/noticias/{slug}', [NewsController::class, 'show'])->name('news.show');

// Comentarios (requiere login)
Route::post('/noticias/{news}/comentarios', [NewsController::class, 'storeComment'])
    ->name('news.comment')
    ->middleware('auth');

// ─────────────────────────────────────────────
// CONTACTO
// ─────────────────────────────────────────────
Route::get('/contacto', [ContactController::class, 'index'])->name('contact');
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');

// ─────────────────────────────────────────────
// AUTENTICACIÓN
// ─────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'login']);
    Route::get('/registro',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registro', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ─────────────────────────────────────────────
// PANEL ADMIN (solo admin y editor)
// ─────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,editor'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Noticias
    Route::resource('news', NewsAdminController::class)->except(['show']);

    // Programas
    Route::resource('programs', \App\Http\Controllers\Admin\ProgramAdminController::class)->except(['show']);

    // Videos
    Route::resource('videos', \App\Http\Controllers\Admin\VideoAdminController::class)->except(['show']);

    // Mensajes de contacto
    Route::get('contacts', function () {
        $contacts = \App\Models\Contact::latest()->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    })->name('contacts.index');

    Route::patch('contacts/{contact}/read', function (\App\Models\Contact $contact) {
        $contact->update(['read' => true]);
        return back()->with('success', 'Marcado como leído.');
    })->name('contacts.read');

    // Usuarios (solo admin)
    Route::middleware('role:admin')->group(function () {
        Route::get('users', function () {
            $users = \App\Models\User::latest()->paginate(20);
            return view('admin.users.index', compact('users'));
        })->name('users.index');

        Route::patch('users/{user}/role', function (\App\Models\User $user, \Illuminate\Http\Request $request) {
            $request->validate(['role' => 'required|in:admin,editor,user']);
            $user->update(['role' => $request->role]);
            return back()->with('success', 'Rol actualizado.');
        })->name('users.role');

        Route::patch('users/{user}/toggle', function (\App\Models\User $user) {
            $user->update(['active' => !$user->active]);
            return back()->with('success', 'Estado actualizado.');
        })->name('users.toggle');
    });

    // Comentarios pendientes
    Route::get('comments', function () {
        $comments = \App\Models\Comment::where('approved', false)
            ->with(['user', 'news'])->latest()->get();
        return view('admin.comments.index', compact('comments'));
    })->name('comments.index');

    Route::patch('comments/{comment}/approve', function (\App\Models\Comment $comment) {
        $comment->update(['approved' => true]);
        return back()->with('success', 'Comentario aprobado.');
    })->name('comments.approve');

    Route::delete('comments/{comment}', function (\App\Models\Comment $comment) {
        $comment->delete();
        return back()->with('success', 'Comentario eliminado.');
    })->name('comments.destroy');
});