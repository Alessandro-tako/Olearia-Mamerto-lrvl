<x-layout>
    <div class="container">
        <div class="row py-5 justify-content-center align-items-center text-center">
            <div class="col-12 pt-5">
                <h1 class="display-2">Risultato per: <span class="fst-italic fw-bold drop-menu">{{$query}}</span></h1>
            </div>
        </div>
        <div class="row justify-content-center aligne-items-center g-4 mb-5">
            @forelse ($articles as $article)
            <div class="col-12 col-md-4">
                <x-card :article="$article" :user="$user"/>
            </div>
            @empty
                <div class="col-12 text-center">
                    <h3>
                        Nessun elemento trovato
                    </h3>
                </div>
            @endforelse
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div>
            {{$articles->links()}}
        </div>
    </div>
</x-layout>