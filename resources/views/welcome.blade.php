<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="spotify">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fahitalavitra</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
@include('partials.navbar')

<main class="mx-5 lg:mx-25 mb-5">
    <x-flash-messages/>
    @yield('content')
</main>
<footer class="text-center bg-neutral text-neutral-content p-2">
    &copy; {{ date('Y') }} Fahitalavitra by Hajatiana. All rights reserved
</footer>
@livewireScripts
</body>
</html>
