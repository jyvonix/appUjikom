@php
    $navs = [
        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25'],
        ['route' => 'admin.guru.index', 'label' => 'Tenaga Pendidik', 'icon' => 'M4.26 10.174L2.858 14.51c-.135.415.211.815.648.815h16.988c.437 0 .783-.4.648-.815l-1.402-4.336c-.149-.46-.616-.763-1.1-.763H5.358c-.483 0-.95.303-1.1.763z M18 19.5v-3m-6 3v-3m-6 3v-3M21 15v3.75A2.25 2.25 0 0118.75 21H5.25A2.25 2.25 0 013 18.75V15'],
        ['route' => 'admin.siswa.index', 'label' => 'Peserta Didik', 'icon' => 'M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z'],
        ['route' => 'admin.nilai.index', 'label' => 'Laporan Nilai', 'icon' => 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z'],
    ];
@endphp

@foreach($navs as $nav)
<li>
    <a href="{{ route($nav['route']) }}" class="{{ request()->routeIs($nav['route']) ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-600 hover:text-blue-600 hover:bg-slate-50' }} group flex gap-x-3 rounded-2xl p-4 text-sm font-black leading-6 transition-all">
        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs($nav['route']) ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $nav['icon'] }}" /></svg>
        {{ $nav['label'] }}
    </a>
</li>
@endforeach
