<x-base title="Liste des services">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-pressing-violet">Gestion des Services</h2>
        <a href="{{ route('services.create') }}" class="btn bg-pressing-teal text-white shadow-sm">
            + Nouveau Service
        </a>
    </div>

    <h2 class="bg-pressing-teal text-center my-2 py-2">Nos Services</h2>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Libellé</th>
                    <th>Description</th>
                    <th>Tarif</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr>
                        <td class="fw-bold">{{ $service->libelle }}</td>
                        <td>{{ $service->description }}</td>
                        <td>{{ $service->tarif }} FCFA</td>
                        <td>
                            @if ($service->actif)
                                <span class="badge bg-success">Actif</span>
                            @else
                                <span class="badge bg-secondary">Inactif</span>
                            @endif
                        </td>
                        <td class="d-flex align-items-center gap-2">
                            <a href="{{ route('services.edit', $service) }}" class="text-pressing-violet"
                                title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('services.destroy', $service) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-secondary"
                                    title="Activer / Désactiver">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <p class="mb-0">Aucun service trouvé.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-base>