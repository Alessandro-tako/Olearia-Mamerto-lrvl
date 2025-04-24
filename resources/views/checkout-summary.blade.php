<x-layout>
    <main class="container py-5" role="main">
        <header class="text-center mb-5">
            <h1 class="text-uppercase fs-2">Riepilogo Ordine</h1>
            <p>Controlla i dettagli del tuo ordine prima di procedere al pagamento.</p>
        </header>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <section class="rounded-4 shadow-lg p-4 bg-white" aria-labelledby="order-summary-heading">
                    <h2 id="order-summary-heading" class="visually-hidden">Dettaglio articoli nel carrello</h2>

                    <ul class="list-group list-group-flush mb-4">
                        @foreach ($cartItems as $item)
                            @php
                                $priceAfterDiscount = $item->article->price - $item->article->discount;
                                $totalForItem = $priceAfterDiscount > 0 ? $priceAfterDiscount * $item->quantity : $item->article->price * $item->quantity;
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                                <div class="me-auto">
                                    <h3 class="h6 mb-1">{{ $item->article->title }}</h3>
                                    
                                    <small class="text-muted">
                                        {{ $item->quantity }} x 
                                        @if ($item->article->discount > 0)
                                            <span class="text-decoration-line-through">{{ number_format($item->article->price, 2) }}€</span>
                                            {{ number_format($priceAfterDiscount, 2) }}€
                                        @else
                                            {{ number_format($item->article->price, 2) }}€
                                        @endif
                                    </small>
                                </div>
                                <span class="fw-bold" aria-label="Totale parziale per questo articolo">
                                    {{ number_format($totalForItem, 2) }}€
                                </span>
                            </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between py-3 border-top">
                            <span class="fw-bold text-uppercase">Totale</span>
                            <span class="fw-bold fs-5 text-success">
                                {{ number_format($cartItems->sum(fn($item) => ($item->article->price - $item->article->discount) * $item->quantity), 2) }}€
                            </span>
                        </li>
                    </ul>

                    <form method="POST" action="{{ route('checkout.process') }}" aria-label="Pagamento con PayPal">
                        @csrf
                        <button type="submit" class="btn btn-custom w-100 py-2 rounded-3 fs-5 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-paypal fs-4" aria-hidden="true"></i>
                            <span>Conferma e Paga con PayPal</span>
                        </button>
                    </form>

                    <a href="{{ route('cart.show') }}" class="btn btn-outline-secondary w-100 py-2 mt-3 rounded-3" aria-label="Torna alla pagina del carrello">
                        Torna al Carrello
                    </a>
                </section>
            </div>
        </div>
    </main>
</x-layout>
