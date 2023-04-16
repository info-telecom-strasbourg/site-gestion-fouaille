<x-layout>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">
                    <a href="{{ request()
                                ->fullUrlWithQuery(['displayForHumans' => !request()->boolean('displayForHumans')])
                                }}"
                    >
                        Date
                    </a>
                </th>
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
                    <td>
                        {{ $commande->date }}
                    </td>
                    @if(isset($commande->member))
                        <td>{{ $commande->member->last_name }}</td>
                        <td>{{ $commande->member->first_name }}</td>
                    @else
                        <td>Membre supprimer</td>
                        <td>Membre supprimer</td>
                    @endif

                    @if(isset($commande->products))
                        <td>{{ $commande->products->name }}</td>
                    @else
                        <td>Produit supprimer</td>
                    @endif
                    <td>{{ $commande->price }}</td>
                    <td>{{ $commande->amount }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $commandes->links() }}
    </div>
</x-layout>
