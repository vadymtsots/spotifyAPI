<?php

namespace App\Mappers\ArtistAlbums;

use ArrayObject;
use Illuminate\Support\Collection;

class ArtistAlbums
{
    public string $href;

    /**
     * Array of AlbumItems objects
     * @var AlbumItems[]
     */
    public array $items;

    public int $limit;

    public string|null $next;

    public int $offset;

    public string|null $previous;

    public int $total;
}
