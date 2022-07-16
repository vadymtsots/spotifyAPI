<?php

namespace App\Service\Spotify;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SpotifyClient
{
    private const SPOTIFY_API_URL = 'https://api.spotify.com/v1/';
    private const SPOTIFY_AUTH_URL = 'https://accounts.spotify.com/api/token';

    private string $token;

    public function __construct()
    {
        $this->token = $this->getAuthToken();
    }

    public function getAuthToken()
    {
        $token = Cache::get('access_token');

        if (null === $token) {
            $token = $this->generateAuthToken();
        }

        return $token;
    }

    private function generateAuthToken()
    {
        $response = Http::withHeaders([
            'Accepts' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode(env('SPOTIFY_CLIENT_ID') . ':' . env('SPOTIFY_CLIENT_SECRET')),
        ])
            ->asForm()
            ->post(self::SPOTIFY_AUTH_URL, ['grant_type' => 'client_credentials']);

        $responseBody = json_decode($response->body(), true);
        $accessToken = $responseBody['access_token'];

        Cache::put('access_token', $accessToken, $responseBody['expires_in']);
        return $accessToken;
    }

    public function searchRequest(string $search, string|array $type): PromiseInterface|Response
    {
        $endpoint = self::SPOTIFY_API_URL . "search?q=" . $search . "&type=" . $type;
        return $this->makeRequest()->get($endpoint);
    }

    public function artistRequest(string $id): PromiseInterface|Response
    {
        $endpoint = self::SPOTIFY_API_URL . "artists/" . $id;
        return $this->makeRequest()->get($endpoint);
    }

    public function artistAlbumsRequest(string $id): PromiseInterface|Response
    {
        $endpoint = self::SPOTIFY_API_URL . "artists/" . $id . "/albums?include_groups=album&market=US&limit=50";
        return $this->makeRequest()->get($endpoint);
    }

    public function albumRequest(string $id): PromiseInterface|Response
    {
        $endpoint = self::SPOTIFY_API_URL . "albums/" . $id . "?market=US";
        return $this->makeRequest()->get($endpoint);
    }

    public function trackRequest(string $id): PromiseInterface|Response
    {
        $endpoint = self::SPOTIFY_API_URL . "tracks/" . $id . "?market=US";
        return $this->makeRequest()->get($endpoint);
    }

    public function trackAudioFeaturesRequest(string $id): PromiseInterface|Response
    {
        $endpoint = self::SPOTIFY_API_URL . "audio-features/{$id}";
        return $this->makeRequest()->get($endpoint);
    }

    private function makeRequest(): PendingRequest
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])
            ->acceptJson();
    }
}
