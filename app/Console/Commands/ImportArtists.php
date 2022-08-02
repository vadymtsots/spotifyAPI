<?php

namespace App\Console\Commands;

use App\Repository\Artist\ArtistRepository;
use App\Service\Spotify\SpotifyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ImportArtists extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:artists';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import artists via Spotify API and insert them into db';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SpotifyService $spotifyService, ArtistRepository $artistRepository)
    {
        $spotifyIds = [
            "0yLwGBQiBqhXOvmTfH2A7n",
            "2ye2Wgw4gimLv2eAKyk1NB",
            "3fMbdgg4jU18AjLCKBhRSm",
            "3U3C9o6UTYNdEsDckpRyvX",
            "3RNrq3jvMZxD9ZyoOZbQOD",
            "6wWVKhxIU2cEi0K81v7HvP",
            "5xLSa7l4IV1gsQfhAMvl0U"
        ];

        try {
            foreach ($spotifyIds as $artistId) {
                $artistData = $spotifyService->getArtistBySpotifyId($artistId);
                $artistRepository->saveFromFields($artistData);
            }

            $this->output->success('Artists have been imported successfully');
        } catch (\Exception $exception) {
            Log::error('Something went wrong while importing artists', [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            ]);

            $this->output->error('Something went wrong. See logs for exception trace');
        }



        return 0;
    }
}
