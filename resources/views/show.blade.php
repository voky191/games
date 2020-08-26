@extends('layouts.app')

@section('content')

    <style>
        .modal {
            z-index:1;
            display:none;
            padding-top:10px;
            position:fixed;
            left:0;
            right: 0;
            top:0;
            bottom: 0;
            width:100%;
            height:100%;
            overflow:auto;
            background-color:rgb(0,0,0);
            background-color:rgba(0,0,0,0.8)
        }

        .modal-content{
            margin: auto;
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }


        .modal-hover-opacity {
            opacity:1;
            filter:alpha(opacity=100);
            -webkit-backface-visibility:hidden
        }

        .modal-hover-opacity:hover {
            opacity:0.60;
            filter:alpha(opacity=60);
            -webkit-backface-visibility:hidden
        }


        .close {
            text-decoration:none;float:right;font-size:24px;font-weight:bold;color:white
        }
        .container1 {
            width:200px;
            display:inline-block;
        }
        .modal-content, #caption {

            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }
    </style>

    <div class="container mx-auto px-4" id="root">
        <div class="game-details pb-12 flex flex-col lg:flex-row  border-b border-gray-800">
            <div class="flex-none">
                @if (array_key_exists('cover', $game))
                <img src="{{ Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) }}" alt="cover" class="ml-auto mr-auto">
                    @endif
            </div>
            <div class="lg:ml-12 xl:mr-64">
                <h2 class="font-semibold text-4xl leading-tight mt-1"  style="text-align: center">{{ $game['name'] }}</h2>
                @if (array_key_exists('genres', $game))
                <div class="text-gray-400"style="text-align: center">
                    <span> @foreach ($game['genres'] as $genre)
                            {{ $genre['name'] }}
                        @endforeach</span>
                    &middot;
                    <span>{{ $game['involved_companies'][0]['company']['name'] }}</span>
                    &middot;
                    <span> @foreach ($game['platforms'] as $platform)
                            @if (array_key_exists('abbreviation', $platform))
                                {{ $platform['abbreviation'] }}
                            @endif
                        @endforeach</span>
                </div>
                @endif

                <div class="flex flex-wrap items-center mt-8">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gray-800 rounded-full">
                            @if (array_key_exists('rating', $game))
                                <div class="progress" value="{{ round($game['rating'])}}"></div>
                            @else
                                <div class="progress" value="0"></div>
                            @endif
                        </div>
                        <div class="ml-4 text-xs">Member <br> Score</div>
                    </div>
                    <div class="flex items-center ml-12">
                        <div class="w-16 h-16 bg-gray-800 rounded-full">
                            @if (array_key_exists('aggregated_rating', $game))
                                <div class="progress" value="{{ round($game['aggregated_rating'])}}"></div>
                            @else
                                <div class="progress" value="0"></div>
                            @endif
                        </div>
                        <div class="ml-4 text-xs">Critic <br> Score</div>
                    </div>

                </div>

                @if (array_key_exists('summary', $game))
                <p class="mt-12">{{ $game['summary'] }}</p>
                @endif

            </div>
        </div> <!-- end game-details -->

        @if (array_key_exists('screenshots', $game))
        <div class="images-container border-b border-gray-800 pb-12 mt-8">
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Images</h2>
            <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mt-8">
                @foreach ($game['screenshots'] as $screenshot)
                    <div>
                            <img src="{{ Str::replaceFirst('thumb', 'screenshot_big', $screenshot['url']) }}" alt="screenshot" class="hover:opacity-75 transition ease-in-out duration-150" onclick="onClick(this)">
                    </div>
                @endforeach
            </div>
        </div> <!-- end images-container -->
        @endif

        <div id="modal01" class="modal" onclick="this.style.display='none'">
            <span class="close">&times;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <div class="modal-content">
                <img id="img01" style="max-width:100%">
            </div>
        </div>


        @if (array_key_exists('videos', $game))
        <div class="iframe-container mt-12 border-b border-gray-800">
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold mb-8">Related Video</h2>
            <iframe src="//www.youtube.com/embed/{{ $game['videos'][0]['video_id'] }}" allowfullscreen style="border: 0; height: 562px; left: 0; width: 80%;" class="mb-16 hidden md:block"></iframe>
            <a href="https://youtube.com/watch/{{ $game['videos'][0]['video_id'] }}" class="inline-flex bg-blue-500 text-white font-semibold px-4 py-4 hover:bg-blue-600 rounded transition ease-in-out duration-150 block md:hidden mb-16" style="height: 56px">
                <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path></svg>
                <span class="ml-2">Play Trailer</span>
            </a>
        </div>
        @endif

        @if (array_key_exists('similar_games', $game))
        <div class="similar-games-container mt-8">
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Similar Games</h2>
            <div class="similar-games text-sm grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-12" style="text-align: center">
                @foreach($game['similar_games'] as $sgame)
                  <div class="game mt-8">
                    <div class="relative inline-block">
                        @if (array_key_exists('cover', $sgame))
                        <a href="{{ route('games.show', $sgame['slug']) }}">
                            <img src="{{ Str::replaceFirst('thumb', 'cover_big', $sgame['cover']['url']) }}" alt="game cover" class="w-32 md:w-48 lg:w-64 hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        @endif
                        <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full" style="right: -20px; bottom: -20px">
                            @if (array_key_exists('rating', $sgame))
                                <div class="progress" value="{{ round($sgame['rating'])}}"></div>
                            @else
                                <div class="progress" value="0"></div>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('games.show', $sgame['slug']) }}" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">{{ $sgame['name'] }}</a>
                    <div class="text-gray-400 mt-1">
                        @if (array_key_exists('platforms', $sgame))
                            @foreach ($sgame['platforms'] as $platform)
                                @if (array_key_exists('abbreviation', $platform))
                                    {{ $platform['abbreviation'] }}
                                @endif
                            @endforeach
                        @endif
                    </div>
                  </div>
                @endforeach
            </div> <!-- end similar-games -->
        </div> <!-- end similar-games-container -->
        @endif

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
    <script>
        function onClick(element) {
            document.getElementById("img01").src = element.src;
            document.getElementById("modal01").style.display = "block";
        }
    </script>
@endsection
