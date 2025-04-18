<x-layout>
    <header class="container">
        <div class="row">
            <div class="col-12 p-0">
                <div class="main-title-box d-flex justify-content-center align-items-center flex-column">
                    <h1 class="main-title-font main-title title">
                        <span class="mainLetterTitle">O</span>learia <span class="mainLetterTitle">M</span>amerto
                    </h1>
                    <h2 class="">Olio Extravergine di alta qualità October EVOO monocultivar OTTOBRATICA</h2>
                    <x-success-message></x-success-message>
                </div>
            </div>
        </div>
    </header>

    <section class="container-fluid">
        <div class="row justify-content-center">
            <!-- Usa <picture> per supportare formati immagine diversi per la performance -->
            <figure class="col-12 col-md-8">
                <picture>
                    <source srcset="{{ Storage::url('images/fotoprincipale.bmp') }}" type="image/webp">
                    <source srcset="{{ Storage::url('images/fotoprincipale.bmp') }}" type="image/jpeg">
                    <img src="{{ Storage::url('images/fotoprincipale.bmp') }}" alt="Bottiglia di olio October EVOO con attestato e bicchieri" class="img-fluid" loading="lazy">
                </picture>
            </figure>

            <article class="col-12 col-md-8 my-5" aria-label="Descrizione azienda Olearia Mamerto">
                <p>
                    L’azienda agricola Olearia Mamerto è ubicata nelle colline poste ai piedi del Parco Nazionale dell’Aspromonte, ad un’altitudine pari a circa 300 metri sul livello del mare, nel Comune di Oppido Mamertina (RC).
                    <br>
                    In un’incantevole atmosfera agreste, caratterizzata dalla presenza di imponenti ulivi secolari, le olive della varietà ottobratica vengono accuratamente selezionate da ciascuna pianta nel momento migliore della loro invaiatura, raccolte a mano e, nell’arco di 24 ore, trasportate al frantoio per la molitura.
                    <br>
                    L’evoo così prodotto, non filtrato, viene conservato all’interno di serbatoi in acciaio inox con colmatura in azoto e mantenuto ad una temperatura costante.
                    <br>
                    L’amore e l’attenzione verso l’intero ciclo vitale delle piante e dei loro frutti, il rispetto delle tradizioni unito all’utilizzo delle più innovative tecniche agronomiche consentono all’azienda Olearia Mamerto di realizzare un evoo di categoria superiore, dal sapore fruttato ed intenso, piacevole al palato ed arricchito da sensazioni di vivacità e freschezza e da un tono amaro-piccante, il tutto, sempre, in perfetto equilibrio.
                    <br>
                    October Evoo è un olio pregiato ed esclusivo, per chi desidera un gusto unico ed inconfondibile, per viziare il palato.
                </p>
            </article>
        </div>
    </section>
</x-layout>