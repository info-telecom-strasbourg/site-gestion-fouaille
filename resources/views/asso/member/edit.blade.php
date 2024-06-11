@section('title', 'Membre Club/Asso')
<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Impossible de mettre à jour ce membre.
        </div>
    @else
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
                <h6 class="m-0 font-weight-bold text-primary">Mise à jour de <strong>{{ $data['first_name'] . ' ' . $data['last_name']}}</strong> dans <strong>{{ $data['organization_name']}}</strong></h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('asso.member.update')}}">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="member_id" value="{{ $data['member_id'] }}">
                    <input type="hidden" name="organization_id" value="{{ $data['organization_id'] }}">

                    <div class="form-group">
                        <label for="role">Rôle</label>
                        <input type="text" class="form-control" id="role" name="role" value="{{ $data['role'] }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    @endif
</x-layout>
