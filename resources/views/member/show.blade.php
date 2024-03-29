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
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-2">
                                <strong class="text-primary">Id :</strong> {{ $data['id'] }}
                            </div>
                            <div class="col-4">
                                <strong class="text-primary">Nom :</strong> {{ $data['last_name'] }}
                            </div>
                            <div class="col-4">
                                <strong class="text-primary">Prénom :</strong> {{ $data['first_name'] }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong class="text-primary">Numéro de carte :</strong> {{ $data['card_number'] }}
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <strong class="text-primary">Email :</strong> {{ $data['email'] }}
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Téléphone :</strong> {{ $data['phone'] }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <strong class="text-primary">Cotisant :</strong> {!! $data['contributor'] !!}
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Admin(marco) :</strong> {!! $data['admin'] !!}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <strong class="text-primary">Promotion :</strong> {{ $data['class'] }}
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Filière :</strong> {{ $data['sector'] }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong class="text-primary">Solde :</strong> {{ $data['balance'] }}
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <strong class="text-primary">Date de création :</strong> {{ $data['created_at'] }}
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Date de naissance :</strong> {{ $data['birth_date'] }}
                            </div>
                        </div>
                    </li>
                </ul>
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
                    <x-table
                        :is_searchable="true"
                        :headers="[
                            'price' => 'Prix',
                            'amount' => 'Nombre',
                            'product' => 'Produit',
                            'type' => 'Type',
                            'date' => 'Date'
                        ]"
                        :datas="$data['orders']->toArray()"
                        :pagination="$pagination"
                    />
                @endif
            </div>
        </div>
    @endif
</x-layout>
