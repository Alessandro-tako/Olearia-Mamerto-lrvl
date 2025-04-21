<x-email-layout>
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header form-custom">
                        <h3 class="text-center card-title fs-2 custom-link1">Il tuo account è stato eliminato</h3>
                    </div>
                    <div class="card-body">
                        <h1>Ciao {{ $user->name }},</h1>
                        <p>Ti confermiamo che il tuo account è stato eliminato con successo. Siamo dispiaciuti di vedere che te ne vai, ma rispettiamo la tua decisione.</p>

                        <p>Se questa azione non è stata compiuta da te, ti invitiamo a contattarci immediatamente per risolvere qualsiasi inconveniente.</p>

                        <p>Anche se hai deciso di eliminare il tuo account, ti ricordiamo che siamo sempre qui per te! Se cambi idea, sappi che il nostro negozio è sempre pronto ad offrirti i nostri migliori prodotti.</p>

                        <p>Ti invitiamo a visitare il nostro sito quando vuoi, per scoprire tutte le novità. Sarà un piacere rivederti tra i nostri clienti!</p>

                        <p>Grazie per aver scelto il nostro servizio finora. Se hai domande o desideri ulteriori informazioni, siamo a tua disposizione.</p>

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
