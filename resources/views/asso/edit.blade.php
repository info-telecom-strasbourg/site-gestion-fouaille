@section('title', 'Club/Asso')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucune asso/club n'a été trouvé.
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
                <h6 class="m-0 font-weight-bold text-primary">Mise à jour de <strong>{{ $data->name }}</strong></h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('asso.update', ['id' => $data->id]) }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                    </div>

                    <div class="form-group">
                        <label for="short_name">Appellation</label>
                        <input type="text" class="form-control" id="short_name" name="short_name" value="{{ $data->short_name }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5">{{ $data->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}">
                    </div>

                    <div class="form-group">
                        <label for="website_link">Site web</label>
                        <input type="url" class="form-control" id="website_link" name="website_link" value="{{ $data->website_link }}">
                    </div>

                    <div class="form-group">
                        <label for="facebook_link">Facebook</label>
                        <input type="url" class="form-control" id="facebook_link" name="facebook_link" value="{{ $data->facebook_link }}">
                    </div>

                    <div class="form-group">
                        <label for="twitter_link">Twitter</label>
                        <input type="url" class="form-control" id="twitter_link" name="twitter_link" value="{{ $data->twitter_link }}">
                    </div>

                    <div class="form-group">
                        <label for="instagram_link">Instagram</label>
                        <input type="url" class="form-control" id="instagram_link" name="instagram_link" value="{{ $data->instagram_link }}">
                    </div>

                    <div class="form-group">
                        <label for="discord_link">Discord</label>
                        <input type="url" class="form-control" id="discord_link" name="discord_link" value="{{ $data->discord_link }}">
                    </div>

                    <div class="association">
                        <label for="association">Association</label>
                        <input type="checkbox" class="bootstrap-switch" id="association" name="association" {{ $data->association ? 'checked' : '' }}>
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mise à jour du logo de <strong>{{ $data->name }}</strong></h6>
            </div>
            <div class="card-body">
                <ul class="list-group mb-3">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-2">
                                <img src="{{ $data->logo->path }}" alt="{{ $data->logo->name }}" class="img-fluid" width="100px">
                            </div>
                            <div class="col-10">
                                <ul>
                                    <li><strong class="text-primary">Nom :</strong> {{ $data->logo->name }}</li>
                                    <li><strong class="text-primary">Taille :</strong> {{ $data->logo->size }}</li>
                                    <li><strong class="text-primary">Url :</strong> {{ $data->logo->path }}</li>
                                    <li><strong class="text-primary">Créé le :</strong> {{ $data->logo->created_at }}</li>
                                    <li><strong class="text-primary">Mis à jour le :</strong> {{ $data->logo->updated_at }}</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>

                <form method="POST" action="{{ route('asso.logo.update', ['id' => $data->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" class="form-control-file" id="logo" name="logo">
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>

            </div>
        </div>
    @endif
</x-layout>
