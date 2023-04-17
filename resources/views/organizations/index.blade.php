<x-layout>
    <div class="container mt-10">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th>Nom complet</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($organizations as $organisation)
                        <tr>
                            <td>{{ $organisation->slug }}</td>
                            <td>{{ $organisation->name }}</td>
                            <td>{{ $organisation->description }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
