<?php

namespace App\Service\Spotify;

use GuzzleHttp\Promise\PromiseInterface;
use http\Client\Response;
use Illuminate\Support\Facades\Http;

class RequestService
{
    private const SPOTIFY_API_URL = 'https://api.spotify.com/v1/';

    public function makeSearchRequest(string $search, string $type, $token): PromiseInterface|\Illuminate\Http\Client\Response
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])
            ->acceptJson()
            ->get(self::SPOTIFY_API_URL . "search?q=" . $search . "&type=" . $type);
    }

    public function makeArtistAlbumsRequest(string $id, $token)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])
            ->acceptJson()
            ->get(self::SPOTIFY_API_URL . "artists/" . $id . "/albums?include_groups=album&market=US&limit=50");
    }
}
