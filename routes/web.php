<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Agence;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\CommentaireController;
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
Route::get('Ajoutcommentaire/{id}', [CommentaireController::class,'Ajoutcommentaire'])->name('frontend.Ajoutcommentaire');
Route::Post('Ajoutercommentaire/{id}', [CommentaireController::class,'Ajoutercommentaire'])->name('frontend.Ajoutercommentaire');
Route::get('listercommentaire', [CommentaireController::class,'Listercommentaire'])->name('admin.VoirCommentaire');
Route::delete('listercommentaire/{id}', [CommentaireController::class,'destroy']);
// Route::get('listercommentaire', [CommentaireController::class,'show']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class,'AdminDashboard'])->name('admin.dashboard');
});
Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('agence/dashboard', [AgenceController::class,'AgenceDashboard'])->name('agence.dashboard');
});
Route::get('ajout_bien', [BienController::class,'AjoutBien'])->name('ajout.bien');
Route::get('liste_bien', [BienController::class,'ListeBien'])->name('liste.bien');

require __DIR__.'/auth.php';

