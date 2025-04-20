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

                        <p>Totale: €{{ $order->total_amount }}</p>

                        <p>Grazie ancora e torna presto ad acquistare da noi 🛒</p>

                        <p>Se hai domande o problemi con la spedizione, non esitare a contattarci.</p>

                        <p><strong>Ci farebbe piacere sentire la tua opinione!</strong></p>
                        <p>Se ti è piaciuto il nostro servizio, ti invitiamo a lasciare una recensione su Google. Questo aiuterà noi a migliorare e altri clienti a trovare il nostro servizio!</p>
                        
                        <div class="star-rating" style="font-size: 2rem; color: #ffcc00;">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>

                        <p><a href="https://www.google.com/search?sca_esv=70d7635d7621967e&sxsrf=AHTn8zohsHYwhdgo2LGwDivUTKaEzksV2Q:1745082902955&si=APYL9bs7Hg2KMLB-4tSoTdxuOx8BdRvHbByC_AuVpNyh0x2KzUPFF1wM6aV8XI5x0hZuMaHjPHL_FIfArP7KURtQbMB6REbc6vyY7NLyr4R4VJrAkJYfmuWKVwHRyzXZfX5CQMZjeBsV2R56bvbpDRiJFJrVUCB91A%3D%3D&q=OLEARIA+MAMERTO+Recensioni&sa=X&ved=2ahUKEwjW16K0zOSMAxV2h_0HHSozIbIQ0bkNegQIJhAE&biw=1718&bih=1270&dpr=1" target="_blank" class="btn btn-success">Lascia una recensione su Google</a></p>

                        <p>Grazie,</p>
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
