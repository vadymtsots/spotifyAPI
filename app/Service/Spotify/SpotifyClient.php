<?php

namespace App\Service\Spotify;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class SpotifyClient
{
    private const SPOTIFY_API_URL = 'https://api.spotify.com/v1/';

    /**
     * @param string $search
     * @param string $type
     * @param $token
     * @return PromiseInterface|Response
     */
    public function searchRequest(string $search, string $type, $token): PromiseInterface|Response
    {
        $endpoint = self::SPOTIFY_API_URL . "search?q=" . $search . "&type=" . $type;
        return $this->makeRequest($endpoint, $token);
    }

    /**
     * @param string $id
     * @param $token
     * @return PromiseInterface|Response
     */
    public function artistRequest(string $id, $token): PromiseInterface|Response
    {
        $endpoint = self::SPOTIFY_API_URL . "artists/" . $id;
        return $this->makeRequest($endpoint, $token);
    }
    /**
     * @param string $id
     * @param $token
     * @return PromiseInterface|Response
     */
    public function artistAlbumsRequest(string $id, $token): PromiseInterface|Response
    {
        $endpoint = self::SPOTIFY_API_URL . "artists/" . $id . "/albums?include_groups=album&market=US&limit=50";
        return $this->makeRequest($endpoint, $token);
    }

    /**
     * @param string $id
     * @param $token
     * @return PromiseInterface|Response
     */
    public function albumRequest(string $id, $token): PromiseInterface|Response
    {
        $endpoint = self::SPOTIFY_API_URL . "albums/" . $id . "?market=US";
        return $this->makeRequest($endpoint, $token);
    }

    /**
     * @param string $endpoint
     * @param $token
     * @return PromiseInterface|Response
     */
    private function makeRequest(string $endpoint, $token): PromiseInterface|Response
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])
            ->acceptJson()
            ->get($endpoint);
    }
}
