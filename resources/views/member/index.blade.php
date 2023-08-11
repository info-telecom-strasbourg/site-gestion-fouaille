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
                        <th>{{ $key }}</th>
                    @endforeach
                    </thead>
                    <tbody>
                    @foreach($data as $key => $value)
                        <tr>
                            @foreach($value as $key2 => $value2)
                                <td>{{ $value2 }}</td>
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
