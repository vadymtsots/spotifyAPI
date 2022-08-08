<?php

namespace App\Http\Controllers\Artist;

use App\Repository\Artist\ArtistRepository;
use App\Service\Spotify\SpotifyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Post(
 *     path="/api/spotify/artist/save",
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
 *         description="Artist successfully saved to database",
 *     ),
 *     @OA\Response(
 *         response=418,
 *         description="Artist with given spotify id already exists in database",
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Validation exception, if search query is empty",
 *     ),
 * )
 *
 */
class SaveController
{
    public function __invoke(
        Request $request,
        SpotifyService $spotifyService,
        ArtistRepository $artistRepository
    ): JsonResponse {
        try {
            Validator::validate($request->all(), [
                'id' => 'required|string'
            ]);

            $artistData = $spotifyService->getArtistBySpotifyId($request->get('id'));

            $artist = $artistRepository->saveFromFields($artistData);

            if (null === $artist) {
                return response()->json([
                    'status' => false,
                    'message' => 'Artist with given spotify id already exists in database'
                ], 418);
            }

            return response()->json([
                'status' => true,
                'message' => 'Artist successfully saved to database'
            ]);
        } catch (\Exception $exception){
            return response()->json([
                'status' => false,
                'error' => "Couldn't save the artist" . $exception->getMessage()
            ]);
        }

    }
}
