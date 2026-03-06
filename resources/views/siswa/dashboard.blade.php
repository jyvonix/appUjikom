<x-siswa-layout>
    <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full uppercase tracking-wider">
                    {{ now()->hour < 12 ? '🌅 Morning Vibes' : (now()->hour < 15 ? '☀️ Productive Day' : '🌆 Good Afternoon') }}
                </span>
            </div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👋
            </h1>
            <p class="text-slate-500 font-medium mt-2 text-lg">
                Siap untuk mengasah kemampuanmu hari ini?
            </p>
        </div>
        
        <div class="hidden lg:block bg-white px-6 py-3 rounded-2xl border border-slate-100 shadow-sm">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Status Belajar</p>
            <p class="text-sm font-bold text-emerald-600 flex items-center mt-1">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-ping mr-2"></span>
                Sangat Aktif
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="group bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden transition-all duration-500 hover:-translate-y-2">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-blue-600/5 rounded-full transition-transform group-hover:scale-150 duration-700"></div>
            
            <div class="relative z-10">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center text-white mb-8 shadow-lg shadow-blue-200 group-hover:rotate-6 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <p class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Skor Terakhir</p>
                <div class="flex items-baseline gap-1 mt-2">
                    <h3 class="text-5xl font-black text-slate-900">{{ $nilai_terakhir ? number_format($nilai_terakhir->skor, 0) : '0' }}</h3>
                    <span class="text-slate-400 font-bold">/100</span>
                </div>
                <div class="mt-6 flex items-center text-[11px] font-bold text-blue-600 bg-blue-50 w-fit px-3 py-1 rounded-full">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"/></svg>
                    Terupdate Otomatis
                </div>
            </div>
        </div>

        <div class="group bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden transition-all duration-500 hover:-translate-y-2">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-emerald-600/5 rounded-full transition-transform group-hover:scale-150 duration-700"></div>
            
            <div class="relative z-10">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-2xl flex items-center justify-center text-white mb-8 shadow-lg shadow-emerald-200 group-hover:rotate-6 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <p class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Total Ujian</p>
                <h3 class="text-5xl font-black text-slate-900 mt-2">{{ $total_ujian }}</h3>
                <p class="mt-6 text-[11px] font-bold text-emerald-600 bg-emerald-50 w-fit px-3 py-1 rounded-full uppercase">
                    📚 Sesi Diselesaikan
                </p>
            </div>
        </div>

        <div class="group bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden transition-all duration-500 hover:-translate-y-2">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-purple-600/5 rounded-full transition-transform group-hover:scale-150 duration-700"></div>
            
            <div class="relative z-10">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center text-white mb-8 shadow-lg shadow-purple-200 group-hover:rotate-6 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    </svg>
                </div>
                <p class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Rata-rata</p>
                <h3 class="text-5xl font-black text-slate-900 mt-2">{{ number_format($rata_rata, 1) }}</h3>
                <p class="mt-6 text-[11px] font-bold text-purple-600 bg-purple-50 w-fit px-3 py-1 rounded-full uppercase">
                    🏆 Performa Akademik
                </p>
            </div>
        </div>
    </div>

    <div class="relative rounded-[3rem] overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-indigo-800"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full opacity-10">
            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z"></path>
            </svg>
        </div>

        <div class="relative p-10 md:p-14 flex flex-col lg:flex-row items-center justify-between gap-10">
            <div class="text-center lg:text-left">
                <h3 class="text-3xl md:text-4xl font-black text-black leading-tight">
                    Tingkatkan Prestasimu,<br>Mulai Ujian Sekarang!
                </h3>
                <p class="text-blue-100/80 font-medium mt-4 text-lg max-w-lg">
                    Jangan biarkan ilmumu menguap. Uji pemahamanmu dengan ribuan latihan soal yang dirancang khusus untukmu.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">
                <a href="{{ route('siswa.soal.index') }}" class="group bg-white text-blue-900 px-10 py-5 rounded-2xl font-black text-center shadow-2xl shadow-blue-950/20 hover:bg-blue-50 transition-all flex items-center justify-center">
                    Mulai Sekarang
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <a href="{{ route('siswa.nilai.index') }}" class="bg-blue-800/40 backdrop-blur-md text-white border border-white/20 px-10 py-5 rounded-2xl font-black text-center hover:bg-blue-800/60 transition-all">
                    Riwayat Nilai
                </a>
            </div>
        </div>
    </div>
</x-siswa-layout>