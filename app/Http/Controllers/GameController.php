<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Game;

class GameController extends Controller
{
    public function index(){
        //$games = Game::with(['cover' => ['url', 'image_id']])->get();
        //$games = Game::all()->with(['cover' => ['url', 'image_id']])->get();
        $games = Game::where('aggregated_rating', '>=', 88)
            ->whereYear('first_release_date', 2019, 2020)
            ->with(['cover' => ['url', 'image_id']])
            ->get();
        //print_r($games);
        return view('index', [
            'games' => $games
        ]);
    }
}
