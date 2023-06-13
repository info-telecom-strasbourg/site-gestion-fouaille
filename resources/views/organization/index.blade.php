<x-layout>
    <div class="container mt-10">
       <x-error-toast/>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Acronyme</th>
                    <th scope="col">Description</th>
                    <th scope="col">Email</th>
                    <th scope="col"> Membres </th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    @php($organization = $data['organization'])
                    <tr>
                        <td>
                            {{ $organization->name}}
                        </td>
                        @if(isset($organization->acronym))
                            <td>{{ $organization->acronym }}</td>
                        @else
                            <td>pas d'acronyme</td>
                        @endif

                        @if(isset($organization->description))
                            <td>{{ $organization->description }}</td>
                        @else
                            <td>pas de description</td>
                        @endif

                        @if(isset($organization->email))
                            <td>{{$organization->email}}</td>
                        @else
                            <td>pas d'email</td>
                        @endif

                        <td>{{ $data['members'] }}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
