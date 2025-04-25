<x-layout>
    <header class="container">
        <div class="row">
            <div class="col-12 p-0">
                <header class="main-title-box d-flex justify-content-center align-items-center flex-column">
                    <h1 class="main-title-font main-title title" data-aos="fade-up">
                        <span class="mainLetterTitle">O</span>learia <span class="mainLetterTitle">M</span>amerto
                    </h1>
                    <h2 data-aos="fade-up" data-aos-delay="100">Olio Extravergine di alta qualità October EVOO monocultivar OTTOBRATICA</h2>
                    {{-- Testo introduttivo --}}
                    <p class="mt-4 px-3 px-md-5" data-aos="fade-up" data-aos-delay="200">
                        <strong>Benvenuti in Olearia Mamerto</strong>
                        <br>
                        Nel cuore della piana di Gioia Tauro, a Oppido Mamertina, coltiviamo con passione l'eccellenza
                        dell’olio extravergine di oliva calabrese.
                        Produciamo un EVOO di qualità superiore, pluripremiato e riconosciuto a livello internazionale.
                        Scopri il gusto autentico della nostra terra, dove tradizione e innovazione si fondono per dar vita
                        a un prodotto unico.
                        <br>
                        <strong>Olearia Mamerto – Tradizione, innovazione e qualità.</strong><br>
                        👉 Dai un’occhiata alla sezione <strong><a class="custom-link2"
                                href="{{ route('article.index') }}">I nostri prodotti</a></strong> e
                        lasciati conquistare dalle nostre eccellenze.
                    </p>
                </header>
            </div>
        </div>
    </header>

    <section class="container-fluid">
        <div class="row justify-content-center">
            <!-- Usa <picture> per supportare formati immagine diversi per la performance -->
            <figure class="col-12 col-md-8" data-aos="zoom-in">
                <picture>
                    <source srcset="{{ Storage::url('images/fotoprincipale.bmp') }}" type="image/webp">
                    <source srcset="{{ Storage::url('images/fotoprincipale.bmp') }}" type="image/jpeg">
                    <img src="{{ Storage::url('images/fotoprincipale.bmp') }}"
                        alt="Bottiglia di olio extravergine di oliva October EVOO con certificato di qualità e bicchieri"
                        class="img-fluid w-75 rounded-3 shadow-sm mx-auto d-block" loading="lazy">
                </picture>
            </figure>

            <article class="col-12 col-md-8 my-5" aria-label="Descrizione azienda Olearia Mamerto" data-aos="fade-up">
                <p>
                    L’azienda agricola Olearia Mamerto è ubicata nelle colline poste ai piedi del Parco Nazionale
                    dell’Aspromonte, ad un’altitudine pari a circa 300 metri sul livello del mare, nel Comune di Oppido
                    Mamertina (RC).
                    <br>
                    In un’incantevole atmosfera agreste, caratterizzata dalla presenza di imponenti ulivi secolari, le
                    olive della varietà ottobratica vengono accuratamente selezionate da ciascuna pianta nel momento
                    migliore della loro invaiatura, raccolte a mano e, nell’arco di 24 ore, trasportate al frantoio per
                    la molitura.
                    <br>
                    L’evoo così prodotto, non filtrato, viene conservato all’interno di serbatoi in acciaio inox con
                    colmatura in azoto e mantenuto ad una temperatura costante.
                    <br>
                    L’amore e l’attenzione verso l’intero ciclo vitale delle piante e dei loro frutti, il rispetto delle
                    tradizioni unito all’utilizzo delle più innovative tecniche agronomiche consentono all’azienda
                    Olearia Mamerto di realizzare un evoo di categoria superiore, dal sapore fruttato ed intenso,
                    piacevole al palato ed arricchito da sensazioni di vivacità e freschezza e da un tono
                    amaro-piccante, il tutto, sempre, in perfetto equilibrio.
                    <br>
                    <strong>October Evoo</strong> è un olio pregiato ed esclusivo, per chi desidera un gusto unico ed
                    inconfondibile, per viziare il palato e per chi cerca un prodotto che unisce eccellenza e rispetto per
                    l’ambiente.
                </p>
            </article>
        </div>
    </section>
    
</x-layout>
