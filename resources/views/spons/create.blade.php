@section('title', 'spons/Club')

<x-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Création d'un partenaire</h6>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('spons.store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Burger-King">
                </div>

                <div class="form-group">
                    <label for="short_name">Promo</label>
                    <input type="text" class="form-control" id="promo" name="short_name" placeholder="Burger Mystère">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">Burger king est un FastFood qui propose une large selection de burgers au boeuf, poulet et même végétariens.
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="bk@gmail.com">
                </div>

                <div class="form-group">
                    <label for="website_link">Lien du site web</label>
                    <input type="text" class="form-control" id="website_link" name="website_link" placeholder="https://bk.com">
                </div>

                <div class="form-group">
                    <label for="Logo">Logo</label>
                    <input type="file" class="form-control-file" id="logo" name="logo">
                </div>


                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</x-layout>
