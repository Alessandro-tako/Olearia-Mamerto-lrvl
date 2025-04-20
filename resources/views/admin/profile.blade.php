<x-layout>
    <header class="bg-dark text-white text-center py-3">
        <h1><i class="bi bi-person-circle textColor fs-1"></i> Profilo {{ $user->name }}</h1>
    </header>

    <x-success-message />

    <main class="container mt-4">
        <!-- Profilo -->
        <div class="row justify-content-center align-items-center py-4">
            <div class="col-12 col-md-6">
                <div class="p-4 bg-dark text-white rounded shadow text-center">
                    <h2 class="fw-bold mb-3">Amministratore</h2>
                    <p class="mb-0">Ciao <strong>{{ $user->name }}</strong>, qui puoi gestire i tuoi articoli in totale autonomia.</p>
                </div>
            </div>
        </div>

        <!-- Messaggi di errore -->
        @if (session()->has('errorMessage'))
            <div class="row justify-content-center mt-3">
                <div class="col-12 col-md-8">
                    <div class="alert alert-danger text-center shadow rounded">
                        {{ session('errorMessage') }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Sezione articoli -->
        <div class="row justify-content-center text-center mt-5">
            <div class="col-12">
                <h2 class="fw-bold mb-4">I miei Prodotti</h2>
            </div>

            @forelse ($articles as $article)
                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <x-card :article="$article" :user="$user" />
                </div>
            @empty
                <div class="col-12 text-center mt-3">
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