<div class="card mx-auto product-card shadow text-center mb-4 h-100 border-0 custom-card">
    {{-- Immagine dell'articolo --}}
    <div class="card-img-container overflow-hidden" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
        <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl(300, 300) : Storage::url('images/300788628_1079807456076614_8301764200808451309_n.jpg') }}"
            class="card-img-top img-fluid hover-zoom" alt="Immagine dell'articolo {{ $article->title }}">
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
        <p class="card-price h5">
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
                <span class="text-danger fs-6 ms-2">Sold Out</span>
            @endif
        </p>
        
        

        <div class="container">
            <div class="row justify-content-evenly align-items-center">
                <a href="{{ route('article.show', ['article' => $article->id]) }}"
                    class="btn btn-outline-success mt-3 px-4 rounded-pill col-12 col-md-6 ">
                    Vai al dettaglio
                </a>

                {{-- Se l'utente è loggato o è admin, mostriamo anche il tasto "Modifica" e "Elimina" --}}
                @if ($user && ($user->is_admin || $user->id === $article->user_id))
                    <div class="row justify-content-center mt-3">
                        <!-- Modifica -->
                        <div class="col-6">
                            <a href="{{ route('article.edit', $article->id) }}" class="btn btn-secondary rounded-pill w-100">
                                <i class="bi bi-pencil-fill"></i> Modifica
                            </a>
                        </div>

                        <!-- Elimina -->
                        <div class="col-6">
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Sicuro di voler eliminare?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger rounded-pill w-100">
                                    <i class="bi bi-trash-fill"></i> Elimina
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                {{-- Mostra sempre il tasto "Aggiungi al carrello" se l'utente non è admin --}}
                @if (!$user || !$user->is_admin)
                    @if ($article->stock > 0)
                        <div class="col-12 col-md-6 mt-3">
                            <form action="{{ route('cart.add', $article->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-custom w-100">
                                    Aggiungi al  <i class="bi bi-cart"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="col-12 col-md-6 mt-3">
                            <button type="button" class="btn btn-custom w-100" disabled>
                                Aggiungi al <i class="bi bi-cart"></i> (Sold Out)
                            </button>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        {{ $slot }}
    </div>
</div>
