<x-layout>
    <div class="container">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-12 py-5 my-2">
                <h1 class="display-4 fst-italic">Dettaglio: <span class="fw-bold">{{ $article->title }}</span></h1>
            </div>
            <x-success-message></x-success-message>

            <div class="col-12 col-md-6 mb-3">
                @if ($article->images->count() > 0)
                    <div class="d-flex flex-column align-items-center">
                        <!-- Immagine principale -->
                        <div class="main-image mb-4">
                            <img id="mainImage" src="{{ $article->images[0]->getUrl(300, 300) }}"
                                class="img-fluid rounded shadow"
                                alt="immagine principale dell'articolo {{ $article->title }}"
                                style="max-height: 400px; object-fit: cover;">
                        </div>

                        <!-- Galleria di anteprime -->
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            @foreach ($article->images as $key => $image)
                                <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 10px; border: 2px solid #ccc; cursor: pointer; transition: all 0.3s;"
                                    onmouseover="this.style.borderColor='#333'"
                                    onmouseout="this.style.borderColor='#ccc'">
                                    <img src="{{ $image->getUrl(300, 300) }}"
                                        data-image="{{ $image->getUrl(300, 300) }}" alt="anteprima {{ $key + 1 }}"
                                        onclick="changeMainImage(this)"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <img class="default-img img-fluid" src="{{ Storage::url('images/logo-presto.png') }}"
                        alt="Nessuna foto inserita dall'utente">
                @endif
            </div>

            <div class="col-12 col-md-6 mb-3 text-center">
                <div class="d-flex flex-column justify-content-center h-75">
                    <h4 class="card-price">
                        Prezzo:
                        @if ($article->stock > 0)
                            <span class="text-success">
                                {{ number_format($article->price - $article->discount, 2, ',', '.') }}€
                            </span>
                            @if ($article->discount > 0)
                                <span class="text-white text-decoration-line-through ms-2">
                                    {{ number_format($article->price, 2, ',', '.') }}€
                                </span>
                            @endif
                        @else
                            <span class="text-danger text-decoration-line-through ms-2">
                                {{ number_format($article->price - $article->discount, 2, ',', '.') }}€
                            </span>
                        @endif
                    </h4>


                    <h5>Descrizione:</h5>
                    <p>{{ $article->description }}</p>

                    <!-- Se l'utente è un admin, mostra più dettagli dell'articolo -->
                    @if (Auth::check() && Auth::user()->is_admin)
                        <div class="mt-3">
                            @if ($article->stock !== null)
                                <h5>Quantità in stock: {{ $article->stock }}</h5>
                            @endif

                            @if ($article->published_at !== null)
                                <h5>Data di pubblicazione: {{ $article->published_at->format('d/m/Y') }}</h5>
                            @endif

                            @if ($article->created_at !== null)
                                <h5>Data di creazione: {{ $article->created_at->format('d/m/Y H:i') }}</h5>
                            @endif

                            @if ($article->updated_at !== null)
                                <h5>Ultimo aggiornamento: {{ $article->updated_at->format('d/m/Y H:i') }}</h5>
                            @endif
                        </div>
                    @endif

                    <!-- Pulsante Modifica e Elimina per admin o proprietario -->
                    @if (Auth::check() && (Auth::user()->id === $article->user_id || Auth::user()->is_admin))
                        <div class="d-flex flex-column flex-md-row justify-content-between mt-3">
                            <!-- Tasto Elimina -->
                            <form action="{{ route('articles.destroy', $article) }}" method="POST"
                                onsubmit="return confirm('Sei sicuro di voler eliminare questo articolo?');"
                                class="col-12 col-md-5">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-lg ">
                                    <i class="bi bi-trash-fill"></i> Elimina
                                </button>
                            </form>

                            <!-- Tasto Modifica -->
                            <a href="{{ route('article.edit', $article->id) }}"
                                class="btn btn-secondary btn-lg col-12 col-md-5 mt-3 mt-md-0">
                                <i class="bi bi-pencil-fill"></i> Modifica
                            </a>
                        </div>
                    @else
                        <!-- Pulsante Aggiungi al carrello o Sold Out -->
                        @if ($article->stock > 0)
                            <form action="{{ route('cart.add', $article->id) }}" method="POST">
                                @csrf
                                <div class="row justify-content-evenly">
                                    <div class="col-12 mb-2">
                                        <p class=" fst-italic">Disponibili: {{ $article->stock }}</p>
                                    </div>
                                    <div class="col-7 col-md-2 my-3">
                                        <input type="number" name="quantity" value="1" min="1"
                                            max="{{ $article->stock }}" class="form-control" />
                                    </div>
                                    <div class="col-7 my-3">
                                        <button type="submit" class="btn btn-custom w-100">
                                            Aggiungi al carrello <i class="bi bi-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="col-12 mt-3">
                                <button type="button" class="btn btn-custom w-100" disabled>
                                    (Sold Out)
                                </button>
                                <p class="mt-2 text-danger">Scorte esaurite.</p>
                            </div>
                        @endif

                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript per il cambio dell'immagine principale -->
    <script>
        function changeMainImage(thumbnail) {
            const imageUrl = thumbnail.getAttribute('data-image');
            document.getElementById('mainImage').src = imageUrl;
        }
    </script>

    @push('jsonld')
        <script type="application/ld+json">
{!! json_encode([
    "@context" => "https://schema.org",
    "@type" => "Product",
    "name" => $article->title,
    "image" => $article->images->pluck('url')->map(fn($url) => asset('storage/' . $url))->values()->all(),
    "description" => $article->description,
    "sku" => $article->sku,
    "brand" => [
        "@type" => "Brand",
        "name" => "Olearia Mamerto"
    ],
    "offers" => [
        "@type" => "Offer",
        "priceCurrency" => "EUR",
        "price" => number_format($article->price - $article->discount, 2),
        "availability" => $article->stock > 0 ? "https://schema.org/InStock" : "https://schema.org/OutOfStock",
        "url" => route('article.show', $article->slug)
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
    @endpush

</x-layout>
