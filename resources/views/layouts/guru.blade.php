<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Guru Panel | Smart Exam SMK</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --smk-primary: #0284c7;
            --smk-primary-dark: #0369a1;
            --smk-accent: #38bdf8;
            --smk-bg: #f0f9ff;
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.6);
            --card-shadow: 0 20px 40px -15px rgba(2, 132, 199, 0.12);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--smk-bg);
            color: #1e293b;
            overflow-x: hidden;
        }

        .mesh-gradient {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            background: 
                radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(2, 132, 199, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(56, 189, 248, 0.15) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(2, 132, 199, 0.12) 0px, transparent 50%);
        }

        .sidebar {
            width: 280px;
            height: calc(100vh - 40px);
            position: fixed;
            left: 20px; top: 20px;
            background: var(--glass-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-radius: 32px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--card-shadow);
            z-index: 50;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            padding: 0;
        }

        .sidebar-header {
            padding: 40px 20px 20px;
        }

        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 0 20px 20px;
            scrollbar-width: thin;
            scrollbar-color: rgba(2, 132, 199, 0.1) transparent;
        }

        .sidebar-content::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-content::-webkit-scrollbar-thumb {
            background-color: rgba(2, 132, 199, 0.1);
            border-radius: 10px;
        }

        .sidebar-footer {
            padding: 20px;
            background: rgba(255, 255, 255, 0.5);
            border-top: 1px solid var(--glass-border);
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            margin-bottom: 8px;
            border-radius: 20px;
            color: #64748b;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link:hover {
            background: white;
            color: var(--smk-primary);
            transform: translateX(8px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--smk-primary) 0%, var(--smk-primary-dark) 100%);
            color: white;
            box-shadow: 0 12px 24px -8px rgba(2, 132, 199, 0.5);
        }

        /* Colored Icons Logic */
        .nav-link .icon-box {
            width: 32px; height: 32px;
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: all 0.3s;
        }

        .nav-link:not(.active) .icon-box { background: rgba(2, 132, 199, 0.08); color: var(--smk-primary); }
        .nav-link.active .icon-box { background: rgba(255, 255, 255, 0.2); color: white; }

        .content-area {
            margin-left: 320px;
            padding: 40px 40px 40px 20px;
            min-height: 100vh;
        }

        .glass-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 32px;
            box-shadow: var(--card-shadow);
        }

        /* Improved Input Visibility */
        input:focus, textarea:focus, select:focus {
            background-color: white !important;
            border-color: var(--smk-primary) !important;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.1) !important;
        }

        /* SweetAlert Custom Styling */
        .swal2-popup.swal-custom {
            border-radius: 40px !important;
            padding: 2.5rem !important;
            border: 1px solid rgba(255,255,255,0.8) !important;
            backdrop-filter: blur(12px);
            box-shadow: 0 40px 80px -20px rgba(2, 132, 199, 0.15) !important;
        }
        .swal2-title { font-weight: 900 !important; tracking: -0.02em !important; color: #0f172a !important; font-size: 1.25rem !important; }
        .swal2-html-container { font-weight: 700 !important; color: #64748b !important; font-size: 0.875rem !important; }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-120%); }
            .content-area { margin-left: 0; padding: 20px; }
        }
    </style>
</head>
<body class="antialiased">
    <div class="mesh-gradient"></div>

    <div class="flex">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="flex items-center gap-3 px-4 mb-4">
                    <div class="w-12 h-12 bg-white rounded-2xl p-2 shadow-sm border border-slate-100">
                        <img src="{{ asset('storage/image/images.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h2 class="text-lg font-extrabold text-slate-800 tracking-tight leading-none">SMART <span class="text-sky-600">EXAM</span></h2>
                        <span class="text-[10px] font-bold text-sky-500 uppercase tracking-widest">Teacher Panel</span>
                    </div>
                </div>
            </div>

            <div class="sidebar-content">
                <nav>
                    <p class="px-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Core</p>
                    <a href="{{ route('guru.dashboard') }}" class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                        <div class="icon-box">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </div>
                        Dashboard
                    </a>
                    
                    <p class="px-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 mt-8">Exam Manager</p>
                    <a href="{{ route('guru.soal.index') }}" class="nav-link {{ request()->routeIs('guru.soal.*') ? 'active' : '' }}">
                        <div class="icon-box">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        Bank Soal
                    </a>
                    <a href="{{ route('guru.nilai.index') }}" class="nav-link {{ request()->routeIs('guru.nilai.*') ? 'active' : '' }}">
                        <div class="icon-box">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        Hasil Ujian
                    </a>
                </nav>
            </div>

            <div class="sidebar-footer">
                <div class="p-4 bg-white rounded-2xl mb-4 border border-slate-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-500 flex items-center justify-center text-white font-black">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs font-black text-slate-800 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-[9px] text-sky-500 font-bold uppercase">Official Teacher</p>
                        </div>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:bg-rose-600 transition-all shadow-lg shadow-slate-200">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="content-area flex-1">
            <div class="max-w-6xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true,
            customClass: {
                popup: 'swal-custom',
                title: 'text-sm font-black',
                htmlContainer: 'text-xs'
            }
        });

        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                iconColor: '#0ea5e9',
            });
        @endif

        @if(session('error'))
            Toast.fire({
                icon: 'error',
                title: 'Error Encountered',
                text: '{{ session('error') }}',
                iconColor: '#f43f5e',
            });
        @endif

        @if(session('warning'))
            Toast.fire({
                icon: 'warning',
                title: 'Attention',
                text: '{{ session('warning') }}',
                iconColor: '#f59e0b',
            });
        @endif
    </script>

    @stack('scripts')
</body>
</html>
