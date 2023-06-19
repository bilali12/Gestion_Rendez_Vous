<?php

use App\Http\Controllers\secretaireController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RendezVousController;
use App\Models\Heure;
use App\Models\Medecin;
use App\Models\TimeSlots;
use Illuminate\Support\Facades\Auth;
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


//middleware d'admin
Route::middleware('admin')->group(function() {
    //route accessible a l'secretaire
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');

    //medecin
    Route::post('/admin/storemedecin', [AdminController::class, 'storeMedecin'])->name('admin.medecin');
    Route::get('/admin/createmedecin', [AdminController::class, 'createMed'])->name('admin.createmedecin');
    Route::get('/admin/creatdisponibily', [MedecinController::class, 'createDisponibility'])->name('admin.createdispo');

    //secretaire
    Route::post('/admin/storesecretaire', [AdminController::class, 'storeSecretaire'])->name('admin.secretaire');
    Route::get('/admin/createsecretaire', [AdminController::class, 'createSec'])->name('admin.createsecretaire');
    // Route::resource('users', secretaireController::class);
    // Route::delete('/delete{id}', [secretaireController::class, 'destroy'])->name('user.destroy');
    //disponibilité
    Route::get('/admin/creatdisponibily', [MedecinController::class, 'createDisponibility'])->name('admin.createdispo');
    Route::post('/admin/storedisponibily', [MedecinController::class, 'storeDispo'])->name('admin.storedispo');
    Route::post('/admin/verifierdispo', [MedecinController::class, 'verifierDisponibilite'])->name('admin.verifierDisponibilite');

    Route::delete('/supprimer{id}', [AdminController::class, 'destroy'])->name('users.destroy');

});

/*---------------------------------------------------------------------------------------------------------------------- */
//middleware de medecin
Route::middleware('medecin')->group(function() {
    //route accessible au medecin
    Route::get('/medecin/dashboard', [MedecinController::class, 'index'])->name('medecin.rendezvous');

});

/*---------------------------------------------------------------------------------------------------------------------- */


//middleware de secretaire
Route::middleware('secretaire')->group(function() {
    //route accessible au secretaire
    Route::get('/secretaire/dashboard', [SecretaireController::class, 'index'])->name('secretaire.index');

    Route::post('/secretaire/store', [SecretaireController::class, 'store'])->name('secretaire.storeRendezVous');
    Route::get('/secretaire/createrendezvous', [SecretaireController::class, 'createRendezVous'])->name('secretaire.createrendezvous');

});


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/loginp', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('loginpage');
Route::get('/login2', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login2');
Route::get('/', function () {
    return view('lifecare-master.index');
});
// Route::get('/', [secretaireController::class, 'index']);
// Route::post('/login', [LoginController::class, 'login']);

// Route::get('/doctors', [MedecinController::class, 'index']);

Route::post('/creneau', [MedecinController::class, 'createCreneauxHoraires']);

// Route::get('/admin/creatdisponibily', [MedecinController::class, 'createDisponibility'])->name('admin.createdispo');
// Route::post('/admin/storedisponibily', [MedecinController::class, 'storeDispo'])->name('admin.storedispo');
// Route::post('/admin/verifierdispo', [MedecinController::class, 'verifierDisponibilite'])->name('admin.verifierDisponibilite');

// Route::post('/admin/storemedecin', [AdminController::class, 'storeMedecin'])->name('admin.medecin');
// Route::get('/admin/createmedecin', [AdminController::class, 'createMed'])->name('admin.createmedecin');

Route::get('/medecin/heures', function(){
    $timeSlots = TimeSlots::all();
    return response()->json([
        'heuresDebut' => $timeSlots->pluck('start_time'),
        'heuresFin' => $timeSlots->pluck('end_time'),
    ]);
});

Route::get('/secretaire/createrendezvous', [RendezVousController::class, 'createRendezVous'])->name('secretaire.createrendezvous');
