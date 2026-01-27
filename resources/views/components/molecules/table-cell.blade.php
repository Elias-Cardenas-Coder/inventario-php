@props(['align' => 'left'])

@php
    $alignClass = match($align) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left'
    };
@endphp

<td class="px-6 py-4 border-b border-slate-100 text-sm text-slate-600 {{ $alignClass }}">
    {{ $slot }}
</td>
