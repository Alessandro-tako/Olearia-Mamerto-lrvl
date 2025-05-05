<div class="card mx-auto product-card shadow text-center mb-4 h-100 border-0 custom-card">
    {{-- Immagine dell'articolo --}}
    <div class="card-img-container overflow-hidden">
        <div id="carouselArticle{{ $article->id }}" class="carousel slide h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100">

                @foreach ($article->images as $key => $image)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }} h-100">
                        <img src="{{ $image->getUrl(300, 300) }}" class="d-block w-100 h-100" style="object-fit: cover;"
                            alt="Immagine articolo {{ $article->title }}">
                    </div>
                @endforeach

                @if ($article->images->isEmpty())
                    <div class="carousel-item active h-100">
                        <img src="{{ Storage::url('images/300788628_1079807456076614_8301764200808451309_n.jpg') }}"
                            class="d-block w-100 h-100" style="object-fit: cover;"
                            alt="Immagine predefinita articolo {{ $article->title }}">
                    </div>
                @endif

            </div>

            @if ($article->images->count() > 1)
                <!-- Frecce del carosello -->
                <button class="carousel-control-prev" type="button"
                    data-bs-target="#carouselArticle{{ $article->id }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Precedente</span>
                </button>
                <button class="carousel-control-next" type="button"
                    data-bs-target="#carouselArticle{{ $article->id }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Successivo</span>
                </button>
            @endif
        </div>
    </div>

    <div class="card-body px-4 py-3">
        <h5 class="card-title text-dark fw-bold mb-2"
            style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
            {{ $article->title }}
        </h5>

        <p class="card-text small text-muted mb-3">
            {{ Str::limit($article->description, 100) }}
        </p>

        {{-- Prezzo --}}
        <p class="card-price h5 mb-3">
            @if ($article->stock > 0)
                @if ($article->discount > 0)
                    <span class="text-success">
                        {{ number_format($article->price - $article->discount, 2, ',', '.') }}€
                    </span>
                    <span class="text-decoration-line-through fs-6 ms-2">
                        {{ number_format($article->price, 2, ',', '.') }}€
                    </span>
                @else
                    <span class="text-dark">
                        {{ number_format($article->price, 2, ',', '.') }}€
                    </span>
                @endif
            @else
                <span class="text-danger text-decoration-line-through fs-6">
                    {{ number_format($article->price - $article->discount, 2, ',', '.') }}€
                </span>
                <p class="mt-2 text-danger">Scorte esaurite.</p>
            @endif
        </p>

        {{-- Input quantità e bottone al centro (solo per utenti non admin) --}}
        @if ($article->stock > 0 && (!$user || !$user->is_admin))
            <form action="{{ route('cart.add', $article->id) }}" method="POST">
                @csrf
                <div class="my-3 text-center">
                    <input type="number" name="quantity" id="quantity-{{ $article->id }}"
                        value="1" min="1" max="{{ $article->stock }}"
                        class="form-control form-control-lg w-50 mx-auto text-center"
                        placeholder="Quantità" />
                </div>
                <div class="d-grid gap-2 col-12 col-md-6 mx-auto">
                    <button type="submit" class="btn btn-custom">
                        Aggiungi al <i class="bi bi-cart"></i>
                    </button>
                </div>
            </form>
        @elseif ($article->stock <= 0 && (!$user || !$user->is_admin))
            <div class="col-12 col-md-6 my-3 mx-auto">
                <button type="button" class="btn btn-custom w-100" disabled>
                    Aggiungi al <i class="bi bi-cart"></i> (Sold Out)
                </button>
            </div>
        @endif

        {{-- Tasti di gestione (modifica / elimina) per admin o proprietario --}}
        @if ($user && ($user->is_admin || $user->id === $article->user_id))
            <div class="row justify-content-center mt-3">
                <div class="col-6">
                    <a href="{{ route('article.edit', $article->id) }}" class="btn btn-secondary rounded-pill w-100">
                        <i class="bi bi-pencil-fill"></i> Modifica
                    </a>
                </div>
                <div class="col-6">
                    <form action="{{ route('articles.destroy', $article) }}" method="POST"
                        onsubmit="return confirm('Sicuro di voler eliminare?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-pill w-100">
                            <i class="bi bi-trash-fill"></i> Elimina
                        </button>
                    </form>
                </div>
            </div>
        @endif

        {{-- Link al dettaglio prodotto --}}
        <div class="mt-3">
            <a href="{{ route('article.show', ['article' => $article->id]) }}"
                class="btn btn-outline-success px-4 rounded-pill">
                Vai al dettaglio
            </a>
        </div>
    </div>
</div>
