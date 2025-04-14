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

                    <h2>Ciao {{ $user->name }}</h2>
                    <p> qui potrai controllare i tuoi ordini</p>
                </div>
            </div>
        </div>
    </main>
</x-layout>