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
                <x-table
                    :headers="[
                        'name' => 'Nom',
                        'price' => 'Prix',
                        'type' => 'Type',
                        'color' => 'Couleur',
                        'available' => 'Disponible'
                    ]"
                    :datas="$data->toArray()"
                    :pagination="$pagination"
                    is_searchable="true"
                />

            </div>
        </div>
    @endif
</x-layout>
