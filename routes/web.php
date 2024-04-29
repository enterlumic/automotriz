<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\MigracionesController;
Route::get('migraciones', [MigracionesController::class, 'index'])->middleware('auth');
Route::post('get_migraciones_by_id', [MigracionesController::class, 'get_migraciones_by_id'])->middleware('auth');
Route::post('delete_migraciones', [MigracionesController::class, 'delete_migraciones'])->middleware('auth');
Route::post('undo_delete_migraciones', [MigracionesController::class, 'undo_delete_migraciones'])->middleware('auth');
Route::get('get_migraciones_by_datatable', [MigracionesController::class, 'get_migraciones_by_datatable'])->middleware('auth');
Route::post('truncate_migraciones', [MigracionesController::class, 'truncate_migraciones'])->middleware('auth');
Route::post('showDatabases', [MigracionesController::class, 'showDatabases'])->middleware('auth');


// Rutas

require __DIR__.'/auth.php';

