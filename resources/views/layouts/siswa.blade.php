<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .header-blur { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(226, 232, 240, 0.8); }
        .primary-blue-gradient { background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); }
    </style>
</head>
<body class="antialiased text-slate-800">
    {{-- Logika sembunyi navbar menggunakan variabel hideNav yang dipassing dari component --}}
    @if(!($hideNav ?? false))
    <nav class="header-blur sticky top-0 z-50 h-20 md:h-24 flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex justify-between items-center">
            <div class="flex items-center gap-6 lg:gap-12"> 
                <div class="flex items-center gap-4"> 
                    <div class="w-10 h-10 md:w-12 md:h-12 primary-blue-gradient rounded-2xl flex items-center justify-center shadow-xl shadow-blue-100 flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="text-lg md:text-xl font-black tracking-widest text-blue-950 uppercase select-none">E-Learning</span>
                </div>
                <div class="hidden md:flex items-center gap-2">
                    <a href="{{ route('siswa.dashboard') }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('siswa.dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-600' }}">Dashboard</a>
                    <a href="{{ route('siswa.soal.index') }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('siswa.soal.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-600' }}">Daftar Soal</a>
                </div>
            </div>
            <div class="flex items-center gap-4 md:gap-6">
                <div class="text-right hidden sm:block border-r pr-4 border-slate-200">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-tighter leading-none mb-1">Siswa</p>
                    <p class="text-sm font-extrabold text-blue-950 leading-none">{{ Auth::user()->name }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2.5 md:p-3 rounded-2xl bg-white text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-all border border-slate-200 hover:border-rose-100 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    @endif

    {{-- Container Utama harus tetap ada agar dashboard tidak rusak --}}
    <main class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 {{ ($hideNav ?? false) ? 'pt-4' : 'pt-8 md:pt-12' }} pb-20">
        {{ $slot }}
    </main>

    @if(!($hideNav ?? false))
    <footer class="py-10 text-center text-slate-400 text-xs font-medium border-t border-slate-100">
        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </footer>
    @endif

    @stack('scripts')
</body>
</html>