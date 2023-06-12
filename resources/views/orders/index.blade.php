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
            @foreach($orders as $order)
                <tr id="commande-{{ $loop->index }}">
                    <td id="date-{{ $loop->index }}">
                        {{ $order->date['diffForHumans'] }}
                    </td>
                    @if(isset($order->member))
                        <td>{{ $order->member->last_name }}</td>
                        <td>{{ $order->member->first_name }}</td>
                    @else
                        <td>Membre supprimer</td>
                        <td>Membre supprimer</td>
                    @endif

                    @if(isset($order->product))
                        <td>{{ $order->product->name }}</td>
                    @else
                        <td>Produit supprimer</td>
                    @endif
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->amount }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
    <script>
        function changeDateFormat() {
            @foreach($orders as $order)
                var date = document.getElementById('commande-{{ $loop->index }}').children[0];
                if(date.innerHTML == '{{ $order->date['original'] }}') {
                    date.innerHTML = '{{ $order->date['diffForHumans'] }}';
                } else {
                    date.innerHTML = '{{ $order->date['original'] }}';
                }
            @endforeach
        }
    </script>
</x-layout>
