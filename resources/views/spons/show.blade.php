@section('title', 'Partenaires')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucun Partnaire n'a été trouvé.
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
                <a href="{{ route('spons.edit', ['id' => $data['id']]) }}" class="btn btn-primary btn-icon-split mb-3">
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
                            <div class="col-6">
                                <strong class="text-primary">Nom :</strong> {{ $data['name'] }}
                            </div>
                            <div class="col-4">
                                <strong class="text-primary">Promo :</strong> {{ $data['promo'] }}
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
                </ul>
            </div>
        </div>
    @endif
</x-layout>
