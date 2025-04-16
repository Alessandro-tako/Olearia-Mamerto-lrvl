<x-layout>
    <div class="container py-5">
        <h1 class="text-center text-uppercase fs-2 mb-5">Riepilogo Ordine</h1>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="rounded-4 shadow-lg p-4 bg-white">
                    <ul class="list-group list-group-flush mb-4">
                        @foreach ($cartItems as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                                <div class="me-auto">
                                    <h5 class="mb-1">{{ $item->article->title }}</h5>
                                    <small class="text-muted">{{ $item->quantity }} x €{{ number_format($item->article->price, 2) }}</small>
                                </div>
                                <span class="fw-bold">€{{ number_format($item->article->price * $item->quantity, 2) }}</span>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between py-3 border-top">
                            <span class="fw-bold text-uppercase">Totale</span>
                            <span class="fw-bold fs-5 text-success">€{{ number_format($total, 2) }}</span>
                        </li>
                    </ul>

                    <form method="POST" action="{{ route('checkout.process') }}">
                        @csrf
                        <button type="submit" class="btn btn-custom w-100 py-2 rounded-3 fs-5 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-paypal fs-4"></i>
                            Conferma e Paga con PayPal
                        </button>
                        
                    </form>

                    <a href="{{ route('cart.show') }}" class="btn btn-outline-secondary w-100 py-2 mt-3 rounded-3">
                        Torna al Carrello
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
