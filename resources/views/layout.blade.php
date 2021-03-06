<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link href="/css/app.css" rel="stylesheet" />
</head>
<body>
    <header class="text-center bg-blue-900 text-white">
        <h1>{{ config('app.name') }}</h1>
    </header>

    <nav class="text-center pt-2">
        <ul>
            <li><a class="text-blue-500 hover:underline" href="/posts">List Post</a></li>
            <li><a class="text-blue-500 hover:underline" href="/posts/create">Create Post</a></li>
        </ul>
    </nav>

    <section class="py-4">
        <div class="mx-auto w-192">
        @yield('contents')
        </div>
    </section>

    <footer class="text-center bg-gray-600 text-gray-300">
        <p>No Copyright 😊</p>
    </footer>

    <script src="/js/app.js"></script>
</body>
</html>l
