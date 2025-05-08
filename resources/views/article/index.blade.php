<x-layout>
    <div class="container ">
        <div
            class="row height-custom justify-content-center align-items-center text-center row-cols-1 row-cols-md-2 row-cols-lg-3">
            <div class="col-12 col-lg-12 py-5">
                <h2 class="secondary-title"><span class="mainLetterTitle">I</span> nostri prodotti</h2>
            </div>
        </div>
        <div class="row height-custom justify-content-center align-items-center py-5">
            @forelse ($articles as $article)
                <div class="col-11 col-lg-4 col-xl-4 col-md-6 g-4">
                    <x-card :article="$article" :user="$user" />
                </div>
            @empty
                <div class="col-12">
                    <h3 class="text-center display-6 fst-italic fw-light ">
                        Ancora nessun prodotto presente nel sito
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

    @push('jsonld')
        <script type="application/ld+json">
            {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "{{ url('/') }}"
                },
                {
                "@type": "ListItem",
                "position": 2,
                "name": "I nostri prodotti",
                "item": "{{ route('article.index') }}"
                }
            ]
            }
</script>
    @endpush

</x-layout>
