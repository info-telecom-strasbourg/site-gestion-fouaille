@section('title', 'Asso/Club')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucune associations n'a été trouvé.
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $data['name'] }}</h6>
            </div>
            <div class="card-body">
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
                                <strong class="text-primary">Twitter :</strong> <a href="{{ $data['facebook_link'] }}">{{ $data['facebook_link'] }}</a>
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Instagram :</strong> <a href="{{ $data['instagram_link'] }}">{{ $data['instagram_link'] }}</a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong class="text-primary">Discord :</strong> <a href="{{ $data['discord_link'] }}">{{ $data['discord_link'] }}</a>
                </ul>
            </div>
        </div>
    @endif
</x-layout>
