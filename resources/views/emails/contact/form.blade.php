<x-email-layout>
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header form-custom">
                        <h3 class="text-center card-title fs-2 custom-link1">Nuovo Messaggio dal Modulo di Contatto</h3>
                    </div>
                    <div class="card-body">
                        <h1>Ciao,</h1>
                        <p>Hai ricevuto un nuovo messaggio dal modulo di contatto:</p>

                        <p><strong>Nome:</strong> {{ $data['name'] }}</p>
                        <p><strong>Email:</strong> {{ $data['email'] }}</p>

                        <p><strong>Messaggio:</strong></p>
                        <p>{{ $data['message'] }}</p>

                        <p>Ti consigliamo di rispondere il prima possibile per soddisfare la richiesta del cliente.</p>

                        <p>Grazie,</p>
                        <p>{{ config('app.name') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-email-layout>
