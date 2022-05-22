<?php

namespace App\Mappers\Track;

class Track
{
    public object $album;

    public array $artists;

    public int $disk_number;

    public int $duration_ms;

    public bool $explicit;

    public object $external_ids;

    public object $external_urls;

    public string $href;

    public string $id;

    public bool $is_local;

    public bool $is_playable;

    public string $name;

    public int $popularity;

    public string|null $preview_url;

    public int $track_number;

    public string $type;

    public string $uri;
}
