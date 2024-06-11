@section('title', 'Asso/Club')
<x-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Membre de {{$data['organization']['short_name']}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Rôle</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['members']['organization'] as $member)
                        <tr>
                            <td>{{ $member['first_name'] }}</td>
                            <td>{{ $member['last_name'] }}</td>
                            <td>{{ $member['role'] }}</td>
                            <td>
                                <form method="POST" action="{{ route('asso.member.destroy')}}">
                                    @CSRF
                                    @method('DELETE')
                                    <input type="hidden" name="member_id" value="{{ $member['id'] }}">
                                    <input type="hidden" name="organization_id" value="{{ request()->route('id') }}">
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                                <form method="GET" action="{{ route('asso.member.edit', ['organization_id' => request()->route('id'), 'member_id' => $member['id']]) }}">
                                    @CSRF
                                    @method('GET')
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-pen"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ajout de membre a {{$data['organization']['short_name']}}</h6>
        </div>
        <div class="card-body">
            <form
                method="GET"
                action="{{route(request()->route()->getName(), ['id' => request()->route('id')])}}"
                class="mb-3"
            >

                @CSRF

                @method('GET')

                @foreach(request()->query() as $key => $value)
                    @if($key !== 'search' && $key !== '_token')
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach

                <div class="form-row">
                    <div class="col">
                        <input type="text"
                               class="form-control"
                               name="search"
                               placeholder="Rechercher"
                               value="{{ request('search') != null ? request('search') : '' }}"
                        >
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['members']['all'] as $member)
                        <tr>
                            <td>{{ $member['first_name'] }}</td>
                            <td>{{ $member['last_name'] }}</td>
                            <td><button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if(isset($pagination))
                    {!!  $pagination !!}
                @endif
            </div>
        </div>
    </div>
</x-layout>
