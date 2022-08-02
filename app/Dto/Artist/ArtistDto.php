<?php

namespace App\Dto\Artist;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class ArtistDto extends Data
{
    #[MapInputName('spotify_id')]
    public string $spotifyId;

    public string $name;

    public int $followers;

    public int $popularity;

    public array $genres;

    public string $url;
}
