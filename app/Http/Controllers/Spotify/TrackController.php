<?php

namespace App\Http\Controllers\Spotify;

use App\Enum\Entity;
use App\Http\Controllers\SpotifyController;
use App\Processor\TrackProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrackController extends SpotifyController
{
    public function __invoke(Request $request, TrackProcessor $processor)
    {
        try {
            //        $id = "6vsyag9kEPckt19NClSf51";

            Validator::validate($request->all(), [
                'id' => 'required|string'
            ]);

            $id = $request->get('id');

            $response = $this->spotifyClient->track($id)->get();

            $track = $processor->get($response, $this->entityFactory->create(Entity::Track));

            return response()->json([
                'status' => true,
                'data' => $track
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
