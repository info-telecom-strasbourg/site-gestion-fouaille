@section('title', 'Asso/Club')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucune associations n'a été trouvé.
        </div>
    @else
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $data['name'] }}</h6>
            </div>
            <div class="card-body">
                <div class=" d-flex justify-content-between">
                    <a href="{{ route('asso.edit', ['id' => $data['id']]) }}" class="btn btn-primary btn-icon-split mb-3">
                        <span class="icon text-white-50">
                            <i class="fas fa-pen"></i>
                        </span>
                        <span class="text">Mettre à jour</span>
                    </a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-icon-split mb-3" data-toggle="modal" data-target="#ModalAsso">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Supprimer</span>
                    </button>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-8">
                                <img src="{{ $data['logo'] }}" alt="{{ $data['name'] }}" class="img-fluid" width="100px">
                            </div>
                            <div class="col-4">
                                <strong class="text-primary">Association :</strong> {!! $data['association'] !!}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-2">
                                <strong class="text-primary">Id :</strong> {{ $data['id'] }}
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Nom :</strong> {{ $data['name'] }}
                            </div>
                            <div class="col-4">
                                <strong class="text-primary">Appellation :</strong> {{ $data['short_name'] }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <p><strong class="text-primary">Description :</strong> {{ $data['description'] }}</p>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <strong class="text-primary">Website :</strong> <a href="{{ $data['website_link'] }}">{{ $data['website_link'] }}</a>
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Email :</strong> <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <strong class="text-primary">Twitter :</strong> <a href="{{ $data['twitter_link'] }}">{{ $data['facebook_link'] }}</a>
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Instagram :</strong> <a href="{{ $data['instagram_link'] }}">{{ $data['instagram_link'] }}</a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <strong class="text-primary">Discord :</strong> <a href="{{ $data['discord_link'] }}">{{ $data['discord_link'] }}</a>
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Facebook :</strong> <a href="{{ $data['facebook_link'] }}">{{ $data['facebook_link'] }}</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Membres</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('asso.member.create', $data['id']) }}" class="btn btn-primary btn-icon-split mb-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Ajouter un membre</span>
                </a>
                <!-- table -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="col_5">{{ __('Nom') }}</th>
                            <th class="col-5">{{ __('Rôle') }}</th>
                            <th class="col-1 justify-content-center">{{ __('Supprimer') }}</th>
                        </tr>
                    </thead>
                    @foreach($data['members'] as $data1)
                        <tr>
                        @foreach($data1 as $key => $value)
                            @if(is_array($value))
                                <td>
                                    @foreach($value as $key2 => $value2)
                                        @if($key2 != 'redirect_route')
                                            <a href="{{ $value['redirect_route'] }}">
                                                {!! $value2 !!}
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                            @else
                                @if($key != 'id')
                                    <td>{!! $value !!}</td>
                                @endif
                            @endif
                        @endforeach
                        <td class="d-flex justify-content-center">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalMember">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                            </button>
                        </td>
                        @include('asso.modal.modalmember')
                        </tr>
                    @endforeach
                </table>
            <!-- end table -->
            </div>
        </div>
    @endif
    @include('asso.modal.modalasso')
</x-layout>
