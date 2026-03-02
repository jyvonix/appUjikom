@php
    $navs = [
        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25'],
        ['route' => 'admin.guru.index', 'label' => 'Tenaga Pendidik', 'icon' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z'],
        ['route' => 'admin.siswa.index', 'label' => 'Peserta Didik', 'icon' => 'M4.26 10.174L2.858 14.51c-.135.415.211.815.648.815h16.988c.437 0 .783-.4.648-.815l-1.402-4.336c-.149-.46-.616-.763-1.1-.763H5.358c-.483 0-.95.303-1.1.763z M18 19.5v-3m-6 3v-3m-6 3v-3M21 15v3.75A2.25 2.25 0 0118.75 21H5.25A2.25 2.25 0 013 18.75V15'],
        ['route' => 'admin.soal.index', 'label' => 'Bank Soal', 'icon' => 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25'],
        ['route' => 'admin.nilai.index', 'label' => 'Laporan Nilai', 'icon' => 'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z'],
    ];
@endphp

@foreach($navs as $nav)
<li>
    <a href="{{ route($nav['route']) }}" class="{{ request()->routeIs($nav['route']) ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} group flex gap-x-3 rounded-md p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs($nav['route']) ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $nav['icon'] }}" /></svg>
        {{ $nav['label'] }}
    </a>
</li>
@endforeach
