<x-layout>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">
                    <a href="#" class="pe-auto text-primary" onclick="changeDateFormat()">
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
                <tr id="commande-{{ $loop->index }}">
                    <td id="date-{{ $loop->index }}">
                        {{ $commande->date['diffForHumans'] }}
                    </td>
                    @if(isset($commande->member))
                        <td>{{ $commande->member->last_name }}</td>
                        <td>{{ $commande->member->first_name }}</td>
                    @else
                        <td>Membre supprimer</td>
                        <td>Membre supprimer</td>
                    @endif

                    @if(isset($commande->product))
                        <td>{{ $commande->product->name }}</td>
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
    <script>
        function changeDateFormat() {
            @foreach($commandes as $commande)
                var date = document.getElementById('commande-{{ $loop->index }}').children[0];
                if(date.innerHTML == '{{ $commande->date['original'] }}') {
                    date.innerHTML = '{{ $commande->date['diffForHumans'] }}';
                } else {
                    date.innerHTML = '{{ $commande->date['original'] }}';
                }
            @endforeach
        }
    </script>        
</x-layout>
