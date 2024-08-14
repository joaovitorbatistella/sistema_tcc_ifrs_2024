<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="{{asset('images/logobranca.png')}}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            <div class="flex">
                <div class="c-sidebar">
                    @include('layouts.sidebar')
                </div>
                <div style="width: 100%">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <header class="bg-white shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endif
                    <!-- Page Content -->
                    <main>
                    {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>

<style>
.c-sidebar  {
    box-sizing: border-box;
    border-radius: 0 15px 15px 0;
    flex-direction: column;
    justify-content: space-between;
    gap: 16px;
    width: 228px;
    height: 100%;
    line-height: 16px;
    display: flex;
}
</style>