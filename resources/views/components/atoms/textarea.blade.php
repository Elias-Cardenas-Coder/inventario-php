@props(['placeholder' => '', 'rows' => 4, 'required' => false])

<textarea
    rows="{{ $rows }}"
    placeholder="{{ $placeholder }}"
    @if($required) required @endif
    {{ $attributes->merge([
        'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors resize-none'
    ]) }}
></textarea>
