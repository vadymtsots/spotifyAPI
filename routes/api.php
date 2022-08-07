<?php

use App\Http\Controllers\Artist\SaveController;
use App\Http\Controllers\Artist\SearchController;
use App\Http\Controllers\SpotifyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Spotify as SpotifyControllers;

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
    Route::post('/search', SpotifyControllers\SearchController::class);
    Route::post('artist/albums', SpotifyControllers\ArtistAlbumsController::class);
    Route::post('/artist/save', SaveController::class);
    Route::post('album', SpotifyControllers\AlbumController::class);
    Route::post('artist', SpotifyControllers\ArtistController::class);
    Route::post('track', SpotifyControllers\TrackController::class);
    Route::post('audio-features', [SpotifyController::class, 'trackAudioFeatures']);
});

Route::get('/artist/search-by-genre', SearchController::class);


