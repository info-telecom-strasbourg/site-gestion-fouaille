@section('title', 'Partenaires')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucun Partenaire n'a été trouvé.
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Partenaires</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('spons.create') }}" class="btn btn-primary btn-icon-split mb-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Ajouter un partenaire</span>
                </a>
                <x-table
                    :headers="[
                        'name' => 'Nom',
                        'logo' => 'logo',
                        'email' => 'email',
                        'promo' => 'Promotion',
                    ]"
                    :datas="$data->toArray()"
                    :pagination="$pagination"
                    is_searchable="true"
                />
            </div>
        </div>
    @endif
</x-layout>
