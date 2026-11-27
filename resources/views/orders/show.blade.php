<x-base title="Détail de la commande">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="text-pressing-violet mb-0">
                Commande {{ $order->ref }}
                <span class="badge bg-info ms-2">{{ $order->statut }}</span>
            </h2>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">Retour</a>
            @unless ($order->orderIsPaid())
                <a href="{{ route('orders.edit', $order) }}" class="btn bg-pressing-violet text-white">Modifier</a>
            @endunless
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-title bg-pressing-teal p-2 rounded-top">
            <h3 class="mb-0">Informations de la Commande</h3>
        </div>
        <div class="card-body row">
            <div class="col-md-4">
                <h4>Client</h4>
                <p class="mb-1 fw-bold"><i class="bi bi-person me-2"></i>{{ $order->customer->nom }}</p>
                <p class="mb-0 text-muted"><i class="bi bi-telephone me-2"></i>{{ $order->customer->tel }}</p>
            </div>
            <div class="col-md-4">
                <h4>Dates</h4>
                <p class="mb-1"><strong>Dépôt :</strong> {{ $order->date_depot }}</p>
                <p class="mb-0"><strong>Livraison prévue :</strong> {{ $order->livraison_prev }}</p>
            </div>
            <div class="col-md-4">
                <h4>Bilan Financier</h4>
                <p class="mb-1"><strong>Total :</strong> {{ $order->montant_total }} FCFA</p>
                <p class="mb-1 text-success"><strong>Déjà payé :</strong> {{ $order->payments->sum('montant') }} FCFA
                </p>
                <p class="mb-0 text-danger fw-bold"><strong>Reste à payer :</strong>
                    {{ $order->montant_total - $order->payments->sum('montant') }} FCFA</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-title bg-pressing-teal p-2 rounded-top">
            <h3 class="mb-0">Détail des Articles</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Vêtement</th>
                            <th>Prestation</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $orderItem)
                            <tr>
                                <td class="fw-bold">{{ $orderItem->item->nom }}</td>
                                <td>{{ $orderItem->service->libelle }}</td>
                                <td>{{ $orderItem->quantite }}</td>
                                <td>{{ $orderItem->prix_unitaire }} FCFA</td>
                                <td class="fw-semibold">{{ $orderItem->quantite * $orderItem->prix_unitaire }} FCFA
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- paiements --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-title bg-pressing-teal p-2 rounded-top">
            <h3 class="mb-0">Règlements & Encaissement</h3>
        </div>
        <div class="card-body">
            @if (!$order->orderIsPaid())
                <form action="{{ route('orders.payments.store', $order) }}" method="POST"
                    class="row g-3 align-items-end mb-4 pb-3 border-bottom">
                    @csrf
                    <div class="col-md-4">
                        <label for="montant" class="form-label">Montant à encaisser (FCFA)</label>
                        <input type="number" name="montant" id="montant"
                            value="{{ old('montant', $order->montant_total - $order->payments->sum('montant')) }}"
                            class="form-control">
                        @error('montant')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn bg-pressing-teal text-white w-100 fw-bold">
                            <i class="bi bi-cash-coin me-1"></i> Encaisser le paiement
                        </button>
                    </div>
                </form>
            @endif
            <h4 class="text-pressing-violet mb-3">Historique des versements</h4>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Montant versé</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order->payments as $payment)
                            <tr>
                                <td>{{ $payment->date_paiement }}</td>
                                <td class="fw-bold">{{ $payment->montant }} FCFA</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Aucun versement enregistré pour cette commande.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-base>