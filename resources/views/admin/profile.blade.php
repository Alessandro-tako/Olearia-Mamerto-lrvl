<x-layout>
    <header class="bg-dark text-white text-center py-3">
        <h1><i class="bi bi-person-circle textColor fs-1"></i> Profilo {{ $user->name }}</h1>
    </header>

    <x-success-message></x-success-message>

    <main class="container mt-4">
        <div class="row height-custom justify-content-center align-items-center py-5">
            <!-- Sezione Profilo -->
            <div class="col-12 col-md-4 text-center">
                <div class="p-3 shadow rounded">
                    <h2>Amministratore</h2>
                    <p class="mb-0">Ciao <strong>{{ $user->name }}</strong>, qui potrai modificare o eliminare i tuoi articoli</p>
                </div>
            </div>

            <!-- Messaggi di errore -->
            @if (session()->has('errorMessage'))
                <div class="col-12 mt-4">
                    <div class="alert alert-danger text-center shadow rounded w-75 mx-auto">
                        {{ session('errorMessage') }}
                    </div>
                </div>
            @endif
        </div>

        <!-- Sezione Prodotti -->
        <div class="row justify-content-center align-items-center text-center py-3">
            <div class="col-12">
                <h2 class="fw-bold mb-4">I miei Prodotti</h2>
            </div>

            @forelse ($articles as $article)
                <div class="col-12 col-md-4 mb-4">
                    <x-card :article="$article" :user="$user"></x-card>
                </div>
            @empty
                <div class="col-12 text-center">
                    <h3 class="fst-italic">Non ci sono Articoli</h3>
                    <a href="{{ route('article.create') }}" class="btn btn-success mt-3">Creane uno ora</a>
                </div>
            @endforelse
        </div>

        <!-- Paginazione -->
        <div class="d-flex justify-content-center mt-4">
            {{ $articles->links() }}
        </div>
    </main>
</x-layout>