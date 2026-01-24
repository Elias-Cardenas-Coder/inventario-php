@props(['title' => '', 'class' => ''])

<div {{ $attributes->merge(['class' => 'bg-white/40 backdrop-blur-sm rounded-2xl shadow-sm border border-slate-200/50 p-8 hover:shadow-md transition-all duration-300 ' . $class]) }}>
    @if($title)
        <h2 class="text-2xl font-light text-slate-700 mb-4 tracking-wide">{{ $title }}</h2>
    @endif
    {{ $slot }}
</div>
