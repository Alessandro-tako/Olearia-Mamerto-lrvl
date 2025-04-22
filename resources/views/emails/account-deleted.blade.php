<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Eliminato</title>
</head>
<body style="background-color: black; color: black; padding: 2rem; font-family: Arial, sans-serif;">
    <div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 10px; padding: 2rem; box-shadow: 0 0 10px rgba(0,255,128,0.1);">
        <h2 style="text-align: center; color: #55b605; font-size: 28px; font-weight: bold; margin-bottom: 1.5rem; margin-top: 1.5rem;">Il tuo account è stato eliminato</h2>

        <p style="font-size: 18px;">Ciao <strong style="color: #228b22;">{{ $user->name }}</strong>,</p>

        <p style="font-size: 16px; line-height: 1.5;">
            Ti confermiamo che il tuo account è stato eliminato con successo. Siamo dispiaciuti di vedere che te ne vai, ma rispettiamo la tua decisione.
        </p>

        <p style="font-size: 16px; line-height: 1.5;">
            Se questa azione non è stata compiuta da te, ti invitiamo a contattarci immediatamente per risolvere qualsiasi inconveniente.
        </p>

        <p style="font-size: 16px; line-height: 1.5;">
            Anche se hai deciso di eliminare il tuo account, ti ricordiamo che siamo sempre qui per te! Se cambi idea, sappi che il nostro negozio è sempre pronto ad offrirti i nostri migliori prodotti.
        </p>

        <p style="font-size: 16px; line-height: 1.5;">
            Ti invitiamo a visitare il nostro sito quando vuoi, per scoprire tutte le novità. Sarà un piacere rivederti tra i nostri clienti!
        </p>

        <p style="font-size: 16px; line-height: 1.5;">
            Grazie per aver scelto il nostro servizio finora. Se hai domande o desideri ulteriori informazioni, siamo a tua disposizione.
        </p>

        <p style="font-size: 16px;">Grazie,</p>
        <p style="font-size: 16px;">{{ config('app.name') }}</p>

        <p style="font-size: 12px; color: #aaa; margin-top: 2rem;">
            Questa email è stata generata automaticamente, ti chiediamo di non rispondere direttamente a questo messaggio.<br>
            Per qualsiasi richiesta o supporto, visita la nostra 
            <a href="{{ route('contacts')}}" style="color: #228b22; text-decoration: none;">pagina contatti</a>.
        </p>
    </div>
</body>
</html>
