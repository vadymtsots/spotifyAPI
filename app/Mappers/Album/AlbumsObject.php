<?php

namespace App\Mappers\Album;

class AlbumsObject
{
    public string $href;

    /**
     * @var AlbumItem[]
     */
    public array $items;

    public int $limit;

    public string|null $next;

    public int $offset;

    public string|null $previous;

    public int $total;
}
