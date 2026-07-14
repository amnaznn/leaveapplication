@props(['active'])

@php
// Use text-slate-900 for high visibility and font-bold for prominence
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-bold leading-5 text-slate-900 dark:text-white focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-bold leading-5 text-slate-900 dark:text-slate-400 hover:text-indigo-600 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>