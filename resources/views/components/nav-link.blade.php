@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold leading-5 text-amber-200 bg-white/10 border border-amber-400/40 shadow-glow focus:outline-none focus:ring-2 focus:ring-amber-400/50 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold leading-5 text-slate-300 border border-transparent hover:text-white hover:border-amber-300/40 hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-amber-400/40 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
