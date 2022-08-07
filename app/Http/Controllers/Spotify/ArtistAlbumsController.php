<?php

namespace App\Http\Controllers\Spotify;

use App\Enum\Entity;
use App\Http\Controllers\SpotifyController;
use App\Processor\ArtistAlbumsProcessor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArtistAlbumsController extends SpotifyController
{
    public function __invoke(Request $request, ArtistAlbumsProcessor $processor): JsonResponse
    {
        try {
//            $id = "3RNrq3jvMZxD9ZyoOZbQOD";

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
