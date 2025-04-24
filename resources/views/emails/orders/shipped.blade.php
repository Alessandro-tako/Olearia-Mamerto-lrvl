<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Il tuo ordine è stato spedito</title>
</head>
<body style="background-color: black; color: black; padding: 1rem; font-family: Arial, sans-serif; margin: 0;">
    <div style="max-width: 600px; width: 100%; margin: 0 auto; background-color: white; border-radius: 10px; padding: 1.5rem; box-shadow: 0 0 10px rgba(0,255,128,0.1); box-sizing: border-box;">
        <h2 style="text-align: center; color: #55b605; font-size: 24px; font-weight: bold; margin-bottom: 1.2rem;">Il tuo ordine è stato spedito!</h2>

        <h1 style="font-size: 20px; margin-top: 0;">Ciao <strong style="color: #228b22;">{{ $order->user->name }}</strong>,</h1>

        <p style="font-size: 15px; line-height: 1.5;">
            Il tuo ordine #{{ $order->id }} è stato spedito e sta arrivando a destinazione!
        </p>

        <p style="font-size: 15px; line-height: 1.5;">Ecco i dettagli della spedizione:</p>

        <ul style="font-size: 15px; line-height: 1.5; padding-left: 1.2rem;">
            @foreach($order->items as $item)
                <li style="margin-bottom: 0.5rem;">
                    {{ $item->quantity }} x {{ $item->article->title }} - 
                    @if($item->article->discount > 0)
                        <span style="text-decoration: line-through; color: red;">
                            {{ number_format($item->article->price, 2) }}€
                        </span> 
                        <span style="color: #228b22;">
                            {{ number_format($item->article->price - $item->article->discount, 2) }}€
                        </span>
                    @else
                        {{ number_format($item->article->price, 2) }}€
                    @endif
                </li>
            @endforeach
        </ul>

        <p style="font-size: 15px; line-height: 1.5;">Totale: 
            @if($order->total_discount > 0)
                <span style="text-decoration: line-through; color: red;">
                    {{ number_format($order->total_amount, 2) }}€
                </span> 
                <span style="color: #228b22;">
                    {{ number_format($order->total_amount - $order->total_discount, 2) }}€
                </span>
            @else
                {{ number_format($order->total_amount, 2) }}€
            @endif
        </p>

        <p style="font-size: 15px; line-height: 1.5;">Grazie ancora e torna presto ad acquistare da noi 🛒</p>

        <p style="font-size: 15px; line-height: 1.5;">Se hai domande o problemi con la spedizione, non esitare a contattarci.</p>

        <p style="font-size: 15px; font-weight: bold;">Ci farebbe piacere sentire la tua opinione!</p>
        <p style="font-size: 15px; line-height: 1.5;">
            Se ti è piaciuto il nostro servizio, ti invitiamo a lasciare una recensione su Google. Questo aiuterà noi a migliorare e altri clienti a trovare il nostro servizio!
        </p>

        <div style="font-size: 1.8rem; color: #ffcc00; text-align: center; margin: 1rem 0;">
            <p style="margin: 0;">⭐⭐⭐⭐⭐</p>
        </div>

        <p style="font-size: 15px; text-align: center;">
            <a href="https://www.google.com/search?sca_esv=70d7635d7621967e&sxsrf=AHTn8zohsHYwhdgo2LGwDivUTKaEzksV2Q:1745082902955&si=APYL9bs7Hg2KMLB-4tSoTdxuOx8BdRvHbByC_AuVpNyh0x2KzUPFF1wM6aV8XI5x0hZuMaHjPHL_FIfArP7KURtQbMB6REbc6vyY7NLyr4R4VJrAkJYfmuWKVwHRyzXZfX5CQMZjeBsV2R56bvbpDRiJFJrVUCB91A%3D%3D&q=OLEARIA+MAMERTO+Recensioni&sa=X&ved=2ahUKEwjW16K0zOSMAxV2h_0HHSozIbIQ0bkNegQIJhAE&biw=1718&bih=1270&dpr=1" target="_blank" style="color: white; background-color: #228b22; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; box-sizing: border-box;">Lascia una recensione su Google</a>
        </p>

        <p style="font-size: 15px;">Grazie,</p>
        <p style="font-size: 15px;">{{ config('app.name') }}</p>

        <p style="font-size: 12px; color: #aaa; margin-top: 2rem;">
            Questa email è stata generata automaticamente, ti chiediamo di non rispondere direttamente a questo messaggio.<br>
            Per qualsiasi richiesta o supporto, visita la nostra 
            <a href="{{ route('contacts')}}" style="color: #228b22; text-decoration: none;">pagina contatti</a>.
        </p>
    </div>
</body>
</html>
