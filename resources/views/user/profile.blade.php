<x-layout>
    <header class="bg-dark text-white text-center py-3" role="banner">
        <h1>
            <i class="bi bi-person-circle textColor fs-1" aria-hidden="true"></i>
            <span>Ciao {{ $user->name }}</span>
        </h1>
    </header>

    <x-success-message></x-success-message>

    <main class="container mt-4" role="main">
        <div class="row justify-content-center py-5">
            <!-- Indirizzo di spedizione -->
            <section class="col-12 col-md-6 text-center" aria-labelledby="shipping-address-title">
                <div class="p-3 shadow mb-4 rounded-4">
                    <h2 id="shipping-address-title" class="h4 textColor mb-3">Indirizzo di spedizione</h2>

                    @if ($shippingAddress)
                        <ul class="list-unstyled text-start">
                            <li><strong>Nome:</strong> {{ $shippingAddress->first_name }} {{ $shippingAddress->last_name }}</li>
                            <li><strong>Indirizzo:</strong> {{ $shippingAddress->address }}</li>
                            <li><strong>Città:</strong> {{ $shippingAddress->city }}</li>
                            <li><strong>CAP:</strong> {{ $shippingAddress->postal_code }}</li>
                            <li><strong>Provincia:</strong> {{ $shippingAddress->province }}</li>
                            <li><strong>Paese:</strong> {{ $shippingAddress->country }}</li>
                            <li><strong>Telefono:</strong> {{ $shippingAddress->phone_number }}</li>
                        </ul>
                        <div class="mt-3">
                            <a class="btn-custom" href="{{ route('user.shipping') }}" aria-label="Modifica indirizzo di spedizione">Modifica l'indirizzo</a>
                        </div>
                    @else
                        <p>Non hai ancora aggiunto un indirizzo di spedizione.</p>
                        <div class="mt-3">
                            <a class="btn-custom" href="{{ route('user.shipping') }}" aria-label="Aggiungi indirizzo di spedizione">Aggiungi un indirizzo</a>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Ordini -->
            <section class="col-12 col-md-6" aria-labelledby="orders-title">
                <div class="p-3 shadows rounded-4">
                    <h2 id="orders-title" class="h4 textColor mb-4">I tuoi ordini</h2>

                    @if ($orders->isEmpty())
                        <p class="text-muted">Non hai ancora effettuato ordini.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-dark table-bordered">
                                <thead>
                                    <tr class="text-success text-uppercase">
                                        <th scope="col">ID</th>
                                        <th scope="col">Totale</th>
                                        <th scope="col">Stato</th>
                                        <th scope="col">Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>€ {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                                            <td>
                                                <span class="badge
                                                    @switch($order->status)
                                                        @case('Pagato e in attesa') bg-secondary @break
                                                        @case('Confermato') bg-warning text-dark @break
                                                        @case('Spedito') bg-success @break
                                                        @case('cancellato') bg-danger @break
                                                        @default bg-light text-dark
                                                    @endswitch">
                                                    {{ $order->status }}
                                                </span>
                                            </td>
                                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </main>
</x-layout>
