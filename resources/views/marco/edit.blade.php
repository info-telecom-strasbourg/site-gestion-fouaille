@section('title', 'Marco')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucune produit trouvé.
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
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mise à jour de <strong>{{ $data['name'] }}</strong></h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('marco.update', ['id' => $data['id']]) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="name">Nom complet</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $data['name'] }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Titre (nom sur la marco)</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $data['title'] }}">
                        </div>

                        <div class="form-group">
                            <label for="price">Prix par défaut</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $data['price'] }}">
                        </div>

                        <div class="form-group">
                            <label for="color">Couleur</label>
                            <input type="color" class="form-control" id="color" name="color" value="{{ $data['color'] }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
    @endif
</x-layout>
