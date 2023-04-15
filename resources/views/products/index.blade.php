<x-layout>
    <div class="container mt-10">
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

                    @error('new_type')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror

                    <div class="col">
                        <button type="submit" class="btn btn-primary mb-3">envoyer</button>
                    </div>
                </form>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Type de produit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product_types as $product_type)
                        <tr>
                            <td>{{ $product_type->type }}</td>
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
                        <input type="number"
                               step=0.01
                               class="form-control"
                               id="price"
                               name="price"
                               placeholder="Prix"
                               required>
                    </div>
                    <div class="col">
                        <select class="form-select"
                                id="type"
                                name="type"
                                aria-label="Default select example"
                                required>
                            <option selected>type</option>
                            @foreach($product_types as $product_type)
                                <option value="{{ $product_type->type }}">
                                    {{ $product_type->type }}
                                </option>
                            @endforeach
                        </select>
                        @error('name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror

                        @error('price')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror

                        @error('type')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary mb-3">envoyer</button>
                    </div>
                </form>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prix par défault</th>
                        <th scope="col">Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->product_type }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
