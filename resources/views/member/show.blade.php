@section('title', 'Membre')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucun membre n'a été trouvé.
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $data['last_name'] . ' ' . $data['first_name'] }}</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('member.edit', ['id' => $data['id']]) }}" class="btn btn-primary btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pen"></i>
                                        </span>
                    <span class="text">Mettre à jour</span>
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Numéro carte</th>
                            <th>Email</th>
                            <th>Numéro de téléphone</th>
                            <th>Solde</th>
                            <th>Cotisant</th>
                            <th>Promotion</th>
                            <th>Admin (MARCO)</th>
                            <th>Création du compte</th>
                            <th>Date de naissance</th>
                            <th>Filière</th>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($data as $key => $value)
                                @if($key != 'orders')
                                    @if(filter_var($value, FILTER_VALIDATE_EMAIL))
                                        <td><a href="mailto:{{ $value }}">{{ $value }}</a></td>
                                    @else
                                        <td>{{ $value }}</td>
                                    @endif
                                @endif
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Dernières commandes</h6>
                </div>
            </div>
            <div class="card-body">
                @if(empty($data['orders']))
                    <div class="alert alert-danger" role="alert">
                        Aucune commande n'a été trouvée.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <th>Prix</th>
                                <th>Nombre</th>
                                <th>Produit</th>
                                <th>Type</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                            @foreach($data['orders'] as $key => $value)
                                <tr>
                                    @foreach($value as $key2 => $value2)
                                        @if($key2 != 'id')
                                            @if($key2 == 'member')
                                                <td><a href="{{ route('member.show', $value2['id']) }}">{{ $value2['name'] }} <i class="fas fa-eye"></i></a></td>
                                            @elseif($key2 == 'price')
                                                <td>{!! $value2 !!}</td>
                                            @else
                                                <td>{{ $value2 }}</td>
                                            @endif
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif
            </div>
        </div>
    @endif
</x-layout>
