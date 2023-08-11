@section('title', 'Membre')

<x-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Membres</h6>
        </div>
        <div class="card-body">
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
                                        <td><a href="{{ route('member.show', $value['Id']) }}">{{ $value2 }}</a></td>
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
            {!!  $pagination !!}
        </div>
    </div>
</x-layout>
