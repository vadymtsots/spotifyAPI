<?php

namespace App\Http\Controllers;

use App\Processor\ArtistAlbumsProcessor;
use App\Processor\ArtistProcessor;
use App\Service\Spotify\AuthService;
use App\Service\Spotify\RequestService;
use App\Service\Spotify\SpotifyService;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;

class SpotifyController
{
    private string $token;

    public function __construct(AuthService $authService, private RequestService $requestService)
    {
        $this->token = $authService->getAuthToken();
    }

    public function search(ArtistProcessor $processor): array
    {
        $search = "Korn";
        $type = "artist";
        $response = $this->requestService->makeSearchRequest($search, $type, $this->token);
        $artist = json_decode($response, true);

        return $processor->get($artist);
    }

    public function artistAlbums(ArtistAlbumsProcessor $processor)
    {
        $id = "3RNrq3jvMZxD9ZyoOZbQOD";
        $response = $this->requestService->makeArtistAlbumsRequest($id, $this->token);
        $result = json_decode($response, true);

        return $processor->get($result);
    }
}
