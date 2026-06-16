<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProgramAdminController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProfileController;

// ─── PÚBLICO ──────────────────────────────────────────────
Route::get('/',             [HomeController::class,   'index'])->name('home');
Route::get('/programacion', [ProgramController::class,'index'])->name('programs');
Route::get('/contacto',     [ContactController::class,'index'])->name('contact');
Route::post('/contacto',    [ContactController::class,'store'])->name('contact.store');

// ─── ADMIN ────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Login
    Route::get('/login',  [AdminAuthController::class,'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class,'login']);
    Route::post('/logout',[AdminAuthController::class,'logout'])->name('logout');

    // Panel protegido
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class,'index'])->name('dashboard');

        // Programas
        Route::resource('programs', ProgramAdminController::class)->except(['show']);

        // Sliders
        Route::resource('sliders', SliderController::class)->except(['show']);

        // Contactos
        Route::get('contacts',              [ContactAdminController::class,'index'])->name('contacts.index');
        Route::get('contacts/{contact}',    [ContactAdminController::class,'show'])->name('contacts.show');
        Route::delete('contacts/{contact}', [ContactAdminController::class,'destroy'])->name('contacts.destroy');

        // Configuración
        Route::get('settings',  [SettingsController::class,'index'])->name('settings');
        Route::post('settings', [SettingsController::class,'update'])->name('settings.update');

        // Perfil
        Route::get('profile',  [ProfileController::class,'index'])->name('profile');
        Route::post('profile', [ProfileController::class,'update'])->name('profile.update');
    });
});