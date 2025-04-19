<x-email-layout>
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header form-custom">
                        <h3 class="text-center card-title fs-2 custom-link1">Il tuo ordine è stato spedito!</h3>
                    </div>
                    <div class="card-body">
                        <h1>Ciao {{ $order->user->name }},</h1>
                        <p>Il tuo ordine #{{ $order->id }} è stato spedito e sta arrivando a destinazione!</p>
                        <p>Ecco i dettagli della spedizione:</p>

                        <ul>
                            @foreach($order->items as $item)
                            <li>{{ $item->quantity }} x {{ $item->article->title }} - €{{ $item->price }}</li>
                            @endforeach
                        </ul>

                        <p>Totale: €{{ $order->total }}</p>

                        <p>Ti avviseremo quando l'ordine arriverà a casa tua.</p>

                        <p>Se hai domande o problemi con la spedizione, non esitare a contattarci.</p>

                        <p>Grazie,</p>
                        <p>{{ config('app.name') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-email-layout>
