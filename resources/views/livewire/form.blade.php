<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header form-custom">
                    <h3 class="text-center card-title fs-2 custom-link1">Aggiungi un prodotto</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <x-success-message />

                        {{-- TITOLO --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" wire:model.defer="title">
                            @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- SKU --}}
                        <div class="mb-3">
                            <label for="sku" class="form-label">SKU (Stock Keeping Unit)</label>
                            <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" wire:model.defer="sku">
                            @error('sku') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- DESCRIZIONE --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
                            <textarea id="description" rows="5" class="form-control @error('description') is-invalid @enderror" wire:model.defer="description"></textarea>
                            @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- IMMAGINI --}}
                        <div class="mb-3">
                            <label for="image" class="form-label btn btn-success">Inserisci le immagini</label>
                            <input type="file" wire:model="temporary_images" id="image" multiple class="form-control @error('temporary_images.*') is-invalid @enderror d-none">
                            @error('temporary_images.*') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- PREVIEW IMMAGINI --}}
                        @if (!empty($images))
                            <div class="row border border-4 border-success rounded shadow py-4">
                                @foreach ($images as $key => $image)
                                    <div class="col d-flex flex-column align-items-center my-3">
                                        <div class="img-preview shadow rounded" style="background-image: url('{{ $image->temporaryUrl() }}'); width:100px; height:100px; background-size:cover;"></div>
                                        <button type="button" class="btn mt-1 btn-danger" wire:click="removeImage({{ $key }})">X</button>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- PREZZO --}}
                        <div class="mb-3">
                            <label for="price" class="form-label">Prezzo</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" wire:model.defer="price">
                            @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- SCONTO --}}
                        <div class="mb-3">
                            <label for="discount" class="form-label">Sconto (%)</label>
                            <input type="number" step="0.01" class="form-control @error('discount') is-invalid @enderror" id="discount" wire:model.defer="discount">
                            @error('discount') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- STOCK --}}
                        <div class="mb-3">
                            <label for="stock" class="form-label">Quantità in stock</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" wire:model.defer="stock">
                            @error('stock') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- UNITÀ --}}
                        <div class="mb-3">
                            <label for="unit" class="form-label">Unità di misura</label>
                            <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" wire:model.defer="unit">
                            @error('unit') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- SUBMIT --}}
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success fs-5 px-5">Invia</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
