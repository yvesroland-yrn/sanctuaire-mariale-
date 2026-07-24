<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AuthController as Auth;

/*
|--------------------------------------------------------------------------
| SITE PUBLIC - SANCTUAIRE NOTRE DAME DE SASSAKO
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'Accueil'])->name('Accueil');

Route::get('/propos', [PageController::class, 'propos'])->name('propos');
Route::get('/actualites', [PageController::class, 'actualites'])->name('actualites');
Route::get('/faire-un-don', [PageController::class, 'don'])->name('don');
Route::get('/reservation', [PageController::class, 'reservation'])->name('reservation');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');


/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

Route::get('/connexion', [Auth::class, 'login'])->name('login');
Route::post('/connexion', [Auth::class, 'login_store'])->name('login.store');
Route::post('/deconnexion', [Auth::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| PAIEMENTS - GENIUSPAY
|--------------------------------------------------------------------------
*/

Route::post('/paiements/geniuspay/checkout', [PaymentController::class, 'checkout'])
    ->name('payments.geniuspay.checkout');



/*
|--------------------------------------------------------------------------
| ADMINISTRATION - SANCTUAIRE
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::redirect('/', '/admin/dashboard');

    // Tableau de bord
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/don', fn () => view('admin.don'))->name('don');
    Route::get('/reservation', fn () => view('admin.reservation'))->name('reservation');
    Route::get('/parametres', fn () => view('admin.parametres'))->name('parametres');
    Route::post('/logout', [Auth::class, 'logout'])->name('logout');


    // Actualités
    Route::get('/actualites', [AdminController::class, 'actualites'])->name('actualites');
    Route::get('/actualites/creer', [AdminController::class, 'creerActualite'])->name('actualites.creer');
    Route::post('/actualites', [AdminController::class, 'storeActualite'])->name('actualites.store');
    Route::get('/actualites/{id}', [AdminController::class, 'editActualite'])->name('actualites.edit');
    Route::put('/actualites/{id}', [AdminController::class, 'updateActualite'])->name('actualites.update');
    Route::delete('/actualites/{id}', [AdminController::class, 'deleteActualite'])->name('actualites.delete');



    // Conseils Spirituels
    Route::get('/conseils', [AdminController::class, 'conseils'])->name('conseils');
    Route::get('/conseils/creer', [AdminController::class, 'creerConseil'])->name('conseils.creer');
    Route::post('/conseils', [AdminController::class, 'storeConseil'])->name('conseils.store');
    Route::get('/conseils/{id}', [AdminController::class, 'editConseil'])->name('conseils.edit');
    Route::put('/conseils/{id}', [AdminController::class, 'updateConseil'])->name('conseils.update');
    Route::delete('/conseils/{id}', [AdminController::class, 'deleteConseil'])->name('conseils.delete');


    // Statistiques
    Route::get('/statistiques', [AdminController::class, 'statistiques'])->name('statistiques');
    Route::get('/statistiques/creer', [AdminController::class, 'creerStatistique'])->name('statistiques.creer');
    Route::post('/statistiques', [AdminController::class, 'storeStatistique'])->name('statistiques.store');
    Route::get('/statistiques/{id}', [AdminController::class, 'editStatistique'])->name('statistiques.edit');
    Route::put('/statistiques/{id}', [AdminController::class, 'updateStatistique'])->name('statistiques.update');
    Route::delete('/statistiques/{id}', [AdminController::class, 'deleteStatistique'])->name('statistiques.delete');



    // Messages
    Route::get('/messages', [AdminController::class, 'messages'])->name('messages');
    Route::get('/messages/{id}', [AdminController::class, 'viewMessage'])->name('messages.view');
    Route::delete('/messages/{id}', [AdminController::class, 'deleteMessage'])->name('messages.delete');


    // Compte (Gestion des utilisateurs)
    Route::get('/compte', [AdminController::class, 'compte'])->name('compte');
    Route::get('/utilisateurs', [AdminController::class, 'utilisateurs'])->name('utilisateurs');
    Route::get('/utilisateurs/creer', [AdminController::class, 'creerUtilisateur'])->name('utilisateurs.creer');
    Route::post('/utilisateurs', [AdminController::class, 'storeUtilisateur'])->name('utilisateurs.store');
    Route::get('/utilisateurs/{id}', [AdminController::class, 'editUtilisateur'])->name('utilisateurs.edit');
    Route::put('/utilisateurs/{id}', [AdminController::class, 'updateUtilisateur'])->name('utilisateurs.update');
    Route::delete('/utilisateurs/{id}', [AdminController::class, 'deleteUtilisateur'])->name('utilisateurs.delete');

});
