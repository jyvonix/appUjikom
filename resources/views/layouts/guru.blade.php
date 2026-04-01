<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Teacher Panel | SmartExam Intelligence</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: -0.01em;
        }
        .glass-sidebar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: saturate(180%) blur(20px);
            border-right: 1px solid rgba(226, 232, 240, 0.8);
        }
        .nav-active {
            background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
        }
        .bg-mesh {
            position: fixed;
            inset: 0;
            z-index: -1;
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
        }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .swal-custom { border-radius: 2rem !important; }
    </style>
</head>
<body class="antialiased h-full overflow-hidden" x-data="{ sidebarOpen: true }">
    <div class="bg-mesh"></div>

    <div class="flex h-full overflow-hidden">
        <!-- Sidebar -->
        <aside 
            class="glass-sidebar flex-shrink-0 transition-all duration-500 ease-in-out relative z-40"
            :class="sidebarOpen ? 'w-72' : 'w-20'"
        >
            <div class="flex flex-col h-full">
                <!-- Logo Area -->
                <div class="p-6 flex items-center justify-between">
                    <div class="flex items-center gap-3 overflow-hidden" x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-200 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <div class="whitespace-nowrap">
                            <h2 class="text-sm font-black text-slate-800 uppercase tracking-tighter leading-none">Smart<span class="text-indigo-600">Exam</span></h2>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Teacher Suite</span>
                        </div>
                    </div>
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-xl hover:bg-slate-100 text-slate-400 hover:text-indigo-600 transition-colors">
                        <svg x-show="sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
                        <svg x-show="!sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/></svg>
                    </button>
                </div>

                <!-- Navigation -->
                <div class="flex-1 overflow-y-auto px-4 py-4 custom-scrollbar">
                    <div class="space-y-1">
                        <p x-show="sidebarOpen" class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 mt-2">Menu Utama</p>
                        
                        <x-nav-link-guru href="{{ route('guru.dashboard') }}" :active="request()->routeIs('guru.dashboard')" icon="dashboard">
                            Dashboard
                        </x-nav-link-guru>

                        <p x-show="sidebarOpen" class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 mt-8">Manajemen Ujian</p>
                        
                        <x-nav-link-guru href="{{ route('guru.soal.index') }}" :active="request()->routeIs('guru.soal.*') && !request()->routeIs('guru.soal.analisis')" icon="bank">
                            Bank Soal
                        </x-nav-link-guru>
                        
                        <x-nav-link-guru href="{{ route('guru.nilai.index') }}" :active="request()->routeIs('guru.nilai.*')" icon="results">
                            Hasil Ujian
                        </x-nav-link-guru>
                        
                        <x-nav-link-guru href="{{ route('guru.soal.analisis') }}" :active="request()->routeIs('guru.soal.analisis')" icon="analysis">
                            Analisis Soal
                        </x-nav-link-guru>
                    </div>
                </div>

                <!-- Footer User Profile -->
                <div class="p-4 mt-auto">
                    <div 
                        class="relative group p-3 rounded-[2rem] transition-all duration-500 ease-in-out border border-transparent hover:border-slate-200/60 hover:bg-white/50 hover:shadow-xl hover:shadow-slate-200/50 overflow-hidden"
                        :class="sidebarOpen ? 'bg-slate-50/50' : 'bg-transparent'"
                    >
                        <div class="flex items-center gap-3 relative z-10">
                            <!-- Avatar with Pulse Glow -->
                            <div class="relative shrink-0">
                                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-indigo-600 to-blue-500 flex items-center justify-center text-white font-black shadow-lg shadow-indigo-200 group-hover:scale-105 transition-transform duration-500">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 border-2 border-white rounded-full"></div>
                            </div>

                            <!-- User Info -->
                            <div class="overflow-hidden whitespace-nowrap" x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0">
                                <h4 class="text-[11px] font-black text-slate-800 truncate tracking-tight uppercase">{{ auth()->user()->name }}</h4>
                                <div class="flex items-center gap-1.5 mt-0.5">
                                    <span class="w-1 h-1 rounded-full bg-indigo-400"></span>
                                    <span class="text-[9px] font-bold text-indigo-500 uppercase tracking-widest">Verified Teacher</span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Profile Action Link (Optional) -->
                        <a href="{{ route('profile.edit') }}" x-show="sidebarOpen" class="absolute inset-0 z-0"></a>
                    </div>
                    
                    <div class="mt-4 px-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="group flex items-center justify-center w-full py-3 bg-white border border-slate-200 rounded-2xl text-slate-400 hover:text-rose-600 hover:border-rose-200 hover:bg-rose-50 hover:shadow-lg hover:shadow-rose-100 transition-all duration-500">
                                <svg class="w-5 h-5 transition-transform duration-500 group-hover:-translate-x-1" :class="sidebarOpen ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span x-show="sidebarOpen" class="text-[10px] font-black uppercase tracking-[0.2em]">Keluar Sistem</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col h-full overflow-hidden relative">
            <!-- Topbar / Header -->
            <header class="h-20 flex-shrink-0 flex items-center justify-between px-8 bg-white/50 backdrop-blur-md border-b border-slate-200/60 relative z-30">
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex flex-col">
                        <h1 class="text-sm font-black text-slate-800 tracking-tight">Portal Akademik Guru</h1>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sistem Manajemen Ujian Terpadu</p>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-3 pr-6 border-r border-slate-200">
                        <div class="text-right">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Sesi Aktif</p>
                            <p class="text-[11px] font-bold text-slate-800">{{ now()->format('l, d F Y') }}</p>
                        </div>
                        <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    
                    <a href="{{ route('profile.edit') }}" class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </a>
                </div>
            </header>

            <!-- Scrollable Content Section -->
            <main class="flex-1 overflow-y-auto p-8 custom-scrollbar relative z-20">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
                
                <!-- Footer Info -->
                <footer class="mt-20 pt-8 border-t border-slate-200 text-center">
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.4em]">SmartExam Intelligence &bull; Secured Guru Panel &bull; v2.4.0</p>
                </footer>
            </main>
        </div>
    </div>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true,
            customClass: {
                popup: 'swal-custom shadow-2xl border-none p-4',
                title: 'text-sm font-black text-slate-800',
                htmlContainer: 'text-[11px] font-bold text-slate-500'
            }
        });

        @if(session('success'))
            Toast.fire({ icon: 'success', title: 'Operasi Berhasil', text: '{{ session('success') }}', iconColor: '#4f46e5' });
        @endif
        @if(session('error'))
            Toast.fire({ icon: 'error', title: 'Terjadi Kesalahan', text: '{{ session('error') }}', iconColor: '#e11d48' });
        @endif
    </script>

    @stack('scripts')
</body>
</html>
