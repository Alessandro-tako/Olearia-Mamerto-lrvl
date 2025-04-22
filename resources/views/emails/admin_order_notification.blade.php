<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuovo Ordine Ricevuto</title>
</head>
<body style="background-color: black; color: black; padding: 2rem; font-family: Arial, sans-serif;">
    <div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 10px; padding: 2rem; box-shadow: 0 0 10px rgba(0,255,128,0.1);">
        <h2 style="text-align: center; color: #55b605; font-size: 28px; font-weight: bold; margin-bottom: 1.5rem; margin-top: 1.5rem;">📦 Nuovo ordine ricevuto</h2>

        <p style="font-size: 18px;">Ciao <strong style="color: #228b22;">{{ $admin->name }}</strong>,</p>

        <p style="font-size: 16px; line-height: 1.5;">
            L'utente <strong>{{ $order->user->name }}</strong> ha appena effettuato un ordine!
        </p>
        <p style="font-size: 16px; line-height: 1.5;">
            Numero ordine: <strong>#{{ $order->id }}</strong>
        </p>

        <p style="font-size: 16px; line-height: 1.5;">
            Totale: 
            @if($order->total_discount > 0)
                <span style="text-decoration: line-through; color: red;">
                    €{{ number_format($order->total_amount, 2) }}
                </span> 
                <span style="color: #228b22;">
                    €{{ number_format($order->total_amount - $order->total_discount, 2) }}
                </span>
            @else
                €{{ number_format($order->total_amount, 2) }}
            @endif
        </p>

        <ul style="font-size: 16px; line-height: 1.5;">
            @foreach($order->items as $item)
                <li>
                    {{ $item->quantity }} x {{ $item->article->title }} - 
                    @if($item->article->discount > 0)
                        <span style="text-decoration: line-through; color: red;">
                            €{{ number_format($item->article->price, 2) }}
                        </span> 
                        <span style="color: #228b22;">
                            €{{ number_format($item->article->price - $item->article->discount, 2) }}
                        </span>
                    @else
                        €{{ number_format($item->article->price, 2) }}
                    @endif
                </li>
            @endforeach
        </ul>

        <p style="font-size: 16px; text-align: center;">
            <a href="{{ route('admin.orders') }}" style="background-color: #228b22; color: white; padding: 12px 24px; border-radius: 50px; text-decoration: none; font-weight: bold;">
                🔎 Visualizza ordine nel pannello admin
            </a>
        </p>

        <p style="font-size: 16px;">Grazie,</p>
        <p style="font-size: 16px;">{{ config('app.name') }}</p>

        <p style="font-size: 12px; color: #aaa; margin-top: 2rem;">
            Questa email è stata generata automaticamente, ti chiediamo di non rispondere direttamente a questo messaggio.<br>
            Per qualsiasi richiesta o supporto, visita la nostra 
            <a href="{{ route('contacts')}}" style="color: green; text-decoration: none;">pagina contatti</a>.
        </p>
    </div>
</body>
</html>
