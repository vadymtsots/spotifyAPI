<?php

namespace App\Http\Controllers\Artist;

use App\Models\Artist;
use App\Processor\ArtistProcessor;
use App\Repository\Artist\ArtistRepository;
use App\Service\Spotify\SpotifyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaveController
{
    public function __invoke(
        Request $request,
        SpotifyService $spotifyService,
        ArtistRepository $artistRepository
    ): JsonResponse {
        try {
            $artistData = $spotifyService->getArtistBySpotifyId($request->get('id'));

            $artist = $artistRepository->saveFromFields($artistData);

            if (null === $artist) {
                return response()->json([
                    'status' => false,
                    'message' => 'Artist with given spotify id already exists in database'
                ]);
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
