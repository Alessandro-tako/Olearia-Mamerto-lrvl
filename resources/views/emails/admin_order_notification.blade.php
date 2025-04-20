<x-email-layout>
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header form-custom">
                        <h3 class="text-center card-title fs-2 custom-link1">📦 Nuovo ordine ricevuto</h3>
                    </div>
                    <div class="card-body">
                        <h1>Ciao {{ $admin->name }},</h1>
                        <p>L'utente <strong>{{ $order->user->name }}</strong> ha appena effettuato un ordine!</p>
                        <p>Numero ordine: <strong>#{{ $order->id }}</strong></p>
                        <p>Totale: <strong>€{{ number_format($order->total_amount, 2) }}</strong></p>

                        <ul>
                            @foreach($order->items as $item)
                                <li>{{ $item->quantity }} x {{ $item->article->title }} - €{{ $item->price }}</li>
                            @endforeach
                        </ul>

                        <p><a class="text-decoration-none" href="{{ route('admin.orders') }}">🔎 Visualizza ordine nel pannello admin</a></p>

                        <p>Grazie,</p>
                        <p>{{ config('app.name') }}</p>
                        <p style="font-size: 0.875rem; color: #666; margin-top: 1rem;">
                            Questa email è stata generata automaticamente, ti chiediamo di non rispondere direttamente a
                            questo messaggio.<br>
                            Per qualsiasi richiesta o supporto, visita la nostra <a href="{{ route('contacts')}}"
                                style="color: #D4AF37; text-decoration: none;">pagina contatti</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-email-layout>
