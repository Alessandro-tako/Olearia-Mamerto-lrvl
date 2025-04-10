<x-layout>
    <section id="gallery" class="container">
        <div class="row justify-content-center">

            <div class="title-container">
                <h2 class="secondary-title"><span class="mainLetterTitle">G</span>alleria</h2>
            </div>

            <div class="col-12 col-md-8 d-flex flex-column align-items-center">
                <!-- Immagine principale -->
                <div class="main-image mb-4">
                    <img id="mainImage" src="{{ Storage::url('images/foto1.jpg') }}" class="img-fluid rounded shadow" alt="Immagine principale">
                </div>

                <!-- Galleria di anteprime -->
                <div class="row g-4 justify-content-center">
                    <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail">
                        <img src="{{ Storage::url('images/foto1.jpg') }}" class="img-thumbnail cursor-pointer" alt="Foto 1" data-image="{{ Storage::url('images/foto1.jpg') }}" onclick="changeMainImage(this)">
                    </div>
                    <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail">
                        <img src="{{ Storage::url('images/foto2.jpg') }}" class="img-thumbnail cursor-pointer" alt="Foto 2" data-image="{{ Storage::url('images/foto2.jpg') }}" onclick="changeMainImage(this)">
                    </div>
                    <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail">
                        <img src="{{ Storage::url('images/foto3.jpg') }}" class="img-thumbnail cursor-pointer" alt="Foto 3" data-image="{{ Storage::url('images/foto3.jpg') }}" onclick="changeMainImage(this)">
                    </div>
                    <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail">
                        <img src="{{ Storage::url('images/foto4.jpg') }}" class="img-thumbnail cursor-pointer" alt="Foto 4" data-image="{{ Storage::url('images/foto4.jpg') }}" onclick="changeMainImage(this)">
                    </div>
                    <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail">
                        <img src="{{ Storage::url('images/foto5.jpg') }}" class="img-thumbnail cursor-pointer" alt="Foto 5" data-image="{{ Storage::url('images/foto5.jpg') }}" onclick="changeMainImage(this)">
                    </div>
                    <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail">
                        <img src="{{ Storage::url('images/foto6.jpg') }}" class="img-thumbnail cursor-pointer" alt="Foto 6" data-image="{{ Storage::url('images/foto6.jpg') }}" onclick="changeMainImage(this)">
                    </div>
                    <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail">
                        <img src="{{ Storage::url('images/foto7.bmp') }}" class="img-thumbnail cursor-pointer" alt="Foto 7" data-image="{{ Storage::url('images/foto7.bmp') }}" onclick="changeMainImage(this)">
                    </div>
                    <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail">
                        <img src="{{ Storage::url('images/foto8.jpg') }}" class="img-thumbnail cursor-pointer" alt="Foto 8" data-image="{{ Storage::url('images/foto8.jpg') }}" onclick="changeMainImage(this)">
                    </div>
                    <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail">
                        <img src="{{ Storage::url('images/foto9.jpg') }}" class="img-thumbnail cursor-pointer" alt="Foto 9" data-image="{{ Storage::url('images/foto9.jpg') }}" onclick="changeMainImage(this)">
                    </div>
                    <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail">
                        <img src="{{ Storage::url('images/foto10.jpg') }}" class="img-thumbnail cursor-pointer" alt="Foto 10" data-image="{{ Storage::url('images/foto10.jpg') }}" onclick="changeMainImage(this)">
                    </div>
                    <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail">
                        <img src="{{ Storage::url('images/foto11.jpg') }}" class="img-thumbnail cursor-pointer" alt="Foto 11" data-image="{{ Storage::url('images/foto11.jpg') }}" onclick="changeMainImage(this)">
                    </div>
                    <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail">
                        <img src="{{ Storage::url('images/foto12.jpg') }}" class="img-thumbnail cursor-pointer" alt="Foto 12" data-image="{{ Storage::url('images/foto12.jpg') }}" onclick="changeMainImage(this)">
                    </div>
                    <div class="col-4 col-sm-3 col-md-2 mb-2 custom-thumbnail">
                        <img src="{{ Storage::url('images/foto13.jpg') }}" class="img-thumbnail cursor-pointer" alt="Foto 13" data-image="{{ Storage::url('images/foto13.jpg') }}" onclick="changeMainImage(this)">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript per cambiare l'immagine principale -->
    <script>
        function changeMainImage(thumbnail) {
            const imageUrl = thumbnail.getAttribute('data-image');
            document.getElementById('mainImage').src = imageUrl;
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
