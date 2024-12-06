<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EnfantController;
use App\Http\Controllers\ReseauxController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    //Parent
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/profile/update-profile', [DashboardController::class, 'updateProfile'])->name('profile.updateProfile');
    Route::put('/profile/update-photo', [DashboardController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::delete('/profile/delete-photo', [DashboardController::class, 'deletePhoto'])->name('profile.deletePhoto');

    //Enfant
    Route::get('/children', [EnfantController::class, 'index'])->name('enfant.index');
    Route::get('/children/create', [EnfantController::class, 'create'])->name('enfant.create');
    Route::get('/children/{id}', [EnfantController::class, 'show'])->name('enfant.show');

    Route::post('/children', [EnfantController::class, 'store'])->name('enfant.store');
    Route::get('/enfants/edit/{id}', [EnfantController::class, 'edit'])->name('enfant.edit');
    Route::put('/enfants/update/{id}', [EnfantController::class, 'update'])->name('enfant.update');
    Route::put('/enfants/update-photo/{id}', [EnfantController::class, 'updatePhoto'])->name('enfant.updatePhoto');
    Route::delete('/enfants/delete-photo/{id}', [EnfantController::class, 'deletePhoto'])->name('enfant.deletePhoto');

    //Réseaux
    Route::post('/reseaux/{enfant}', [ReseauxController::class, 'store'])->name('reseaux.store');
    Route::put('/reseaux/{id}', [ReseauxController::class, 'update'])->name('reseaux.update');

    Route::post('/reseaux/{reseau}/delete', [ReseauxController::class, 'destroy'])->name('reseaux.delete');


    

});


