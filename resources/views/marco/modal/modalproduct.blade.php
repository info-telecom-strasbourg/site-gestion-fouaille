
<!-- Modal -->
<form action="{{ route('marco.delete', ['id' => $data['id']]) }}">
    <div class="modal fade" id="ModalProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Attention</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> 
        </div>
        <div class="modal-body">
            Voulez vous vraiment supprimer {{ $data['name'] }}?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">{{ __('Annuler') }}</button>
            <button type="submit" class="btn btn-danger">{{ __('Supprimer') }}</button>
        </div>
        </div>
    </div>
    </div>
</form>