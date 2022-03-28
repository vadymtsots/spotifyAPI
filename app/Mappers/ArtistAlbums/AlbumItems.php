<?php

namespace App\Mappers\ArtistAlbums;

use ArrayObject;

class AlbumItems
{
    /**
     * @var string
     */
    public string $album_group;

    /**
     * @var string
     */
    public string $album_type;

    /**
     * @var array
     */
    public array $artists;

    /**
     * @var object
     */
    public object $external_urls;

    /**
     * @var string
     */
    public string $href;

    /**
     * @var string
     */
    public string $id;

    /**
     * @var array
     */
    public array $images;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $release_date;

    /**
     * @var string
     */
    public string $release_date_precision;

    /**
     * @var int
     */
    public int $total_tracks;

    /**
     * @var string
     */
    public string $uri;
}
