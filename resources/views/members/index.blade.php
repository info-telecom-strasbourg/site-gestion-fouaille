<x-layout>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Surnom</th>
                <th scope="col">Numéro carte</th>
                <th scope="col">Solde</th>
            </tr>
            </thead>
            <tbody>
            @foreach($members as $member)
                <tr>
                    <td> {{ $member->id }} </td>
                    <td>{{ $member->last_name }}</td>
                    <td>{{ $member->first_name }}</td>
                    <td>{{ $member->nickname }}</td>
                    <td>{{ $member->card_number }}</td>
                    <td>{{ $member->balance }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $members->links() }}
    </div>
</x-layout>
