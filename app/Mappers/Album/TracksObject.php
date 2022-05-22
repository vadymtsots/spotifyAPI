<?php

namespace App\Mappers\Album;

class TracksObject
{
    public string $href;

    /**
     * Array of TrackItems objects
     * @var TracksItems[]
     */
    public array $items;

    public int $limit;

    public string|null $next;

    public int $offset;

    public string|null $previous;

    public int $total;
}
