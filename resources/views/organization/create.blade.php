<x-layout>
    <div class="container">
        <form method="POST" action="organization/store">
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
                    <label for="slug" class="form-label">Acronyme</label>
                    <input type="text"
                           class="form-control"
                           id="acronym"
                           name="acronym"
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
    </div>
</x-layout>
