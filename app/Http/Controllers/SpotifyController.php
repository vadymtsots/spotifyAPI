<?php

namespace App\Http\Controllers;

use App\Enum\Entity;
use App\Factory\EntityFactory;
use App\Processor\AlbumProcessor;
use App\Processor\ArtistAlbumsProcessor;
use App\Processor\ArtistProcessor;
use App\Processor\TrackProcessor;
use App\Service\Spotify\AuthService;
use App\Service\Spotify\SpotifyClient;

class SpotifyController
{
    private string $token;

    public function __construct(
        AuthService           $authService,
        private SpotifyClient $requestService,
        private EntityFactory $entityFactory
    )
    {
        $this->token = $authService->getAuthToken();
    }

//    public function search(ArtistProcessor $processor)
//    {
//        $search = "Korn"; //temporarily hardcoded, TO DO: reformat to $request->get()
//        $type = "artist";
//        $response = $this->requestService->searchRequest($search, $type, $this->token);
//
//        $response = $processor->get($response, $this->mapper);
//        dd($response);
//
//    }

    public function artistAlbums(ArtistAlbumsProcessor $processor): array
    {
        $id = "3RNrq3jvMZxD9ZyoOZbQOD"; //temporarily hardcoded, TO DO: reformat to $request->get()
        $response = $this->requestService->artistAlbumsRequest($id, $this->token);

        return $processor->get($response, $this->entityFactory->create(Entity::ArtistAlbums));
    }

    public function artist(ArtistProcessor $processor): array
    {
        $id = "3RNrq3jvMZxD9ZyoOZbQOD";
        $response = $this->requestService->artistRequest($id, $this->token);

        return $processor->get($response, $this->entityFactory->create(Entity::Artist));
    }

    public function album(AlbumProcessor $processor): array
    {
        $id = "0gsiszk6JWYwAyGvaTTud4";
        $response = $this->requestService->albumRequest($id, $this->token);

        return $processor->get($response, $this->entityFactory->create(Entity::Album));
    }

    public function track(TrackProcessor $processor): array
    {
        $id = "6vsyag9kEPckt19NClSf51";
        $response = $this->requestService->trackRequest($id, $this->token);

        return $processor->get($response, $this->entityFactory->create(Entity::Track));
    }

    public function trackAudioFeatures()
    {
        $id = "6vsyag9kEPckt19NClSf51";
        $response = $this->requestService->trackAudioFeaturesRequest($id, $this->token);

        return $response;
    }
}
