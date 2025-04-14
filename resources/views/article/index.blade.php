<x-layout>
    <div class="container ">
        <div class="row height-custom justify-content-center align-items-center text-center row-cols-1 row-cols-md-2 row-cols-lg-3">
            <div class="col-12 col-lg-12 py-5">
                <h2 class="secondary-title"><span class="mainLetterTitle">I</span> nostri prodotti</h2>
            </div>
        </div>
        <div class="row height-custom justify-content-center align-items-center py-5">
            @forelse ($articles as $article)
                <div class="col-11 col-lg-4 col-xl-4 col-md-6 g-4">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-1">
                    <h3 class="text-center">
                        Nessun prodotto presente
                    </h3>
                </div>
            @endforelse
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div>
            {{ $articles->links() }}
        </div>
    </div>
</x-layout>