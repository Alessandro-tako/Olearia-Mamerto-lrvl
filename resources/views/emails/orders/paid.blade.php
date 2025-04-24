<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grazie per il tuo acquisto!</title>
</head>
<body style="margin:0; padding:0; background-color: #000000; color: black; font-family: Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #000000; padding: 20px;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; background-color: #ffffff; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0,255,128,0.1);">
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <h2 style="color: #55b605; font-size: 28px; font-weight: bold; margin: 0;">Grazie per il tuo acquisto!</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h1 style="font-size: 24px; margin: 0 0 10px;">Ciao <strong style="color: #228b22;">{{ $order->user->name }}</strong>,</h1>
                            <p style="font-size: 16px; line-height: 1.5; margin: 10px 0;">
                                Il tuo pagamento per l'ordine #{{ $order->id }} è stato completato con successo!
                            </p>
                            <p style="font-size: 16px; line-height: 1.5; margin: 10px 0;">
                                Grazie per aver scelto il nostro servizio. Ecco i dettagli del tuo ordine:
                            </p>

                            <ul style="font-size: 16px; line-height: 1.5; padding-left: 20px; margin: 10px 0;">
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

                            <p style="font-size: 16px; line-height: 1.5; margin: 10px 0;">
                                Totale: 
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

                            <p style="font-size: 16px; line-height: 1.5; margin: 10px 0;">Ti avviseremo quando il tuo ordine sarà confermato e in fase di preparazione.</p>
                            <p style="font-size: 16px; line-height: 1.5; margin: 10px 0;">Se hai domande, non esitare a contattarci.</p>

                            <p style="font-size: 16px; margin-top: 20px;">Grazie,<br>{{ config('app.name') }}</p>

                            <p style="font-size: 12px; color: #888888; margin-top: 30px;">
                                Questa email è stata generata automaticamente, ti chiediamo di non rispondere direttamente a questo messaggio.<br>
                                Per qualsiasi richiesta o supporto, visita la nostra
                                <a href="{{ route('contacts') }}" style="color: #55b605; text-decoration: none;">pagina contatti</a>.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
