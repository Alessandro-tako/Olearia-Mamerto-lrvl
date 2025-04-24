<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuovo ordine ricevuto</title>
</head>
<body style="background-color: black; color: black; padding: 0; margin: 0; font-family: Arial, sans-serif;">
    <div style="max-width: 600px; width: 100%; margin: 0 auto; background-color: white; border-radius: 10px; padding: 2rem; box-sizing: border-box; box-shadow: 0 0 10px rgba(0,255,128,0.1);">
        <h2 style="text-align: center; color: #55b605; font-size: 28px; font-weight: bold; margin-bottom: 1.5rem;">Nuovo ordine ricevuto!</h2>

        <h1 style="font-size: 24px; margin: 0 0 1rem;">Ciao <strong style="color: #228b22;">{{ config('app.name') }} Team,</strong></h1>

        <p style="font-size: 16px; line-height: 1.5; margin: 0 0 1rem;">Un nuovo ordine è stato effettuato!</p>

        <p style="font-size: 16px; line-height: 1.5; margin: 0 0 1rem;">Dettagli dell'ordine:</p>
        <ul style="font-size: 16px; line-height: 1.5; margin: 0 0 1rem; padding-left: 1rem;">
            <li><strong>ID Ordine:</strong> {{ $order->id }}</li>
            <li><strong>Nome Cliente:</strong> {{ $order->user->name }}</li>
            <li><strong>Email Cliente:</strong> {{ $order->user->email }}</li>
            <li><strong>Totale Ordine:</strong> €{{ $order->total }}</li>
        </ul>

        <p style="font-size: 16px; line-height: 1.5; margin: 0 0 1rem;">Ecco i dettagli dei prodotti acquistati:</p>
        <ul style="font-size: 16px; line-height: 1.5; margin: 0 0 1.5rem; padding-left: 1rem;">
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

        <p style="font-size: 16px; line-height: 1.5; margin: 0 0 1rem;">Puoi visualizzare il dettaglio completo dell'ordine cliccando sul link qui sotto:</p>
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <a href="{{ route('orders.show', $order->id) }}" style="display: inline-block; padding: 10px 20px; background-color: #228b22; color: white; text-decoration: none; font-size: 16px; border-radius: 5px;">Visualizza Ordine</a>
        </div>

        <p style="font-size: 16px; line-height: 1.5; margin: 0 0 1rem;">Grazie per aver gestito questo ordine con attenzione!</p>

        <p style="font-size: 16px; line-height: 1.5; margin: 0 0 1rem;">Saluti,</p>
        <p style="font-size: 16px; line-height: 1.5; margin: 0 0 2rem;">{{ config('app.name') }}</p>

        <p style="font-size: 12px; color: #aaa; margin-top: 2rem; line-height: 1.5;">
            Questa email è stata generata automaticamente, ti chiediamo di non rispondere direttamente a questo messaggio.<br>
            Per qualsiasi richiesta o supporto, visita la nostra 
            <a href="{{ route('contacts')}}" style="color: #228b22; text-decoration: none;">pagina contatti</a>.
        </p>
    </div>
</body>
</html>
