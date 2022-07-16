<?php

namespace App\Mappers\Album;

class AlbumItem
{
    public string $album_type;

    /** @var AlbumArtists[] */
    public array $artists;

    public array $available_markets;

    public object $external_urls;

    public string $href;

    public string $id;

    public array $images;

    public string $name;

    public string $release_date;

    public string $release_date_precision;

    public int $total_tracks;

    public string $type;

    public string $uri;
}
