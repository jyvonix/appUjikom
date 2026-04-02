<x-siswa-layout>
    <div class="max-w-7xl mx-auto space-y-8 md:space-y-12 pb-10">
        {{-- Elite Hero Greeting --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 animate-fade-in">
            <div class="space-y-1 md:space-y-2">
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2.5 py-0.5 rounded-full bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-[10px] font-black uppercase tracking-widest border border-indigo-500/20">System Online</span>
                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                </div>
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-none">
                    Welcome, <span class="text-indigo-600 dark:text-indigo-400">{{ Auth::user()->name }}</span>
                </h1>
                <p class="text-slate-500 dark:text-slate-400 font-medium text-xs md:text-base max-w-md">
                    Pantau progres akademik dan optimalkan potensi belajar Anda hari ini.
                </p>
            </div>
            
            <div class="hidden lg:flex items-center gap-4 bg-white dark:bg-slate-900/50 p-2 rounded-2xl border border-slate-200 dark:border-white/5 shadow-sm">
                <div class="px-4 py-2 border-r border-slate-100 dark:border-white/5 text-center">
                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Server Time</p>
                    <p class="text-xs font-bold dark:text-white">{{ now()->format('H:i') }}</p>
                </div>
                <div class="px-4 py-2 text-center">
                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Status</p>
                    <p class="text-xs font-bold text-emerald-500">Authorized</p>
                </div>
            </div>
        </div>

        {{-- Dynamic Intelligence Grid --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
            {{-- Avg Score --}}
            <div class="group relative bg-white dark:bg-slate-900/40 border border-slate-200 dark:border-white/5 rounded-[1.5rem] md:rounded-[2.5rem] p-5 md:p-8 transition-all duration-500 hover:border-indigo-500/30 overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-indigo-500/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10 space-y-4 md:space-y-6">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl md:rounded-2xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 group-hover:text-indigo-600 transition-colors">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <div>
                        <p class="text-[8px] md:text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">Rata-rata Skor</p>
                        <h3 class="text-xl md:text-3xl font-black text-slate-900 dark:text-white">{{ number_format($rata_rata, 1) }}</h3>
                    </div>
                </div>
            </div>

            {{-- Completed Sessions --}}
            <div class="group relative bg-white dark:bg-slate-900/40 border border-slate-200 dark:border-white/5 rounded-[1.5rem] md:rounded-[2.5rem] p-5 md:p-8 transition-all duration-500 hover:border-purple-500/30 overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-purple-500/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10 space-y-4 md:space-y-6">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl md:rounded-2xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 group-hover:text-purple-600 transition-colors">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <p class="text-[8px] md:text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">Total Sesi</p>
                        <h3 class="text-xl md:text-3xl font-black text-slate-900 dark:text-white">{{ $total_ujian }}</h3>
                    </div>
                </div>
            </div>

            {{-- Streak --}}
            <div class="group relative bg-white dark:bg-slate-900/40 border border-slate-200 dark:border-white/5 rounded-[1.5rem] md:rounded-[2.5rem] p-5 md:p-8 transition-all duration-500 hover:border-orange-500/30 overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-orange-500/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10 space-y-4 md:space-y-6">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl md:rounded-2xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 group-hover:text-orange-500 transition-colors">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.99 7.99 0 0120 13a7.99 7.99 0 01-2.343 5.657z"/></svg>
                    </div>
                    <div>
                        <p class="text-[8px] md:text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">Learning Streak</p>
                        <div class="flex items-center gap-2">
                            <h3 class="text-xl md:text-3xl font-black text-slate-900 dark:text-white">{{ $streak }}</h3>
                            <span class="text-lg animate-bounce">🔥</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- VIP Rank Card (Mobile Responsive) --}}
            <div class="col-span-2 lg:col-span-1 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-[1.5rem] md:rounded-[2.5rem] p-5 md:p-8 relative overflow-hidden group shadow-xl shadow-indigo-500/20">
                <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10 h-full flex flex-col justify-between space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="text-[8px] md:text-[9px] font-black text-indigo-100 uppercase tracking-[0.2em] opacity-80">Achiever Status</span>
                        <div class="text-white opacity-90 transform group-hover:rotate-12 transition-transform duration-500">
                            {!! $rank['icon'] !!}
                        </div>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-base md:text-xl font-black text-white leading-tight">{{ $rank['title'] }}</h4>
                        <p class="text-[8px] md:text-[10px] font-bold text-indigo-200 uppercase tracking-widest">{{ $rank['desc'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Next Steps & Insights --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-8">
            {{-- CTA Main Card --}}
            <div class="lg:col-span-2 relative group overflow-hidden bg-white dark:bg-slate-900/40 border border-slate-200 dark:border-white/5 rounded-[2rem] md:rounded-[3rem] p-6 md:p-10 transition-all duration-500">
                <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity duration-500">
                    <svg class="w-32 h-32 md:w-48 md:h-48" fill="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-6 md:gap-10">
                    <div class="w-20 h-20 md:w-28 md:h-28 bg-indigo-600 rounded-[1.5rem] md:rounded-[2.2rem] flex items-center justify-center text-white shadow-2xl shadow-indigo-500/40 flex-shrink-0 transform group-hover:rotate-3 transition-transform duration-500">
                        <svg class="w-10 h-10 md:w-14 md:h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <div class="space-y-4 md:space-y-6 flex-1 text-center md:text-left">
                        <div class="space-y-1">
                            <h3 class="text-xl md:text-3xl font-black text-slate-900 dark:text-white leading-none">Siap untuk Ujian Baru?</h3>
                            <p class="text-slate-500 dark:text-slate-400 font-bold text-xs md:text-sm tracking-tight leading-relaxed max-w-sm mx-auto md:mx-0">
                                Jangan biarkan streak Anda terputus. Pilih modul hari ini dan raih skor tertinggi.
                            </p>
                        </div>
                        <a href="{{ route('siswa.soal.index') }}" class="inline-flex items-center gap-3 px-8 md:px-10 py-3.5 md:py-4 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-xl md:rounded-2xl font-black text-[10px] md:text-xs uppercase tracking-[0.2em] shadow-xl hover:scale-105 active:scale-95 transition-all">
                            <span>Open Assessment Matrix</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Productivity & Quote --}}
            <div class="flex flex-col gap-4 md:gap-6">
                <div class="flex-1 bg-white dark:bg-slate-900/40 border border-slate-200 dark:border-white/5 rounded-[2rem] p-6 flex flex-col items-center text-center justify-center group transition-all duration-500 hover:shadow-lg">
                    <div class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 mb-4 group-hover:text-indigo-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tighter">Waktu Belajar</h4>
                        <p class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">{{ $productivity }}</p>
                    </div>
                </div>
                
                <div class="bg-indigo-600/5 dark:bg-indigo-500/5 border border-dashed border-indigo-200 dark:border-indigo-500/20 rounded-[2rem] p-6 relative overflow-hidden">
                    <div class="relative z-10">
                        <svg class="w-6 h-6 text-indigo-300 dark:text-indigo-800 mb-3" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C14.9124 8 14.017 7.10457 14.017 6V5C14.017 4.44772 14.4647 4 15.017 4H21.017C21.5693 4 22.017 4.44772 22.017 5V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM2.01697 21L2.01697 18C2.01697 16.8954 2.9124 16 4.01697 16H7.01697C7.56925 16 8.01697 15.5523 8.01697 15V9C8.01697 8.44772 7.56925 8 7.01697 8H4.01697C2.9124 8 2.01697 7.10457 2.01697 6V5C2.01697 4.44772 2.46468 4 3.01697 4H9.01697C9.56925 4 10.017 4.44772 10.017 5V15C10.017 18.3137 7.33067 21 4.01697 21H2.01697Z"/></svg>
                        <p class="text-[11px] md:text-xs font-bold text-slate-600 dark:text-slate-400 leading-relaxed italic">
                            "{{ $quote }}"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in { animation: fadeIn 0.8s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-siswa-layout>
