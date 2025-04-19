<x-layout>
    <section id="contacts" class="container">
        <div class="row">
            <div class="title-container col-12">
                <h2 class="secondary-title"><span class="mainLetterTitle">C</span>ontatti</h2>
                <p>
                    Per conoscere la nostra selezione e per acquistare i nostri prodotti non esitare a contattarci!
                </p>

                <dl>
                    <dt>Indirizzo</dt>
                    <dd>Via Pasquale Galluppi, 17 89014 Oppido Mamertina (RC)</dd>

                    <dt>Telefono</dt>
                    <dd> +39 096686033</dd>
                    <dd>+39 3382017840</dd>

                    <dt>E-mail</dt>
                    <dd><a class="text-white" href="mailto:oleariamamerto@gmail.com">oleariamamerto@gmail.com</a></dd>
                </dl>

                <p>Per rimanere aggiornato, non dimenticare di seguirci sui social!</p>
            </div>

            <div class="row justify-content-around g-3">
                <!-- Link a Facebook -->
                <a href="https://www.facebook.com/Oleariamamerto/?locale=it_IT"
                    class="button-fb col-10 col-md-3 text-center" target="_blank" rel="noopener noreferrer" aria-label="Segui Olearia Mamerto su Facebook">
                    <i class="bi bi-facebook"></i>
                </a>

                <!-- Link a TikTok -->
                <a href="https://www.tiktok.com/@oleariamamerto"
                    class="button-tt col-10 col-md-3 text-center" target="_blank" rel="noopener noreferrer" aria-label="Segui Olearia Mamerto su TikTok">
                    <i class="bi bi-tiktok"></i>
                </a>

                <!-- Link a Instagram -->
                <a href="https://www.instagram.com/oleariamamerto/?locale=us&hl=am-et"
                    class="button-ig col-10 col-md-3 text-center" target="_blank" rel="noopener noreferrer" aria-label="Segui Olearia Mamerto su Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>

            <!-- Frase aggiuntiva -->
            <div class="col-12 mt-4 text-center">
                <p>Per inviarci un messaggio o se hai bisogno di assistenza, non esitare a contattarci!</p>
            </div>

            <!-- Bottone per accedere al modulo di contatto -->
            <div class="col-12 mt-3 text-center">
                <a href="{{ route('contact.form') }}" class="btn btn-custom">Contattaci</a>
            </div>

            <!-- Google Maps Embed -->
            <div class="col-12 mt-5 text-center">
                <h3>Trova la nostra sede</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3130.6026006331726!2d15.96387327731154!3d38.311874171854924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13151ca4510903f3%3A0xdde81351f1004087!2sOLEARIA%20MAMERTO!5e0!3m2!1sit!2sit!4v1744979111782!5m2!1sit!2sit" 
                    width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </section>
</x-layout>
