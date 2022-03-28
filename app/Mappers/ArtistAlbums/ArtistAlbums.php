<?php

namespace App\Mappers\ArtistAlbums;

use ArrayObject;
use Illuminate\Support\Collection;

class ArtistAlbums
{
    /**
     * @var string
     */
    public string $href;

    /**
     * @var AlbumItems[]
     */
    public array $items;

    /**
     * @var int
     */
    public int $limit;

    /**
     * @var string|null
     */
    public string|null $next;

    /**
     * @var int
     */
    public int $offset;

    /**
     * @var string|null
     */
    public string|null $previous;

    /**
     * @var int
     */
    public int $total;
}