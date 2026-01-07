<!DOCTYPE html>
<html lang="fr" data-theme="spotify">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Notification' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="text-20px bg-neutral p-5">
<div class="card text-secondary shadow-primary shadow-md">
    <div class="card-body">
        <h5 class="card-title mb-0">{{ $data['name'] }}</h5>
        <div class="mb-6 font-bold">Numéro de téléphone: {{ $data['phone'] }}</div>
        <p class="mb-4">{!! nl2br(e($data['message'])) !!}</p>
    </div>
</div>
</body>
</html>
