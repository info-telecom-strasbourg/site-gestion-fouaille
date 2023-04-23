<x-layout>
    <div class="container mt-10">
        @if ($errors->any())
            <div class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                <div class="toast-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <script>
                var toast = document.querySelector('.toast');
                var toastInstance = new bootstrap.Toast(toast);
                toastInstance.show();
            </script>

        @endif
        <div class="row">
            <div class="col-7">
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
                                   required>
                        </div>
                    </div>
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control"
                              id="description"
                              name="description"
                              rows="4"
                              placeholder="Les BDE est l’association qui s’occupe de la vie étudiante
                              et anime tout la partie associative de l’écoles. Ses principales missions sont :">
                    </textarea>

                    <label for="website_link" class="form-label">Lien vers le site web</label>
                    <input type="text"
                           class="form-control"
                           id="website_link"
                           name="website_link"
                           placeholder="https://bde-tps.fr/">

                    <label for="facebook_link" class="form-label">Lien vers le facebook</label>
                    <input type="text"
                           class="form-control"
                           id="facebook_link"
                           name="facebook_link"
                           placeholder="https://www.facebook.com/bde.telecomps/">

                    <label for="twitter_link" class="form-label">Lien vers le twitter</label>
                    <input type="text"
                           class="form-control"
                           id="twitter_link"
                           name="twitter_link"
                           placeholder="https://www.twitter.com/bde.telecomps/">

                    <label for="instagram_link" class="form-label">Lien vers instagram</label>
                    <input type="text"
                           class="form-control"
                           id="instagram_link"
                           name="instagram_link"
                           placeholder="https://www.instagram.com/bde/">

                    <label for="discord_link" class="form-label">Lien vers le discord</label>
                    <input type="text"
                           class="form-control"
                           id="discord_link"
                           name="discord_link"
                           placeholder="https://www.discord.com/bde/">

                    <label for="logo_link" class="form-label">Lien vers le logo</label>
                    <input type="text"
                           class="form-control"
                           id="logo_link"
                           name="logo_link"
                           placeholder="https://www.serveur.com/bde.png/">

                    <div class="form-check">
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
            <div class="col-5">
                <form method="POST" action="organizationMember">
                    @csrf

                    <div class="row">
                        <div class="col">
                            <label for="id_member" class="form-label">Membre</label>
                            <select class="form-select"
                                    id="id_member"
                                    name="id_member">
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->last_name . " " . $member->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="id_organization" class="form-label">Organisation</label>
                            <select class="form-select"
                                    id="id_organization"
                                    name="id_organization">
                                @foreach($organizations as $organization)
                                    <option value="{{ $organization->id }}">{{ $organization->slug }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="role" class="form-label">Rôle</label>
                            <input type="text"
                                   class="form-control"
                                   id="role"
                                   name="role"
                                   placeholder="Président"
                                   required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">envoyer</button>
                </form>
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
