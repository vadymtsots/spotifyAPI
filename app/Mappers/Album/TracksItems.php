<?php

namespace App\Mappers\Album;

class TracksItems
{
    /**
     * @var array
     */
    public array $artists;

    /**
     * @var int
     */
    public int $disc_number;

    /**
     * @var int
     */
    public int $duration_ms;

    /**
     * @var bool
     */
    public bool $explicit;

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
     * @var bool
     */
    public bool $is_local;

    /**
     * @var bool
     */
    public bool $is_playable;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var string|null
     */
    public ?string $preview_url;

    /**
     * @var int
     */
    public int $track_number;

    /**
     * @var string
     */
    public string $type;

    /**
     * @var string
     */
    public string $uri;
}
