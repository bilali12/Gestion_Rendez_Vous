<?php

use App\Http\Controllers\secretaireController;
use App\Http\Controllers\MedecinController;

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

// Route::prefix('secretaire')->middleware('auth')->group(function() {
//     Route::get('/index', [secretaireController::class, 'index'])->name('secretaire.index');
// });

Route::middleware('admin')->group(function() {
    //route accessible a l'secretaire
    Route::get('/admin/dashboard', [secretaireController::class, 'index'])->name('admin.index');

    //medecin
    Route::post('/admin/storemedecin', [secretaireController::class, 'storeMedecin'])->name('admin.medecin');
    Route::get('/admin/createmedecin', [secretaireController::class, 'createMed'])->name('admin.createmedecin');

    //secretaire
    Route::post('/admin/storesecretaire', [secretaireController::class, 'storeSecretaire'])->name('admin.secretaire');
    Route::get('/admin/createsecretaire', [secretaireController::class, 'createSec'])->name('admin.createsecretaire');
    // Route::resource('users', secretaireController::class);
    // Route::delete('/delete{id}', [secretaireController::class, 'destroy'])->name('user.destroy');
    Route::delete('/supprimer{id}', [secretaireController::class, 'destroy'])->name('users.destroy');

});
Route::middleware('medecin')->group(function() {
    //route accessible au medecin
    Route::get('/medecin/index', [MedecinController::class, 'index'])->name('medecin.index');
});
Route::middleware('secretaire')->group(function() {
    //route accessible au secretaire
    Route::get('/secretaire/dashboard', [SecretaireController::class, 'index'])->name('secretaire.index');

    Route::post('/secretaire/store', [SecretaireController::class, 'store'])->name('secretaire.patient');
    Route::get('/secretaire/create', [SecretaireController::class, 'create'])->name('secretaire.createPatient');

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

