<x-layout>
    <header class="bg-dark text-white text-center py-3">
        <h1><i class="bi bi-cart-check textColor fs-1"></i> Gestione Ordini</h1>
    </header>

    <x-success-message></x-success-message>

    <main class="container mt-4">

        <form method="GET" action="{{ route('admin.orders') }}" class="mb-4 text-start">
            <label for="search" class="form-label text-white">Cerca ordini (ID, email, stato):</label>
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control"
                    value="{{ request('search') }}" placeholder="es: mario@rossi.it o 123">
                <button class="btn btn-outline-light" type="submit">Cerca</button>
            </div>
        </form>
        
        
        <div class="row height-custom justify-content-center align-items-center py-5">
            <div class="col-12 col-md-10 text-center">
                <div class="p-4 shadow bg-dark text-white">
                    <h3 class="textColor mb-4">Dettaglio Ordini</h3>

                    @forelse ($orders as $order)
                        <div class="mb-5 p-3 border rounded">
                            <h5>
                                ID Ordine: <span class="text-success">#{{ $order->id }}</span>
                                @if ($order->status === 'Pagato e in attesa')
                                    <span class="badge bg-info text-dark ms-2">🆕 Nuovo ordine</span>
                                @endif
                            </h5>
                            
                            <p><strong>Utente:</strong> {{ $order->user->email }}</p>
                            <p><strong>Totale:</strong> €{{ number_format($order->total_amount, 2, ',', '.') }}</p>
                            <p>
                                <strong>Stato:</strong>
                                <span
                                    class="badge
                                    @switch($order->status)
                                        @case('Pagato e in attesa') bg-secondary @break
                                        @case('Confermato') bg-warning text-dark @break
                                        @case('Spedito') bg-success @break
                                        @case('cancellato') bg-danger @break
                                        @default bg-light text-dark
                                    @endswitch">
                                    {{ $order->status }}
                                </span>
                            </p>
                            @if ($order->user->shippingAddress)
                            <div class="mt-3 text-start">
                                <h6 class="textColor">📍 Indirizzo di Spedizione:</h6>
                                <p class="mb-0"><strong>Nome:</strong> {{ $order->user->shippingAddress->first_name }} {{ $order->user->shippingAddress->last_name }}</p>
                                <p class="mb-0"><strong>Indirizzo:</strong> {{ $order->user->shippingAddress->address }}</p>
                                <p class="mb-0"><strong>Città:</strong> {{ $order->user->shippingAddress->city }} ({{ $order->user->shippingAddress->postal_code }})</p>
                                <p class="mb-0"><strong>Provincia:</strong> {{ $order->user->shippingAddress->province }}</p>
                                <p class="mb-0"><strong>Paese:</strong> {{ $order->user->shippingAddress->country }}</p>
                                <p class="mb-0"><strong>Telefono:</strong> {{ $order->user->shippingAddress->phone_number }}</p>
                            </div>
                        @endif
                        

                            <h5 class="mt-4">Articoli:</h5>
                            <ul class="list-unstyled text-start">
                                @foreach ($order->items as $item)
                                    <li>
                                        • <strong>{{ $item->article->title }}</strong> – Quantità:
                                        {{ $item->quantity }} – Prezzo:
                                        €{{ number_format($item->price, 2, ',', '.') }}
                                    </li>
                                @endforeach
                            </ul>

                            <form action="{{ route('order.update.status', $order->id) }}" method="POST"
                                class="mt-3">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3 text-start">
                                    <label class="form-label">Aggiorna stato:</label>
                                    <select name="status" class="form-select">
                                        <option value="Pagato e in attesa"
                                            {{ $order->status == 'Pagato e in attesa' ? 'selected' : '' }}>Pagato e in
                                            attesa</option>
                                        <option value="Confermato"
                                            {{ $order->status == 'Confermato' ? 'selected' : '' }}>Confermato</option>
                                        <option value="Spedito" {{ $order->status == 'Spedito' ? 'selected' : '' }}>
                                            Spedito</option>
                                        <option value="cancellato"
                                            {{ $order->status == 'cancellato' ? 'selected' : '' }}>Cancellato</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-custom">Aggiorna stato</button>
                            </form>
                        </div>
                        <hr class="border-secondary">
                    @empty
                        <p class="text-light">Nessun ordine presente.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</x-layout>
