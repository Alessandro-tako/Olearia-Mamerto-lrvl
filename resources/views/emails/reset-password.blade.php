<x-email-layout>
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header form-custom">
                        <h3 class="text-center card-title fs-2 custom-link1">Reset della Password</h3>
                    </div>
                    <div class="card-body">
                        <h1>Ciao {{ $user->name }},</h1>
                        <p>Per reimpostare la tua password, clicca il link qui sotto:</p>
                        <a href="{{ $resetUrl }}" class="btn btn-custom">Reimposta la password</a>
                        <p>Se non hai richiesto questa modifica, ignora questa email.</p>
                        <p>Grazie,</p>
                        <p>{{ config('app.name') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-email-layout>
