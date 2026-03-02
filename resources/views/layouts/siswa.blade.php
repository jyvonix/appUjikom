<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Portal Siswa</title>

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f0f4f8; /* Soft Blue-Gray Background */
        }
        .header-blur {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
        }
        .card-shadow {
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
        }
        .primary-blue-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        .btn-blue {
            background: #2563eb;
            transition: all 0.3s ease;
        }
        .btn-blue:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }
    </style>
</head>
<body class="antialiased text-slate-800">
    <!-- Navbar Fungsional -->
    <nav class="header-blur sticky top-0 z-50 h-20 flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex justify-between items-center">
            <div class="flex items-center space-x-10">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 primary-blue-gradient rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-blue-900">E-LEARNING</span>
                </div>
                
                <div class="hidden md:flex space-x-1">
                    <a href="{{ route('siswa.dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-bold {{ request()->routeIs('siswa.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:text-blue-600 hover:bg-slate-50' }} transition-all">Dashboard</a>
                    <a href="{{ route('siswa.soal.index') }}" class="px-4 py-2 rounded-lg text-sm font-bold {{ request()->routeIs('siswa.soal.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:text-blue-600 hover:bg-slate-50' }} transition-all">Daftar Soal</a>
                    <a href="{{ route('siswa.nilai.index') }}" class="px-4 py-2 rounded-lg text-sm font-bold {{ request()->routeIs('siswa.nilai.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:text-blue-600 hover:bg-slate-50' }} transition-all">Hasil Ujian</a>
                </div>
            </div>

            <div class="flex items-center space-x-5">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Siswa</p>
                    <p class="text-sm font-bold text-blue-900 leading-none mt-0.5">{{ Auth::user()->name }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2.5 rounded-xl bg-slate-100 text-slate-500 hover:bg-red-50 hover:text-red-600 transition-all border border-slate-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content Area: Padding Top Diperhatikan Agar Tidak Tertutup Navbar -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @if(session('success'))
            <div class="mb-6 flex items-center p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-100 shadow-sm">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        {{ $slot }}
    </main>
</body>
</html>
