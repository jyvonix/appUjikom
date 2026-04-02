<x-siswa-layout>
    <div class="space-y-12">
        {{-- Hero Greeting Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-2">
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tighter leading-none">
                    Dashboard <span class="text-indigo-gradient">Overview</span>
                </h1>
                <p class="text-slate-500 dark:text-slate-400 font-bold text-sm md:text-base">
                    Ringkasan performa dan aktivitas belajar Anda hari ini.
                </p>
            </div>
            <div class="flex items-center gap-3 px-5 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm">
                <div class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></div>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Real-time Analytics</span>
            </div>
        </div>

        {{-- Important Info Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Card 1: IPK / Rata-rata --}}
            <div class="card-pro p-8 rounded-[2.5rem] relative overflow-hidden group">
                <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-indigo-500/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000"></div>
                <div class="relative z-10 space-y-6">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">Rata-rata Skor</p>
                        <h3 class="text-4xl font-black text-slate-800 dark:text-white">{{ number_format($rata_rata, 1) }}</h3>
                    </div>
                </div>
            </div>

            {{-- Card 2: Total Sesi --}}
            <div class="card-pro p-8 rounded-[2.5rem] relative overflow-hidden group">
                <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-purple-500/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000"></div>
                <div class="relative z-10 space-y-6">
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-purple-500/10 flex items-center justify-center text-purple-600 dark:text-purple-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">Ujian Selesai</p>
                        <h3 class="text-4xl font-black text-slate-800 dark:text-white">{{ $total_ujian }}</h3>
                    </div>
                </div>
            </div>

            {{-- Card 3: Streak --}}
            <div class="card-pro p-8 rounded-[2.5rem] relative overflow-hidden group">
                <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-orange-500/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000"></div>
                <div class="relative z-10 space-y-6">
                    <div class="w-12 h-12 rounded-2xl bg-orange-50 dark:bg-orange-500/10 flex items-center justify-center text-orange-600 dark:text-orange-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.99 7.99 0 0120 13a7.99 7.99 0 01-2.343 5.657z" /></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">Learning Streak</p>
                        <div class="flex items-center gap-3">
                            <h3 class="text-4xl font-black text-slate-800 dark:text-white">{{ $streak }}</h3>
                            <span class="text-2xl">🔥</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 4: Rank/Badge (Premium Styling) --}}
            <div class="bg-gradient-to-br from-indigo-600 to-purple-700 p-8 rounded-[2.5rem] relative overflow-hidden group shadow-2xl shadow-indigo-200 dark:shadow-none transition-all hover:scale-[1.02]">
                <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10 h-full flex flex-col justify-between">
                    <span class="text-[9px] font-black text-indigo-100 uppercase tracking-widest">Achiever Status</span>
                    <div class="space-y-1">
                        <h4 class="text-xl font-black text-white leading-tight">Master Level</h4>
                        <p class="text-[10px] font-bold text-indigo-200 uppercase tracking-widest">Digital Intelligence</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Next Action Section (Quick Access) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 card-pro p-10 rounded-[3rem] bg-indigo-600/5 dark:bg-indigo-500/5 border-dashed border-indigo-200 dark:border-indigo-500/20 flex flex-col md:flex-row items-center gap-10">
                <div class="w-32 h-32 bg-white dark:bg-slate-900 rounded-[2.5rem] flex items-center justify-center text-indigo-600 shadow-2xl shadow-indigo-100 dark:shadow-none flex-shrink-0">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
                <div class="space-y-6 flex-1 text-center md:text-left">
                    <div class="space-y-2">
                        <h3 class="text-2xl font-black text-slate-800 dark:text-white">Siap untuk Ujian Baru?</h3>
                        <p class="text-slate-500 dark:text-slate-400 font-bold text-sm leading-relaxed">
                            Jangan biarkan streak Anda terputus. Pilih modul yang tersedia dan tunjukkan kemampuan terbaik Anda hari ini.
                        </p>
                    </div>
                    <a href="{{ route('siswa.soal.index') }}" class="btn-premium inline-flex items-center gap-4 px-10 py-5 text-white rounded-[2rem] font-black text-[10px] uppercase tracking-[0.3em] shadow-xl">
                        <span>Buka Menu Ujian</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <div class="card-pro p-10 rounded-[3rem] flex flex-col justify-between items-center text-center">
                <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800 rounded-[1.5rem] flex items-center justify-center text-slate-400 mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div class="space-y-2 mb-8">
                    <h4 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-tighter">Waktu Belajar</h4>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Sangat Produktif</p>
                </div>
                <p class="text-sm font-bold text-slate-500 dark:text-slate-400 leading-relaxed italic">
                    "Kecerdasan tanpa ambisi adalah burung tanpa sayap."
                </p>
            </div>
        </div>
    </div>
</x-siswa-layout>
