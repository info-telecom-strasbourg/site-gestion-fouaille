@section('title', 'Membre')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucun membre n'a été trouvé.
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Membres</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('member.index') }}" class="mb-3">
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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        @foreach($data[0] as $key => $value)
                            @if($key != 'Id')
                                <th>{{ $key }}</th>
                            @endif
                        @endforeach
                        </thead>
                        <tbody>
                        @foreach($data as $key => $value)
                            <tr>
                                @foreach($value as $key2 => $value2)
                                    @if($key2 != 'Id')
                                        @if($key2 == 'Nom')
                                            <td><a href="{{ route('member.show', $value['Id']) }}">{{ $value2 }} <i class="fas fa-eye"></i></a></td>
                                        @elseif(filter_var($value2, FILTER_VALIDATE_EMAIL))
                                            <td><a href="mailto:{{ $value2 }}">{{ $value2 }}</a></td>
                                        @elseif($key2 == 'Cotisant')
                                            <td>{!! $value2 !!}</td>
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
                {!!  $pagination !!}
            </div>
        </div>
    @endif
</x-layout>
