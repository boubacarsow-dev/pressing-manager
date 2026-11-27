<x-base title="Liste des commandes">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-pressing-violet">Gestion des Commandes</h2>
        <a href="{{ route('orders.create') }}" class="btn bg-pressing-teal text-white shadow-sm">
            Nouvelle Commande
        </a>
    </div>

    <h2 class="bg-pressing-teal text-center my-2 py-2">Toutes les Commandes</h2>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Référence</th>
                    <th>Client</th>
                    <th>Dépôt</th>
                    <th>Livraison prévue</th>
                    <th>Montant total</th>
                    <th>Paiement</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td class="fw-bold text-pressing-teal">{{ $order->ref }}</td>
                        <td>{{ $order->customer->nom }}</td>
                        <td>{{ $order->date_depot }}</td>
                        <td>{{ $order->livraison_prev }}</td>
                        <td class="fw-semibold">{{ $order->montant_total }} FCFA</td>
                        <td>
                            @if ($order->orderIsPaid())
                                <span class="badge bg-warning">En attente</span>
                            @else
                                <span class="badge bg-success">Soldé</span>
                            @endif
                        </td>
                        <td>
                            @switch($order->statut)
                                @case('reçue')
                                    <span class="badge bg-secondary">Reçue</span>
                                @break

                                @case('en traitement')
                                    <span class="badge bg-warning text-dark">En traitement</span>
                                @break

                                @case('prête')
                                    <span class="badge bg-success">Prête</span>
                                @break

                                @case('récupérée')
                                    <span class="badge bg-primary">Récupérée</span>
                                @break
                            @endswitch
                        </td>
                        <td class="d-flex align-items-center gap-2">
                            <a href="{{ route('orders.show', $order) }}" class="text-pressing-teal"
                                title="Détails & Paiement">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('orders.edit', $order) }}" class="text-pressing-violet" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('orders.destroy', $order) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <p class="mb-0">Aucune commande enregistrée.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-base>