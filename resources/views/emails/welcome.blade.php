<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="background-color: black; color: black; padding: 2rem; font-family: Arial, sans-serif;">
        <div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 10px; padding: 2rem; box-shadow: 0 0 10px rgba(0,255,128,0.1);">
            <h2 style="text-align: center; color: #55b605; font-size: 28px; font-weight: bold; margin-bottom: 1.5rem; margin-top: 1.5rem;">Benvenuto su {{ config('app.name') }}!</h2>

            <p style="font-size: 18px;">Ciao <strong style="color: #228b22;">{{ $user->name }}</strong> 👋,</p>

            <p style="font-size: 16px; line-height: 1.5;">
                Grazie per esserti registrato su <strong style="color: #55b605;">{{ config('app.name') }}</strong>! 🎉
                <br> Siamo felicissimi di averti a bordo. Inizia subito a esplorare i nostri prodotti e servizi.
            </p>

            <p style="font-size: 16px; line-height: 1.5;">Se hai bisogno di supporto, non esitare a contattarci.</p>

            <div style="text-align: center; margin: 2rem 0;">
                <a href="{{ route('homepage') }}" style="background-color: #228b22; color: white; padding: 12px 24px; border-radius: 50px; text-decoration: none; font-weight: bold; display: inline-block;">
                    Vai al sito
                </a>
            </div>

            <p style="font-size: 16px;">Grazie per esserti unito a noi,<br>
                <strong style="color: #55b605;">{{ config('app.name') }}</strong>
            </p>

            <p style="font-size: 12px; color: #aaa; margin-top: 2rem;">
                Questa email è stata generata automaticamente, ti chiediamo di non rispondere direttamente a questo messaggio.<br>
                Per qualsiasi richiesta o supporto, visita la nostra 
                <a href="{{ route('contacts')}}" style="color: #55b605; text-decoration: none;">pagina contatti</a>.
            </p>
        </div>
    </div>
</body>
</html>

