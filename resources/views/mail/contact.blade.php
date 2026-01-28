<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message de contact</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #121212; padding: 20px; margin: 0; color: #ffffff;">
    <div
        style="max-width: 600px; margin: 0 auto; background-color: #181818; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
        <h2 style="color: #1DB954; margin-bottom: 20px; font-size: 24px;">Nouveau message de contact</h2>
        <p style="font-size: 16px; color: #b3b3b3; margin-bottom: 10px;"><strong style="color: #ffffff;">De:</strong>
            {{ $data['name'] }}</p>
        <p style="font-size: 16px; color: #b3b3b3; margin-bottom: 10px;"><strong style="color: #ffffff;">Email:</strong>
            {{ $data['email'] }}</p>
        <p style="font-size: 16px; color: #b3b3b3; margin-bottom: 10px;"><strong
                style="color: #ffffff;">Téléphone:</strong> {{ $data['phone'] }}</p>
        <p style="font-size: 16px; color: #b3b3b3; margin-bottom: 20px;"><strong style="color: #ffffff;">Sujet:</strong>
            {{ $data['subject'] }}</p>
        <div
            style="margin-top: 20px; padding: 15px; background-color: #282828; border-left: 4px solid #1DB954; border-radius: 4px;">
            <p style="font-size: 16px; color: #ffffff; margin-bottom: 10px;"><strong>Message:</strong></p>
            <p style="font-size: 14px; color: #ffffff; line-height: 1.5; margin: 0;">{!! nl2br(e($data['message'])) !!}</p>
        </div>
    </div>
</body>

</html>
