@props(['label', 'id' => null])

<div class="flex items-center">
    <input
        type="checkbox"
        @if($id) id="{{ $id }}" @endif
        {{ $attributes->merge(['class' => 'w-4 h-4 text-slate-600 rounded focus:ring-2 focus:ring-slate-500']) }}
    />
    <label
        @if($id) for="{{ $id }}" @endif
        class="ml-2 text-sm text-gray-700"
    >
        {{ $label }}
    </label>
</div>
