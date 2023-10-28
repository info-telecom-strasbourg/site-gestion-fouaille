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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <th>Nom</th>
                            <th>Logo</th>
                            <th>Email</th>
                            <th>Site web</th>
                            <th>Association</th>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $value)
                            <tr>
                                @foreach($value as $key2 => $value2)
                                    @if($key2 != 'id')
                                        @if($key2 == 'logo')
                                            <td><img src="{{ $value2 }}" alt="Logo" width="100" height="100"></td>
                                        @elseif($key2 == 'name')
                                            <td><a href="{{ route('asso.show', $value['id']) }}">{{ $value2 }} <i class="fas fa-eye"></i></a></td>
                                        @elseif(filter_var($value2, FILTER_VALIDATE_URL))
                                            <td><a href="{{ $value2 }}">{{ $value2 }}</a></td>
                                        @elseif(filter_var($value2, FILTER_VALIDATE_EMAIL))
                                            <td><a href="mailto:{{ $value2 }}">{{ $value2 }}</a></td>
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
