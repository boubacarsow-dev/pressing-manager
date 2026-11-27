<x-base title="Liste des vêtements">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-pressing-violet">Gestion des Vêtements</h2>
        <a href="{{ route('items.create') }}" class="btn bg-pressing-teal text-white shadow-sm">
            + Nouveau Vêtement
        </a>
    </div>

    <h2 class="bg-pressing-teal text-center my-2 py-2">Catalogue des Vêtements</h2>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Vêtement</th>
                    <th>Prestations & Tarifs appliqués</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td class="fw-bold">{{ $item->nom }}</td>
                        <td>
                            @foreach ($item->services as $service)
                                <span class="badge bg-pressing-violet me-1">
                                    {{ $service->libelle }} : {{ $service->pivot->prix_applique }} FCFA
                                </span>
                            @endforeach
                        </td>
                        <td class="d-flex align-items-center gap-2">
                            <a href="{{ route('items.edit', $item) }}" class="text-pressing-violet" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('items.destroy', $item) }}" method="POST">
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
                        <td colspan="3">
                            <p class="mb-0">Aucun vêtement enregistré.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-base>