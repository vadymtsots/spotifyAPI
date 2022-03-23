<?php

namespace App\Http\Controllers;

use App\Factory\EntityFactory;
use App\Mappers\Artist\Artist;
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
use JsonMapper;

class SpotifyController
{
    private string $token;

    public function __construct(
        AuthService           $authService,
        private SpotifyClient $requestService,
        private JsonMapper    $mapper,
        private EntityFactory $factory
    )
    {
        $this->token = $authService->getAuthToken();
    }

    public function search(ArtistProcessor $processor)
    {
        $search = "Korn"; //temporarily hardcoded, TO DO: reformat to $request->get()
        $type = "artist";
        $response = $this->requestService->searchRequest($search, $type, $this->token);

        $response = $processor->get($response, $this->mapper);
        dd($response);

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

    public function artist(ArtistProcessor $processor)
    {
        $id = "3RNrq3jvMZxD9ZyoOZbQOD";
        $response = $this->requestService->artistRequest($id, $this->token);

        return $processor->get($response, $this->factory->create('artist'));
    }
}
