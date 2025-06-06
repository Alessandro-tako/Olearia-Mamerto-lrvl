<x-layout>
    <head>
        <title>Il tuo carrello - Nome del Sito</title>
        <meta name="description" content="Visualizza e gestisci gli articoli nel tuo carrello. Procedi al pagamento in modo semplice e sicuro.">
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "ShoppingCart",
            "name": "Il tuo Carrello",
            "itemList": {
                "@type": "ItemList",
                "itemListElement": [
                    @foreach ($cartItems as $cartItem)
                    {
                        "@type": "ListItem",
                        "position": {{ $loop->iteration }},
                        "item": {
                            "@type": "Product",
                            "name": "{{ $cartItem->article->title }}",
                            "priceCurrency": "EUR",
                            "price": "{{ number_format($cartItem->article->price, 2, '.', '') }}",
                            "url": "{{ route('article.show', $cartItem->article->id) }}"
                        }
                    },
                    @endforeach
                ]
            }
        }
        </script>
    </head>

    <div class="container py-5 text-light">
        <div class="row">
            <h2 class="secondary-title col-12 mb-4 text-center">
                <span class="mainLetterTitle">I</span>l tuo carrello
            </h2>
        </div>
        <x-success-message></x-success-message>

        @if($cartItems->count() > 0)
            <h3>Articoli nel tuo carrello</h3>
            <ul class="list-group list-group-flush">
                @foreach($cartItems as $cartItem)
                    <li class="list-group-item bg-dark text-light rounded-3 mb-3 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h5 class="mb-1">{{ $cartItem->article->title }}</h5>
                                @if($cartItem->article->discount > 0)
                                <p class="mb-0 text-danger text-decoration-line-through">
                                    {{ number_format($cartItem->article->price, 2) }} €
                                </p>
                                <p class="mb-0 text-success fw-semibold">
                                    {{ number_format($cartItem->article->price - $cartItem->article->discount, 2) }} €
                                </p>
                            @else
                                <p class="mb-0 text-success fw-semibold">
                                    {{ number_format($cartItem->article->price, 2) }} €
                                </p>
                            @endif
                            
                            </div>

                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                <!-- Aggiorna quantità -->
                                <form action="{{ route('cart.updateQuantity', $cartItem->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1"
                                        class="form-control form-control-sm text-center bg-dark text-light border-success"
                                        style="width: 70px;">
                                    <button type="submit" class="btn btn-sm btn-white text-success border-success">Aggiorna</button>
                                </form>

                                <!-- Rimuovi -->
                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Rimuovi</button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-4 text-end">
                <h5 class="fw-bold text-success">
                    Totale: {{ number_format($cartItems->sum(fn($item) => (($item->article->price - $item->article->discount) > 0 ? ($item->article->price - $item->article->discount) : $item->article->price) * $item->quantity), 2) }} €
                </h5>
                
                <a href="{{ route('checkout.summary') }}" class="btn-custom mt-2">Procedi al pagamento</a>
            </div>
        @else
            <div class="alert alert-dark mt-4 text-center" role="alert">
                Il carrello è vuoto.
            </div>
        @endif

        <a href="{{ route('article.index') }}" class="btn btn-outline-success rounded-pill">Continua a fare acquisti</a>
    </div>
</x-layout>
