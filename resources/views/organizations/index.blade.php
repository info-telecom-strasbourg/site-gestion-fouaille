<x-layout>
    <div class="container mt-10">
        <div class="row">
            <div class="col-4">
                <x-table :headers="['Nom', 'Nom complet', 'Description']"
                         :datas="$organizations"
                         :selected_data="['slug', 'name', 'description']"/>
            </div>
            <div class="col-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Club</th>
                        <th scope="col">Rôle</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($organization_members as $organization_member)
                        <tr>
                            <td>{{ $organization_member->member->first_name . " " . $organization_member->member->last_name }}</td>
                            <td>{{ $organization_member->organization->slug }}</td>
                            <td>{{ $organization_member->role }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
