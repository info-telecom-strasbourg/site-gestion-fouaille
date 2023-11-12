<form method="GET" action="{{ route(request()->route()->getName()) }}" class="mb-3">

    @CSRF

    @method('GET')

    @foreach(request()->query() as $key => $value)
        @if($key !== 'search' && $key !== '_token')
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endif
    @endforeach

    <div class="form-row">
        <div class="col">
            <input type="text"
                   class="form-control"
                   name="search"
                   placeholder="Rechercher"
                   value="{{ request('search') != null ? request('search') : '' }}"
            >
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </div>

</form>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        @foreach($headers as $key => $value)
            <th>
                {{ $value }}
                @if(isset(request()->order_by) && request()->order_by == $key)
                    @if(isset(request()->order_direction) && request()->order_direction == 'asc')
                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), ['order_by' => $key, 'order_direction' => 'desc'])) }}">
                            <i class="fas fa-sort-up"/>
                        </a>
                    @else
                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), ['order_by' => $key, 'order_direction' => 'asc'])) }}">
                            <i class="fas fa-sort-down"/>
                        </a>
                    @endif
                @else
                    <a href="{{ route(
                        request()->route()->getName(),
                        array_merge(request()->all(),
                        ['order_by' => $key, 'order_direction' => 'asc'])) }}"
                    >
                        <i class="fas fa-sort"/>
                    </a>
                @endif
            </th>
        @endforeach
        </thead>
        <tbody>
        @foreach($datas as $data)
            <tr>
                @foreach($data as $key => $value)
                    @if(is_array($value))
                        <td>
                            @foreach($value as $key2 => $value2)
                                @if($key2 != 'redirect_route')
                                    <a href="{{ $value['redirect_route'] }}">
                                        {!! $value2 !!}
                                    </a>
                                @endif
                            @endforeach
                        </td>
                    @else
                        @if($key != 'id')
                            <td>{!! $value !!}</td>
                        @endif
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    {!!  $pagination !!}
</div>
