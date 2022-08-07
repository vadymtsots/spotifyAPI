<?php

namespace App\Http\Controllers;

use Aerni\Spotify\Spotify;
use App\Factory\EntityFactory;

class SpotifyController
{
    public function __construct(
        protected EntityFactory $entityFactory,
        protected Spotify $spotifyClient
    ) {
    }

    public function trackAudioFeatures(): array
    {
        $id = "6vsyag9kEPckt19NClSf51";
        $response = $this->spotifyClient->audioFeaturesForTrack($id)->get();

        return $response;
    }
}
