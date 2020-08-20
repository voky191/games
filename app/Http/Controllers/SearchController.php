<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MarcReichel\IGDBLaravel\Models\Game;

class SearchController extends Controller
{
    public function index(Request $request){

        $name = $request->input('search');
        //if($name != '') {
        $games = Game::search($name)
            ->with(['cover' => ['url', 'image_id']])
            ->get();

        //dump($games);

        return view('search', compact(['games', 'name']));
       /* } else
            return redirect('/');*/
    }
}
