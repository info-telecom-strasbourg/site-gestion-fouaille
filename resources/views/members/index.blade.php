<x-layout>
    <div class="container">
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
        <form method="POST" action="member">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="last_name" class="form-label">Nom</label>
                    <input type="text"
                           class="form-control"
                           id="last_name"
                           name="last_name"
                           placeholder="Bergamini"
                           required>
                </div>
                <div class="col">
                    <label for="first_name" class="form-label">Prénom</label>
                    <input type="text"
                           class="form-control"
                           id="first_name"
                           name="first_name"
                           placeholder="Enzo"
                           required>
                </div>
                <div class="col">
                    <label for="nickname" class="form-label">Surnom</label>
                    <input type="text"
                           class="form-control"
                           id="nickname"
                           name="nickname"
                           placeholder="zozo">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="card_number" class="form-label">Numéro de carte</label>
                    <input type="number"
                           class="form-control"
                           id="card_number"
                           name="card_number"
                           placeholder="123456789">
                </div>
                <div class="col">
                    <label for="email" class="form-label">email</label>
                    <input type="email"
                           class="form-control"
                           id="email"
                           name="email"
                           placeholder="email@gmail.com">
                </div>
                <div class="col">
                    <label for="phone_number" class="form-label">Numéro de téléphone</label>
                    <input type="tel"
                           class="form-control"
                           id="phone_number"
                           name="phone_number"
                           pattern="^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$"
                           placeholder="0606060606">
            </div>
            <div class="row">
                <div class="col">
                    <label for="class" class="form-label">Promotion</label>
                    <input type="number"
                           class="form-control"
                           id="class"
                           name="class"
                           value="{{ date('Y') }}">
                </div>
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               role="switch"
                               id="contributor"
                               name="contributor"
                               checked>
                        <label class="form-check-label" for="contributor">Cotisant</label>
                    </div>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary mb-3">envoyer</button>
                </div>
            </div>
        </form>
        <x-table :headers="['Id', 'Nom', 'Prenom', 'Surnom', 'Numéro carte', 'Solde']"
                 :datas="$members"
                 :selected_data="['id', 'last_name','first_name','nickname','card_number','balance']"/>
        {{ $members->links() }}
    </div>
</x-layout>
