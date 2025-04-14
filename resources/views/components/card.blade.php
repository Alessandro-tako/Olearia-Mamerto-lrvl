<div class="card mx-auto product-card shadow text-center mb-4 h-100 border-0 custom-card">
    {{-- Immagine dell'articolo --}}
    <div class="card-img-container overflow-hidden" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
        <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl(300, 300) : Storage::url('images/300788628_1079807456076614_8301764200808451309_n.jpg') }}" class="card-img-top img-fluid hover-zoom"
            alt="Immagine dell'articolo {{ $article->title }}">
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
            €{{ number_format($article->price - $article->discount, 2, ',', '.') }}
            @if ($article->discount > 0)
                <span class="text-success text-decoration-line-through fs-6 ms-2">
                    €{{ number_format($article->price, 2, ',', '.') }}
                </span>
            @endif
        </p>

        <a href="{{ route('article.show', ['article' => $article->id]) }}" class="btn btn-success mt-3 px-4 rounded-pill">
            Vai al dettaglio
        </a>
        {{ $slot }}
    </div>
</div>
