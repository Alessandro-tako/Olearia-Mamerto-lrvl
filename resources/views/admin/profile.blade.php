<x-layout>
    <header class="bg-dark text-white text-center py-3">
        <h1>Profilo {{ $user->name }}</h1>
    </header>
    <main class="container mt-4">
        <div class="row height-custom justify-content-center align-items-center py-5">
            <!-- Sezione Profilo -->
            <div class="col-12 col-md-4 text-center">
                <div class="card p-3 shadow">

                    <div><i class="bi bi-person-circle textColor fs-1"></i></div>

                    <h2>Amministratore</h2>
                    <p>Ciao <strong>{{ $user->name }}</strong> qui potrai modificare o eliminare i tuoi articoli</p>
                </div>
            </div>

            <!-- Sezione Prodotti -->
            <div class="container">
                <div class="row height-custom justify-content-center align-items-center py-5">
                    <h2 class="mb-3">I miei Prodotti</h2>
                    @forelse ($articles as $article)
                        <div class="col-12 col-md-4">
                            <x-card :article="$article">
                                @if (Auth::check() && (Auth::user()->id === $article->user_id || Auth::user()->is_admin))
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <a href="{{ route('article.edit', $article->id) }}"
                                            class="btn btn-secondary rounded-pill my-2"><i class="bi bi-pencil-fill"></i>
                                            Modifica</a>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <form action="{{ route('articles.destroy', $article) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Sicuro di voler eliminare?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger rounded-pill my-2"><i
                                                    class="bi bi-trash-fill"></i>
                                                Elimina</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            
                            </x-card>
                        </div>
                    @empty
                        <div class="text-center">
                            <h3>Non ci sono Articoli</h3>
                            <a href="{{ route('article.create') }}" class="btn btn-success mt-2">
                                Creane uno ora
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
            <div>
                @if (session()->has('errorMessage'))
                    <div class="alert alert-danger text-center shadow rounded w-50">
                        {{ session('errorMessage') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div>
                {{ $articles->links() }}
            </div>
        </div>
    </main>
</x-layout>
