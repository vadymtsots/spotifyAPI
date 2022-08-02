<?php

namespace App\Repository\Artist;

use App\Dto\Artist\ArtistDto;
use App\Models\Artist;

class ArtistRepository
{
    public function saveFromFields(array $fields): ?Artist
    {
        $artistDto = ArtistDto::from($fields);

        $artistExists = Artist::query()
            ->where('spotify_id', $artistDto->spotifyId)
            ->exists();

        if ($artistExists) {
            return null;
        }

        return Artist::query()->create([
            'name' => $artistDto->name,
            'spotify_id' => $artistDto->spotifyId,
            'followers' => $artistDto->followers,
            'popularity' => $artistDto->popularity,
            'genres' => $artistDto->genres,
            'url' => $artistDto->url
        ]);
    }
}
