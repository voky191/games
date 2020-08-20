<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MarcReichel\IGDBLaravel\Models\Company;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\PlatformLogo;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;
        $current = Carbon::now()->timestamp;
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;


        $popularGames = Game::select(['name', 'first_release_date', 'popularity', 'rating', 'slug'])
            ->where('aggregated_rating', '>=', 88)
            ->whereIn('platforms', ['48','49','130','6'])
            ->whereYear('first_release_date', date('Y')-1, date('Y'))
            ->with(['cover' => ['url', 'image_id']])
            ->with(['platforms' => ['abbreviation', 'name', 'platform_logo']])
            ->limit(6)
            ->get();

        //dump($popularGames);

        $recentlyReviewed=Game::select(['name', 'first_release_date', 'popularity', 'rating', 'rating_count', 'summary', 'slug'])
            ->whereIn('platforms', ['48','49','130','6'])
            ->whereBetween('first_release_date', $before, $current)
            ->where('rating_count', '>', 5)
            ->with(['cover' => ['url', 'image_id']])
            ->with(['platforms' => ['abbreviation', 'name', 'platform_logo']])
            ->orderBy('popularity', 'desc')
            ->limit(3)
            ->get();

        // dump($recentlyReviewed);

        $mostAnticipated=Game::select(['name', 'first_release_date', 'popularity', 'rating', 'rating_count', 'summary', 'slug'])
            ->whereIn('platforms', ['48','49','130','6'])
            ->whereBetween('first_release_date', $current, $afterFourMonths)
            ->with(['cover' => ['url', 'image_id']])
            ->with(['platforms' => ['abbreviation', 'name', 'platform_logo']])
            ->orderBy('popularity', 'desc')
            ->limit(2)
            ->get();

        // dump($mostAnticipated);

       $comingSoon=Game::select(['name', 'first_release_date', 'popularity', 'rating', 'rating_count', 'summary', 'slug'])
           ->whereIn('platforms', ['48','49','130','6'])
           ->where('first_release_date', '>=', $current)
           ->with(['cover' => ['url', 'image_id']])
           ->where('popularity', '>', '5')
           ->orderBy('first_release_date', 'asc')
           ->limit(4)
           ->get();

        // dump($comingSoon);

        return view('index', compact(['mostAnticipated', 'recentlyReviewed', 'popularGames', 'comingSoon']));
    }
}
