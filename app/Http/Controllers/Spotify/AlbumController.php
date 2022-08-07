<?php

namespace App\Http\Controllers\Spotify;

use App\Enum\Entity;
use App\Processor\AlbumProcessor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AlbumController extends \App\Http\Controllers\SpotifyController
{
    public function __invoke(Request $request, AlbumProcessor $processor): JsonResponse
    {
        try {
            //        $id = "0gsiszk6JWYwAyGvaTTud4";

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
