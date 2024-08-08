<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Duurzaam Garant</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased bg-gray-50 bg-gray-50 text-white/50">
        <div class="!bg-gray-50 text-black/50 bg-black text-white/50">

            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[green] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <a href="{{ route('customers.index') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                            </a>
                        </div>
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ url('/customers') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[green] hover:text-black/50 "
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[green] hover:text-black/50 "
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[green] hover:text-black/50 "
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </header>

                    <main class="mt-6">
                        <a
                                href="/customers"
                                id="docs-card"
                                style="background-color: #047857; padding: 2rem; border-radius: 0.75rem; display: flex; flex-direction: column; align-items: start; gap: 1.5rem; overflow: hidden;"
                                class="flex flex-col items-start gap-6 overflow-hidden !bg-green-700 p-8 rounded-xl"
                            >
                                <div class="relative flex justify-between items-center gap-6 lg:items-end">
                                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-white/50 text-green-900 sm:size-16">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
                                              </svg>

                                        </div>

                                        <div class="pt-3 sm:pt-5 lg:pt-0 w-full">
                                            <h2 class="text-xl font-semibold text-white">Welkom Duurzaam Garant</h2>

                                            <p class="mt-4 text-sm leading-relaxed text-white">
                                                Ga naar het dashboard
                                            </p>
                                        </div>

                                    </div>

                                    <svg class="size-6 shrink-0 stroke-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                                </div>
                            </a>
                    </main>

                    <footer class="py-16 text-center text-sm text-black text-white/70">
                        Duurzaam Garant
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
