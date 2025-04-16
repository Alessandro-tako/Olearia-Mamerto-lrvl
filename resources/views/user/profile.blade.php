<x-layout>
    <header class="bg-dark text-white text-center py-3">
        <h1><i class="bi bi-person-circle textColor fs-1"></i>  Ciao {{ $user->name }}</h1>
    </header>
    <x-success-message></x-success-message>
    <main class="container mt-4">
        <div class="row height-custom justify-content-center align-items-center py-5">

            <div class="col-12 col-md-6 text-center">
                <div class="p-3 shadow">
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
                    <div class="container">
                        <div class="row text-center justify-content-evenly align-items-center my-5 text-start">
                            {{-- <p class="col-12 col-md-6">Inserisci o modifica i tuoi dati per la spedizione</p> --}}
                            <p class="col-12 col-md-6">
                                <a class="btn-custom" href="{{ route('user.shipping') }}">Aggiungi o
                                    modifica</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 text-center"><x-user-orders :orders="$orders">
            </x-user-orders>
        </div>
        </div>




    </main>
</x-layout>
