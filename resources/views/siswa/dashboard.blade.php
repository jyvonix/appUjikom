<x-siswa-layout>
    {{-- Smart Header --}}
    <div class="mb-12 flex flex-col md:flex-row items-start md:items-center justify-between gap-8">
        <div class="space-y-2">
            <div class="flex items-center gap-3">
                <div class="px-3 py-1 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-md">
                    Overview
                </div>
                <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-widest">{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
                Dashboard <span class="text-blue-600">Siswa</span>
            </h1>
            <p class="text-slate-500 font-medium text-base">
                Selamat datang kembali, <span class="text-slate-900 font-bold">{{ Auth::user()->name }}</span>. Pantau progres akademikmu di sini.
            </p>
        </div>

        {{-- Current Streak refined --}}
        <div class="bg-white px-6 py-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-5">
            <div class="flex flex-col">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Learning Streak</span>
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-bold text-slate-800">{{ $streak }}</span>
                    <span class="text-xs font-semibold text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-full">{{ Str::plural('Day', $streak) }}</span>
                </div>
            </div>
            <div class="w-10 h-10 bg-orange-50 rounded-full flex items-center justify-center text-orange-500 shadow-inner">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.562 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.562 0 01.321-.988l5.518-.442a.563.562 0 00.475-.345L11.48 3.5z"/></svg>
            </div>
        </div>
    </div>

    {{-- Performance Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="card-pro p-8 rounded-3xl relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-24 h-24 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-4">Skor Tertinggi</p>
            <div class="flex items-baseline gap-2 mb-6">
                <span class="text-5xl font-extrabold text-slate-900 tracking-tight">{{ $nilai_terakhir ? number_format($nilai_terakhir->skor, 0) : '0' }}</span>
                <span class="text-slate-400 font-bold text-lg">pts</span>
            </div>
            <div class="w-full bg-slate-50 h-1.5 rounded-full overflow-hidden">
                <div class="bg-blue-600 h-full rounded-full transition-all duration-1000" style="width: {{ $nilai_terakhir ? $nilai_terakhir->skor : 0 }}%"></div>
            </div>
        </div>

        <div class="card-pro p-8 rounded-3xl relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-24 h-24 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-4">Total Sesi</p>
            <div class="flex items-baseline gap-2 mb-6">
                <span class="text-5xl font-extrabold text-slate-900 tracking-tight">{{ $total_ujian }}</span>
                <span class="text-slate-400 font-bold text-lg">ujian</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                <span class="text-[11px] font-bold text-emerald-600 uppercase tracking-widest">Active Progress</span>
            </div>
        </div>

        <div class="card-pro p-8 rounded-3xl relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-24 h-24 text-indigo-600" fill="currentColor" viewBox="0 0 24 24"><path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/></svg>
            </div>
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-4">Rata-rata</p>
            <div class="flex items-baseline gap-2 mb-6">
                <span class="text-5xl font-extrabold text-slate-900 tracking-tight">{{ number_format($rata_rata, 1) }}</span>
                <span class="text-slate-400 font-bold text-lg">%</span>
            </div>
            <div class="text-[11px] font-bold text-indigo-600 uppercase tracking-widest">
                Competency Level: <span class="text-slate-900">{{ $rata_rata >= 80 ? 'Master' : 'Student' }}</span>
            </div>
        </div>
    </div>

    {{-- Call to Action: Professional Banner --}}
    <div class="relative bg-slate-900 rounded-[3rem] overflow-hidden shadow-2xl">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_100%_0%,#2563eb,transparent_50%)] opacity-30"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10"></div>
        
        <div class="relative p-10 md:p-20 flex flex-col lg:flex-row items-center justify-between gap-16">
            <div class="max-w-xl text-center lg:text-left space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 backdrop-blur-md rounded-full border border-white/10 text-white text-[10px] font-bold uppercase tracking-[0.3em]">
                    Advanced Assessment
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.1]">
                    Evaluasi Kemampuanmu Bersama <span class="text-blue-400">SmartExam Intelligence</span>
                </h2>
                <p class="text-slate-400 font-medium text-lg leading-relaxed">
                    Sistem ujian terintegrasi yang dirancang untuk mengukur tingkat pemahaman Anda secara akurat dan objektif.
                </p>
                <div class="flex flex-col sm:flex-row items-center gap-5 justify-center lg:justify-start pt-4">
                    <a href="{{ route('siswa.soal.index') }}" class="w-full sm:w-auto px-10 py-5 bg-blue-600 text-white rounded-2xl font-bold text-xs uppercase tracking-widest hover:bg-blue-500 transition-all shadow-xl shadow-blue-600/20 flex items-center justify-center gap-3 active:scale-95 transform">
                        Mulai Ujian Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                    <a href="{{ route('siswa.nilai.index') }}" class="w-full sm:w-auto px-10 py-5 bg-white/5 backdrop-blur-xl border border-white/10 text-white rounded-2xl font-bold text-xs uppercase tracking-widest hover:bg-white/10 transition-all flex items-center justify-center active:scale-95 transform">
                        Lihat Transcript
                    </a>
                </div>
            </div>

            {{-- Professional Icon Box --}}
            <div class="hidden lg:block relative">
                <div class="w-72 h-72 bg-blue-600/10 rounded-[4rem] blur-[100px] absolute inset-0 animate-pulse"></div>
                <div class="relative w-64 h-64 bg-white/[0.03] backdrop-blur-3xl rounded-[3rem] border border-white/10 flex items-center justify-center rotate-3 shadow-2xl group hover:rotate-6 transition-all duration-700 p-12">
                    <svg class="w-full h-full text-blue-500 opacity-40 group-hover:opacity-100 transition-opacity duration-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</x-siswa-layout>