<x-base title="Gestion des Vêtements">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h2 class="text-pressing-violet mb-0">Ajouter un Vêtement</h2>
            <a href="{{ route('items.index') }}" class="btn bg-pressing-violet text-white">Retour</a>
        </div>

        <div class="card-body">
            <form action="{{ route('items.store') }}" method="POST">
                @csrf
                <div class="card-title bg-pressing-teal p-2 rounded">
                    <h3 class="mb-0">Nouveau Vêtement</h3>
                </div>

                <div class="mb-4">
                    <label for="nom" class="form-label">Nom du vêtement</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}"
                        class="form-control">
                    @error('nom')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <h4 class="text-pressing-violet mb-2">Prestations disponibles et tarifs</h4>
                @error('services')
                    <div class="text-danger small mb-2">{{ $message }}</div>
                @enderror

                <div class="table-responsive mb-4">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">Choix</th>
                                <th>Service</th>
                                <th>Tarif par défaut</th>
                                <th>Prix appliqué (FCFA)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="services[{{ $service->id }}][selected]"
                                            value="1" class="form-check-input" @checked(old("services.{$service->id}.selected"))>
                                    </td>
                                    <td class="fw-semibold">{{ $service->libelle }}</td>
                                    <td class="text-muted">{{ $service->tarif }} FCFA</td>
                                    <td>
                                        <input type="number" name="services[{{ $service->id }}][prix_applique]"
                                            value="{{ old("services.{$service->id}.prix_applique") }}"
                                            class="form-control" placeholder="Ex: 1500">
                                        @error("services.{$service->id}.prix_applique")
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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