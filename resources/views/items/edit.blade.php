<x-base title="Gestion des Vêtements">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h2 class="text-pressing-violet mb-0">Modifier un Vêtement</h2>
            <a href="{{ route('items.index') }}" class="btn bg-pressing-violet text-white">Retour</a>
        </div>

        <div class="card-body">
            <form action="{{ route('items.update', $item) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-title bg-pressing-teal p-2 rounded">
                    <h3 class="mb-0">Modification Vêtement</h3>
                </div>

                <div class="mb-4">
                    <label for="nom" class="form-label">Nom du vêtement</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', $item->nom) }}"
                        class="form-control">
                    @error('nom')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <h4 class="text-pressing-violet mb-2">Prestations associées et tarifs</h4>
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
                                @php
                                    $linkedService = $item->services->firstWhere('id', $service->id);
                                    $isChecked = session()->hasOldInput()
                                        ? (bool) old("services.{$service->id}.selected")
                                        : (bool) $linkedService;
                                    $prixValue = old(
                                        "services.{$service->id}.prix_applique",
                                        $linkedService?->pivot->prix_applique,
                                    );
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" name="services[{{ $service->id }}][selected]"
                                            value="1" class="form-check-input" @checked($isChecked)>
                                    </td>
                                    <td class="fw-semibold">{{ $service->libelle }}</td>
                                    <td class="text-muted">{{ $service->tarif }} FCFA</td>
                                    <td>
                                        <input type="number" name="services[{{ $service->id }}][prix_applique]"
                                            value="{{ $prixValue }}" class="form-control">
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
                        <i class="bi bi-save me-1"></i> Modifier
                    </button>
                    <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-base>