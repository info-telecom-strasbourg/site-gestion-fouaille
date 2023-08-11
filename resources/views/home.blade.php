@section('title', 'Home')

<x-layout>
    <h1>Home</h1>

    @if(cas()->isAuthenticated())
        <p>Vous êtes connecté en tant que {{ cas()->user() }}.</p>
        <a href="{{ route('logout') }}">Se déconnecter</a>
    @else
        <p>Vous n'êtes pas connecté.</p>
        <a href="{{ route('login') }}">Se connecter</a>
    @endif

    @if(session()->has('failed') && session()->get('failed') == true)
        <div class="alert alert-danger" role="alert">
            <p>{{ session()->get('message') }}</p>
        </div>
        @php(session()->forget('message'))
        @php(session()->forget('failed'))
    @elseif(session()->has('failed') && session()->get('failed') == false)
        <div class="alert alert-success" role="alert">
            <p>{{ session()->get('message') }}</p>
        </div>
        @php(session()->forget('message'))
        @php(session()->forget('failed'))
    @endif


</x-layout>
