<?php

namespace App\Http\Controllers\Spotify;

use App\Http\Controllers\SpotifyController;
use App\Processor\AlbumProcessor;
use App\Service\Spotify\SpotifyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Post(
 *     path="/api/spotify/artist",
 *     description="Search for an artist by Spotify id",
 *     tags={"Artist"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 @OA\Property(property="id", description="Spotify id of an artist", example="6JW8wliOEwaDZ231ZY7cf4"),
 *                 required={"id"}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful request",
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Validation exception, if search query is empty",
 *     ),
 * )
 *
 */
class ArtistController extends SpotifyController
{
    public function __invoke(
        Request $request,
        SpotifyService $spotifyService,
        AlbumProcessor $processor
    ): JsonResponse {
        try {
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
