@section('title', 'Fouaille')

<x-layout>
    <div class="card shadow mb-4">
        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
           role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Période</h6>
        </a>
        <div class="collapse show" id="collapseCardExample">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="GET" action="{{ route('fouaille.index') }}">
                    @csrf
                    @method('GET')

                    <div class="form-group">
                        <label for="start_at">Début</label>
                        <input type="datetime-local" class="form-control" id="start_at" name="start_at" value="{{ $start_at }}">
                    </div>

                    <div class="form-group">
                        <label for="end_at">Fin</label>
                        <input type="datetime-local" class="form-control" id="end_at" name="end_at" value="{{ $end_at }}">
                    </div>


                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucune commande n'a été trouvée entre le <span class="font-weight-bold">{{ $start_at_formatted }}</span> et le <span class="font-weight-bold">{{ $end_at_formatted }}</span>.
        </div>
    @else
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Recettes</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ $total_purchases }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-euro-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Rechargements</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ $total_reloads }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-euro-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Graphique</div>
                                <div class="h5 font-weight-bold text-gray-800">
                                    <a href="{{ route('fouaille.chart') }}" class="btn btn-primary">Voir</a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Détail</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center flex-wrap">
                    @foreach($data['product_details'] as $key => $value)
                    <div class="card border-bottom-secondary shadow m-2">
                        @foreach($value as $key2 => $value2)
                                @if($key2 != 'id')
                                    @if($key2 == 'name')
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">{{ $value2 }}</h6>
                                        </div>
                        <div class="card-body">
                                    @elseif($key2 == 'amount')
                                        <p class="product-amount">nombre : <span class="text-primary">{{ $value2 }}</span></p>
                                    @elseif($key2 == 'total')
                                        <p class="product-total">total : <span class="text-success">{{ $value2 }} €</span></p>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Dernières commandes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <th>
                                Nom
                                @if(isset(request()->order_by) && request()->order_by == 'name')
                                    @if(isset(request()->order_direction) && request()->order_direction == 'asc')
                                        <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'name', 'order_direction' => 'desc'])) }}">
                                            <i class="fas fa-sort-up"/>
                                        </a>
                                    @else
                                        <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'name', 'order_direction' => 'asc'])) }}">
                                            <i class="fas fa-sort-down"/>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'name', 'order_direction' => 'asc'])) }}">
                                        <i class="fas fa-sort"/>
                                    </a>
                                @endif
                            </th>
                            <th>
                                Prix
                                @if(isset(request()->order_by) && request()->order_by == 'price')
                                    @if(isset(request()->order_direction) && request()->order_direction == 'asc')
                                        <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'price', 'order_direction' => 'desc'])) }}">
                                            <i class="fas fa-sort-up"/>
                                        </a>
                                    @else
                                        <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'price', 'order_direction' => 'asc'])) }}">
                                            <i class="fas fa-sort-down"/>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'price', 'order_direction' => 'asc'])) }}">
                                        <i class="fas fa-sort"/>
                                    </a>
                                @endif
                            </th>
                            <th>
                                Nombre
                                @if(isset(request()->order_by) && request()->order_by == 'amount')
                                    @if(isset(request()->order_direction) && request()->order_direction == 'asc')
                                        <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'amount', 'order_direction' => 'desc'])) }}">
                                            <i class="fas fa-sort-up"/>
                                        </a>
                                    @else
                                        <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'amount', 'order_direction' => 'asc'])) }}">
                                            <i class="fas fa-sort-down"/>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'amount', 'order_direction' => 'asc'])) }}">
                                        <i class="fas fa-sort"/>
                                    </a>
                                @endif
                            </th>
                            <th>
                                Produit
                                @if(isset(request()->order_by) && request()->order_by == 'product')
                                    @if(isset(request()->order_direction) && request()->order_direction == 'asc')
                                        <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'product', 'order_direction' => 'desc'])) }}">
                                            <i class="fas fa-sort-up"/>
                                        </a>
                                    @else
                                        <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'product', 'order_direction' => 'asc'])) }}">
                                            <i class="fas fa-sort-down"/>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'product', 'order_direction' => 'asc'])) }}">
                                        <i class="fas fa-sort"/>
                                    </a>
                                @endif
                            </th>
                            <th>
                                Type
                                @if(isset(request()->order_by) && request()->order_by == 'type')
                                    @if(isset(request()->order_direction) && request()->order_direction == 'asc')
                                        <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'type', 'order_direction' => 'desc'])) }}">
                                            <i class="fas fa-sort-up"/>
                                        </a>
                                    @else
                                        <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'type', 'order_direction' => 'asc'])) }}">
                                            <i class="fas fa-sort-down"/>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'type', 'order_direction' => 'asc'])) }}">
                                        <i class="fas fa-sort"/>
                                    </a>
                                @endif
                            </th>
                            <th>
                                Date
                                @if(isset(request()->order_by) && request()->order_by == 'date')
                                    @if(isset(request()->order_direction) && request()->order_direction == 'asc')
                                        <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'date', 'order_direction' => 'desc'])) }}">
                                            <i class="fas fa-sort-up"/>
                                        </a>
                                    @else
                                        <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'date', 'order_direction' => 'asc'])) }}">
                                            <i class="fas fa-sort-down"/>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('fouaille.index', array_merge(request()->all(), ['order_by' => 'date', 'order_direction' => 'asc'])) }}">
                                        <i class="fas fa-sort"/>
                                    </a>
                                @endif
                            </th>
                        </thead>
                        <tbody>
                        @foreach($data['orders'] as $key => $value)
                            <tr>
                                @foreach($value as $key2 => $value2)
                                    @if($key2 != 'id')
                                        @if($key2 == 'member')
                                            <td><a href="{{ route('member.show', $value2['id']) }}">{{ $value2['name'] }} <i class="fas fa-eye"></i></a></td>
                                        @elseif ($key2 == 'price')
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
    <script>

    </script>
</x-layout>
