<x-base title="Vue detaille du client">
<div class="d-flex justify-content-between align-items-center mb-2">
 <h2 class="text-pressing-violet">fiche de {{$customer->nom}}</h2>
 <div class="d-flex gap-2">
        <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
            Retour
        </a>
        <a href="{{ route('customers.edit', $customer) }}" class="btn bg-pressing-violet text-white">
            Modifier
        </a>
        <a href="{{ route('orders.create', ['customer_id' => $customer->id]) }}" class="btn bg-pressing-teal text-white">
            + Nouvelle Commande
        </a>
    </div>
</div>

 <div class="card border-0 shadow-sm mb-4">
    <div class="card-title bg-pressing-teal text-whitefw-bold">
        <h3>Informations Personnel</h3>
    </div>
    <div class="card-body row col-md-3">
        <div class="col">
            <h4>Telephone</h4>
            <i class="bi bi-telephone me-2"></i>{{ $customer->tel }}
        </div>
        <div class="col">
            <h4>Adresse</h4>
            <i class="bi bi-geo-alt me-2"></i>{{ $customer->adresse }}
        </div>
        <div class="col">
            <h4>Client depuis</h4>
            <i class="bi bi-telephone me-2"></i>{{ $customer->created_at->format('d/m/Y') }}
        </div>
    </div>
 </div>

  {{-- historique --}}
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-title bg-pressing-teal text-whitefw-bold">
        <h3>historique</h3>
    </div>
    <div class="card-body">
        <table class="table table-responsive table-hover">
            <thead>
            <th>Commande</th>
            <th>Date Depot</th>
            <th>Vetements</th>
            <th>Statut</th>
            <th>Montant</th>
        </thead>
        <tbody>
            @forelse ($customer->orders as $order)
                <tr class="table-info">
                    <td>{{$order->id}}</td>
                    <td>{{$order->date_depot}}</td>
                    <td>{{$order->items->pluck('nom')->join(', ')}}</td>
                    <td>
                       @switch($order->statut)
                           @case('reçue')
                               <span class="badge bg-info">{{$order->statut}}</span>
                               @break
                           @case('en traitement')
                            <span class="badge bg-warning">{{$order->statut}}</span>
                           @case('prête')
                                <span class="badge bg-secondary">{{$order->statut}}</span>
                           @break
                           @case('récupérée')
                                <span class="badge bg-success">{{$order->statut}}</span>
                           @break
                       @endswitch
                    </td>
                    <td>{{$order->montant_total}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5"> aucune commande trouvee pour ce client </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
  </div>
</x-base>    