<x-email-layout>
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header form-custom">
                        <h3 class="text-center card-title fs-2 custom-link1">Benvenuto su {{ config('app.name') }}!</h3>
                    </div>
                    <div class="card-body">
                        <h1>Ciao {{ $user->name }} 👋</h1>
                        <p>Grazie per esserti registrato su <strong>{{ config('app.name') }}</strong>! 🎉</p>

                        <p>Siamo felicissimi di averti a bordo! Inizia subito a esplorare i nostri prodotti e servizi.</p>

                        <p>Se hai bisogno di supporto, non esitare a contattarci.</p>


                        <p>Grazie per esserti unito a noi,</p>
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
