@section('title', 'Asso/Club')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucun membre n'a été trouvé.
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Associations / Clubs</h6>
            </div>
            <div class="card-body">
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
