<x-layout>
    <section id="gallery" class="container">
        <div class="row justify-content-center">
            <div class="title-container text-center mb-5" data-aos="fade-up">
                <h2 class="secondary-title"><span class="mainLetterTitle">G</span>alleria</h2>
            </div>

            <div class="col-12 col-md-8 d-flex flex-column align-items-center">
                <!-- Immagine principale -->
                <div class="main-image mb-4 position-relative" data-aos="fade-up" data-aos-delay="100">
                    <img id="mainImage" src="{{ Storage::url('images/foto1.jpg') }}" class="img-fluid rounded shadow" alt="Immagine principale della galleria" title="Immagine principale" loading="lazy">
                    <div class="loading-spinner" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Caricamento...</span>
                        </div>
                    </div>
                </div>

                <!-- Galleria di anteprime -->
                <div class="row g-4 justify-content-center">
                    @foreach(range(1, 13) as $i)
                        <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail" data-aos="zoom-in" data-aos-delay="{{ $i * 100 }}">
                            <img 
                                src="{{ Storage::url('images/foto' . $i . '.jpg') }}" 
                                class="img-thumbnail cursor-pointer" 
                                alt="Foto {{ $i }} della galleria" 
                                title="Foto {{ $i }}" 
                                data-image="{{ Storage::url('images/foto' . $i . '.jpg') }}" 
                                onclick="changeMainImage(this)" 
                                loading="lazy"
                                aria-label="Miniatura foto {{ $i }}"
                            >
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript per cambiare l'immagine principale -->
    <script>
        function changeMainImage(thumbnail) {
            const imageUrl = thumbnail.getAttribute('data-image');
            const mainImage = document.getElementById('mainImage');
            const loadingSpinner = document.querySelector('.loading-spinner');

            // Mostra spinner di caricamento
            loadingSpinner.style.display = 'block';

            // Cambia immagine principale e nascondi spinner quando carica
            mainImage.onload = function() {
                loadingSpinner.style.display = 'none';
            };
            mainImage.src = imageUrl;
        }
    </script>

    <!-- CSS personalizzato per galleria -->
    <style>
        .custom-thumbnail {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            transition: all 0.3s ease-in-out;
        }

        .custom-thumbnail img {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            object-fit: cover;
        }

        .custom-thumbnail:hover img {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            border: 3px solid #3498db;
        }

        .custom-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .row.g-4 {
            gap: 2rem;
        }
    </style>
</x-layout>
