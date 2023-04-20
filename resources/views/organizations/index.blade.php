<x-layout>
    <div class="container mt-10">
        <div class="row">
            <div class="col-4">
                <form method="POST" action="organization">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name"
                                   placeholder="bureau des étudiants"
                                   required>
                        </div>
                        <div class="col">
                            <label for="slug" class="form-label">Sigle</label>
                            <input type="text"
                                   class="form-control"
                                   id="slug"
                                   name="slug"
                                   placeholder="bde"
                                 Ò  required>
                        </div>
                    </div>
                    <label for="website_link" class="form-label">Lien vers le site web</label>
                    <input type="text"
                           class="form-control"
                           id="website_link"
                           name="website_link"
                           placeholder="https://bde-tps.fr/"
                           required>

                    <label for="facebook_link" class="form-label">Lien vers le facebook</label>
                    <input type="text"
                           class="form-control"
                           id="facebook_link"
                           name="facebook_link"
                           placeholder="https://www.facebook.com/bde.telecomps/"
                           required>

                    <label for="twitter_link" class="form-label">Lien vers le twitter</label>
                    <input type="text"
                           class="form-control"
                           id="twitter_link"
                           name="twitter_link"
                           placeholder="https://www.twitter.com/bde.telecomps/"
                           required>

                    <label for="instagram_link" class="form-label">Lien vers instagram</label>
                    <input type="text"
                           class="form-control"
                           id="instagram_link"
                           name="instagram_link"
                           placeholder="https://www.instagram.com/bde/"
                           required>

                    <label for="discord_link" class="form-label">Lien vers le discord</label>
                    <input type="text"
                           class="form-control"
                           id="discord_link"
                           name="discord_link"
                           placeholder="https://www.discord.com/bde/"
                           required>

                    <label for="logo_link" class="form-label">Lien vers le logo</label>
                    <input type="text"
                           class="form-control"
                           id="logo_link"
                           name="logo_link"
                           placeholder="https://www.serveur.com/bde.png/"
                           required>

                    <div class="form-check form-switch">
                        <input class="form-check-input"
                               type="checkbox"
                               role="switch"
                               id="association"
                               name="association">
                        <label class="form-check-label" for="association">Association</label>
                    </div>

                    <button type="submit" class="btn btn-primary mb-3">envoyer</button>

                </form>
                <x-table :headers="['Nom', 'Description']"
                         :datas="$organizations"
                         :selected_data="['slug', 'description']"/>
            </div>
            <div class="col-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Club</th>
                        <th scope="col">Rôle</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($organization_members as $organization_member)
                        <tr>
                            <td>{{ $organization_member->member->first_name . " " . $organization_member->member->last_name }}</td>
                            <td>{{ $organization_member->organization->slug }}</td>
                            <td>{{ $organization_member->role }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
