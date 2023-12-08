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

                <div class="form-group">
                    <label for="member">Membre</label>
                    <select class="custom-select" id="member_id" name="member_id">
                        <option selected>Ouvrir la liste</option>
                        @foreach($data['members'] as $key => $value)
                            <option id="member_id" name="member_id" value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" id="organization_id" name="organization_id" value="{{ $data['organization']['id'] }}">

                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</x-layout>
