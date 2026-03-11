<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      data-theme="spotify">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
@include('partials.navbar')
<div class="mx-5 lg:mx-40">
    {{ $slot }}
</div>

@livewireScripts
<script src="https://js.stripe.com/clover/stripe.js"></script>
@stack('scripts')
</body>

</html>
