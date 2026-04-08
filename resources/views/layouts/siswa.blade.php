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
            color: #f8fafc;
        }

        /* Core Elements Text Visibility Refinement */
        html.dark .text-slate-900, html.dark .text-slate-800 { color: #f8fafc; }
        html.dark .text-slate-600, html.dark .text-slate-500 { color: #94a3b8; }

        .bg-subtle {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: 
                radial-gradient(circle at 100% 0%, rgba(79, 70, 229, 0.03) 0%, transparent 40%),
                radial-gradient(circle at 0% 100%, rgba(168, 85, 247, 0.03) 0%, transparent 40%);
        }
        
        html.dark .bg-subtle {
            background: 
                radial-gradient(circle at 100% 0%, rgba(79, 70, 229, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 0% 100%, rgba(168, 85, 247, 0.06) 0%, transparent 50%);
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        html.dark .glass-nav {
            background: rgba(2, 6, 23, 0.7);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .card-pro {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.04);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        html.dark .card-pro {
            background: rgba(15, 23, 42, 0.4);
            border-color: rgba(255, 255, 255, 0.05);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.3);
        }

        .card-pro:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            border-color: rgba(79, 70, 229, 0.1);
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

        /* Custom Mobile Nav Styles */
        .mobile-dock {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
        html.dark .mobile-dock {
            background: rgba(15, 23, 42, 0.8);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="antialiased">
    <div class="bg-subtle"></div>

    @if(!($hideNav ?? false))
    <nav class="fixed top-0 left-0 right-0 z-[100] glass-nav h-16 md:h-20 flex items-center">
        <div class="max-w-7xl mx-auto px-4 md:px-10 w-full flex justify-between items-center">
            <div class="flex items-center gap-8"> 
                <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-2.5 group"> 
                    <img src="{{ asset('storage/image/images.png') }}" class="w-10 h-10 md:w-12 md:h-12 object-contain" alt="Logo">
                    <span class="text-base md:text-lg font-black tracking-tighter dark:text-white">SMART<span class="text-indigo-600">EXAM</span></span>
                </a>
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('siswa.dashboard') }}" class="px-5 py-2 rounded-xl text-[13px] font-bold transition-all {{ request()->routeIs('siswa.dashboard') ? 'text-indigo-600 bg-indigo-50 dark:bg-indigo-500/10' : 'text-slate-500 hover:text-indigo-600 hover:bg-slate-50 dark:hover:bg-slate-800' }}">Dashboard</a>
                    <a href="{{ route('siswa.soal.index') }}" class="px-5 py-2 rounded-xl text-[13px] font-bold transition-all {{ request()->routeIs('siswa.soal.*') ? 'text-indigo-600 bg-indigo-50 dark:bg-indigo-500/10' : 'text-slate-500 hover:text-indigo-600 hover:bg-slate-50 dark:hover:bg-slate-800' }}">Ujian</a>
                    <a href="{{ route('siswa.nilai.index') }}" class="px-5 py-2 rounded-xl text-[13px] font-bold transition-all {{ request()->routeIs('siswa.nilai.*') ? 'text-indigo-600 bg-indigo-50 dark:bg-indigo-500/10' : 'text-slate-500 hover:text-indigo-600 hover:bg-slate-50 dark:hover:bg-slate-800' }}">Riwayat</a>
                </div>
            </div>
            
            <div class="flex items-center gap-2 md:gap-4">
                {{-- Theme Toggle --}}
                <button id="theme-toggle-global" type="button" class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center rounded-xl bg-white dark:bg-slate-800 text-slate-500 hover:text-indigo-600 transition-all border border-slate-200 dark:border-slate-700 shadow-sm">
                    <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>

                <div class="hidden sm:flex flex-col text-right pr-4 border-r border-slate-200 dark:border-slate-700">
                    <span class="text-[13px] font-black text-slate-800 dark:text-white leading-none">{{ Auth::user()->name }}</span>
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Authorized User</span>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" id="logout-form-siswa">
                    @csrf
                    <button type="button" 
                        onclick="event.preventDefault(); 
                            Swal.fire({
                                title: 'Akhiri Sesi?',
                                text: 'Anda akan keluar dari aplikasi secara aman.',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Ya, Keluar',
                                cancelButtonText: 'Batal',
                                reverseButtons: true,
                                background: document.documentElement.classList.contains('dark') ? '#020617' : '#fff',
                                color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b',
                                customClass: {
                                    popup: 'rounded-[2rem] border border-white/10 shadow-2xl',
                                    confirmButton: 'bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-2xl font-bold uppercase tracking-widest text-[10px] shadow-lg shadow-indigo-500/20 ml-3',
                                    cancelButton: 'bg-slate-100 dark:bg-white/5 text-slate-400 px-8 py-3 rounded-2xl font-bold uppercase tracking-widest text-[10px]'
                                },
                                buttonsStyling: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('logout-form-siswa').submit();
                                }
                            });"
                        class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center rounded-xl bg-white dark:bg-slate-800 text-slate-400 hover:text-rose-500 transition-all border border-slate-200 dark:border-slate-700 shadow-sm">
                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    @endif

    <main class="w-full max-w-7xl mx-auto px-4 md:px-10 {{ ($hideNav ?? false) ? 'pt-6' : 'pt-24 md:pt-36' }} pb-32 md:pb-20 page-enter">
        {{ $slot }}
    </main>

    {{-- Refined Mobile Tab Bar --}}
    @if(!($hideNav ?? false))
    <div class="md:hidden fixed bottom-0 left-0 right-0 z-[100] mobile-dock pb-safe">
        <div class="flex items-center justify-around h-20 px-4">
            <a href="{{ route('siswa.dashboard') }}" class="flex flex-col items-center gap-1 px-4 transition-all {{ request()->routeIs('siswa.dashboard') ? 'text-indigo-600 scale-110' : 'text-slate-400' }}">
                <div class="w-6 h-6 flex items-center justify-center">
                    <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <span class="text-[9px] font-black uppercase tracking-widest">Home</span>
            </a>
            <a href="{{ route('siswa.soal.index') }}" class="relative -top-8 flex flex-col items-center">
                <div class="w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-3xl flex items-center justify-center text-white shadow-2xl shadow-indigo-500/40 border-4 border-[#f8fafc] dark:border-[#020617] active:scale-90 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </a>
            <a href="{{ route('siswa.nilai.index') }}" class="flex flex-col items-center gap-1 px-4 transition-all {{ request()->routeIs('siswa.nilai.*') ? 'text-indigo-600 scale-110' : 'text-slate-400' }}">
                <div class="w-6 h-6 flex items-center justify-center">
                    <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[9px] font-black uppercase tracking-widest">History</span>
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