<?php

use App\Http\Controllers\Artist\SaveController;
use App\Http\Controllers\Artist\SearchController;
use App\Http\Controllers\SpotifyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('spotify')->group(function () {
    Route::get('/search', [SpotifyController::class, 'search']);
    Route::get('artist/albums', [SpotifyController::class, 'artistAlbums']);
    Route::post('/artist/save', SaveController::class);
    Route::get('album', [SpotifyController::class, 'album']);
    Route::get('artist', [SpotifyController::class, 'artist']);
    Route::get('track', [SpotifyController::class, 'track']);
    Route::get('audio-features', [SpotifyController::class, 'trackAudioFeatures']);
});

Route::get('/artist/search-by-genre', SearchController::class);


