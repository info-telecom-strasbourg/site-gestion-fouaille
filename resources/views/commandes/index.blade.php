@foreach($commandes as $commande)
    <p>{{ $commande->member->last_name }}</p>
@endforeach
