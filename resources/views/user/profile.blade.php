<x-layout>
    <header class="bg-dark text-white text-center py-3">
        <h1>Profilo {{ $user->name }}</h1>
    </header>
    <x-success-message></x-success-message>
    <main class="container mt-4">
        <div class="row height-custom justify-content-center align-items-center py-5">
            <!-- Sezione Profilo -->
            <div class="col-12 col-md-4 text-center">
                <div class="card p-3 shadow">
                    <div><i class="bi bi-person-circle textColor fs-1"></i></div>
                    <h2>Ciao {{ $user->name }}</h2>
                    <p>Qui potrai controllare i tuoi ordini</p>
                </div>
                <!-- Visualizza indirizzo di spedizione -->
                <!-- resources/views/user/profile.blade.php -->

                <div class=" p-3 shadow">
                    <h3>Indirizzo di spedizione</h3>
                    @if ($shippingAddress)
                        <ul class="list-unstyled">
                            <li><strong>Nome:</strong> {{ $shippingAddress->first_name }}
                                {{ $shippingAddress->last_name }}</li>
                            <li><strong>Indirizzo:</strong> {{ $shippingAddress->address }}</li>
                            <li><strong>Città:</strong> {{ $shippingAddress->city }}</li>
                            <li><strong>CAP:</strong> {{ $shippingAddress->postal_code }}</li>
                            <li><strong>Provincia:</strong> {{ $shippingAddress->province }}</li>
                            <li><strong>Paese:</strong> {{ $shippingAddress->country }}</li>
                            <li><strong>Telefono:</strong> {{ $shippingAddress->phone_number }}</li>
                        </ul>
                    @else
                        <p>Non hai ancora aggiunto un indirizzo di spedizione.</p>
                    @endif
                </div>

                <div class="container">
                    <div class="row text-center align-items-center my-5 text-start">
                        <p class="col-12 col-md-6">Inserisci o modifica i tuoi dati per la spedizione</p>
                        <p class="col-12 col-md-6">
                            <a class="btn-custom" href="{{ route('user.shipping') }}">Aggiungi o
                                modifica</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
