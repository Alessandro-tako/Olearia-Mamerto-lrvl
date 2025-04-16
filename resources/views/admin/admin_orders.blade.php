<x-layout>
    <header class="bg-dark text-white text-center py-3">
        <h1><i class="bi bi-cart-check textColor fs-1"></i> Gestione Ordini</h1>
    </header>
    <x-success-message></x-success-message>
    <main class="container mt-4">
        <div class="row height-custom justify-content-center align-items-center py-5">

            <div class="col-12 col-md-8 text-center">
                <div class="p-3 shadow">
                    <h3>Dettaglio Ordini</h3>

                    @foreach($orders as $order)
                        <div class="my-4">
                            <h5>ID Ordine: {{ $order->id }}</h5>
                            <p>Utente: {{ $order->user->name }}</p>
                            <p>Totale: €{{ number_format($order->total_amount, 2) }}</p>
                            <p>Stato: {{ ucfirst($order->status) }}</p>

                            <h5>Articoli:</h5>
                            <ul class="list-unstyled">
                                @foreach($order->items as $item)
                                    <li>{{ $item->article->title }} - Quantità: {{ $item->quantity }} - Prezzo: €{{ number_format($item->price, 2) }}</li>
                                @endforeach
                            </ul>

                            <form action="{{ route('order.update.status', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <select name="status" class="form-select">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>In attesa</option>
                                        <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Confermato</option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Spedito</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Annullato</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Aggiorna stato</button>
                            </form>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</x-layout>
