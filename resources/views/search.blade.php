@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-4">
        <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Search results for "{{ $name }}"</h2>
        <div class="popular-games text-sm grid grid-cols-2 lg:grid-cols-3 gap-12 pb-16" style="text-align: center">
            @foreach ($games as $searchResult)
                @if ($searchResult['cover']['url'])
                <div class="game mt-8">
                    <div class="relative inline-block">
                            <a href="{{ route('games.show', $searchResult['slug']) }}"><img src="{{ Str::replaceFirst('thumb', 'cover_big', $searchResult['cover']['url']) }}" alt="game cover" class="w-32 md:w-48 lg:w-64 hover:opacity-75 transition ease-in-out duration-150 shadow-lg"></a>
                    </div>
                    <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">{{$searchResult->name}}</a>
                    {{--}}<div class="text-gray-400 mt-1">
                        @foreach ($game['platforms'] as $platform)
                            {{ $platform['abbreviation'] }}
                        @endforeach
                    </div>--}}
                </div>
                @endif
            @endforeach
        </div>
    </div>

@endsection
