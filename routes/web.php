<?php

use App\Models\Bien;
use App\Http\Controllers\Agence;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BienController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentaireController;

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


Route::prefix('user')->middleware(['auth','role:admin'])->group(function(){
    Route::get('/dashboard', [AdminController::class,'AdminDashboard'])->name('admin.dashboard');
    Route::get('add_admin', [AdminController::class,'AdAdmin'])->name('add.admin');
    Route::post('/add/admin', [AdminController::class,'addAdmin'])->name('add.admin');
    
    Route::get('ajout_bien', [BienController::class,'AjoutBien'])->name('ajout.bien');
    Route::get('liste_bien', [BienController::class,'ListeBien'])->name('liste.bien');
    Route::get('liste_user',[AdminController::class,'ListeUser'])->name('liste.user');
    Route::post('/inactive_user/{id}',[AdminController::class,'InactiveUser'])->name('inactive.user');
    Route::get('/',[AdminController::class,'Desactivation'])->name('desactiver');



    //route pour les biens 
Route::get('ajout_bien', [BienController::class,'index']);
Route::post('ajout_bien', [BienController::class,'store']);
Route::delete('liste_bien/{id}', [BienController::class, 'delete'])->name('bien.delete');
Route::get('liste_bien', [BienController::class,'show'])->name('liste.bien');
Route::get('modifier/{id}', [BienController::class,'edit']);
Route::put('modifier/{id}', [BienController::class, 'update']);
// web.php

Route::post('/search', [AdminController::class, 'search'])->name('search');
Route::get('/details/{id}', [BienController::class, 'details'])->name('bien.details');
Route::get('delete_comment/{id}', [CommentaireController::class, 'Supp'])->name('comment.delete');
Route::post('/comment/store', [CommentaireController::class, 'store'])->name('comment.store');
Route::get('Ajoutcommentaire/{id}', [CommentaireController::class,'Ajoutcommentaire'])->name('frontend.Ajoutcommentaire');
Route::post('Ajoutercommentaire/{id}', [CommentaireController::class,'Ajoutercommentaire'])->name('frontend.Ajoutercommentaire');
Route::get('listercommentaire', [CommentaireController::class,'Listercommentaire'])->name('admin.VoirCommentaire');
Route::get('commentaire', [CommentaireController::class,'Commentaire'])->name('frontend.VoirCommentaire');
Route::delete('listercommentaire/{id}', [CommentaireController::class,'destroy']);

});

Route::post('/store-step-1', [BienController::class, 'storeStep1'])->name('storeStep1');
Route::get('/form-step-2', [BienController::class, 'showFormStep2'])->name('showFormStep2');
Route::post('/store-step-2', [BienController::class, 'storeStep2'])->name('storeStep2');
Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class,'AdminDashboard'])->name('admin.dashboard');
});
Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('agence/dashboard', [AgenceController::class,'AgenceDashboard'])->name('agence.dashboard');
});
Route::get('add_admin', [AdminController::class,'AdAdmin'])->name('add.admin');
Route::post('/add/admin', [AdminController::class,'addAdmin'])->name('add.admin');

Route::get('ajout_bien', [BienController::class,'AjoutBien'])->name('ajout.bien');
Route::get('liste_bien', [BienController::class,'ListeBien'])->name('liste.bien');
Route::get('liste_user',[AdminController::class,'ListeUser'])->name('liste.user');
Route::post('/inactive_user/{id}',[AdminController::class,'InactiveUser'])->name('inactive.user');
Route::get('/',[AdminController::class,'Desactivation'])->name('desactiver');
Route::post('/change_role/{id}',[AdminController::class,'ChangeRole'])->name('change.role');

//route pour les biens 
Route::get('ajout_bien', [BienController::class,'index']);
Route::post('ajout_bien', [BienController::class,'store']);
Route::delete('liste_bien/{id}', [BienController::class, 'delete'])->name('bien.delete');
Route::get('liste_bien', [BienController::class,'show'])->name('liste.bien');
Route::get('modifier/{id}', [BienController::class,'edit']);
Route::put('modifier/{id}', [BienController::class, 'update']);
// web.php

Route::post('/search', [AdminController::class, 'search'])->name('search');
Route::get('/details/{id}', [BienController::class, 'details'])->name('bien.details');
Route::get('delete_comment/{id}', [CommentaireController::class, 'Supp'])->name('comment.delete');
Route::post('/comment/store', [CommentaireController::class, 'store'])->name('comment.store');
Route::get('Ajoutcommentaire/{id}', [CommentaireController::class,'Ajoutcommentaire'])->name('frontend.Ajoutcommentaire');
Route::post('Ajoutercommentaire/{id}', [CommentaireController::class,'Ajoutercommentaire'])->name('frontend.Ajoutercommentaire');
Route::get('listercommentaire', [CommentaireController::class,'Listercommentaire'])->name('admin.VoirCommentaire');
Route::get('commentaire', [CommentaireController::class,'Commentaire'])->name('frontend.VoirCommentaire');
Route::delete('listercommentaire/{id}', [CommentaireController::class,'destroy']);

// Route pour ajouter des chambres
Route::get('ajout_chambre', [BienController::class,'indexChambre']);
require __DIR__.'/auth.php';