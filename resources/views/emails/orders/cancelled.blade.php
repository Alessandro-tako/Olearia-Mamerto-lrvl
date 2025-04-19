<x-email-layout>
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header form-custom">
                        <h3 class="text-center card-title fs-2 custom-link1">Il tuo ordine è stato annullato</h3>
                    </div>
                    <div class="card-body">
                        <h1>Ciao {{ $order->user->name }},</h1>
                        <p>Ci dispiace, ma l'ordine #{{ $order->id }} è stato annullato.</p>
                        <p>Se hai domande o dubbi riguardo all'annullamento dell'ordine, non esitare a contattarci.</p>

                        <p>Grazie per la tua comprensione.</p>

                        <p>Se desideri effettuare un nuovo ordine, siamo a tua disposizione.</p>

                        <p>Grazie,</p>
                        <p>{{ config('app.name') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-email-layout>
