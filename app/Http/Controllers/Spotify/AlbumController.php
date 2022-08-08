<?php

namespace App\Http\Controllers\Spotify;

use App\Enum\Entity;
use App\Http\Controllers\SpotifyController;
use App\Processor\AlbumProcessor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Post(
 *     path="/api/spotify/album",
 *     description="Search for an album by Spotify id",
 *     tags={"Album"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 @OA\Property(property="id", description="Spotify id of an album", example="0gsiszk6JWYwAyGvaTTud4"),
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
class AlbumController extends SpotifyController
{
    public function __invoke(Request $request, AlbumProcessor $processor): JsonResponse
    {
        try {
            Validator::validate($request->all(), [
                'id' => 'required|string'
            ]);

            $id = $request->get('id');

            $response = $this->spotifyClient->album($id)->get();

            $album = $processor->get($response, $this->entityFactory->create(Entity::Album));

            return response()->json([
                'status' => true,
                'data' => $album
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
