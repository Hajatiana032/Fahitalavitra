<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
        }

        .ticket {
            position: relative;
            width: 650px;
            height: 360px;
            margin: auto;
            color: #fff;
            overflow: hidden;
            border-radius: 10px;
        }

        /* Poster du film */
        .poster {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .poster img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.70);
            padding: 25px;
        }

        /* Header */
        .header {
            border-bottom: 2px solid #1DB954;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            color: #1DB954;
        }

        .row {
            margin-bottom: 8px;
        }

        .label {
            font-size: 13px;
            color: #bbbbbb;
        }

        .value {
            font-size: 15px;
            font-weight: bold;
        }

        /* Footer */
        .footer {
            position: absolute;
            bottom: 15px;
            left: 25px;
            right: 25px;
            border-top: 1px dashed #888;
            padding-top: 8px;
            font-size: 12px;
            text-align: center;
            color: #ccc;
        }
    </style>
    <title></title>

</head>

<body>

<div class="ticket">

    <div class="poster">
        <img src="https://image.tmdb.org/t/p/w500{{ $projection->movie->backdrop }}"
             alt="{{ $projection->movie->title }}">
    </div>

    <div class="overlay">

        <div class="header">
            <div class="title">{{ $projection->movie->title }}</div>
        </div>

        <div class="row">
            <span class="label">Code :</span>
            <span class="value">{{ $ticket->code }}</span>
        </div>

        <div class="row">
            <span class="label">Date et heure :</span>
            <span class="value">
                {{ $projection->start_at->format('d M Y à H:i') }}
            </span>
        </div>

        <div class="row">
            <span class="label">Client :</span>
            <span class="value">
                {{ $customer->last_name }} {{ $customer->first_name }}
            </span>
        </div>

        <div class="row">
            <span class="label">Email :</span>
            <span class="value">{{ $customer->email }}</span>
        </div>

        <div class="row">
            <span class="label">Téléphone :</span>
            <span class="value">{{ $customer->phone }}</span>
        </div>

        <div class="footer">
            Présentez ce billet à l'entrée de la salle
        </div>

    </div>

</div>

</body>
</html>
