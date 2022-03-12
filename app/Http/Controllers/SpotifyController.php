<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class SpotifyController
{
    public function getAuthToken()
    {
        $response = Http::withHeaders([
            'Accepts' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode(env('SPOTIFY_CLIEND_ID') . ':' . env('SPOTIFY_CLIENT_SECRET')),
        ])
        ->asForm()
        ->post('https://accounts.spotify.com/api/token', ['grant_type' => 'client_credentials']);

        return json_decode($response->body());

    }
    public function search()
    {   $token = $this->getAuthToken();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token->access_token
        ])
            ->acceptJson()
            ->get('https://api.spotify.com/v1/search?q=Tallah&type=artist');

        return json_decode($response);
    }
}
