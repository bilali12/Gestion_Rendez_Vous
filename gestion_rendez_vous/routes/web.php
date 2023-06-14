<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\SecretaireController;
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

// Route::prefix('admin')->middleware('auth')->group(function() {
//     Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
// });

Route::middleware('admin')->group(function() {
    //route accessible a l'admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    // Route::post('/admin/createmedecin', [AdminController::class, 'storeMedecin'])->name('admin.medecin');
    // Route::get('/admin/create', [AdminController::class, 'show']);

});
Route::middleware('medecin')->group(function() {
    //route accessible au medecin
    Route::get('/medecin/index', [MedecinController::class, 'index'])->name('medecin.index');
});
Route::middleware('secretaire')->group(function() {
    //route accessible au secretaire
    Route::get('/secretaire/index', [SecretaireController::class, 'index'])->name('secretaire.index');
});


Route::get('/accueil', function () {
    return view('lifecare-master.index');
});

Auth::routes();

Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('loginpage');
Route::get('/login2', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login2');
// Route::get('/', [AdminController::class, 'index']);
// Route::post('/login', [LoginController::class, 'login']);
Route::post('/admin/createmedecin', [AdminController::class, 'storeMedecin'])->name('admin.medecin');
Route::get('/admin/create', [AdminController::class, 'essai']);
