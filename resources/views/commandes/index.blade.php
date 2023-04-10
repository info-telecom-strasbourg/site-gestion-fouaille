<x-layout>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Produit</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantité</th>
            </tr>
            </thead>
            <tbody>
            @foreach($commandes as $commande)
                <tr>
                    <th scope="row">{{ $commande->date }}</th>
                    <td>{{ $commande->member->last_name }}</td>
                    <td>{{ $commande->member->first_name }}</td>
                    <td>{{ $commande->products->name }}</td>
                    <td>{{ $commande->price }}</td>
                    <td>{{ $commande->amount }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
