<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Duurzaam Garant</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            [aria-label='Pagination Navigation'] span a {
                background-color: white !important;
                color:rgb(17 24 39 / var(--tw-text-opacity));
            }
            [aria-label='Pagination Navigation'] span a:hover {
                background-color: rgb(59 130 246 / var(--tw-bg-opacity)) !important;
            }
            [aria-label='Pagination Navigation'] span[aria-current="page"] span {
                background-color: rgb(59 130 246 / var(--tw-bg-opacity)) !important;
                color: white !important;
            }
            [aria-label='Pagination Navigation'] span[aria-disabled="true"] span {
                background-color: rgb(203, 203, 204) !important;
            }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('scripts') <!-- Bunu buraya ekleyin -->
    </body>
</html>
