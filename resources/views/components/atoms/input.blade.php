@props(['type' => 'text', 'placeholder' => '', 'required' => false])

<input
    type="{{ $type }}"
    placeholder="{{ $placeholder }}"
    @if($required) required @endif
    {{ $attributes->merge([
        'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors'
    ]) }}
/>
