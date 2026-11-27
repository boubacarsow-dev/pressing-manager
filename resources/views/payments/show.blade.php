<x-base title="Détail du paiement">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-pressing-violet mb-0">Reçu de Paiement {{ $payment->id }}</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">
                Retour
            </a>
            <a href="{{ route('orders.show', $payment) }}" class="btn bg-pressing-teal text-white">
                Voir la commande
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-title bg-pressing-teal p-2 rounded-top">
            <h3 class="mb-0">Détails de l'encaissement</h3>
        </div>
        <div class="card-body row">
            <div class="col-md-4">
                <h4>Montant encaissé</h4>
                <p class="fw-bold mb-0">
                    <i class="bi bi-cash-coin me-2"></i>{{ $payment->montant }} FCFA
                </p>
            </div>
            <div class="col-md-4">
                <h4>Date du règlement</h4>
                <p class="mb-0">
                    <i class="bi bi-calendar-check me-2"></i>{{ $payment->date_paiement }}
                </p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-title bg-pressing-teal p-2 rounded-top">
            <h3 class="mb-0">Commande & Client associés</h3>
        </div>
        <div class="card-body row">
            <div class="col-md-4">
                <h4>Client</h4>
                <p class="mb-0">
                    <i class="bi bi-person me-2"></i>{{ $payment->nom }}
                </p>
            </div>
            <div class="col-md-4">
                <h4>Commande</h4>
                <p class="mb-0">
                    <i class="bi bi-receipt me-2"></i>{{ $payment->ref }}
                </p>
            </div>
            <div class="col-md-4">
                <h4>Total commande</h4>
                <p class="mb-0">
                    <i class="bi bi-tag me-2"></i>{{ $payment->montant_total }} FCFA
                </p>
            </div>
        </div>
    </div>
</x-base>