<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KurbanController;
use App\Http\Controllers\KurbanHewanController;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\EnsureDataMasjidCompleted;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('masjid', MasjidController::class);

    Route::middleware(EnsureDataMasjidCompleted::class)->group(function () {
        Route::resource('kurbanhewan', KurbanHewanController::class);
        Route::resource('kurban', KurbanController::class);
        Route::resource('informasi', InformasiController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('profil', ProfilController::class);
        Route::resource('kas', KasController::class);
        Route::resource('userprofile', UserProfileController::class);
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    });
});


Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
