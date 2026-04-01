<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SmartExam Intelligence - Administrator Portal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f0f7ff;
            color: #1e293b;
            letter-spacing: -0.01em;
        }

        /* Floating Sidebar Style */
        .sidebar-float {
            width: 280px;
            height: calc(100vh - 40px);
            position: fixed;
            left: 20px;
            top: 20px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border-radius: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 25px 50px -12px rgba(37, 99, 235, 0.1);
            z-index: 70;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-item-pro {
            margin: 4px 16px;
            padding: 12px 16px;
            border-radius: 1.25rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            transition: all 0.25s ease;
        }

        .nav-item-pro:hover {
            background: rgba(37, 99, 235, 0.05);
            color: #2563eb;
        }

        .nav-item-pro.active {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            color: #ffffff;
            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.3);
        }

        .main-workspace {
            margin-left: 320px;
            padding: 40px;
            transition: all 0.4s ease;
        }

        /* Responsive Mobile Drawer */
        @media (max-width: 1024px) {
            .sidebar-float {
                left: -300px;
                height: 100vh;
                top: 0;
                border-radius: 0 2rem 2rem 0;
                left: -320px;
            }
            .sidebar-float.open {
                left: 0;
            }
            .main-workspace {
                margin-left: 0;
                padding: 24px;
            }
        }

        /* Mobile Header */
        .mobile-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }

        .sidebar-overlay {
            background: rgba(15, 23, 42, 0.3);
            backdrop-filter: blur(4px);
            z-index: 60;
        }
    </style>
</head>
<body class="antialiased" x-data="{ sidebarOpen: false }">
    
    {{-- Mobile Sidebar Overlay --}}
    <div x-show="sidebarOpen" 
         x-transition:enter="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="opacity-100" x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 sidebar-overlay lg:hidden"></div>

    <div class="flex">
        {{-- Floating Sidebar --}}
        <aside :class="sidebarOpen ? 'open' : ''" class="sidebar-float flex flex-col shadow-2xl">
            
            {{-- Branding --}}
            <div class="p-8 flex flex-col items-center text-center gap-4">
                <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center shadow-xl shadow-blue-100 border border-blue-50">
                    <img src="{{ asset('storage/image/images.png') }}" class="w-14 h-14 object-contain" alt="Logo">
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900 tracking-tight uppercase leading-none">SmartExam</h2>
                    <p class="text-[9px] font-bold text-blue-500 uppercase tracking-[0.2em] mt-2">Admin Intelligence</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto no-scrollbar py-4">
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="nav-item-pro {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        Dashboard
                    </a>

                    <div class="px-8 py-4 text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-4">Database</div>
                    
                    <a href="{{ route('admin.admin.index') }}" class="nav-item-pro {{ request()->routeIs('admin.admin.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Data Admin
                    </a>
                    <a href="{{ route('admin.guru.index') }}" class="nav-item-pro {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Data Guru
                    </a>
                    <a href="{{ route('admin.siswa.index') }}" class="nav-item-pro {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Data Siswa
                    </a>
                    <a href="{{ route('admin.soal.index') }}" class="nav-item-pro {{ request()->routeIs('admin.soal.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        Bank Soal
                    </a>
                    <a href="{{ route('admin.modul.index') }}" class="nav-item-pro {{ request()->routeIs('admin.modul.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        Modul Ujian
                    </a>
                    <a href="{{ route('admin.nilai.index') }}" class="nav-item-pro {{ request()->routeIs('admin.nilai.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        Laporan Nilai
                    </a>

                    <div class="px-8 py-4 text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-4">System</div>
                    <a href="{{ route('admin.setting.index') }}" class="nav-item-pro {{ request()->routeIs('admin.setting.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
                        Pengaturan
                    </a>
                </div>
            </nav>

            {{-- Footer Sidebar --}}
            <div class="p-6 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 bg-slate-900 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest hover:bg-rose-600 transition-all shadow-lg active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Workspace --}}
        <div class="flex-1 min-w-0">
            {{-- Mobile Header --}}
            <header class="h-16 lg:hidden mobile-header sticky top-0 z-[50] flex items-center justify-between px-6">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('storage/image/images.png') }}" class="w-7 h-7 object-contain" alt="Logo">
                    <span class="text-sm font-bold text-slate-900 uppercase">SmartExam</span>
                </div>
                <button @click="sidebarOpen = true" class="p-2 bg-slate-50 rounded-lg text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                </button>
            </header>

            <main class="main-workspace">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

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
            Toast.fire({ icon: 'success', title: 'Operasi Berhasil', text: '{{ session('success') }}', iconColor: '#2563eb' });
        @endif

        @if(session('error'))
            Toast.fire({ icon: 'error', title: 'Terjadi Kesalahan', text: '{{ session('error') }}', iconColor: '#f43f5e' });
        @endif
    </script>

    @stack('scripts')
</body>
</html>l>