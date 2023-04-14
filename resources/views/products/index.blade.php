<x-layout>
    <div class="container mt-10">
        <div class="row">
            <div class="col-4">
                <form class="row">
                    <div class="col">
                        <label for="new_type" class="visually-hidden">type</label>
                        <input type="text" class="form-control" id="new_type" placeholder="type">
                    </div>
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
                <form class="row">
                    <div class="col">
                        <label for="new_type" class="visually-hidden">type</label>
                        <input type="text" class="form-control" id="new_type" placeholder="Nom">
                    </div>
                    <div class="col">
                        <label for="new_type" class="visually-hidden">type</label>
                        <input type="text" class="form-control" id="new_type" placeholder="Prix">
                    </div>
                    <div class="col">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>type</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
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
