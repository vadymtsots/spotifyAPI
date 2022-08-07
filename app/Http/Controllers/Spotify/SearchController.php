<?php

namespace App\Http\Controllers\Spotify;

use App\Enum\Entity;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SpotifyController;
use App\Processor\SearchProcessor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
