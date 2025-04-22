<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuovo Messaggio dal Modulo di Contatto</title>
</head>
<body style="background-color: black; color: black; padding: 2rem; font-family: Arial, sans-serif;">
    <div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 10px; padding: 2rem; box-shadow: 0 0 10px rgba(0,255,128,0.1);">
        <h2 style="text-align: center; color: #55b605; font-size: 28px; font-weight: bold; margin-bottom: 1.5rem;">Nuovo Messaggio dal Modulo di Contatto</h2>

        <h1 style="font-size: 24px;">Ciao,</h1>

        <p style="font-size: 16px; line-height: 1.5;">Hai ricevuto un nuovo messaggio dal modulo di contatto:</p>

        <p style="font-size: 16px; line-height: 1.5;"><strong>Nome:</strong> {{ $data['name'] }}</p>
        <p style="font-size: 16px; line-height: 1.5;"><strong>Email:</strong> {{ $data['email'] }}</p>

        <p style="font-size: 16px; line-height: 1.5;"><strong>Messaggio:</strong></p>
        <p style="font-size: 16px; line-height: 1.5;">{{ $data['message'] }}</p>

        <p style="font-size: 16px; line-height: 1.5;">Ti consigliamo di rispondere il prima possibile per soddisfare la richiesta del cliente.</p>

        <p style="font-size: 16px; line-height: 1.5;">Grazie,</p>
        <p style="font-size: 16px; line-height: 1.5;">{{ config('app.name') }}</p>

        <hr style="margin-top: 2rem; border: none; border-top: 1px solid #ddd;">

        <p style="font-size: 12px; color: #aaa; margin-top: 2rem;">
            Questa email è stata generata automaticamente, ti chiediamo di non rispondere direttamente a questo messaggio.<br>
            Per qualsiasi richiesta o supporto, visita la nostra 
            <a href="{{ route('contacts')}}" style="color: #228b22; text-decoration: none;">pagina contatti</a>.
        </p>
    </div>
</body>
</html>
