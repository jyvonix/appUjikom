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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
            color: #1e293b;
            overflow-x: hidden;
            letter-spacing: -0.02em;
            transition: background-color 0.5s cubic-bezier(0.4, 0, 0.2, 1), color 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Dark Mode Global Styles */
        html.dark body {
            background-color: #020617;
            color: #f1f5f9;
        }

        /* Core Elements Text Visibility Fix */
        html.dark .text-slate-900, html.dark .text-slate-800, html.dark h1, html.dark h2, html.dark h3, html.dark h4 {
            color: #ffffff !important;
        }
        html.dark .text-slate-600, html.dark .text-slate-500, html.dark .text-slate-400 {
            color: #94a3b8 !important;
        }

        .bg-subtle {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: 
                radial-gradient(circle at 100% 0%, rgba(79, 70, 229, 0.04) 0%, transparent 40%),
                radial-gradient(circle at 0% 100%, rgba(168, 85, 247, 0.04) 0%, transparent 40%);
        }
        
        html.dark .bg-subtle {
            background: 
                radial-gradient(circle at 100% 0%, rgba(79, 70, 229, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 0% 100%, rgba(168, 85, 247, 0.08) 0%, transparent 50%);
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        html.dark .glass-nav {
            background: rgba(15, 23, 42, 0.7);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .card-pro {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.02), 0 4px 6px -2px rgba(0, 0, 0, 0.01);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        html.dark .card-pro {
            background: #0f172a;
            border-color: rgba(255, 255, 255, 0.05);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .card-pro:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            border-color: rgba(79, 70, 229, 0.2);
        }

        .text-indigo-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-premium {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-premium:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4);
        }

        .page-enter {
            animation: slideUpFade 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(79, 70, 229, 0.2); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(79, 70, 229, 0.4); }
    </style>
</head>
<body class="antialiased">
    <div class="bg-subtle"></div>

    @if(!($hideNav ?? false))
    <nav class="fixed top-0 left-0 right-0 z-[100] glass-nav h-16 md:h-20 flex items-center">
        <div class="max-w-7xl mx-auto px-6 md:px-10 w-full flex justify-between items-center">
            <div class="flex items-center gap-10"> 
                <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-2.5 group"> 
                    <img src="{{ asset('storage/image/images.png') }}" class="w-12 h-12 object-contain" alt="Logo">
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
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            customClass: {
                popup: 'rounded-[1.5rem] border-none shadow-2xl backdrop-blur-xl bg-white/90 p-4',
                title: 'text-sm font-black text-slate-800',
                htmlContainer: 'text-[11px] font-bold text-slate-500'
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if(session('success'))
            Toast.fire({ icon: 'success', title: 'Berhasil', text: '{{ session('success') }}', iconColor: '#3b82f6' });
        @endif

        @if(session('error'))
            Toast.fire({ icon: 'error', title: 'Gagal', text: '{{ session('error') }}', iconColor: '#f43f5e' });
        @endif

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