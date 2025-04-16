<x-layout>
    <header class="bg-dark text-white text-center py-3">
        <h1><i class="bi bi-pencil-square textColor fs-1"></i> Zona di Revisione</h1>
    </header>
    <x-success-message></x-success-message>
    <main class="container mt-4">
        <div class="row height-custom justify-content-center align-items-center py-5">

            <div class="col-12 col-md-8 text-center">
                <div class="p-3 shadow">
                    <h3 class="fw-bold mb-4">Zona di Revisione</h3>

                    @if ($article_to_check)
                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">
                                <div class="row justify-content-center">
                                    @if ($article_to_check->images->count())
                                        @foreach ($article_to_check->images as $key => $image)
                                            <div class="col-6 mb-3">
                                                <img src="{{$image->getUrl(300, 300) }}"
                                                    class="img-fluid rounded-start"
                                                    alt="Immagine {{ $key + 1 }} dell'articolo '{{ $article_to_check->title }}'">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-6 col-md-4 mb-4 text-center">
                                            <img src="{{ Storage::url('images/logo-presto.png') }}"
                                                class="img-fluid rounded shadow" alt="immagine segnaposto">
                                        </div>
                                    @endif

                                    <div class="col-md-8">
                                        <h5>{{ $article_to_check->title }}</h5>
                                        <h4>€{{ number_format($article_to_check->price, 2) }}</h4>
                                        <p class="h6">{{ $article_to_check->description }}</p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-around py-4">
                                    <form action="{{ route('reject', ['article' => $article_to_check]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-danger fw-bold px-4 rounded-pill">Rifiuta</button>
                                    </form>
                                    <form action="{{ route('accept', ['article' => $article_to_check]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-custom">Accetta</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row justify-content-center align-items-center height-custom text-center mb-5">
                            <div class="col-12">
                                <h3 class="fst-italic display-4">Non ci sono articoli da revisionare</h3>
                                <a href="{{ route('homepage') }}" class="mt-5 btn btn-success">Torna alla homepage</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</x-layout>
