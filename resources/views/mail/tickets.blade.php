<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Vos billets</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #121212; padding: 20px; margin: 0; color: #ffffff;">

<div style="max-width: 600px; margin: 0 auto; background-color: #181818; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.5);">

    <h2 style="color: #1DB954; margin-bottom: 20px; font-size: 24px;">
        🎟️ Confirmation de votre achat
    </h2>
    
    <p style="font-size: 16px; color: #b3b3b3;">
        Merci pour votre achat. Vos billets sont attachés à cet email en format PDF.
    </p>

    <div style="margin-top:20px;padding:15px;background-color:#282828;border-left:4px solid #1DB954;border-radius:4px;">

        <p style="font-size:14px;color:#b3b3b3;margin:5px 0;">
            🎬 Film : <span style="color:#ffffff">{{ $projection->movie->title }}</span>
        </p>

        <p style="font-size:14px;color:#b3b3b3;margin:5px 0;">
            🎟️ Nombre de billets : <span style="color:#ffffff">{{ $quantity }}</span>
        </p>

    </div>

    <div style="margin-top:25px;padding:15px;background-color:#202020;border-radius:4px;">
        <p style="font-size:14px;color:#b3b3b3;margin:0;">
            Vos billets sont attachés en pièces jointes.
            Présentez-les à l'entrée de la salle.
        </p>
    </div>

    <p style="margin-top:25px;font-size:13px;color:#777;">
        Cet email est généré automatiquement. Merci de ne pas y répondre.
    </p>

</div>

</body>
</html>
