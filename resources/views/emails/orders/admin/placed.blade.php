<x-email-layout>
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header form-custom">
                        <h3 class="text-center card-title fs-2 custom-link1">Nuovo ordine ricevuto!</h3>
                    </div>
                    <div class="card-body">
                        <h1>Ciao {{ config('app.name') }} Team,</h1>
                        <p>Un nuovo ordine è stato effettuato!</p>

                        <p>Dettagli dell'ordine:</p>
                        <ul>
                            <li><strong>ID Ordine:</strong> {{ $order->id }}</li>
                            <li><strong>Nome Cliente:</strong> {{ $order->user->name }}</li>
                            <li><strong>Email Cliente:</strong> {{ $order->user->email }}</li>
                            <li><strong>Totale Ordine:</strong> €{{ $order->total }}</li>
                        </ul>

                        <p>Ecco i dettagli dei prodotti acquistati:</p>
                        <ul>
                            @foreach($order->items as $item)
                                <li>{{ $item->quantity }} x {{ $item->product_name }} - €{{ $item->price }}</li>
                            @endforeach
                        </ul>

                        <p>Puoi visualizzare il dettaglio completo dell'ordine cliccando sul link qui sotto:</p>

                        @component('mail::button', ['url' => route('orders.show', $order->id)])
                            Visualizza Ordine
                        @endcomponent

                        <p>Grazie per aver gestito questo ordine con attenzione!</p>

                        <p>Saluti,</p>
                        <p>{{ config('app.name') }}</p>
                        <p style="font-size: 0.875rem; color: #666; margin-top: 1rem;">
                            Questa email è stata generata automaticamente, ti chiediamo di non rispondere direttamente a
                            questo messaggio.<br>
                            Per qualsiasi richiesta o supporto, visita la nostra <a href="{{ route('contacts')}}"
                                style="color: #228b22; text-decoration: none;">pagina contatti</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-email-layout>
