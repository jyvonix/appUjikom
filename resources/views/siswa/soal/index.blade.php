<x-siswa-layout>
    <div class="relative min-h-screen">
        {{-- Premium Header Section --}}
        <div class="mb-8 md:mb-12 space-y-6 md:space-y-8 animate-slide-in">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 md:gap-8">
                <div class="space-y-3 md:space-y-4">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-full backdrop-blur-md">
                        <div class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(79,70,229,0.8)]"></div>
                        <span class="text-[9px] md:text-[10px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">Examination Portal</span>
                    </div>
                    <h1 class="text-3xl md:text-6xl font-black text-slate-900 dark:text-white tracking-tighter leading-tight">
                        Modul <span class="text-indigo-gradient">Ujian</span>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 font-bold text-xs md:text-lg max-w-xl leading-relaxed">
                        Pilih modul di bawah ini. Pastikan Anda telah melakukan persiapan maksimal.
                    </p>
                </div>
            </div>
        </div>

        {{-- Modul Selection Grid --}}
        <div class="space-y-8 md:space-y-10">
            <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-4 md:pb-6">
                <h2 class="text-lg md:text-xl font-black text-slate-800 dark:text-white flex items-center gap-3 md:gap-4">
                    <span class="w-1.5 md:w-2 h-6 md:h-8 bg-indigo-600 rounded-full"></span>
                    Available Assessments
                </h2>
                <span class="hidden md:block text-[9px] font-black text-slate-400 uppercase tracking-[0.3em]">SECURE ACCESS ENABLED</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($moduls as $modul)
                    <div class="card-pro group rounded-[2.5rem] md:rounded-[3.5rem] p-3 md:p-4 flex flex-col relative overflow-hidden transition-all duration-500 hover:border-indigo-500/30">
                        {{-- Background Accent Glow --}}
                        <div class="absolute -top-24 -right-24 w-48 h-48 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-all duration-700"></div>
                        
                        <div class="p-5 md:p-8 flex-1 flex flex-col relative z-10">
                            {{-- Header Card --}}
                            <div class="flex items-start justify-between mb-8 md:mb-10">
                                <div class="w-14 h-14 md:w-16 md:h-16 bg-slate-50 dark:bg-slate-800/50 rounded-[1.5rem] md:rounded-[1.8rem] flex items-center justify-center text-slate-400 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500 shadow-inner transform group-hover:rotate-6 group-hover:scale-110">
                                    <svg class="w-7 h-7 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <div class="flex flex-col items-end">
                                    <span class="text-[9px] md:text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">Items</span>
                                    <span class="text-lg md:text-xl font-black text-slate-800 dark:text-white">{{ $modul->soals_count }}</span>
                                </div>
                            </div>

                            <h3 class="text-xl md:text-2xl font-black text-slate-800 dark:text-white mb-3 md:mb-4 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors leading-tight">{{ $modul->nama }}</h3>
                            <p class="text-slate-400 dark:text-slate-500 font-bold text-[11px] md:text-xs leading-relaxed mb-8 md:mb-10 line-clamp-3">
                                {{ $modul->deskripsi ?? 'Akselerasi penguasaan materi ' . $modul->nama . ' melalui instrumen penilaian berstandar kompetensi industri.' }}
                            </p>

                            {{-- Dynamic Metadata Tags --}}
                            <div class="flex flex-wrap gap-2 md:gap-3 mb-8 md:mb-10 mt-auto">
                                <div class="px-3 md:px-4 py-1.5 md:py-2 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-100 dark:border-slate-700/50 flex items-center gap-2">
                                    <svg class="w-3 md:w-3.5 h-3 md:h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="text-[9px] md:text-[10px] font-black text-slate-600 dark:text-slate-300 uppercase tracking-widest">{{ $modul->waktu }} MIN</span>
                                </div>
                                <div class="px-3 md:px-4 py-1.5 md:py-2 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-100 dark:border-slate-700/50 flex items-center gap-2">
                                    <svg class="w-3 md:w-3.5 h-3 md:h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="text-[9px] md:text-[10px] font-black text-slate-600 dark:text-slate-300 uppercase tracking-widest">{{ $modul->getSetting('kkm') }}% PASS</span>
                                </div>
                            </div>

                            <a href="{{ route('siswa.soal.kerjakan', ['modul_id' => $modul->id]) }}" class="btn-premium w-full py-4 md:py-5 text-white rounded-[1.5rem] md:rounded-[2rem] font-black text-[9px] md:text-[10px] uppercase tracking-[0.3em] flex items-center justify-center gap-2 md:gap-3 shadow-xl active:scale-95 transition-transform">
                                <span>Initialize Session</span>
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 md:py-32 card-pro rounded-[3rem] md:rounded-[4rem] border-2 border-dashed flex flex-col items-center justify-center text-center group">
                        <div class="w-24 h-24 md:w-32 md:h-32 bg-slate-50 dark:bg-slate-800 rounded-[2.5rem] md:rounded-[3rem] flex items-center justify-center mb-6 md:mb-8 shadow-inner transform -rotate-6 group-hover:rotate-0 transition-all duration-700">
                            <svg class="w-12 h-12 md:w-16 md:h-16 text-slate-200 dark:text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-black text-slate-800 dark:text-white uppercase tracking-tighter mb-3 md:mb-4">No Session Detected</h3>
                        <p class="text-slate-400 dark:text-slate-500 font-bold text-xs md:text-sm max-w-sm px-8">Maaf, saat ini belum ada modul ujian aktif yang tersedia untuk Anda.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Verification Insight --}}
        <div class="mt-20 md:mt-32 border-t border-slate-200 dark:border-slate-800 pt-8 md:pt-12 flex flex-col md:flex-row items-center justify-between gap-6 md:gap-8 opacity-40 mb-10 md:mb-0">
            <div class="flex items-center gap-4">
                <div class="w-8 h-8 md:w-10 md:h-10 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">SmartExam Protocol v2.0</span>
            </div>
            <p class="text-[8px] md:text-[9px] font-black text-slate-400 uppercase tracking-[0.5em] text-center md:text-right">SECURE ENVIRONMENT AUTHENTICATED</p>
        </div>
    </div>
</x-siswa-layout>
