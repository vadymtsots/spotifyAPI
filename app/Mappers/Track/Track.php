<?php

namespace App\Mappers\Track;

class Track
{
    /**
     * @var object
     */
    public object $album;

    /**
     * @var array
     */
    public array $artists;

    /**
     * @var int
     */
    public int $disk_number;

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
    public object $external_ids;

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
     * @var int
     */
    public int $popularity;

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
