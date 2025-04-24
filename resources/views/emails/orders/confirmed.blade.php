<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Il tuo ordine è confermato!</title>
</head>
<body style="background-color: black; color: black; padding: 2rem; font-family: Arial, sans-serif;">
    <div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 10px; padding: 2rem; box-shadow: 0 0 10px rgba(0,255,128,0.1);">
        <h2 style="text-align: center; color: #55b605; font-size: 28px; font-weight: bold; margin-bottom: 1.5rem;">Il tuo ordine è confermato!</h2>

        <h1 style="font-size: 24px;">Ciao <strong style="color: #228b22;">{{ $order->user->name }}</strong>,</h1>

        <p style="font-size: 16px; line-height: 1.5;">
            Il tuo ordine con il numero #{{ $order->id }} è stato confermato ed è in lavorazione!
        </p>

        <p style="font-size: 16px; line-height: 1.5;">Grazie per aver scelto il nostro servizio. Ecco i dettagli del tuo ordine:</p>

        <ul style="font-size: 16px; line-height: 1.5;">
            @foreach($order->items as $item)
                <li>
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

        <p style="font-size: 16px; line-height: 1.5;">Totale: 
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

        <p style="font-size: 16px; line-height: 1.5;">Ti invieremo un altro aggiornamento quando il tuo ordine verrà spedito.</p>
        
        <p style="font-size: 16px; line-height: 1.5;">Se hai domande, non esitare a contattarci.</p>

        <p style="font-size: 16px;">Grazie,</p>
        <p style="font-size: 16px;">{{ config('app.name') }}</p>

        <p style="font-size: 12px; color: #aaa; margin-top: 2rem;">
            Questa email è stata generata automaticamente, ti chiediamo di non rispondere direttamente a questo messaggio.<br>
            Per qualsiasi richiesta o supporto, visita la nostra 
            <a href="{{ route('contacts')}}" style="color: #228b22; text-decoration: none;">pagina contatti</a>.<br>
        </p>
    </div>
</body>
</html>
