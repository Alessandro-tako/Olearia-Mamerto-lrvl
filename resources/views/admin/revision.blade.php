<x-layout>
    <header class="bg-dark text-white text-center py-3">
        <h1><i class="bi bi-pencil-square textColor fs-1"></i> Zona di Revisione</h1>
    </header>

    <main class="container mt-4">
        <div class="row height-custom justify-content-center align-items-center py-5">
            <div class="col-12 col-md-8">
                <div class="p-4 shadow bg-dark text-white rounded">

                    <h3 class="fw-bold text-center mb-4">Articolo da revisionare</h3>

                    @if ($article_to_check)
                        <div class="row justify-content-center align-items-center">
                            @if ($article_to_check->images->count())
                                @foreach ($article_to_check->images as $key => $image)
                                    <div class="col-6 col-md-4 mb-3">
                                        <img src="{{ $image->getUrl(300, 300) }}" class="img-fluid rounded shadow" alt="Immagine {{ $key + 1 }}">
                                    </div>
                                @endforeach
                            @else
                                <div class="col-6 col-md-4 mb-3 text-center">
                                    <img src="{{ Storage::url('images/logo-presto.png') }}" class="img-fluid rounded shadow" alt="immagine segnaposto">
                                </div>
                            @endif
                            <div class="col-12 col-md-8 mt-4">
                                <h4 class="mb-3"><strong>Titolo:</strong> {{ $article_to_check->title }}</h4>
                                <p class="mb-2"><strong>Prezzo:</strong> <span class="text-success">{{ number_format($article_to_check->price, 2) }}€</span></p>
                                <p class="mb-2"><strong>Descrizione:</strong> {{ $article_to_check->description }}</p>
                                <p class="mb-2"><strong>Stock:</strong> {{ $article_to_check->stock }} {{ $article_to_check->unit }}</p>
                            </div>
                            
                            
                        </div>

                        <div class="d-flex justify-content-center gap-4 mt-5">
                            <form action="{{ route('reject', ['article' => $article_to_check]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-danger fw-bold px-4 rounded-pill">Rifiuta</button>
                            </form>
                            <form action="{{ route('accept', ['article' => $article_to_check]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-custom px-4">Accetta</button>
                            </form>
                        </div>
                    @else
                        <div class="text-center my-5">
                            <h3 class="fst-italic display-5">Non ci sono articoli da revisionare</h3>
                            <a href="{{ route('homepage') }}" class="btn btn-success mt-4">Torna alla homepage</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </main>
</x-layout>
