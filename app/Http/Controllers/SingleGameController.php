<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SingleGameController extends Controller
{
    public function index($slug)
    {
        try {
            $game = Http::withHeaders(config('services.igdb'))
                ->withOptions([
                    'body' => "
                    fields name, cover.url, first_release_date, popularity, platforms.abbreviation, rating,
                    slug, involved_companies.company.name, genres.name, aggregated_rating, summary, websites.*, videos.*, screenshots.*, similar_games.cover.url, similar_games.name, similar_games.rating,similar_games.platforms.abbreviation, similar_games.slug;
                    where slug=\"{$slug}\";
                "
                ])->get('https://api-v3.igdb.com/games')
                ->json();

            return view('show', [
                'game' => $game[0],
            ]);
        } catch (\Exception $exception) {
           return view('404');
        }
    }
}
