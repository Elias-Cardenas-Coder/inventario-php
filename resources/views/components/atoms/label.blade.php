@props(['label', 'id' => null, 'required' => false])

<label
    @if($id) for="{{ $id }}" @endif
    {{ $attributes->merge(['class' => 'block text-sm font-medium text-gray-700 mb-2']) }}
>
    {{ $label }}
    @if($required)
        <span class="text-red-600">*</span>
    @endif
</label>
