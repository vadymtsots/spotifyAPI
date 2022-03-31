<?php

namespace App\Mappers\Album;

class TracksObject
{
    /**
     * @var string
     */
    public string $href;

    /**
     * Array of TrackItems objects
     * @var TracksItems[]
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
