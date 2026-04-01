@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'nav-active text-white'
            : 'text-slate-500 hover:text-indigo-600 hover:bg-slate-50';

$iconSvg = [
    'dashboard' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />',
    'bank' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />',
    'results' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />',
    'analysis' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />',
];
@endphp

<a {{ $attributes->merge(['class' => 'group flex items-center p-3 rounded-2xl font-bold text-xs transition-all duration-300 ' . $classes]) }}>
    <div 
        class="flex items-center justify-center shrink-0 w-10 h-10 rounded-xl transition-all duration-300 {{ $active ? 'bg-white/20' : 'bg-slate-100 group-hover:bg-indigo-100/50 group-hover:text-indigo-600' }}"
        :class="sidebarOpen ? 'mr-3' : ''"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {!! $iconSvg[$icon] ?? '' !!}
        </svg>
    </div>
    <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0">
        {{ $slot }}
    </span>
    
    @if($active)
        <div x-show="sidebarOpen" class="ml-auto w-1.5 h-1.5 rounded-full bg-white shadow-[0_0_10px_#fff]"></div>
    @endif
</a>
