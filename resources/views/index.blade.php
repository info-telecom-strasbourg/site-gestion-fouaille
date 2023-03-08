@extends('components.base')
@section('title', 'Accueil')
@section('content')
    <div class="container-fluid">
        <div class="row g-20">
            <div class="col-4">
                <div class="card" >
                    <div class="card-body">
                        <h5 class="card-title">Dates</h5>
                        <form class="row g-2" action="getData" method="get">
                            @csrf
                            <div class="col-md-6 form-floating">
                                <input type="datetime-local" class="form-control" name="datestart" value={{ $current_date1 }} id="floatingSelect" aria-label="Floating label select example">
                                <label for="floatingSelect">Date de début</label>
                            </div>
                            <div class="col-md-6 form-floating">
                                <input type="datetime-local" class="form-control" name="dateend" value={{ $current_date2 }} id="floatingSelect" aria-label="Floating label select example">
                                <label for="floatingSelect">Date de fin</label>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title">Recette</h5>
                            <div class="alert alert-success" role="alert">Totale : {{ $total_commandes }}€</div>
                            <div class="alert alert-secondary" role="alert">Repas : {{ $total_repas }}€</div>
                            <div class="alert alert-secondary" role="alert">Boisson : {{ $total_boisson }}€</div>
                        </div>
                    </div>
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title">Rechargement</h5>
                            {{-- <div class="alert alert-warning" role="alert">Totale : {{ total_rechargement }}€</div> --}}
                        </div>
                    </div>
              </div>
            </div>
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Type de produit</th>
                            <th scope="col">Produit</th>
                            <th scope="col">Date</th>
                            <th scope="col">Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($peoples) == 0)
                        <tr>
                            <td colspan="7" class="text-center">Aucune donnée</td>
                        </tr>
                        @else
                            @foreach ($peoples as $data)
                            <tr>
                                <td>{{ $data->nom }}</td>
                                <td>{{ $data->prenom }}</td>
                                <td>{{ $data->prix }}</td>
                                <td>{{ $data->type_produit }}</td>
                                <td>{{ $data->produit }}</td>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->amount }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection