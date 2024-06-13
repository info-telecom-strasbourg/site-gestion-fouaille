@section('title', 'Marco')

<x-layout>
    @if(empty($data))
        <div class="alert alert-danger" role="alert">
            Aucune produit trouvé.
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Produits</h6>
            </div>
            <div class="card-body">
                <div class=" d-flex justify-content-between">
                    <a href="{{ route('marco.edit', ['id' => $data['id']]) }}" class="btn btn-primary btn-icon-split mb-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-pen"></i>
                    </span>
                    <span class="text">Mettre à jour</span>
                </a>
                <button type="button" class="btn btn-danger btn-icon-split mb-3" data-toggle="modal" data-target="#ModalProduct">
                    <span class="icon text-white-50">
                        <i class="fa-solid fa-trash-can"></i>
                    </span>
                    <span class="text">Supprimer</span>
                </button>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-2">
                                <strong class="text-primary">Id :</strong> {{ $data['id'] }}
                            </div>
                            <div class="col-4">
                                <strong class="text-primary">Nom :</strong> {{ $data['name'] }}
                            </div>
                            <div class="col-4">
                                <strong class="text-primary">Titre :</strong> {{ $data['title'] }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <strong class="text-primary">Type :</strong> {{ $data['type'] }}
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Couleur :</strong> <div class="p-3" style="background-color: {{ $data['color'] }}"></div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <strong class="text-primary">Prix :</strong> {{ $data['price'] }}
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Disponible :</strong> {!! $data['available'] !!}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    @endif
    @include('marco.modal.modalproduct')
</x-layout>
