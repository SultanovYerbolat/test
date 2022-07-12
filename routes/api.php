<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmsController;
use App\Http\Controllers\GenresController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes for Genres
Route::get('genres/{id}', [GenresController::class, 'apiShow'])->name('genres.apiShow');
Route::get('genres', [GenresController::class, 'apiIndex']);

// Routes for Films
Route::get('films/{id}', [FilmsController::class, 'apiShow'])->name('films.apiShow');
Route::get('films', [FilmsController::class, 'apiIndex']);
