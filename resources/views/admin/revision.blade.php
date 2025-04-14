<x-layout>

    <div class="container-fluid pt-5">
        <div class="row justify-content-center align-items-center ">
            <div class="col-12 col-md-6 mb-5">
                <div class="rounded shadow section-title">
                    <h1 class="display-5 text-center mb-2 fw-bold">
                        Zona di revisione
                    </h1>
                </div>
            </div>
        </div>
        @if ($article_to_check)
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row justify-content-center">
                        @if ($article_to_check->images->count())

                            @foreach ($article_to_check->images as $key => $image)
                                <div class="col-6">
                                    <div class="mb-3 ">
                                        <div class="row g-0 ">
                                            <div class="col-12">
                                                <img src="{{$image->getUrl(300, 300) }}"
                                                    class="img-fluid rounded-start"
                                                    alt="Immagine {{ $key + 1 }} dell'articolo '{{ $article_to_check->title }}'">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-6 col-md-4 mb-4 text-center">
                                <img src="{{ Storage::url('images/logo-presto.png') }}"
                                    class="img-fluid rounded shadow" alt="immagine segnaposto">
                            </div>
                        @endif
                        <div class="col-md-4 ps-4 d-flex flex-column justify-content-between text-center">
                            <div>
                                <h1>{{ $article_to_check->title }}</h1>
                                <h4>{{ $article_to_check->price }}€</h4>
                                <p class="h6">{{ $article_to_check->description }}</p>
                            </div>

                            {{-- fine aggiornamento revisor index --}}
                            <div class="d-flex pb-4 justify-content-around">
                                <form action="{{ route('accept', ['article' => $article_to_check]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success fw-bold">Accetta</button>
                                </form>
                                <form action="{{ route('reject', ['article' => $article_to_check]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-danger fw-bold">Rifiuta</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row justify-content-center align-items-center height-custom text-center mb-5">
                    <div class="col-12 section-title">
                        <h1 class="text-center fst-italic display-4">
                            Non ci sono articoli da revisionare
                        </h1>
                        <a href="{{ route('homepage') }}" class="mt-5 btn btn-success">Torna alla homepage</a>
                    </div>
                </div>
        @endif
    </div>

    @if (session()->has('message'))
        <div class="row justify-content-center mb-5">
            <div class="col-5 alert alert-success text-center shadow rounded">
                {{ session('message') }}
            </div>
        </div>
    @endif

    {{-- AGGIORNAMENTO REVISOR INDEX --}}



</x-layout>
