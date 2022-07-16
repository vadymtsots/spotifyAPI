<?php

namespace App\Mappers\Search;

use App\Mappers\Album\AlbumsObject;
use App\Mappers\Album\TracksObject;
use App\Mappers\Artist\ArtistObject;

class SearchObject
{
    public TracksObject $tracks;

    public ArtistObject $artists;

    public AlbumsObject $albums;

    public object $playlists;

    public object $shows;

    public object $episodes;
}
