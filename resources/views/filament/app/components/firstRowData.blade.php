@php
$data = json_decode($rowData, true);
// foreach ($data as $key => $value) {
// // $dataKey[] = $key;
// <p>$key</p>
// }
// // dd(array_keys($data));
// dd($dataKey);
@endphp

<div>
    <ol class="OrderedDataList">
        @foreach ($data as $key => $value)
        <li class="listData">
            <div class="data-container" id="data-container"  key="{{ $key }}" value="{{ $value }}">
            </div>
            {{ $key }} : {{ $value }}
            <div class="btn">
            <button class="remove-btn" style="margin-right: 10px; color: red; cursor: pointer;" data-key="{{ $key }}" data-value="{{ $value }}">
                X
            </button>
            </div>
        </li>
        @endforeach
    </ol>
</div>