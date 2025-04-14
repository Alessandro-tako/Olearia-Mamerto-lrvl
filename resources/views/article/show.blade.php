<x-layout>
    <div class="container">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-12 py-5 my-2">
                <h1 class="display-4">Dettaglio: {{ $article->title }}</h1>
            </div>

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
                <h2 class="display-5"><span class="fw-bold">Titolo: </span> {{ $article->title }}</h2>
                <div class="d-flex flex-column justify-content-center h-75">
                    <h4 class="card-price">Prezzo:
                        €{{ number_format($article->price - $article->discount, 2, ',', '.') }}
                        @if ($article->discount > 0)
                            <span class="text-success text-decoration-line-through ms-2">
                                €{{ number_format($article->price, 2, ',', '.') }}
                            </span>
                        @endif
                    </h4>
                    <h5>Descrizione:</h5>
                    <p>{{ $article->description }}</p>
                    <button wire:click="$emitTo('cart', 'addToCart', {{ $article->id }})" class="btn btn-success">
                        Aggiungi al carrello
                    </button>
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
</x-layout>
