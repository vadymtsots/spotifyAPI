<?php

namespace App\Mappers\Artist;

class ArtistObject
{
    public string $href;

    /**
     * @var ArtistItem[]
     */
    public array $items;

    public int $limit;

    public string|null $next;

    public int $offset;

    public string|null $previous;

    public int $total;
}
