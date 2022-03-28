<?php

namespace App\Factory;

use App\Enum\Entity;
use App\Mappers\Artist\Artist;
use App\Mappers\ArtistAlbums\ArtistAlbums;

class EntityFactory
{
    public function __construct(private Artist $artist, private ArtistAlbums $artistAlbums)
    {

    }

    public function create(Entity $type): object
    {
        return match($type) {
            Entity::Artist => $this->artist,
            Entity::Album => throw new \Exception('To be implemented'),
            Entity::ArtistAlbums => $this->artistAlbums,
            Entity::Track => throw new \Exception('To be implemented'),
            Entity::TrackAudioFeatures => throw new \Exception('To be implemented'),
            Entity::TrackAudioAnalysis => throw new \Exception('To be implemented')
        };
    }
}
