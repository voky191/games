<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Games</title>
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/progressbar.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous">
    </script>
</head>
<body class="bg-gray-900 text-white">

<header class="border-b border-gray-800">
    <nav class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4 py-6">
        <div class="flex flex-col lg:flex-row items-center">
            <a href="/">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png" alt="logo" class="w-10 h-10 flex-none">
            </a>
            <ul class="flex ml-0 lg:ml-16 space-x-8  mt-6 lg:mt-0">
                <li><a href="{{ route('games') }}" class="hover:text-gray-400">Games</a></li>
                <li><a href="#" class="hover:text-gray-400">Reviews</a></li>
                <li><a href="#" class="hover:text-gray-400">Coming Soon</a></li>
            </ul>
        </div>
        <div class="flex items-center mt-6 lg:mt-0">
            <div class="relative">
                <form action="{{ route('search') }}" method="POST">
                    @csrf
                <input type="text" required class="bg-gray-800 text-sm rounded-full px-3 py-1 pl-8 w-64 focus:outline-none focus:shadow-outline" placeholder="Search..." name="search" id="search">
                <div class="absolute top-0 flex items-center h-full ml-2">
                    <button type="Submit">
                    <svg viewBox="0 0 16 16" class="bi bi-search fill-current text-gray-400 w-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg>
                    </button>
                </div>
                </form>
            </div>
            <div class="ml-6">
                <a href=""><img src="https://cdn.iconscout.com/icon/free/png-512/avatar-370-456322.png" alt="avatar" class="rounded-full w-8" style="max-width: fit-content"></a>
            </div>
        </div>
    </nav>
</header>

<main class="py-8">
    @yield('content')
</main>

<footer class="border-t border-gray-800">
    <div class="container mx-auto px-4 py-6">
        Powered by <a href="#" class="underline hover:text-gray-400">IGDB ARI</a>
    </div>
</footer>
<script>
    document.addEventListener('invalid', (function(){
        return function(e){
            //prevent the browser from showing default error bubble/ hint
            e.preventDefault();
            // optionally fire off some custom validation handler
            // myvalidationfunction();
        };
    })(), true);
</script>
</body>
</html>
