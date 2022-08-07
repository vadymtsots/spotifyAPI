Spotify API

This project is intended to process the original responses from Spotify API
into more readable way.

Prerequisites:
 - php 8.1;
 - http extension installed;

How to generate Spotify API keys:
 - create an account on https://www.spotify.com
 - go to https://developer.spotify.com/
 - go to **Dashboard** section
 - log in if needed
 - create a new app
 - go to the created app and copy keys

In order to use this repo, do the following:

- clone repository;
- run composer install;
- create .env file from .env.example
- pass these Spotify keys into .env file (SPOTIFY_CLIENT_ID and SPOTIFY_CLIENT_SECRET)
- run php artisan serve;

This is enough to use endpoints prefixed with /spotify

In order to enable search by genre functionality, do the following steps after the ones above:

- setup Mysql database locally;
- enter credentials in .env file;
- run php artisan migrate;
- run php artisan import:artists, which will import 7 example artists;


