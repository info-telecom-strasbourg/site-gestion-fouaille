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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ajout d'un membre à {{$data['organization']['short_name']}}</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('asso.member.store')}}">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="role">Rôle</label>
                    <input type="text" class="form-control" id="role" name="role" placeholder="Président">
                </div>

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
                        @foreach($data['members'] as $member)
                            <tr>
                                <td>{{ $member['first_name'] }}</td>
                                <td>{{ $member['last_name'] }}</td>
                                @if($member['is_member'] == 0)
                                    <td>
                                        <form action="{{ route('asso.member.store') }}" method="POST">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="user_id" value="{{ $member['id'] }}">
                                            <input type="hidden" name="organization_id" value="{{ $data['organization']['id'] }}">
                                            <input type="hidden" name="role" value="">

                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <form action="{{ route('asso.member.destroy', $data['organization']['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <input type="hidden" name="user_id" value="{{ $member['id'] }}">
                                            <input type="hidden" name="organization_id" value="{{ $data['organization']['id'] }}">

                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <input type="hidden" id="organization_id" name="organization_id" value="{{ $data['organization']['id'] }}">

                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</x-layout>
