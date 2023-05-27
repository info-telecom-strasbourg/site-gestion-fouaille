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
        <div class="row">
            <div class="col-4">
                <form class="row" method="POST" action="productType">
                    @csrf
                    <div class="col">
                        <input type="text"
                               class="form-control"
                               id="type"
                               name="type"
                               placeholder="type"
                               required>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-primary mb-3">envoyer</button>
                    </div>
                </form>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Type de produit</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product_types as $product_type)
                        <tr>
                            <td>{{ $product_type->type }}</td>
                            <td>
                                <form method="POST" action="productType/{{ $product_type->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-8">
                <form class="row" method="POST" action="product">
                    @csrf
                    <div class="col">
                        <input type="text"
                               class="form-control"
                               id="name"
                               name="name"
                               placeholder="Nom"
                               required>
                    </div>
                    <div class="col">
                        <input type="text"
                               class="form-control"
                               id="slug"
                               name="slug"
                               placeholder="Titre"
                               required>
                    </div>
                    <div class="col">
                        <input type="number"
                               step=0.01
                               class="form-control"
                               id="price"
                               name="price"
                               placeholder="Prix"
                               required>
                    </div>
                    <div class="col">
                        <input type="color"
                               class="form-control"
                               id="color"
                               name="color"
                               placeholder="Couleur"
                               required>
                    </div>
                    <div class="col">
                        <select class="form-select"
                                id="id_product_type"
                                name="id_product_type"
                                aria-label="Default select example"
                                required>
                            <option selected>type</option>
                            @foreach($product_types as $product_type)
                                <option value="{{ $product_type->id }}">
                                    {{ $product_type->type }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary mb-3">envoyer</button>
                    </div>
                </form>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Prix par défault</th>
                        <th scope="col">Type</th>
                        <th scope="col">Couleur</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->slug }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->productType->type }}</td>
                            <td><p style="color: {{ $product->color }}">{{ $product->color }}</p></td>
                            <td>
                                <form method="POST" action="product/{{ $product->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger"
                                    >
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
