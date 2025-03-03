<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        {{-- @include('layouts.navigation') --}}
        @include('components.layouts.header')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-black shadow-lg">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <x-mary-toast />  
    </div>

    @livewireScripts
</body>
@include('components.layouts.footer')

</html>
