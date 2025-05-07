<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminReservaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Redirección inicial */

Route::get('/', function () {
    return redirect()->route('welcome');
});

/* Vista de bienvenida */
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

/* Registro */
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

/* Login */
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

/* Paneles (puedes ajustar las vistas según las tengas disponibles) */
Route::get('/panel/customer', [CustomerController::class, 'panel'])
    ->middleware('viajero.auth')
    ->name('customer.panel');

Route::get('/panel/customer', [CustomerController::class, 'index'])->name('customer.panel');

Route::get('/panel/admin', function () {
    return view('panel.admin');
})->name('admin.panel');

Route::get('/panel/hotel', function () {
    return view('panel.hotel');
})->name('corp.panel');

Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta de bienvenida (para evitar error 404 al cerrar sesión o redirigir)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Ruta para el editar los diferentes perfiles
Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/perfil/editar', [ProfileController::class, 'update'])->name('profile.update');

//Rutas para el calendario 
Route::post('/admin/reserva/oneway', [AdminReservaController::class, 'storeOneWay'])->name('admin.reserva.oneway');
Route::get('/admin', function () {
    return view('panel.admin');
})->name('admin.panel');


Route::post('/admin/reservas/return', [AdminReservaController::class, 'storeReturn'])->name('admin.reserva.return');
Route::post('/admin/reserva/roundtrip', [AdminReservaController::class, 'storeRoundTrip'])->name('admin.reserva.roundtrip');


// Get para verificar conexión con BBDD de MySQL
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        $databaseName = DB::connection()->getDatabaseName();
        return "✅ Conexión exitosa a MySQL. Base de datos: <strong>{$databaseName}</strong>";
    } catch (\Exception $e) {
        return "❌ Error de conexión: " . $e->getMessage();
    }
});
