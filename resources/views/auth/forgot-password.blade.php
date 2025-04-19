<x-layout>
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header form-custom">
                        <h3 class="text-center card-title fs-2 custom-link1">Recupero Password</h3>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label card-title mb-0">Indirizzo email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-custom">Invia link di recupero</button>
                        </form>

                        <!-- Messaggio di stato -->
                        @if (session('status'))
                            <div class="mt-3 text-center text-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Link per il login -->
                        <div class="mt-3 text-center">
                            <a href="{{ route('login') }}" class="fs-6 text-decoration-none custom-link1">Ritorna al login</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
