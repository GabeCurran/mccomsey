<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/my.css')}}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@3.0.6/css/line.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/nav.js') }}" defer></script>
        <script src="{{ asset('js/footer.js') }}" defer></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="{{ 'js/parallax.min.js' }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-banner class='w-screen banner'></x-banner>
        @include('layouts.navigation')
        <div class="min-h-screen bg-white content-container">

            <!-- Page Heading -->
            <header class="bg-gray-100 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>


            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden sm:rounded-lg">
                            <div class="p-6 bg-white">
                                {{ $content1 }}
                            </div>
                        </div>
                    </div>
                </div>
                <x-middle-banner></x-middle-banner>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden sm:rounded-lg">
                            <div class="p-6 bg-white">
                                {{ $content2 }}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class='placeholder'></div>
        <x-footer></x-footer>
    </body>
</html>
