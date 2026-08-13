<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;


Route::get('/debug/proxy', function (Illuminate\Http\Request $request) {
    return response()->json([
        'ip' => $request->ip(),
        'secure' => $request->isSecure(),
        'scheme' => $request->getScheme(),
        'host' => $request->getHost(),

        'x_real_ip' => $request->header('X-Real-IP'),
        'x_forwarded_for' => $request->header('X-Forwarded-For'),
        'x_forwarded_proto' => $request->header('X-Forwarded-Proto'),
        'x_forwarded_host' => $request->header('X-Forwarded-Host'),

        'railway_edge' => $request->header('X-Railway-Edge'),
        'railway_request_id' => $request->header('X-Railway-Request-Id'),
    ]);
});


Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/contacto', function () {
    return view('contacto.index');
})->name('contacto');

Route::get('/registro', function () {
    return view('auth.form');
})->name('');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('usuarios', UsuarioController::class)->only('index');

    Route::resource('productos', ProductoController::class);

    Route::get('/profile/view', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
