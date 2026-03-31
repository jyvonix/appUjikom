<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SmartExam - Student Intelligence</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Theme Logic --}}
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f8fafc;
            color: #334155;
            overflow-x: hidden;
            letter-spacing: -0.015em;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Dark Mode Global Styles */
        html.dark body {
            background-color: #020617;
            color: #f1f5f9;
        }

        html.dark .glass-nav {
            background: rgba(15, 23, 42, 0.8);
            border-bottom: 1px solid rgba(30, 41, 59, 0.6);
        }

        html.dark .bg-white, html.dark .bg-white\/90 {
            background-color: #0f172a !important;
            border-color: #1e293b !important;
        }

        html.dark .text-slate-900, html.dark .text-slate-800 {
            color: #f8fafc !important;
        }

        html.dark .text-slate-500, html.dark .text-slate-400 {
            color: #94a3b8 !important;
        }

        html.dark .bg-slate-50, html.dark .bg-slate-50\/30 {
            background-color: #1e293b !important;
        }

        html.dark .border-slate-100, html.dark .border-slate-50 {
            border-color: #1e293b !important;
        }

        html.dark .card-pro {
            background: #0f172a;
            border-color: #1e293b;
        }

        html.dark .bg-subtle {
            background: 
                radial-gradient(circle at 100% 0%, rgba(79, 70, 229, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 0% 100%, rgba(124, 58, 237, 0.05) 0%, transparent 40%);
        }
        
        .bg-subtle {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: 
                radial-gradient(circle at 100% 0%, rgba(37, 99, 235, 0.03) 0%, transparent 40%),
                radial-gradient(circle at 0% 100%, rgba(59, 130, 246, 0.02) 0%, transparent 40%);
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: saturate(180%) blur(12px);
            -webkit-backdrop-filter: saturate(180%) blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        }
        .card-pro {
            background: #ffffff;
            border: 1px solid rgba(241, 245, 249, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.01);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-pro:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            border-color: rgba(37, 99, 235, 0.1);
        }
        .text-blue-gradient {
            background: linear-gradient(to right, #1e40af, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .page-enter {
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Optimized for Mobile Touch */
        .touch-action-none { touch-action: none; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="antialiased">
    <div class="bg-subtle"></div>

    @if(!($hideNav ?? false))
    <nav class="fixed top-0 left-0 right-0 z-[100] glass-nav h-16 md:h-20 flex items-center">
        <div class="max-w-7xl mx-auto px-6 md:px-10 w-full flex justify-between items-center">
            <div class="flex items-center gap-10"> 
                <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-2.5 group"> 
                    <img src="{{ asset('storage/image/images.png') }}" class="w-8 h-8 object-contain" alt="Logo">
                    <span class="text-lg font-bold tracking-tight text-slate-900 hidden sm:inline">Smart<span class="text-blue-600">Exam</span></span>
                </a>
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('siswa.dashboard') }}" class="px-4 py-2 rounded-xl text-[13px] font-semibold transition-all {{ request()->routeIs('siswa.dashboard') ? 'text-blue-600 bg-blue-50' : 'text-slate-500 hover:text-blue-600 hover:bg-slate-50' }}">Dashboard</a>
                    <a href="{{ route('siswa.soal.index') }}" class="px-4 py-2 rounded-xl text-[13px] font-semibold transition-all {{ request()->routeIs('siswa.soal.*') ? 'text-blue-600 bg-blue-50' : 'text-slate-500 hover:text-blue-600 hover:bg-slate-50' }}">Ujian</a>
                    <a href="{{ route('siswa.nilai.index') }}" class="px-4 py-2 rounded-xl text-[13px] font-semibold transition-all {{ request()->routeIs('siswa.nilai.*') ? 'text-blue-600 bg-blue-50' : 'text-slate-500 hover:text-blue-600 hover:bg-slate-50' }}">Riwayat</a>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                {{-- Theme Toggle --}}
                <button id="theme-toggle-global" type="button" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-500 hover:bg-blue-50 hover:text-blue-600 transition-all border border-slate-100 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-400">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>

                <div class="hidden sm:flex flex-col text-right pr-4 border-r border-slate-100">
                    <span class="text-[13px] font-bold text-slate-800 leading-none">{{ Auth::user()->name }}</span>
                    <span class="text-[10px] font-medium text-slate-400 uppercase tracking-widest mt-1">Student</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:text-rose-500 hover:bg-rose-50 transition-all border border-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    @endif

    <main class="w-full max-w-7xl mx-auto px-6 md:px-10 {{ ($hideNav ?? false) ? 'pt-6' : 'pt-24 md:pt-32' }} pb-32 page-enter">
        {{ $slot }}
    </main>

    {{-- Luxury Bottom Tab for Mobile --}}
    @if(!($hideNav ?? false))
    <div class="md:hidden fixed bottom-8 left-1/2 -translate-x-1/2 z-[100] w-[90%] max-w-[360px]">
        <div class="bg-white/90 backdrop-blur-xl rounded-[2rem] p-2 flex items-center justify-between shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-slate-100">
            <a href="{{ route('siswa.dashboard') }}" class="flex-1 flex flex-col items-center gap-1.5 py-3 rounded-2xl transition-all {{ request()->routeIs('siswa.dashboard') ? 'text-blue-600 bg-blue-50' : 'text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="text-[10px] font-bold uppercase tracking-tight">Home</span>
            </a>
            <a href="{{ route('siswa.soal.index') }}" class="flex-1 flex flex-col items-center gap-1.5 py-3 rounded-2xl transition-all {{ request()->routeIs('siswa.soal.*') ? 'text-blue-600 bg-blue-50' : 'text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="text-[10px] font-bold uppercase tracking-tight">Exam</span>
            </a>
            <a href="{{ route('siswa.nilai.index') }}" class="flex-1 flex flex-col items-center gap-1.5 py-3 rounded-2xl transition-all {{ request()->routeIs('siswa.nilai.*') ? 'text-blue-600 bg-blue-50' : 'text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-[10px] font-bold uppercase tracking-tight">History</span>
            </a>
        </div>
    </div>
    @endif

    @stack('scripts')
    <script>
        const themeToggleGlobalBtn = document.getElementById('theme-toggle-global');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Sync icons on load
        if (document.documentElement.classList.contains('dark')) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        themeToggleGlobalBtn.addEventListener('click', function() {
            // toggle icons
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
</body>
</html>