@section('title', 'Asso/Club')

<x-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $data['Nom'] }}</h6>
        </div>
        <div class="card-body">
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
                                @if($key == 'Logo')
                                    <td><img src="{{ $value }}" alt="Logo" width="100" height="100"></td>
                                @elseif(filter_var($value, FILTER_VALIDATE_URL))
                                    <td><a href="{{ $value }}">{{ $value }}</a></td>
                                @elseif(filter_var($value, FILTER_VALIDATE_EMAIL))
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
</x-layout>
