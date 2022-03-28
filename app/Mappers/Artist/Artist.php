<?php

namespace App\Mappers\Artist;

class Artist
{
    /**
     * @var object
     */
    public object $external_urls;

    /**
     * @var object
     */
    public object $followers;

    /**
     * @var array
     */
    public array $genres;

    /**
     * @var array
     */
    public array $images;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var int
     */
    public int $popularity;

    /**
     * @var string
     */
    public string $type;

    /**
     * @var string
     */
    public string $uri;
}
