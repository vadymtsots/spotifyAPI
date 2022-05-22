<?php

namespace App\Service\Spotify;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AuthService
{
    /**
     * @return mixed
     */
    public function getAuthToken()
    {
        $token = Cache::get('access_token');

        if (null === $token) {
            $token = $this->generateAuthToken();
        }

        return $token;
    }

    /**
     * @return mixed
     */
    private function generateAuthToken()
    {
        $response = Http::withHeaders([
            'Accepts' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode(env('SPOTIFY_CLIENT_ID') . ':' . env('SPOTIFY_CLIENT_SECRET')),
        ])
            ->asForm()
            ->post('https://accounts.spotify.com/api/token', ['grant_type' => 'client_credentials']);

        $responseBody = json_decode($response->body(), true);
        $accessToken = $responseBody['access_token'];

        Cache::put('access_token', $accessToken, $responseBody['expires_in']);
        return $accessToken;
    }
}
