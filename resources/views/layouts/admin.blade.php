<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SMK Dashboard | Smart Exam</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --smk-blue: #2563eb;
            --smk-gradient: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%);
            --smk-glass: rgba(255, 255, 255, 0.8);
            --smk-border: rgba(255, 255, 255, 0.6);
            --admin-emerald: #10b981;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f0f7ff;
            color: #0f172a;
        }

        .mesh-bg {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            z-index: -1;
            background: #f0f7ff;
            overflow: hidden;
        }
        .mesh-sphere {
            position: absolute; border-radius: 50%; filter: blur(100px); opacity: 0.5;
            animation: move 20s infinite alternate cubic-bezier(0.45, 0.05, 0.55, 0.95);
        }
        .sphere-1 { width: 600px; height: 600px; background: #dbeafe; top: -100px; right: -100px; }
        .sphere-2 { width: 500px; height: 500px; background: #bfdbfe; bottom: -100px; left: -100px; animation-delay: -5s; }

        @keyframes move {
            from { transform: translate(0, 0) scale(1); }
            to { transform: translate(100px, 100px) scale(1.1); }
        }

        .sidebar-container {
            width: 300px;
            height: calc(100vh - 40px);
            position: fixed;
            left: 20px; top: 20px;
            background: var(--smk-glass);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border-radius: 32px;
            border: 1px solid var(--smk-border);
            box-shadow: 0 25px 50px -12px rgba(37, 99, 235, 0.1);
            z-index: 50;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 32px;
            scrollbar-width: thin;
            scrollbar-color: rgba(37, 99, 235, 0.1) transparent;
        }

        .sidebar-content::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-content::-webkit-scrollbar-thumb {
            background-color: rgba(37, 99, 235, 0.1);
            border-radius: 10px;
        }

        .nav-item {
            margin: 8px 16px; padding: 14px 20px; border-radius: 20px;
            display: flex; align-items: center; color: #64748b; font-weight: 600;
            transition: all 0.3s;
        }

        .nav-item:hover { color: var(--smk-blue); background: rgba(37, 99, 235, 0.08); }
        .nav-item.active { background: var(--smk-gradient); color: white; box-shadow: 0 12px 24px -6px rgba(37, 99, 235, 0.3); }
        .nav-item svg { width: 22px; height: 22px; margin-right: 14px; }

        .main-content { margin-left: 340px; padding: 40px; }

        /* SweetAlert Custom Styling */
        .swal2-popup.swal-custom {
            border-radius: 48px !important;
            padding: 2rem !important;
            border: 1px solid rgba(255,255,255,0.8) !important;
            backdrop-filter: blur(10px);
        }
        .swal2-title { font-weight: 900 !important; tracking: -0.025em !important; color: #1e293b !important; }
        .swal2-html-container { font-weight: 700 !important; color: #64748b !important; }
        .swal2-confirm.swal-btn-confirm {
            border-radius: 24px !important;
            font-weight: 900 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
            padding: 1rem 2.5rem !important;
            font-size: 0.75rem !important;
        }

        @media (max-width: 1024px) {
            .sidebar-container { display: none; }
            .main-content { margin-left: 0; padding: 20px; }
        }
    </style>
</head>
<body class="antialiased">
    <div class="mesh-bg">
        <div class="mesh-sphere sphere-1"></div>
        <div class="mesh-sphere sphere-2"></div>
    </div>

    <div class="flex">
        <aside class="sidebar-container flex flex-col">
            <div class="p-8 text-center">
                <div class="flex flex-col items-center gap-4 mb-12">
                    <div class="w-20 h-20 rounded-2xl bg-white p-2 shadow-xl shadow-blue-100 flex items-center justify-center">
                        <img src="{{ asset('storage/image/images.png') }}" alt="Logo SMK" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="text-xl font-extrabold tracking-tight text-slate-800">SMART <span class="text-blue-600">EXAM</span></span>
                        <p class="text-[10px] font-bold text-blue-400 uppercase tracking-[0.3em]">Versi Administrator</p>
                    </div>
                </div>

                <nav class="space-y-1 text-left">
                    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] px-8 py-4 mt-4">Database</div>
                    <a href="{{ route('admin.admin.index') }}" class="nav-item {{ request()->routeIs('admin.admin.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Data Admin
                    </a>
                    <a href="{{ route('admin.guru.index') }}" class="nav-item {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Data Guru
                    </a>
                    <a href="{{ route('admin.siswa.index') }}" class="nav-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Data Siswa
                    </a>
                    <a href="{{ route('admin.soal.index') }}" class="nav-item {{ request()->routeIs('admin.soal.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Bank Soal
                    </a>
                    <a href="{{ route('admin.nilai.index') }}" class="nav-item {{ request()->routeIs('admin.nilai.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Laporan Nilai
                    </a>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] px-8 py-4 mt-4">Sistem</div>
                    <a href="{{ route('admin.setting.index') }}" class="nav-item {{ request()->routeIs('admin.setting.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Pengaturan
                    </a>
                </nav>
            </div>

            <div class="mt-auto p-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full py-3 bg-slate-900 text-white rounded-2xl text-[11px] font-bold uppercase tracking-wider hover:bg-blue-600 transition-all">Keluar Sistem</button>
                </form>
            </div>
        </aside>

        <main class="main-content flex-1">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            customClass: {
                popup: 'swal-custom shadow-2xl',
                title: 'text-sm font-black',
                htmlContainer: 'text-xs'
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: 'Operation Successful',
                text: '{{ session('success') }}',
                iconColor: '#10b981',
            });
        @endif

        @if(session('error'))
            Toast.fire({
                icon: 'error',
                title: 'Action Failed',
                text: '{{ session('error') }}',
                iconColor: '#f43f5e',
            });
        @endif

        @if(session('warning'))
            Toast.fire({
                icon: 'warning',
                title: 'Attention Required',
                text: '{{ session('warning') }}',
                iconColor: '#f59e0b',
            });
        @endif
    </script>

    @stack('scripts')
</body>
</html>
