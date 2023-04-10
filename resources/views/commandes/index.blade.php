<x-layout>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nom</th>
                <th scope="col">Produit</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantité</th>
            </tr>
            </thead>
            <tbody>
            @foreach($commandes as $commande)
                <tr>
                    <th scope="row">{{ $commande->id }}</th>
                    <td>{{ $commande->member->nickname }}</td>
                    <td>{{ $commande->products->name }}</td>
                    <td>{{ $commande->price }}</td>
                    <td>{{ $commande->amount }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
