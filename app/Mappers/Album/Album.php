<?php

namespace App\Mappers\Album;

class Album
{
    public string $album_type;

    public array $artists;

    public array $copyrights;

    public object $external_ids;

    public object $external_urls;

    public array $genres;

    public string $href;

    public string $id;

    public array $images;

    public string $label;

    public string $name;

    public string $popularity;

    public string $release_date;

    public string $release_date_precision;

    public int $total_tracks;

    public TracksObject $tracks;

    public string $type;

    public string $uri;


}
