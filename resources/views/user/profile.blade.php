<x-layout>
    <header class="bg-dark text-white py-3" role="banner">
        <div class="container d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="mb-0 fs-4 d-flex align-items-center">
                <i class="bi bi-person-circle textColor fs-2 me-2" aria-hidden="true"></i>
                <span class="text-break">Ciao {{ $user->name }}</span>
            </h1>

            <!-- Icona Ingranaggio -->
            <button class="btn btn-sm btn-outline-light mt-md-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOptions" aria-expanded="false" aria-controls="collapseOptions"
                aria-label="Opzioni avanzate" title="Opzioni avanzate">
                <i class="bi bi-gear-fill fs-5"></i>
            </button>
        </div>

        <!-- Collapse opzioni -->
        <div class="collapse mt-3 text-center" id="collapseOptions">
            <div class="container">
                <div class="row justify-content-evenly">

                    @if ($shippingAddress)
                        <a class="btn btn-custom me-2 my-5 col-6 col-md-2" href="{{ route('user.shipping') }}">
                            Modifica l'indirizzo
                        </a>
                    @else
                        <a class="btn btn-custom me-2 my-5 col-6 col-md-2" href="{{ route('user.shipping') }}">
                            Aggiungi un indirizzo
                        </a>
                    @endif

                    <form method="POST" action="{{ route('profile.destroy') }}" class="d-inline"
                        onsubmit="return confirm('Sei sicuro di voler eliminare il tuo profilo? Questa azione è irreversibile.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger my-5">
                            Elimina il mio profilo
                        </button>
                    </form>
                </div>
            </div>
        </div>
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
            </section>

            <!-- Ordini -->
            <section class="col-12 col-md-6" aria-labelledby="orders-title">
                <div class="text-center p-3 shadows rounded-4">
                    <h2 id="orders-title" class="h4 textColor mb-4">I tuoi ordini</h2>

                    @if ($orders->isEmpty())
                        <p class="text-white">Non hai ancora effettuato ordini.</p>
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
                                        @php
                                            // Calcolo del totale considerando lo sconto per ogni articolo
                                            $total = 0;
                                            foreach ($order->items as $item) {
                                                $price = $item->article->price ?? 0;
                                                $discount = $item->article->discount ?? 0;
                                                $quantity = $item->quantity ?? 1;
                                                $total += ($price - $discount) * $quantity;
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>€ {{ number_format($total, 2, ',', '.') }}</td>
                                            <td>
                                                <span
                                                    class="badge
                                                    @switch($order->status)
                                                        @case('Pagato e in attesa') bg-info @break
                                                        @case('Confermato') bg-warning text-dark @break
                                                        @case('Spedito') bg-success @break
                                                        @case('Cancellato') bg-danger @break
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
