    <header class="bg-dark text-white text-center py-3">
        <h1>Modifica Indirizzo di Spedizione</h1>
    </header>

    <main class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <h2 class="text-center mb-4">Modifica Indirizzo</h2>

                @if (session()->has('message'))
                    <div class="alert alert-success text-center shadow rounded">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Form per modificare l'indirizzo di spedizione -->
                <form action="{{ route('user.edit') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $address->first_name) }}" required>
                            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Cognome</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $address->last_name) }}" required>
                            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Indirizzo</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $address->address) }}" required>
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">Città</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $address->city) }}" required>
                            @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="postal_code" class="form-label">CAP</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code', $address->postal_code) }}" required>
                            @error('postal_code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="province" class="form-label">Provincia</label>
                            <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $address->province) }}" required>
                            @error('province') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label">Paese</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $address->country) }}" required>
                            @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $address->phone_number) }}" required>
                        @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Aggiorna Indirizzo</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
