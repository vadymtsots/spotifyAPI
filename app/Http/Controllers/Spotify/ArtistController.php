<?php

namespace App\Http\Controllers\Spotify;

use App\Http\Controllers\SpotifyController;
use App\Processor\AlbumProcessor;
use App\Service\Spotify\SpotifyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ArtistController extends SpotifyController
{
    public function __invoke(
        Request $request,
        SpotifyService $spotifyService,
        AlbumProcessor $processor
    ): JsonResponse {
        try {
//            $id = '4P0dddbxPil35MNN9G2MEX';

            Validator::validate($request->all(), [
                'id' => 'required|string'
            ]);

            $id = $request->get('id');

            $artist = $spotifyService->getArtistBySpotifyId($id);

            return response()->json([
                'data' => $artist
            ]);

        } catch (\Exception $exception) {
            Log::error('An error occurred', [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
