<div class="container py-4">
    <div class="row">
        @forelse($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    @foreach ($article->images as $image)
                    <img src="{{ url('storage/articles/' . $image->path) }}" alt="Immagine articolo" />

                @endforeach
                
                

                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->description, 100) }}</p>
                        <p class="card-text">
                            <strong>Prezzo:</strong>
                            €{{ number_format($article->price - $article->discount, 2, ',', '.') }}
                            @if ($article->discount > 0)
                                <span class="text-muted text-decoration-line-through ms-2">
                                    €{{ number_format($article->price, 2, ',', '.') }}
                                </span>
                            @endif
                        </p>
                        <p class="card-text"><strong>Disponibili:</strong> {{ $article->stock }} {{ $article->unit }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <span class="badge bg-{{ $article->is_active ? 'success' : 'warning' }}">
                            {{ $article->is_active ? 'Attivo' : 'In attesa' }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">Nessun articolo caricato al momento.</p>
            </div>
        @endforelse
    </div>
</div>
