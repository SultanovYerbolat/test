<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmsController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Routes for Genres
Route::get('genres/create', [GenresController::class, 'create'] );
Route::post('genres/store', [GenresController::class, 'store'] )->name('genres.store');
Route::get('genres/edit/{id}', [GenresController::class, 'edit'] )->name('genres.edit');
Route::post('genres/update/{id}', [GenresController::class, 'update'] )->name('genres.update');
Route::post('genres/destroy/{id}', [GenresController::class, 'destroy'] )->name('genres.destroy');
Route::get('genres', [GenresController::class, 'index'] );

// Routes for Films
Route::get('films/create', [FilmsController::class, 'create'] );
Route::post('films/store', [FilmsController::class, 'store'] )->name('films.store');
Route::get('films/edit/{id}', [FilmsController::class, 'edit'] )->name('films.edit');
Route::post('films/update/{id}', [FilmsController::class, 'update'] )->name('films.update');
Route::post('films/publish/{id}', [FilmsController::class, 'publish'] )->name('films.publish');
Route::post('films/destroy/{id}', [FilmsController::class, 'destroy'] )->name('films.destroy');
Route::get('films', [FilmsController::class, 'index'] );

//Routes for Admin panel

Route::get('admin', [AdminController::class, 'index'] );