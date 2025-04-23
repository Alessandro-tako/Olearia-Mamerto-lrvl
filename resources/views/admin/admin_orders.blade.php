<x-layout>
    <header class="bg-dark text-white text-center py-3">
        <h1><i class="bi bi-cart-check textColor fs-1"></i> Gestione Ordini</h1>
    </header>

    <x-success-message />

    <main class="container mt-4">
        <!-- Verifica se l'utente è cancellato o meno -->
        @php
            $userIsDeleted = false;
            if (Auth::user() && Auth::user()->deleted_at) {
                $userIsDeleted = true;
            }
        @endphp

        <!-- Barra di ricerca visibile solo se l'utente non è cancellato -->
        @if (!$userIsDeleted)
            <form method="GET" action="{{ route('admin.orders') }}" class="mb-4 text-start">
                <label for="search" class="form-label text-white">Cerca ordini (#ID, email, stato):</label>
                <div class="input-group">
                    <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"
                        placeholder="es: mario@rossi.it o 123">
                    <button class="btn btn-outline-light" type="submit">Cerca</button>
                </div>
            </form>
        @else
            <p class="text-muted">Non è possibile cercare ordini. L'utente è stato eliminato.</p>
        @endif

        <!-- Visualizzazione degli ordini -->
        @forelse ($orders as $order)
            @php
                $hasValidUser = $order->user && optional($order->user->shippingAddress)->first_name;
            @endphp

            <div class="card mb-4 shadow border-0">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Ordine #{{ $order->id }}</strong> •
                        <small>{{ $hasValidUser ? $order->user->email : 'Utente eliminato' }}</small>
                    </div>
                    @if ($order->status === 'Pagato e in attesa' && $hasValidUser)
                        <span class="badge bg-info text-dark">🆕 Nuovo ordine</span>
                    @endif
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12 col-md-4">
                            @php
                                $total = 0;
                                foreach ($order->items as $item) {
                                    $price = $item->article->price ?? 0;
                                    $discount = $item->article->discount ?? 0;
                                    $quantity = $item->quantity ?? 1;
                                    $total += ($price - $discount) * $quantity;
                                }
                            @endphp

                            <p class="mb-1"><strong>Totale:</strong> €{{ number_format($total, 2, ',', '.') }}</p>

                            @if ($hasValidUser)
                                <p class="mb-1">
                                    <strong>Stato:</strong>
                                    @switch($order->status)
                                        @case('Pagato e in attesa')
                                            <span class="badge bg-info text-dark">{{ $order->status }}</span>
                                            @break
                                        @case('Confermato')
                                            <span class="badge bg-warning text-dark">{{ $order->status }}</span>
                                            @break
                                        @case('Spedito')
                                            <span class="badge bg-success">{{ $order->status }}</span>
                                            @break
                                        @case('Cancellato')
                                            <span class="badge bg-danger">{{ $order->status }}</span>
                                            @break
                                        @default
                                            <span class="badge bg-light text-dark">{{ $order->status }}</span>
                                    @endswitch
                                </p>
                            @else
                                <p class="mb-1"><strong>Email:</strong> <small class="text-muted">Utente eliminato</small></p>
                            @endif
                        </div>

                        <div class="col-12 col-md-8 text-end">
                            @if ($hasValidUser)
                                <form action="{{ route('order.update.status', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group">
                                        <select name="status" class="form-select">
                                            @foreach (['Pagato e in attesa', 'Confermato', 'Spedito', 'Cancellato'] as $status)
                                                <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-outline-success">Aggiorna</button>
                                    </div>
                                </form>
                            @else
                                <div class="p-2 small mb-0">
                                    ⚠️ Utente eliminato: impossibile aggiornare lo stato dell’ordine.
                                </div>
                            @endif
                        </div>
                    </div>

                    <button class="btn btn-sm btn-outline-dark mb-2" data-bs-toggle="collapse"
                        data-bs-target="#details-{{ $order->id }}" aria-expanded="false">
                        Dettagli ordine
                    </button>

                    <div class="collapse" id="details-{{ $order->id }}">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h6 class="textColor">📍 Indirizzo di Spedizione:</h6>
                                @if ($hasValidUser)
                                    <ul class="list-unstyled small">
                                        <li><strong>Nome:</strong> {{ $order->user->shippingAddress->first_name }}
                                            {{ $order->user->shippingAddress->last_name }}</li>
                                        <li><strong>Indirizzo:</strong> {{ $order->user->shippingAddress->address }}</li>
                                        <li><strong>Città:</strong> {{ $order->user->shippingAddress->city }}
                                            ({{ $order->user->shippingAddress->postal_code }})</li>
                                        <li><strong>Provincia:</strong> {{ $order->user->shippingAddress->province }}</li>
                                        <li><strong>Paese:</strong> {{ $order->user->shippingAddress->country }}</li>
                                        <li><strong>Telefono:</strong> {{ $order->user->shippingAddress->phone_number }}</li>
                                    </ul>
                                @else
                                    <p class="text-muted">Indirizzo non disponibile. L'utente potrebbe essere stato eliminato.</p>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <h6 class="textColor">📦 Articoli ordinati:</h6>
                                <ul class="list-unstyled small">
                                    @foreach ($order->items as $item)
                                        <li>
                                            • <strong>{{ $item->article->title }}</strong> – Q.tà:
                                            {{ $item->quantity }} – 
                                            @if ($item->article->discount > 0)
                                                <span class="text-decoration-line-through text-muted">
                                                    €{{ number_format($item->article->price, 2, ',', '.') }}
                                                </span>
                                                <span class="ms-1 text-success fw-semibold">
                                                    €{{ number_format($item->article->price - $item->article->discount, 2, ',', '.') }}
                                                </span>
                                            @else
                                                <span class="fw-semibold">
                                                    €{{ number_format($item->article->price, 2, ',', '.') }}
                                                </span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-light text-center mt-5">Nessun ordine presente.</p>
        @endforelse
    </main>
</x-layout>
