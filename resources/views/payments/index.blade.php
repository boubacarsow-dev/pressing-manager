<x-base title="Journal des paiements">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-pressing-violet">Journal de Caisse</h2>
    </div>

    <h2 class="bg-pressing-teal text-center my-2 py-2">Historique des Paiements</h2>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Référence Commande</th>
                    <th>Client</th>
                    <th>Montant encaissé</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td class="fw-bold">
                            <a href="" class="text-pressing-teal text-decoration-none">
                                {{ $payment->order->ref }}
                            </a>
                        </td>
                        <td>{{ $payment->order->customer->nom }}</td>
                        <td class="fw-semibold">{{ $payment->montant }} FCFA</td>
                        <td>{{ $payment->date_paiement }}</td>
                        <td>
                            <a href="{{ route('payments.show', $payment) }}" class="text-pressing-violet"
                                title="Voir le reçu">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <p class="mb-0">Aucun paiement enregistré.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{-- Liens de pagination --}}
    </div>
</x-base>