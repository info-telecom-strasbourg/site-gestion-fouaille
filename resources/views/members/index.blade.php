<x-layout>
    <div class="container">
        <x-table :headers="['Id', 'Nom', 'Prenom', 'Surnom', 'Numéro carte', 'Solde']"
                 :datas="$members"
                 :selected_data="['id', 'last_name','first_name','nickname','card_number','balance']"/>
        {{ $members->links() }}
    </div>
</x-layout>
