<nav class="navbar navbar-expand-lg nav-cus fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <img class="navbar-logo"
                src="{{ Storage::url('images/300788628_1079807456076614_8301764200808451309_n.jpg') }}" alt="">
            Olearia Mamerto
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
            {{-- barra di ricerca --}}
            <form class="d-flex ms-auto" role="search" action="{{ route('article.search') }}" method="GET">
                <div class="input-group gap-2">
                    <input class="form-control rounded-pill px-5 mx-3" type="search" name="query" placeholder="Cerca"
                        aria-label="Search">
                </div>
                <button class="btn-custom" type="submit"><i class="bi bi-search"></i></button>
            </form>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link custom-link1" aria-current="page" href="{{ route('chi-siamo') }}">Chi Siamo</a>
                </li>
                <li>
                    <a class="nav-link custom-link2" href="{{ route('galleria') }}">Galleria</a>
                </li>
                <li>
                    <a class="nav-link custom-link2" href="{{ route('article.index') }}">I nostri prodotti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-link3" href="{{ route('contacts') }}">Contatti</a>
                </li>

                {{-- Sezione autenticazione --}}
                @if (auth()->guest())
                    <li class="nav-item">
                        <a class="nav-link btn-nav px-4" href="{{ route('login') }}">Accedi</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-person-circle"></i> Ciao {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            @if (Auth::check() && Auth::user()->is_admin)
                                <li><a href="{{ route('article.create') }}" class="dropdown-item">Inserisci un prodotto</a></li>
                                <li><a href="{{ route('admin.profile') }}" class="dropdown-item drop-menu">Vai al profilo Amministratore</a></li>
                                <li>
                                    <a class="dropdown-item drop-menu" href="{{ route('revision.index') }}">
                                        Articoli da Revisionare
                                        @if (\App\Models\Article::ToBeRevisedCount() > 0)
                                            <span class="badge rounded-circle bg-success text-white">
                                                {{ \App\Models\Article::toBeRevisedCount() }}
                                            </span>
                                        @endif
                                    </a>
                                </li>
                            @else
                                <li><a href="{{ route('user.profile') }}" class="dropdown-item drop-menu">Vai al profilo</a></li>
                            @endif
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </ul>
                    </li>
                @endif

                {{-- Carrello --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.show') }}">
                        <i class="bi bi-cart"></i>
                        @if (\App\Models\Cart::itemCount() > 0)
                            <span class="badge rounded-circle bg-success text-white">
                                {{ \App\Models\Cart::itemCount() }}
                            </span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
