@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-4 pe-4 py-3 border-l-4 border-amber-400 text-start text-base font-semibold text-amber-100 bg-white/5 focus:outline-none focus:bg-amber-400/10 focus:border-amber-300 transition duration-150 ease-in-out'
            : 'block w-full ps-4 pe-4 py-3 border-l-4 border-transparent text-start text-base font-semibold text-slate-200 hover:text-white hover:bg-white/5 hover:border-amber-300/40 focus:outline-none focus:bg-white/10 focus:border-amber-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
