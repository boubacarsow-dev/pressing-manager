<x-base title="Gestion des Client">
<div class="card border-0 shadow-sm">
    <div class="header" style="display:flex; justify-content: space-between;">
        <h2 class="">Modifier un Client</h2>
        <button" class="btn bg-pressing-violet">
            <a href="{{route('customers.index')}}">Retour</a>
        </button>
    </div>
    <div class="card-body">
        <form action="{{route('customers.update',$customer)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-title bg-pressing-teal">
            <h3>Modification Client</h3>
        </div>
        <label for="nom" class="form-label">Nom et Prenom</label>
        <input type="text" name="nom" id="nom" value="{{old('nom')}}" class="form-control">
         @error('nom')
            <div class="text-danger small">{{$message}}</div>
        @enderror
        <label for="tel" id="tel" class="form-label">Telephone</label>
        <input type="text" name="tel" id="tel" value="{{old('tel')}}" class="form-control">
         @error('tel')
            <div class="text-danger small">{{$message}}</div>
        @enderror
        <label for="adresse" class="form-label">Adresse</label>
        <textarea name="adresse" id="adresse" class="form-control" rows="4"> {{old('adresse')}}</textarea>
         @error('adresse')
            <div class="text-danger small">{{$message}}</div>
        @enderror
          <div style="display: flex; justify-content: space-around;
    align-items: center;">
            <button type="submit" class="btn bg-pressing-teal px-4 fw-bold"><i class="bi-save"></i>Modifier</button>
          <button type="reset" class="btn text-decoration-none">Annuler</button>
          </div>
        </form>
    </div>
</div>
</x-base>    