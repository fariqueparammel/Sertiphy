@php
    $data = json_decode($rowData, true);
    // foreach ($data as $key => $value) {
    //     // $dataKey[] = $key;
    //     <p>$key</p>
    // }
    // // dd(array_keys($data));
    // dd($dataKey);
@endphp

<div>
    <ol class="OrderedDataList">
        @foreach ($data as $key => $value)
            <li class="listData">
                <div id="data-container" style="display: none;" key="{{ $key }}" value="{{ $value }}">
                </div>
                {{ $key }} : {{ $value }}
            </li>
        @endforeach
    </ol>
</div>
