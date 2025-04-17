<x-layout>
    <header class="bg-dark text-white text-center py-3">
        <h1><i class="bi bi-person-circle textColor fs-1"></i> Ciao {{ $user->name }}</h1>
    </header>
    <x-success-message></x-success-message>
    <main class="container mt-4">
        <div class="row justify-content-center py-5">
            <div class="col-12 col-md-6 text-center">
                <div class="p-3 shadow mb-4">
                    <h3>Indirizzo di spedizione</h3>
                    @if ($shippingAddress)
                        <ul class="list-unstyled">
                            <li><strong>Nome:</strong> {{ $shippingAddress->first_name }} {{ $shippingAddress->last_name }}</li>
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
                <div class="text-center">
                    <a class="btn-custom" href="{{ route('user.shipping') }}">Aggiungi o modifica</a>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="p-3 shadow">
                    <h3 class="textColor mb-4">I tuoi ordini</h3>

                    @if ($orders->isEmpty())
                        <p class="text-white">Non hai ancora effettuato ordini.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-dark table-bordered">
                                <thead>
                                    <tr class="text-success">
                                        <th>ID</th>
                                        <th>Totale</th>
                                        <th>Stato</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="text-white">
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
            </div>
        </div>
    </main>
</x-layout>
