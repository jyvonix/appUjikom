<x-siswa-layout>
    <div class="relative min-h-screen pb-32 md:pb-24">
        {{-- Elite Page Header --}}
        <div class="mb-8 md:mb-14 space-y-6 animate-fade-in px-1">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 shadow-[0_0_10px_rgba(79,70,229,0.5)]"></div>
                        <span class="text-[9px] md:text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em]">Performance History</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-none">
                        Riwayat <span class="text-indigo-600 dark:text-indigo-400">Akademik</span>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 font-medium text-xs md:text-sm max-w-sm md:max-w-lg leading-relaxed">
                        Arsip digital seluruh pencapaian kompetensi dan evaluasi belajar Anda.
                    </p>
                </div>

                {{-- Summary Overview (Optimized for Mobile) --}}
                <div class="flex items-center gap-2 md:gap-3">
                    <div class="flex-1 md:flex-none px-4 md:px-5 py-3 bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-white/5 rounded-2xl shadow-sm flex flex-col min-w-[100px]">
                        <span class="text-[7px] md:text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Rata-rata</span>
                        <span class="text-lg md:text-xl font-black text-slate-900 dark:text-white">{{ number_format($nilais->avg('skor') ?? 0, 1) }}</span>
                    </div>
                    <div class="flex-1 md:flex-none px-4 md:px-5 py-3 bg-indigo-600 rounded-2xl shadow-xl shadow-indigo-500/20 flex flex-col text-white min-w-[100px]">
                        <span class="text-[7px] md:text-[8px] font-black text-indigo-100 uppercase tracking-widest mb-1 opacity-70">Total Sesi</span>
                        <span class="text-lg md:text-xl font-black">{{ $nilais->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        @if($nilais->isEmpty())
            <div class="py-16 md:py-20 bg-white dark:bg-slate-900/40 border border-slate-200 dark:border-white/5 rounded-[2.5rem] flex flex-col items-center text-center shadow-sm mx-1">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-slate-50 dark:bg-slate-800 rounded-2xl md:rounded-3xl flex items-center justify-center mb-6 text-slate-200 dark:text-slate-700">
                    <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                </div>
                <h3 class="text-lg md:text-xl font-bold text-slate-800 dark:text-white tracking-tight mb-2">Belum Ada Data</h3>
                <p class="text-slate-400 text-xs md:text-sm max-w-xs px-8 mb-8">Data pengerjaan ujian Anda akan muncul di sini setelah Anda menyelesaikan sesi pertama.</p>
                <a href="{{ route('siswa.dashboard') }}" class="px-8 py-3.5 bg-indigo-600 text-white rounded-xl font-bold text-[10px] md:text-xs uppercase tracking-widest shadow-lg shadow-indigo-500/20 transition-all hover:scale-105 active:scale-95">
                    Mulai Ujian
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 gap-3 md:gap-4 px-1">
                @foreach($nilais as $index => $nilai)
                    @php 
                        $modul = $nilai->modul;
                        $modulKkm = $modul ? $modul->getSetting('kkm') : 75;
                        $isLulus = $nilai->skor >= $modulKkm; 
                        $modulName = $modul ? $modul->nama : 'Modul Terhapus';
                    @endphp
                    <div class="group relative bg-white dark:bg-slate-900/40 border border-slate-200 dark:border-white/5 rounded-[1.5rem] md:rounded-[2rem] p-4 md:p-6 transition-all duration-300 hover:shadow-xl hover:shadow-slate-200/30 dark:hover:shadow-none hover:border-indigo-300 dark:hover:border-indigo-500/30 overflow-hidden">
                        
                        {{-- Subtle Status Glow --}}
                        <div class="absolute -right-10 -top-10 w-32 h-32 md:w-40 md:h-40 rounded-full blur-[60px] md:blur-[80px] transition-opacity duration-500 opacity-0 group-hover:opacity-40 {{ $isLulus ? 'bg-emerald-500' : 'bg-rose-500' }}"></div>
                        
                        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-5 md:gap-6">
                            
                            {{-- Info Section --}}
                            <div class="flex items-center gap-4 md:gap-6 flex-1">
                                {{-- Date Badge --}}
                                <div class="flex flex-col items-center justify-center w-12 h-12 md:w-16 md:h-16 rounded-xl md:rounded-2xl {{ $isLulus ? 'bg-indigo-600 text-white' : 'bg-rose-500 text-white' }} shadow-lg shadow-indigo-500/10 shrink-0 transform group-hover:scale-105 transition-transform duration-300">
                                    <span class="text-[6px] md:text-[7px] font-black uppercase tracking-widest opacity-80 leading-none mb-1">{{ $nilai->created_at->translatedFormat('M') }}</span>
                                    <span class="text-base md:text-xl font-black leading-none tracking-tighter">{{ $nilai->created_at->format('d') }}</span>
                                </div>
                                
                                <div class="space-y-1 md:space-y-2 flex-1 min-w-0">
                                    <div class="flex items-center gap-2 md:gap-3">
                                        <span class="text-[8px] md:text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Sesi #{{ $nilais->count() - $index }}</span>
                                        <div class="w-1 h-1 rounded-full bg-slate-300 dark:bg-slate-700"></div>
                                        <span class="text-[8px] md:text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">{{ $nilai->created_at->format('H:i') }}</span>
                                    </div>
                                    <h4 class="text-sm md:text-lg font-bold text-slate-800 dark:text-white leading-tight truncate md:whitespace-normal group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $modulName }}</h4>
                                    <div class="flex items-center gap-1.5">
                                        <div class="w-1.5 h-1.5 rounded-full {{ $isLulus ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]' : 'bg-rose-500 shadow-[0_0_8px_rgba(244,63,94,0.5)]' }}"></div>
                                        <span class="text-[8px] md:text-[10px] font-black uppercase tracking-widest {{ $isLulus ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                            {{ $isLulus ? 'Certified' : 'Failed' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Stats & Action Section (Refined for Mobile) --}}
                            <div class="flex items-center justify-between lg:justify-end gap-4 md:gap-10 border-t lg:border-t-0 pt-4 lg:pt-0 border-slate-50 dark:border-white/5">
                                <div class="flex items-center gap-4 md:gap-8 flex-1 lg:flex-none">
                                    <div class="flex flex-col items-start md:items-center">
                                        <span class="text-[7px] md:text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Benar</span>
                                        <span class="text-sm md:text-base font-black text-slate-700 dark:text-slate-200">{{ $nilai->jumlah_benar }}</span>
                                    </div>
                                    <div class="w-px h-6 md:h-8 bg-slate-100 dark:bg-white/5"></div>
                                    <div class="flex flex-col items-start md:items-center">
                                        <span class="text-[7px] md:text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Skor Akhir</span>
                                        <span class="text-xl md:text-2xl font-black {{ $isLulus ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400 dark:text-slate-600' }} tracking-tighter">
                                            {{ number_format($nilai->skor, 0) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="shrink-0">
                                    @php
                                        $canPreview = false;
                                        if ($modul) {
                                            $modulMaxRetakes = (int)$modul->getSetting('max_retakes');
                                            $totalPercobaan = \App\Models\Nilai::where('user_id', Auth::id())
                                                ->where('modul_id', $nilai->modul_id)
                                                ->count();
                                            
                                            // Siswa bisa preview jika:
                                            // 1. Sudah LULUS (skor >= KKM)
                                            // 2. ATAU sudah menghabiskan semua kesempatan (percobaan >= max_retakes)
                                            $canPreview = ($isLulus) || ($totalPercobaan >= $modulMaxRetakes);
                                        }
                                    @endphp
                                    
                                    @if($canPreview)
                                        <a href="{{ route('siswa.nilai.preview', $nilai->id) }}" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-xl md:rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 shadow-lg hover:scale-105 active:scale-95 transition-all group/btn">
                                            <svg class="w-5 h-5 md:w-6 md:h-6 group-hover/btn:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                                        </a>
                                    @else
                                        <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-xl md:rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-300 dark:text-slate-600 border border-slate-200 dark:border-white/5 cursor-not-allowed group/locked relative">
                                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                            
                                            {{-- Tooltip info --}}
                                            <div class="absolute bottom-full mb-3 left-1/2 -translate-x-1/2 px-3 py-2 bg-slate-900 text-[9px] font-bold text-white uppercase tracking-widest rounded-lg opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap shadow-xl">
                                                Locked: Complete Remedial First
                                                <div class="absolute top-full left-1/2 -translate-x-1/2 border-8 border-transparent border-t-slate-900"></div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Verification Footer --}}
        <div class="mt-16 text-center opacity-20">
            <p class="text-[8px] md:text-[9px] font-bold text-slate-400 uppercase tracking-[0.4em]">Encrypted Digital Transcript</p>
        </div>
    </div>

    <style>
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-siswa-layout>
