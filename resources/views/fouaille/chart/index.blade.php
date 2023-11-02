@section('title', 'Fouaille - graph')

<x-layout>
    <a href="{{ route('fouaille.index', request()->all()) }}" class="btn btn-primary mb-3">Back</a>
    @if(!$is_data)
        <div class="alert alert-danger" role="alert">
            No data to display
        </div>
    @else
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-primary">{{ $start_at }} / {{ $end_at }}</h5>
            </div>
            <div class="card-body">
                {!! $chart->container() !!}
                {!! $chart->script() !!}
            </div>
        </div>
    @endif
</x-layout>
