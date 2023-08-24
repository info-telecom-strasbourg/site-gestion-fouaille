@section('title', 'Marco')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucune produit trouvé.
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Produits</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('marco.edit', ['id' => $data['id']]) }}" class="btn btn-primary btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pen"></i>
                                        </span>
                    <span class="text">Mettre à jour</span>
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <th>Nom</th>
                        <th>Titre (nom sur la marco)</th>
                        <th>Prix par défaut</th>
                        <th>Type</th>
                        <th>Couleur</th>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($data as $key => $value)
                                    @if($key != 'id')
                                        @if($key == 'color')
                                            <td><div class="p-3" style="background-color: {{ $value }}"></div></td>
                                        @elseif($key == 'price')
                                            <td><span class="text-success">{{ $value }} €</span></td>
                                        @else
                                            <td>{{ $value }}</td>
                                        @endif
                                    @endif
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</x-layout>
