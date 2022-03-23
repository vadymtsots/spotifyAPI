<?php

namespace App\Factory;

use App\Mappers\Artist\Artist;

class EntityFactory
{
    public function __construct(private Artist $artist)
    {

    }

    public function create($type): object
    {
        return match($type) {
            'artist' => $this->artist
        };
    }
}
