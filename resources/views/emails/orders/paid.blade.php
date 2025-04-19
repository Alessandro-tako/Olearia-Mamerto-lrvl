<x-email-layout>
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header form-custom">
                        <h3 class="text-center card-title fs-2 custom-link1">Grazie per il tuo acquisto!</h3>
                    </div>
                    <div class="card-body">
                        <h1>Ciao {{ $order->user->name }},</h1>
                        <p>Il tuo pagamento per l'ordine #{{ $order->id }} è stato completato con successo!</p>
                        <p>Grazie per aver scelto il nostro servizio. Ecco i dettagli del tuo ordine:</p>

                        <ul>
                            @foreach($order->items as $item)
                            <li>{{ $item->quantity }} x {{ $item->article->title }} - €{{ $item->price }}</li>
                            @endforeach
                        </ul>

                        <p>Totale: €{{ $order->total }}</p>

                        <p>Ti avviseremo quando il tuo ordine sarà confermato e in fase di preparazione.</p>

                        <p>Se hai domande, non esitare a contattarci.</p>

                        <p>Grazie,</p>
                        <p>{{ config('app.name') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-email-layout>
