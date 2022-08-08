<?php

namespace App\Http\Controllers\Spotify;

use App\Enum\Entity;
use App\Http\Controllers\SpotifyController;
use App\Processor\TrackProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Post(
 *     path="/api/spotify/track",
 *     description="Search for a track by Spotify id",
 *     tags={"Track"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 @OA\Property(property="id", description="Spotify id of a track", example="6vsyag9kEPckt19NClSf51"),
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
class TrackController extends SpotifyController
{
    public function __invoke(Request $request, TrackProcessor $processor)
    {
        try {
            Validator::validate($request->all(), [
                'id' => 'required|string'
            ]);

            $id = $request->get('id');

            $response = $this->spotifyClient->track($id)->get();

            $track = $processor->get($response, $this->entityFactory->create(Entity::Track));

            return response()->json([
                'status' => true,
                'data' => $track
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
