<?php

namespace App\Http\Controllers;

use Aerni\Spotify\Spotify;
use App\Enum\Entity;
use App\Factory\EntityFactory;
use App\Processor\AlbumProcessor;
use App\Processor\ArtistAlbumsProcessor;
use App\Processor\ArtistProcessor;
use App\Processor\SearchProcessor;
use App\Processor\TrackProcessor;
use App\Service\Spotify\SpotifyClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SpotifyController
{
    public function __construct(
        private EntityFactory $entityFactory,
        private Spotify $spotifyClient
    )
    {
    }

    public function search(SearchProcessor $processor): JsonResponse
    {
        try {
            $search = "Korn"; //temporarily hardcoded, TO DO: reformat to $request->get()
            $type = ['artist', 'album'];
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

    public function artistAlbums(ArtistAlbumsProcessor $processor): array
    {
        $id = "3RNrq3jvMZxD9ZyoOZbQOD"; //temporarily hardcoded, TO DO: reformat to $request->get()
        $response = $this->spotifyClient->artistAlbums($id)->get();

        return $processor->get($response, $this->entityFactory->create(Entity::ArtistAlbums));
    }

    public function artist(ArtistProcessor $processor)
    {
        try {
            $id = "3RNrq3jvMZxD9ZyoOZbQOD";
            $response = $this->spotifyClient->artist($id)->get();

            $artist = $processor->get($response, $this->entityFactory->create(Entity::Artist));

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
            ]);
        }
    }

    public function album(AlbumProcessor $processor): array
    {
        $id = "0gsiszk6JWYwAyGvaTTud4";
        $response = $this->spotifyClient->album($id)->get();

        return $processor->get($response, $this->entityFactory->create(Entity::Album));
    }

    public function track(TrackProcessor $processor): array
    {
        $id = "6vsyag9kEPckt19NClSf51";
        $response = $this->spotifyClient->track($id)->get();

        return $processor->get($response, $this->entityFactory->create(Entity::Track));
    }

    public function trackAudioFeatures(): array
    {
        $id = "6vsyag9kEPckt19NClSf51";
        $response = $this->spotifyClient->audioFeaturesForTrack($id)->get();

        return $response;
    }
}
