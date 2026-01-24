@props(['label' => ''])

<div {{ $attributes->merge(['class' => 'mb-6']) }}>
    @if($label)
        <h3 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-200">{{ $label }}</h3>
    @endif
    {{ $slot }}
</div>
