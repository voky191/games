@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Popular games</h2>
        <div class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16">
                @foreach ($popularGames as $game)
                    <div class="game mt-8">
                        <div class="relative inline-block">
                            <a href="#"><img src="{{ Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) }}" alt="game cover" class="hover:opacity-75 transition ease-in-out duration-150"></a>
                            <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full" style="right:-20px; bottom:-20px">
                                <div class="font-semibold text-xs flex justify-center items-center h-full">{{ round($game['aggregated_rating']).'%' }}</div>
                            </div>
                        </div>
                        <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">{{$game->name}}</a>
                       @foreach ($game['platforms'] as $platform)
                           {{-- @if (array_key_exists('abbreviation', $platform))--}}
                            <div class="text-gray-400 mt-1" style="display: inline-block">
                                {{ $platform['name'] }}
                            </div>
                          {{--  @endif --}}
                        @endforeach
                    </div>
                @endforeach
        </div>
        <div class="flex flex-col lg:flex-row my-10">
            <div class="recently-reviewed w-full lg:w-3/4 mr-0 lg:mr-32">
                <h2 class="text-blue-500 uppercase tracking-wide  font-semibold">Recently reviewed</h2>
                <div class="recently-reviewed-container space-y-12 mt-8">
                    <div class="game bg-gray-800 rounded-lg shadow-md flex px-6 py-6">
                        <div class="relative flex-none">
                            <a href="#"><img src="https://cdn-products.eneba.com/resized-products/zTTVb_NAle18D-5snqycIAeGQ7e94IVqNXi1jFi2ljs_390x400_1x-0.jpeg" alt="game cover" class="w-48 hover:opacity-75 transition ease-in-out duration-150"></a>
                            <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full" style="right:-20px; bottom:-20px">
                                <div class="font-semibold text-xs flex justify-center items-center h-full">95%</div>
                            </div>
                        </div>
                        <div class="ml-12">
                            <a href="#" class="block text-lg font-semibold leading-tight hover:text-gray-400 mt-4">Horizon: Zero Dawn</a>
                            <div class="text-gray-400 mt-1">PS4, PC</div>
                            <p class="mt-6 text-gray-400 hidden lg:block">
                                Horizon Zero Dawn is an action role-playing game developed by Guerrilla Games and published by Sony Interactive
                                Entertainment. The plot follows Aloy, a hunter in a world overrun by machines, who sets out to uncover her past.
                                The player uses ranged weapons, a spear, and stealth to combat mechanical creatures and other enemy forces. A
                                skill tree provides the player with new abilities and bonuses.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="most-anticipated lg:w-1/4 mt-12 lg:mt-0">
                <h2 class="text-blue-500 uppercase tracking-wide  font-semibold">Most anticipated</h2>
                <div class="most-anticipated-container space-y-10 mt-8">
                    <div class="game flex">
                        <a href="#"><img src="https://cdn-products.eneba.com/resized-products/zTTVb_NAle18D-5snqycIAeGQ7e94IVqNXi1jFi2ljs_390x400_1x-0.jpeg" alt="game cover" class="w-16 hover:opacity-75 transition ease-in-out duration-150"></a>
                        <div class="ml-4">
                            <a href="#" class="hover:text-gray-300">Horizon: Zero Dawn</a>
                            <div class="text-gray-400 text-sm mt-1">7 August 2020</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 @endsection
