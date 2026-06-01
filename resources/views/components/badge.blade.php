@props(['type' => 'success'])

@php
    $styles = [
        'success' => 'bg-green-100 text-success',
        'warning' => 'bg-yellow-100 text-warning',
        'danger' => 'bg-red-100 text-danger',
    ];
@endphp

<span class="px-3 py-1 text-xs rounded-full {{ $styles[$type] }}">
    {{ $slot }}
</span>