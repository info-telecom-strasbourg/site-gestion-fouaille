@section('title', 'Asso/Club')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucune asso n'a été trouvé.
        </div>
    @else
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Associations / Clubs</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('asso.create') }}" class="btn btn-primary btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                    <span class="text">Ajouter une Asso/club</span>
                </a>
                <x-table
                    :headers="[
                        'name' => 'Nom',
                        'logo' => 'logo',
                        'email' => 'Email',
                        'association' => 'Association'
                    ]"
                    :datas="$data->toArray()"
                    :pagination="$pagination"
                    is_searchable="true"
                />
            </div>
        </div>
    @endif
</x-layout>
