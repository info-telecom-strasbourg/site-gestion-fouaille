@section('title', 'Membre')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucun membre n'a été trouvé.
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $data['Nom'] . ' ' . $data['Prénom'] }}</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('member.edit', ['id' => $data['Id']]) }}" class="btn btn-primary btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pen"></i>
                                        </span>
                    <span class="text">Mettre à jour</span>
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        @foreach($data as $key => $value)
                            <th>{{ $key }}</th>
                        @endforeach
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($data as $key => $value)
                                @if(filter_var($value, FILTER_VALIDATE_EMAIL))
                                    <td><a href="mailto:{{ $value }}">{{ $value }}</a></td>
                                @else
                                    <td>{{ $value }}</td>
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
