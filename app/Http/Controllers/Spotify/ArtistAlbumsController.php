<?php

namespace App\Http\Controllers\Spotify;

use App\Enum\Entity;
use App\Http\Controllers\SpotifyController;
use App\Processor\ArtistAlbumsProcessor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
* @OA\Post(
 *     path="/api/spotify/artist/albums",
 *     description="Search for the albums from an artist by Spotify id",
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
class ArtistAlbumsController extends SpotifyController
{
    public function __invoke(Request $request, ArtistAlbumsProcessor $processor): JsonResponse
    {
        try {
            Validator::validate($request->all(), [
                'id' => 'required|string'
            ]);

            $id = $request->get('id');
            $response = $this->spotifyClient->artistAlbums($id)
                ->limit(50)
                ->includeGroups('album')
                ->get();

            $artistAlbums = $processor->get($response, $this->entityFactory
                ->create(Entity::ArtistAlbums));

            return response()->json([
                'status' => true,
                'data' => $artistAlbums
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
