<?php

namespace App\Http\Controllers;

use App\Processor\AlbumProcessor;
use App\Processor\ArtistAlbumsProcessor;
use App\Processor\ArtistProcessor;
use App\Service\Spotify\AuthService;
use App\Service\Spotify\SpotifyClient;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;

class SpotifyController
{
    private string $token;

    public function __construct(AuthService $authService, private SpotifyClient $requestService)
    {
        $this->token = $authService->getAuthToken();
    }

    public function search(ArtistProcessor $processor): array
    {
        $search = "Korn"; //temporarily hardcoded, TO DO: reformat to $request->get()
        $type = "artist";
        $response = $this->requestService->searchRequest($search, $type, $this->token);

        return $processor->get($response);
    }

    public function artistAlbums(ArtistAlbumsProcessor $processor)
    {
        $id = "3RNrq3jvMZxD9ZyoOZbQOD"; //temporarily hardcoded, TO DO: reformat to $request->get()
        $response = $this->requestService->artistAlbumsRequest($id, $this->token);

        return $processor->get($response);
    }

    public function album(AlbumProcessor $processor)
    {
        $id = "0gsiszk6JWYwAyGvaTTud4";
        $response = $this->requestService->albumRequest($id, $this->token);

        return $processor->get($response);
    }
}
