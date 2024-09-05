@section('title', 'Défis de l\'intégration')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucun défi n'a été trouvé.
        </div>
    @else
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    nombre de catégories validées</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_categories }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-coins fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    nombre de défis réalisés</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_challenges}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-trophy fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-1 font-weight-bold text-primary">{{ $data['user_name'] }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                        <thead>
                            @foreach($data['challenges'] as $key => $value)
                                <th>{{ $value['name'] . ' ( Catégorie ' . $value['category'] . ' )'}}</th>
                            @endforeach
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($data['challenges'] as $key => $value)
                                    @if($value['realized_at'] != null)
                                        <td><i class="fas fa-check"></i></td>
                                    @else
                                        <td><i class="fas fa-times"></i></td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($data['challenges'] as $key => $value)
                                    @if($value['realized_at'] != null)
                                        <td>{{ $value['realized_at'] }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($data['challenges'] as $key => $value)
                                    @if($value['realized_at'] != null)
                                        <form action="{{ route('challenge.destroy', $data['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <input type="hidden" name="challenge_id" value="{{ $value['id'] }}">

                                            <td>
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </form>
                                    @else
                                        <form action="{{ route('challenge.create', $data['id']) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="challenge_id" value="{{ $value['id'] }}">

                                            <td>
                                                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i>
                                                </button>
                                            </td>
                                        </form>
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
