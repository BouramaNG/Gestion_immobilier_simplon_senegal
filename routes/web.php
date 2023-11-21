<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Agence;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\BienController;
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
    return view('frontend.acceuil');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('admin/dashboard', [AdminController::class,'AdminDashboard'])->name('admin.dashboard');
});
Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('agence/dashboard', [AgenceController::class,'AgenceDashboard'])->name('agence.dashboard');
});
//ALL MY ROUTE THAT I ADD IN THIS PROJECT
Route::get('ajout_bien', [BienController::class,'index']);
Route::post('ajout_bien', [BienController::class,'store']);
Route::delete('liste_bien/{id}', [BienController::class,'delete']);
Route::get('liste_bien', [BienController::class,'show'])->name('liste.bien');
Route::get('modifier/{id}', [BienController::class,'edit']);
Route::put('modifier/{id}', [BienController::class, 'update']);
require __DIR__.'/auth.php';
