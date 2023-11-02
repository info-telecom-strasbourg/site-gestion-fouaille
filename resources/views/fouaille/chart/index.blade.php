@section('title', 'Fouaille - graph')

<x-layout>
    {!! $chart->container() !!}
    {!! $chart->script() !!}
</x-layout>
