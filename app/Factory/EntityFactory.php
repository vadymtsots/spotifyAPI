<?php

namespace App\Factory;

use App\Enum\Entity;
use App\Mappers\Album\Album;
use App\Mappers\Artist\Artist;
use App\Mappers\ArtistAlbums\ArtistAlbums;
use App\Mappers\Track\Track;

/**
 * This factory is used to create Entity objects.
 * These objects are mapped with json response from Spotify API
 */
class EntityFactory
{
    public function __construct(
        private Artist $artist,
        private ArtistAlbums $artistAlbums,
        private Album $album,
        private Track $track
    ) {
    }

    public function create(Entity $type): object
    {
        return match($type) {
            Entity::Artist => $this->artist,
            Entity::Album => $this->album,
            Entity::ArtistAlbums => $this->artistAlbums,
            Entity::Track => $this->track
        };
    }
}
