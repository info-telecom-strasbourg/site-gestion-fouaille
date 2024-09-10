@section('title', 'Défis de l\'intégration')

<x-layout>
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Participants</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $participation_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucun défi n'a été trouvé.
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-1 font-weight-bold text-primary">Défis</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('challenge.index') }}" class="mb-3">
                    <div class="form-row">
                        <div class="col">
                            <input type="text"
                                   class="form-control"
                                   name="search"
                                   placeholder="Rechercher"
                                   value="{{ request('search') != null ? request('search') : '' }}"
                            >
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Rechercher</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                        <thead>
                            <th>Nom</th>
                            <th>Catégories réalisées</th>
                            <th>Nombre de défis réalisés</th>
                            <th>Défis réalisés</th>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $value)
                            <tr>
                                <td><a href="{{ route('challenge.show', ['id' => $value['member']['Id']]) }}">{{ $value['member']['Nom'] }} <i class="fas fa-eye"></i></a></td>
                                <td>{{ $value['total_categories'] }}</td>
                                <td>{{ $value['challenge_count'] }}</td>
                                <td>
                                    @foreach($value['challenges'] as $key2 => $value2)
                                        <p>{{ $value2['Nom'] }} : {{ $value2['Date de réalisation'] }}</p>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {!! $pagination !!}
            </div>
        </div>
    @endif
</x-layout>
