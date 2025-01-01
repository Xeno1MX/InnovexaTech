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
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    <div class="flex w-full h-screen">
        @include('layouts.sidebar')

        <div class="h-full bg-gray-100 flex-1 flex flex-col">

            @include('layouts.navigation')

            <div class="flex-1 overflow-y-auto">
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
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Toggle sidebar visibility
            $('#toggleSidebar').on('click', function () {
                $('#sidebar').toggleClass('md:min-w-[300px]');
                $('#sidebar').toggleClass('w-0');
                $('#sidebar-name').toggleClass('hidden');
                // $('#main-content').toggleClass('ml-0');
            });
        });
    </script>
</body>
</html>
