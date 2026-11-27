<x-base title="Modifier la Commande">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h2 class="text-pressing-violet mb-0">Modifier la Commande {{ $order->ref }}</h2>
            <a href="{{ route('orders.show', $order) }}" class="btn bg-pressing-violet text-white">Retour</a>
        </div>

        <div class="card-body">
            <form action="{{ route('orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-title bg-pressing-teal p-2 rounded mb-3">
                    <h3 class="mb-0">Informations Générales</h3>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <label for="customer_id" class="form-label">Client</label>
                        <select name="customer_id" id="customer_id" class="form-select">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" @selected(old('customer_id', $order->customer_id) == $customer->id)>
                                    {{ $customer->nom }} : {{ $customer->tel }}
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="date_depot" class="form-label">Date de dépôt</label>
                        <input type="datetime-local" name="date_depot" id="date_depot" value="{{ old('date_depot', \Carbon\Carbon::parse($order->date_depot)->format('Y-m-d\TH:i')) }}" class="form-control">
                        @error('date_depot')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="livraison_prev" class="form-label">Livraison prévue</label>
                        <input type="datetime-local" name="livraison_prev" id="livraison_prev" value="{{ old('livraison_prev', \Carbon\Carbon::parse($order->livraison_prev)->format('Y-m-d\TH:i')) }}" class="form-control">
                        @error('livraison_prev')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="statut" class="form-label">Statut</label>
                        <select name="statut" id="statut" class="form-select">
                            <option value="reçue" @selected(old('statut', $order->statut) == 'reçue')>Reçue</option>
                            <option value="en traitement" @selected(old('statut', $order->statut) == 'en traitement')>En traitement</option>
                            <option value="prête" @selected(old('statut', $order->statut) == 'prête')>Prête</option>
                            <option value="récupérée" @selected(old('statut', $order->statut) == 'récupérée')>Récupérée</option>
                        </select>
                        @error('statut')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="text-pressing-violet mb-0">Articles de la commande</h4>
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
                            @foreach ($order->orderItems as $index => $line)
                                <tr class="order-line-row">
                                    <td>
                                        <select name="lines[{{ $index }}][item_id]" class="form-select">
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}" @selected(old("lines.{$index}.item_id", $line->item_id) == $item->id)>
                                                    {{ $item->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("lines.{$index}.item_id")
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <select name="lines[{{ $index }}][service_id]" class="form-select">
                                            @foreach ($items as $item)
                                                @foreach ($item->services as $service)
                                                    <option value="{{ $service->id }}" @selected(old("lines.{$index}.service_id", $line->service_id) == $service->id)>
                                                        {{ $item->nom }} - {{ $service->libelle }} ({{ $service->pivot->prix_applique }} FCFA)
                                                    </option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error("lines.{$index}.service_id")
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="number" name="lines[{{ $index }}][quantite]" value="{{ old("lines.{$index}.quantite", $line->quantite) }}" min="1" class="form-control">
                                        @error("lines.{$index}.quantite")
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-line-btn" title="Retirer la ligne">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-around align-items-center">
                    <button type="submit" class="btn bg-pressing-teal px-4 fw-bold">
                        <i class="bi bi-save me-1"></i> Mettre à jour
                    </button>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-base>