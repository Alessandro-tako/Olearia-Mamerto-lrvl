<div class="card mx-auto card-w shadow text-center mb-3 product-card h-100">
    {{-- Immagine dell'articolo --}}
    <img src="{{ $article->images->isNotEmpty() ? url('storage/articles/' . $article->images->first()->path) : 'default-image.jpg' }}"
        class="card-img-top img-fluid" alt="Immagine dell'articolo {{ $article->title }}"
        style="object-fit: cover; height: 200px;">

    <div class="card-body">
        <h5 class="card-title"
            style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; max-height: 3.5rem; line-height: 1.5rem; margin-bottom: 0.5rem;">
            {{ $article->title }}
        </h5>
        <p class="card-text text-truncate">{{ Str::limit($article->description, 100) }}</p>

        {{-- Prezzo --}}
        <p class="card-price">
            €{{ number_format($article->price - $article->discount, 2, ',', '.') }}
            @if ($article->discount > 0)
                <span class="text-muted text-decoration-line-through ms-2">
                    €{{ number_format($article->price, 2, ',', '.') }}
                </span>
            @endif
        </p>

        {{$slot}}
    </div>
</div>
