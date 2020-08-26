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
    <style>
        .sticky {
            position: fixed;
            top: 0;
            width: 100%
        }
        .content {
            padding: 16px;
        }
        .sticky + .content {
            padding-top: 102px;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">

<header class="border-b border-gray-800" id="header" style="z-index: 20; background: #1a202c">
    <nav class="container mx-auto flex flex-row items-center justify-between px-4 py-4 pt-0 lg:pt-4">
        <div class="flex flex-row items-center mt-6 lg:mt-2">
            <a href="/">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png" alt="logo" class="w-8 h-8 lg:w-10 lg:h-10 flex-none">
            </a>
        </div>
        <div class="flex items-center mt-6 lg:mt-0">
            <div class="relative">
                <form action="{{ route('search') }}" method="POST">
                    @csrf
                <input type="text" required class="bg-gray-800 text-sm rounded-full px-3 py-1 pl-8 w-48 lg:w-64 focus:outline-none focus:shadow-outline" placeholder="Search..." name="search" id="search">
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
        </div>
    </nav>
</header>

<main class="py-8 content">
    @yield('content')
</main>

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
<script>
    window.onscroll = function() {myFunction()};

    var header = document.getElementById("header");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>
</body>
</html>
