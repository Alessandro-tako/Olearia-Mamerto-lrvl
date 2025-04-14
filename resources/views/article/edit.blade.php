<x-layout>
    <div><x-success-message></x-success-message></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <h2 class="text-center my-4">Modifica Articolo</h2>

                @if (session()->has('message'))
                    <div class="alert alert-success text-center shadow rounded">
                        {{ session('message') }}
                    </div>
                @endif

                <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Titolo</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $article->title) }}">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label>SKU</label>
                        <input type="text" class="form-control" name="sku" value="{{ old('sku', $article->sku) }}">
                        @error('sku') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Descrizione</label>
                        <textarea class="form-control" rows="4" name="description">{{ old('description', $article->description) }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Prezzo</label>
                            <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $article->price) }}">
                            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Sconto</label>
                            <input type="number" step="0.01" class="form-control" name="discount" value="{{ old('discount', $article->discount) }}">
                            @error('discount') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Quantità in stock</label>
                            <input type="number" class="form-control" name="stock" value="{{ old('stock', $article->stock) }}">
                            @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Unità di misura</label>
                            <input type="text" class="form-control" name="unit" value="{{ old('unit', $article->unit) }}">
                            @error('unit') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Upload immagini -->
                    <div class="mb-3">
                        <label>Carica Immagini</label>
                        <input type="file" class="form-control" name="images[]" id="imageInput" multiple>
                        @error('images.*') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Anteprima immagini nuove -->
                    <div id="new-image-preview" class="d-flex flex-wrap gap-3 mb-3"></div>

                    <!-- Immagini già salvate -->
                    <div class="mb-3">
                        <h5>Immagini salvate</h5>
                        <div class="d-flex flex-wrap gap-3" id="existing-images">
                            @foreach ($article->images as $img)
                                <div class="position-relative" data-image-id="{{ $img->id }}">
                                    <img src="{{ asset('storage/' . $img->path) }}" width="120" class="rounded shadow">
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-1 bg-white rounded-circle p-1"
                                            aria-label="Close" onclick="removeExistingImage({{ $img->id }}, this)"></button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Campo hidden per inviare gli ID immagini da rimuovere -->
                    <input type="hidden" name="images_to_remove" id="imagesToRemove">

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">
                            Aggiorna Articolo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        let removedImages = [];

        function removeExistingImage(id, btn) {
            removedImages.push(id);
            document.getElementById('imagesToRemove').value = removedImages.join(',');

            const imageDiv = btn.closest('[data-image-id]');
            imageDiv.remove();
        }

        const imageInput = document.getElementById('imageInput');
        const previewContainer = document.getElementById('new-image-preview');

        imageInput.addEventListener('change', function() {
            previewContainer.innerHTML = '';

            Array.from(this.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewBox = document.createElement('div');
                    previewBox.classList.add('position-relative');

                    previewBox.innerHTML = `
                        <img src="${e.target.result}" width="120" class="rounded shadow">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-1 bg-white rounded-circle p-1"
                                aria-label="Close" onclick="removeNewImage(${index})"></button>
                    `;

                    previewContainer.appendChild(previewBox);
                }
                reader.readAsDataURL(file);
            });
        });

        function removeNewImage(index) {
            const dt = new DataTransfer();
            const input = document.getElementById('imageInput');
            const { files } = input;

            Array.from(files).forEach((file, i) => {
                if (i !== index) dt.items.add(file);
            });

            input.files = dt.files;
            input.dispatchEvent(new Event('change'));
        }
    </script>
</x-layout>
