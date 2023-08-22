@section('title', 'Fouaille')

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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Nombre</th>
                            <th>Produit</th>
                            <th>Type</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $value)
                            <tr>
                                @foreach($value as $key2 => $value2)
                                    @if($key2 != 'id')
                                        @if($key2 == 'member')
                                            <td><a href="{{ route('member.show', $value2['id']) }}">{{ $value2['name'] }} <i class="fas fa-eye"></i></a></td>
                                        @else
                                            <td>{!! $value2 !!}</td>
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
