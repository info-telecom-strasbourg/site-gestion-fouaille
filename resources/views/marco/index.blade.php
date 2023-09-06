@section('title', 'Marco')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucun produit trouvé.
        </div>
    @else
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Liste des produits</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('marco.create') }}" class="btn btn-primary btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                    <span class="text">Ajouter un produit</span>
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <th>Nom</th>
                            <th>Prix par défaut</th>
                            <th>Type</th>
                            <th>Couleur</th>
                            <th>Disponible</th>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $value)
                            <tr>
                                @foreach($value as $key2 => $value2)
                                    @if($key2 != 'id')
                                        @if($key2 == 'color')
                                            <td><div class="p-3" style="background-color: {{ $value2 }}"></div></td>
                                        @elseif($key2 == 'name')
                                            <td><a href="{{ route('marco.show', $value['id']) }}">{{ $value2 }} <i class="fas fa-eye"></i></a></td>
                                        @elseif($key2 == 'price')
                                            <td><span class="text-success">{{ $value2 }} €</span></td>
                                        @else
                                            <td>{{ $value2 }}</td>
                                        @endif
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</x-layout>
