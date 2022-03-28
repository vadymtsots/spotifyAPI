<?php

namespace App\Enum;

enum Entity: int
{
    case Artist = 1;
    case Album = 2;
    case ArtistAlbums = 3;
    case Track = 4;
    case TrackAudioFeatures = 5;
    case TrackAudioAnalysis = 6;
}
