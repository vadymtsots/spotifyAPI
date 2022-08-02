<?php

namespace App\Service\Spotify;

use Aerni\Spotify\Spotify;
use App\Enum\Entity;
use App\Factory\EntityFactory;
use App\Processor\ArtistProcessor;

class SpotifyService
{
    public function __construct(
        private Spotify $spotifyClient,
        private EntityFactory $entityFactory,
        private ArtistProcessor $artistProcessor
    ) {
    }

    public function getArtistBySpotifyId(string $id): array
    {
        $response = $this->spotifyClient->artist($id)->get();

        return $this->artistProcessor->get($response, $this->entityFactory->create(Entity::Artist));
    }
}
