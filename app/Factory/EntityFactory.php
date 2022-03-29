<?php

namespace App\Factory;

use App\Enum\Entity;
use App\Mappers\Album\Album;
use App\Mappers\Artist\Artist;
use App\Mappers\ArtistAlbums\ArtistAlbums;

class EntityFactory
{
    public function __construct(
        private Artist $artist,
        private ArtistAlbums $artistAlbums,
        private Album $album)
    {

    }

    public function create(Entity $type): object
    {
        return match($type) {
            Entity::Artist => $this->artist,
            Entity::Album => $this->album,
            Entity::ArtistAlbums => $this->artistAlbums,
        };
    }
}
