@php
$value = data_get($entry, $column['name']);
@endphp

<span>
    {{ $value === null || $value === '' ? '-' : $value }}
</span>