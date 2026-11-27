<x-base title="Gestion des Services">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h2 class="text-pressing-violet mb-0">Ajouter un Service</h2>
            <a href="{{ route('services.index') }}" class="btn bg-pressing-violet text-white">Retour</a>
        </div>

        <div class="card-body">
            <form action="{{ route('services.store') }}" method="POST">
                @csrf
                <div class="card-title bg-pressing-teal p-2 rounded">
                    <h3 class="mb-0">Nouveau Service</h3>
                </div>

                <div class="mb-3">
                    <label for="libelle" class="form-label">Libellé du service</label>
                    <input type="text" name="libelle" id="libelle" value="{{ old('libelle') }}"
                        class="form-control">
                    @error('libelle')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tarif" class="form-label">Tarif de base (FCFA)</label>
                    <input type="number" name="tarif" id="tarif" value="{{ old('tarif') }}"
                        class="form-control">
                    @error('tarif')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" name="actif" id="actif" value="1" class="form-check-input"
                        checked>
                    <label for="actif" class="form-check-label">Service actif dès la création</label>
                    @error('actif')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-around align-items-center">
                    <button type="submit" class="btn bg-pressing-teal px-4 fw-bold">
                        <i class="bi bi-save me-1"></i> Enregistrer
                    </button>
                    <button type="reset" class="btn btn-outline-secondary">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</x-base>