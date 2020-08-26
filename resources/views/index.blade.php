@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Popular games</h2>
        <div class="popular-games text-sm grid grid-cols-2 lg:grid-cols-3 gap-12 border-b border-gray-800 pb-16" style="text-align: center">
                @foreach ($popularGames as $game)
                    <div class="game mt-8">
                        <div class="relative inline-block">
                            <a href="{{ route('games.show', $game['slug']) }}"><img src="{{ Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) }}" alt="game cover" class="w-32 md:w-48 lg:w-64 hover:opacity-75 transition ease-in-out duration-150 shadow-lg"></a>
                            <div class="absolute bottom-0 right-0 w-12 lg:w-16 h-12 lg:h-16 bg-gray-800 rounded-full" style="right:-20px; bottom:-20px">
                                <div class="progress" value="{{ round($game['aggregated_rating'])}}"></div>
                            </div>
                        </div>
                        <a href="{{ route('games.show', $game['slug']) }}" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">{{$game->name}}</a>
                        <div class="text-gray-400 mt-1">
                            @foreach ($game['platforms'] as $platform)
                                    {{ $platform['abbreviation'] }}
                            @endforeach
                        </div>
                    </div>
                @endforeach
        </div>
        <div class="flex flex-col lg:flex-row my-10">
            <div class="recently-reviewed w-full lg:w-3/4 mr-0 lg:mr-32">
                <h2 class="text-blue-500 uppercase tracking-wide  font-semibold">Recently reviewed</h2>
                <div class="recently-reviewed-container space-y-12 mt-8">
                    @foreach($recentlyReviewed as $gameReview)
                    <div class="game bg-gray-800 rounded-lg shadow-md flex px-6 py-6">
                        <div class="relative flex-none">
                            <a href="{{ route('games.show', $gameReview['slug']) }}"><img src="{{ Str::replaceFirst('thumb', 'cover_big', $gameReview['cover']['url']) }}" alt="game cover" class="w-24 lg:w-48 hover:opacity-75 transition ease-in-out duration-150 shadow-md"></a>
                            <div class="absolute bottom-0 right-0 w-12 lg:w-16 h-12 lg:h-16 bg-gray-900 rounded-full" style="right:-20px; bottom:-20px">
                                <div class="progress" value="{{ round($gameReview['rating'])}}"></div>
                            </div>
                        </div>
                        <div class="ml-12">
                            <a href="{{ route('games.show', $gameReview['slug']) }}" class="block text-base lg:text-lg font-semibold leading-tight hover:text-gray-400 mt-4">{{ $gameReview['name'] }}</a>
                            <div class="text-gray-400 mt-1">
                                @foreach ($gameReview['platforms'] as $platform)
                                    {{ $platform['abbreviation'] }}
                                @endforeach</div>
                            <p class="mt-4 text-gray-400 hidden h-24 md:text-sm xl:text-base lg:block ">
                                {{ $gameReview['summary'] }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="most-anticipated lg:w-1/4 mt-12 lg:mt-0">
                <h2 class="text-blue-500 uppercase tracking-wide  font-semibold">Most anticipated</h2>
                <div class="most-anticipated-container space-y-10 mt-8">
                    @foreach($mostAnticipated as $anticipatedGame)
                    <div class="game flex">
                        <a href="{{ route('games.show', $anticipatedGame['slug']) }}"><img src="{{ Str::replaceFirst('thumb', 'cover_big', $anticipatedGame['cover']['url']) }}" alt="game cover" class="w-24 lg:w-48 hover:opacity-75 transition ease-in-out duration-150 shadow-md"></a>
                        <div class="ml-4">
                            <a href="{{ route('games.show', $anticipatedGame['slug']) }}" class="hover:text-gray-300">{{ $anticipatedGame['name'] }}</a>
                            <div class="text-gray-400 text-sm mt-1">{{ date('j M Y', strtotime($anticipatedGame['first_release_date']) ) }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <h2 class="text-blue-500 uppercase tracking-wide font-semibold mt-12">Coming Soon</h2>
                <div class="coming-soon-container space-y-10 mt-8">
                    @foreach($comingSoon as $soonGame)
                    <div class="game flex">
                        <a href="{{ route('games.show', $soonGame['slug']) }}"><img src="{{ Str::replaceFirst('thumb', 'cover_big', $soonGame['cover']['url']) }}" alt="game cover" class="w-16 hover:opacity-75 transition ease-in-out duration-150 shadow-md"></a>
                        <div class="ml-4">
                            <a href="{{ route('games.show', $soonGame['slug']) }}" class="hover:text-gray-300">{{ $soonGame['name'] }}</a>
                            <div class="text-gray-400 text-sm mt-1">{{ date('j M Y', strtotime($soonGame['first_release_date']) ) }}</div>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
    </div>
    </div>
    <script>
        let endColor = '#9ec64d';
        $('.progress').each(function(i) {
            let circle = new ProgressBar.Circle(this, {
                color: endColor,
                easing: 'linear',
                strokeWidth: 6,
                duration: 2000,
                text: {
                    value: '0'
                }
            });
            let value = ($(this).attr('value') / 100);
            circle.animate(value, {
                step: function(state, circle, bar) {
                    circle.setText((circle.value() * 100).toFixed(0)+'%');
                }
            });
        });
    </script>

 @endsection
