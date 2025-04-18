<div>
    <h2 class="text-center my-4">
        {{ $editMode ? 'Modifica Articolo' : 'Crea un nuovo Articolo' }}
    </h2>

    @if (session()->has('message'))
        <div class="alert alert-success text-center shadow rounded" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}" aria-label="{{ $editMode ? 'Modifica articolo' : 'Crea nuovo articolo' }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titolo:</label>
            <input type="text" id="title" class="form-control" wire:model="title">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="sku" class="form-label">SKU:</label>
            <input type="text" id="sku" class="form-control" wire:model="sku">
            @error('sku') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione:</label>
            <textarea id="description" class="form-control" rows="4" wire:model="description"></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Prezzo:</label>
                <input type="number" step="0.01" id="price" class="form-control" wire:model="price">
                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="discount" class="form-label">Sconto:</label>
                <input type="number" step="0.01" id="discount" class="form-control" wire:model="discount">
                @error('discount') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="stock" class="form-label">Quantità in stock:</label>
                <input type="number" id="stock" class="form-control" wire:model="stock">
                @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="unit" class="form-label">Unità di misura:</label>
                <input type="text" id="unit" class="form-control" wire:model="unit">
                @error('unit') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Upload immagini -->
        <div class="mb-3">
            <label for="image" class="btn-custom" role="button" aria-describedby="image-desc">Carica le immagini del prodotto:</label>
            <input type="file" id="image" class="form-control d-none" wire:model="temporary_images" multiple>
            <div id="image-desc" class="">Puoi caricare più immagini contemporaneamente</div>
            @error('temporary_images.*') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Immagini nuove da salvare -->
        <div class="mb-3 d-flex flex-wrap gap-3">
            @foreach ($images as $key => $image)
                @if (is_object($image))
                    <div class="position-relative" aria-label="Anteprima immagine caricata">
                        <img src="{{ $image->temporaryUrl() }}" width="120" class="rounded shadow" alt="Immagine caricata">
                        <button type="button" class="btn-close position-absolute top-0 end-0" aria-label="Rimuovi immagine"
                                wire:click="removeImage({{ $key }})"></button>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Immagini già salvate (in edit mode) -->
        @if ($editMode)
            <h5>Immagini salvate</h5>
            <div class="mb-3 d-flex flex-wrap gap-3">
                @foreach ($images as $key => $img)
                    @if (is_array($img) && isset($img['path']))
                        <div class="position-relative" aria-label="Immagine salvata">
                            <img src="{{ asset('storage/' . $img['path']) }}" width="120" class="rounded shadow" alt="Immagine articolo salvata">
                            <button type="button" class="btn-close position-absolute top-0 end-0" aria-label="Elimina immagine"
                                    wire:click="deleteExistingImage({{ $img['id'] }})"></button>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        <!-- Pulsante -->
        <div class="d-grid mt-4">
            <button type="submit" class="btn-custom">
                {{ $editMode ? 'Aggiorna Articolo' : 'Crea Articolo' }}
            </button>
        </div>
    </form>
</div>
