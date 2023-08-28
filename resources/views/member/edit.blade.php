@section('title', 'Membre')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucun membre n'a été trouvé.
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
                <h6 class="m-0 font-weight-bold text-primary">Mise à jour de <strong>{{ $data->last_name . ' ' . $data->first_name }}</strong></h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('member.update', ['id' => $data->id]) }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="contributor">Cotisant</label>
                        <input type="checkbox" class="bootstrap-switch" id="contributor" name="contributor" {{ $data->contributor ? 'checked' : '' }}>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Nom</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $data->last_name }}">
                    </div>

                    <div class="form-group">
                        <label for="first_name">Prénom</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $data->first_name }}">
                    </div>

                    <div class="form-group">
                        <label for="card_number">Numéro de carte</label>
                        <input type="number" class="form-control" id="card_number" name="card_number" value="{{ $data->card_number }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Numéro de téléphone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ $data->phone }}">
                    </div>

                    <div class="form-group">
                        <label for="admin">Admin marco</label>
                        <input type="checkbox" class="bootstrap-switch" id="admin" name="admin" {{ $data->admin ? 'checked' : '' }}>
                    </div>

                    <div class="form-group">
                        <label for="class">Promotion</label>
                        <input type="number" class="form-control" id="class" name="class" value="{{ $data->class }}">
                    </div>

                    <div class="form-group">
                        <label for="birth_date">Date de naissance</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ $data->birth_date }}">
                    </div>

                    <div class="form-group">
                        <label for="sector">Filière</label>
                        <input type="text" class="form-control" id="sector" name="sector" value="{{ $data->sector }}">
                    </div>



                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    @endif
</x-layout>
