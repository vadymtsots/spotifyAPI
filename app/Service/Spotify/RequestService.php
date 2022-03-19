<?php

namespace App\Service\Spotify;

use GuzzleHttp\Promise\PromiseInterface;
use http\Client\Response;
use Illuminate\Support\Facades\Http;

class RequestService
{
    private const SPOTIFY_API_URL = 'https://api.spotify.com/v1/';

    public function searchRequest(string $search, string $type, $token): PromiseInterface|\Illuminate\Http\Client\Response
    {
        $endpoint = self::SPOTIFY_API_URL . "search?q=" . $search . "&type=" . $type;
        return $this->makeRequest($endpoint, $token);
    }

    public function artistAlbumsRequest(string $id, $token): PromiseInterface|\Illuminate\Http\Client\Response
    {
        $endpoint = self::SPOTIFY_API_URL . "artists/" . $id . "/albums?include_groups=album&market=US&limit=50";
        return $this->makeRequest($endpoint, $token);
    }

    private function makeRequest(string $endpoint, $token)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])
            ->acceptJson()
            ->get($endpoint);
    }
}
