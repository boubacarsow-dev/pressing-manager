<x-base title="Nouvelle Commande">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h2 class="text-pressing-violet mb-0">Créer une Commande</h2>
            <a href="{{ route('orders.index') }}" class="btn bg-pressing-violet text-white">Retour</a>
        </div>

        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="card-title bg-pressing-teal p-2 rounded mb-3">
                    <h3 class="mb-0">Informations Générales</h3>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <label for="customer_id" class="form-label">Client</label>
                        <select name="customer_id" id="customer_id" class="form-select">
                            <option value="">-- Choisir un client --</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" @selected(old('customer_id', request('customer_id')) == $customer->id)>
                                    {{ $customer->nom }} : {{ $customer->tel }}
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="date_depot" class="form-label">Date et heure de dépôt</label>
                        <input type="datetime-local" name="date_depot" id="date_depot" value="{{ old('date_depot') }}" class="form-control">
                        @error('date_depot')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="livraison_prev" class="form-label">Livraison prévue</label>
                        <input type="datetime-local" name="livraison_prev" id="livraison_prev" value="{{ old('livraison_prev') }}" class="form-control">
                        @error('livraison_prev')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="text-pressing-violet mb-0">Articles à traiter</h4>
                    <button type="button" id="add-line-btn" class="btn btn-sm bg-pressing-violet text-white">
                        + Ajouter un article
                    </button>
                </div>
                @error('lines')
                    <div class="text-danger small mb-2">{{ $message }}</div>
                @enderror

                <div class="table-responsive mb-4">
                    <table class="table align-middle" id="order-lines-table">
                        <thead class="table-light">
                            <tr>
                                <th>Vêtement</th>
                                <th>Prestation</th>
                                <th style="width: 130px;">Quantité</th>
                                <th style="width: 70px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="order-lines-body">
                            <tr class="order-line-row">
                                <td>
                                    <select name="lines[0][item_id]" class="form-select">
                                        <option value="">-- Choisir un vêtement --</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}" @selected(old('lines.0.item_id') == $item->id)>
                                                {{ $item->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('lines.0.item_id')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <select name="lines[0][service_id]" class="form-select">
                                        <option value="">-- Choisir un service --</option>
                                        @foreach ($items as $item)
                                            @foreach ($item->services as $service)
                                                <option value="{{ $service->id }}" @selected(old('lines.0.service_id') == $service->id)>
                                                    {{ $item->nom }} - {{ $service->libelle }} ({{ $service->pivot->prix_applique }} FCFA)
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('lines.0.service_id')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" name="lines[0][quantite]" value="{{ old('lines.0.quantite', 1) }}" min="1" class="form-control">
                                    @error('lines.0.quantite')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-line-btn" title="Retirer la ligne">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-around align-items-center">
                    <button type="submit" class="btn bg-pressing-teal px-4 fw-bold">
                        <i class="bi bi-save me-1"></i> Enregistrer la commande
                    </button>
                    <button type="reset" class="btn btn-outline-secondary">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</x-base>