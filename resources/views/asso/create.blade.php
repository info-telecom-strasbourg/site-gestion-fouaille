@section('title', 'Asso/Club')

<x-layout>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Création d'asso/club</h6>
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
            <form method="POST" action="{{ route('asso.store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Bureau des étudiants">
                </div>

                <div class="form-group">
                    <label for="short_name">Nom court</label>
                    <input type="text" class="form-control" id="short_name" name="short_name" placeholder="BDE">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">Le Bureau des Étudiants (BDE) est une association étudiante dynamique qui joue un rôle essentiel dans la vie etudiante et anime la partie associative de l'école. En tant qu'intermédiaire entre les étudiants et l'administration, le BDE assure une communication fluide et efficace, garantissant ainsi que les besoins et les préoccupations des étudiants sont entendus et pris en compte par l'équipe administrative.</textarea>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="bde@gmail.com">
                </div>

                <div class="form-group">
                    <label for="website_link">Lien du site web</label>
                    <input type="text" class="form-control" id="website_link" name="website_link" placeholder="https://bde.com">
                </div>

                <div class="form-group">
                    <label for="facebook_link">Lien de la page facebook</label>
                    <input type="text" class="form-control" id="facebook_link" name="facebook_link" placeholder="https://www.facebook.com/bde.telecomps">
                </div>

                <div class="form-group">
                    <label for="twitter_link">Lien du compte twitter</label>
                    <input type="text" class="form-control" id="twitter_link" name="twitter_link" placeholder="https://twitter.com/bde_telecomps">
                </div>

                <div class="form-group">
                    <label for="instagram_link">Lien du compte instagram</label>
                    <input type="text" class="form-control" id="instagram_link" name="instagram_link" placeholder="https://www.instagram.com/bde_telecomps">
                </div>

                <div class="form-group">
                    <label for="discord_link">Lien du discord</label>
                    <input type="text" class="form-control" id="discord_link" name="discord_link" placeholder="https://discord.gg/bde_telecomps">
                </div>

                <div class="form-group">
                    <label for="association">Association</label>
                    <input type="checkbox" class="bootstrap-switch" id="association" name="association">
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
