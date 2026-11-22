<x-base title="Liste des clients">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-pressing-violet">Gestion des Clients</h2>
        <a href="{{ route('customers.create') }}" class="btn bg-pressing-teal text-white shadow-sm">
            + Nouveau Client
        </a>
    </div>
    {{-- Filter --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
        <form action="{{ route('customers.index') }}" method="GET">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input 
                    type="text" 
                    name="search"
                    class="form-control border-start-0 ps-0" 
                    placeholder="Rechercher par nom ou numéro..." 
                    value="{{ request('search') }}"
                >
                <button type="submit" class="btn bg-pressing-teal text-white fw-semibold px-4">
                    Rechercher
                </button>
                
                @if(request('search'))
                    <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Effacer
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

    {{-- tableaux --}}
    <h2 class="bg-pressing-teal theme-inverse text-center my-2">Mes Clients</h2>
     <div class="table-responsive">
     <table class="table">
        <thead class="table-light">
            <th>Nom et Prenom</th>
            <th>Telephone</th>
            <th>Adresse</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
               <tr>
                 <td class="fw-bold">{{$customer->nom}}</td>
                <td>{{$customer->tel}}</td>
                <td>{{$customer->adresse?? '-'}}</td>
                <td class="d-flex align-items-between m-2">
                    <a href="{{route('customers.edit', $customer)}}"> <i class="bi-pencil"></i></a>
                   <form action="{{route('customers.destroy', $customer)}}" method="post">
                    @csrf
                    @method('DELETE')
                        <button type="submit" value=""><i class="bi-trash"></i></button>
                    </form> 
                </td>
               </tr>
            @empty
                <td colspan="4">
                    <p>aucun client trouve</p>
                </td>
            @endforelse
        </tbody>
     </table>
     </div>
     <div class="mt-4">
        {{ $customers->links() }}
    </div
</x-base>