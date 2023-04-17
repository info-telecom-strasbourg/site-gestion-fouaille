@props(['headers', 'datas', 'selected_data'])

<table class="table {{ $attributes['class'] }}">
    <thead>
    <tr>
        @foreach($headers as $header)
            <th>{{ $header }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach($datas as $data)
        <tr>
            @foreach($selected_data as $selected)
                <td>{{ $data->$selected }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
