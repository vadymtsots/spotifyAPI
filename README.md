Spotify API

This project is intended to process the original responses from Spotify API
into more readable way.

In order to use this repo, do the following:

    - clone repository;
    - run composer install;
    - create .env file from .env.example
    - generate Spotify API keys on official site: www.spotify.com
    - pass these ids into .env file (SPOTIFY_CLIENT_ID and SPOTIFY_CLIENT_SECRET)
    - run php artisan serve;

This is enough to use endpoints prefixed with /spotify

In order to enable search by genre functionality, do the following steps after the ones above:

    - setup Mysql database locally;
    - enter credentials in .env file;
    - run php artisan migrate;
    - run php artisan import:artists, which will import 7 example artists;

After this, you can use `artist/search-by-genre` endpoint. Payload is following:

`"search": <your-input>`


