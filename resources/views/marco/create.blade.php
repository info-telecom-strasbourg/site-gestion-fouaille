@section('title', 'Marco')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Erreur lors de la récupération des données.
        </div>
    @else
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Création de produit</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('marco.store')}}">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Katsteel Red">
                    </div>

                    <div class="form-group">
                        <label for="title">Titre (nom sur la marco)</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="KatsteelR">
                    </div>

                    <div class="form-group">
                        <label for="product_type_id">Type de produit</label>
                        <select class="custom-select" id="product_type_id" name="product_type_id">
                            <option selected>Ouvrir la liste</option>
                            @foreach($data as $key => $value)
                                <option id="product_type_id" name="product_type_id" value="{{ $value['id'] }}">{{ $value['type'] }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="price">Prix par défaut</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="1">
                    </div>

                    <div class="form-group">
                        <label for="color">Couleur</label>
                        <input type="color" class="form-control" id="color" name="color" placeholder="#FF0000">
                    </div>

                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    @endif
</x-layout>
