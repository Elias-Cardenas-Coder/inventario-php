@props(['type' => 'button', 'variant' => 'primary', 'size' => 'md', 'disabled' => false])

@php
    $baseClasses = 'font-light rounded-lg transition-all duration-300 inline-flex items-center justify-center';

    $variants = [
        'primary' => 'bg-slate-700 text-white hover:bg-slate-800 shadow-sm hover:shadow-md disabled:bg-slate-400',
        'secondary' => 'bg-slate-300 text-slate-800 hover:bg-slate-400 shadow-sm hover:shadow-md disabled:bg-slate-200',
        'danger' => 'bg-rose-300 text-rose-900 hover:bg-rose-400 shadow-sm hover:shadow-md disabled:bg-rose-200',
        'success' => 'bg-emerald-300 text-emerald-900 hover:bg-emerald-400 shadow-sm hover:shadow-md disabled:bg-emerald-200',
        'outline' => 'border-2 border-slate-400 text-slate-700 hover:bg-slate-50 hover:border-slate-500 disabled:border-slate-300 disabled:text-slate-400',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-base',
        'lg' => 'px-6 py-3 text-lg',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

<button
    type="{{ $type }}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</button>
