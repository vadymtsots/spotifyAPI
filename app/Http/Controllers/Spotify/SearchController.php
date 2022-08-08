<?php

namespace App\Http\Controllers\Spotify;

use App\Enum\Entity;
use App\Http\Controllers\SpotifyController;
use App\Processor\SearchProcessor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Post(
 *     path="/api/spotify/search",
 *     description="Search for artist, album or track in Spotify API",
 *     tags={"Search"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 @OA\Property(property="search", description="Search query", example="Sepultura"),
 *                 @OA\Property(property="type", description="Type of search: artist, album or track",
 *                  example="album, artist, track"),
 *                 required={"search"}
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

class SearchController extends SpotifyController
{
    public function __invoke(Request $request, SearchProcessor $processor): JsonResponse
    {
        try {
            Validator::validate($request->all(), [
                'search' => 'required|string',
                'type' => 'nullable|string'
            ]);

            $search = $request->get('search');
            $type = $request->get('type', 'artist');
            $response = $this->spotifyClient->searchItems($search, $type)->get();

            $searchResults = $processor->get(
                $response,
                $this->entityFactory->create(Entity::SearchObject)
            );

            return response()->json([
                'data' => $searchResults
            ]);
        } catch (\Exception $exception) {
            Log::error('An error occurred', [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'error' => $exception->getMessage()
            ]);
        }
    }
}
