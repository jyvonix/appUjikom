<x-siswa-layout>
    <div class="relative min-h-screen pb-20">
        {{-- High-End Header Section --}}
        <div class="mb-16 space-y-10 animate-slide-in">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-10">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-indigo-200 group-hover:rotate-6 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <span class="text-[10px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-[0.4em]">Performance Ledger</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black text-slate-900 dark:text-white tracking-tighter leading-none">
                        Riwayat <span class="text-indigo-gradient">Akademik</span>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 font-bold text-sm md:text-lg max-w-xl leading-relaxed">
                        Dokumentasi terenkripsi dari seluruh pencapaian dan evaluasi kompetensi yang telah Anda lalui.
                    </p>
                </div>

                {{-- Summary Stats (Glassmorphism) --}}
                <div class="flex flex-wrap items-center gap-4">
                    <div class="px-8 py-6 card-pro rounded-[2.5rem] flex flex-col items-center justify-center min-w-[160px] relative overflow-hidden group">
                        <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-indigo-500/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 group-hover:text-indigo-500 transition-colors">IPK Rata-rata</span>
                        <span class="text-4xl font-black text-slate-800 dark:text-white">{{ number_format($nilais->avg('skor') ?? 0, 1) }}</span>
                    </div>
                    <div class="px-8 py-6 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-[2.5rem] flex flex-col items-center justify-center min-w-[160px] text-white shadow-2xl shadow-indigo-200 transform hover:-translate-y-1 transition-all">
                        <span class="text-[9px] font-black text-indigo-100 uppercase tracking-widest mb-2 opacity-80">Total Sesi</span>
                        <span class="text-4xl font-black">{{ $nilais->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        @if($nilais->isEmpty())
            <div class="py-32 card-pro rounded-[4rem] border-2 border-dashed flex flex-col items-center justify-center text-center">
                <div class="w-32 h-32 bg-slate-50 dark:bg-slate-800 rounded-[3rem] flex items-center justify-center mb-8 shadow-inner transform rotate-3 group hover:rotate-0 transition-transform duration-500">
                    <svg class="w-16 h-16 text-slate-200 dark:text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                </div>
                <h3 class="text-3xl font-black text-slate-800 dark:text-white uppercase tracking-tighter mb-4">Ledger is Empty</h3>
                <p class="text-slate-400 font-bold text-sm max-w-sm px-10 mb-10">Belum ada data pengerjaan yang tercatat dalam sistem kami. Mulailah ujian pertama Anda.</p>
                <a href="{{ route('siswa.dashboard') }}" class="btn-premium px-10 py-5 text-white rounded-[2rem] font-black text-[10px] uppercase tracking-[0.3em] shadow-xl">
                    Initialize First Session
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6">
                @foreach($nilais as $index => $nilai)
                    @php 
                        $modul = $nilai->modul;
                        $modulKkm = $modul ? $modul->getSetting('kkm') : 75;
                        $isLulus = $nilai->skor >= $modulKkm; 
                        $modulName = $modul ? $modul->nama : 'Modul Terhapus';
                    @endphp
                    <div class="card-pro group rounded-[3rem] p-2 relative overflow-hidden">
                        {{-- Status Highlight Background --}}
                        <div class="absolute inset-0 bg-gradient-to-r {{ $isLulus ? 'from-emerald-500/5 to-teal-500/5' : 'from-rose-500/5 to-orange-500/5' }} opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                        
                        <div class="px-8 py-8 md:px-12 md:py-10 flex flex-col lg:flex-row lg:items-center justify-between gap-10 relative z-10">
                            
                            {{-- Left Section: Transcript Meta --}}
                            <div class="flex items-center gap-10">
                                <div class="flex flex-col items-center justify-center w-24 h-24 rounded-[2.5rem] {{ $isLulus ? 'bg-indigo-600 text-white shadow-indigo-200' : 'bg-rose-500 text-white shadow-rose-200' }} shrink-0 shadow-2xl transform transition-all group-hover:scale-110 group-hover:rotate-3">
                                    <span class="text-[10px] font-black uppercase tracking-widest mb-1 opacity-80">{{ $nilai->created_at->translatedFormat('M') }}</span>
                                    <span class="text-4xl font-black leading-none tracking-tighter">{{ $nilai->created_at->format('d') }}</span>
                                </div>
                                
                                <div class="space-y-3">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <span class="px-4 py-1.5 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-full text-[9px] font-black text-slate-400 uppercase tracking-widest shadow-sm">SESSION #{{ $nilais->count() - $index }}</span>
                                        @if($modul)
                                            <span class="px-4 py-1.5 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-500/20 rounded-full text-[9px] font-black uppercase tracking-widest">VERIFIED MODULE</span>
                                        @endif
                                    </div>
                                    <h4 class="text-2xl md:text-3xl font-black text-slate-800 dark:text-white leading-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $modulName }}</h4>
                                    <div class="flex items-center gap-8 text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                                        <div class="flex items-center gap-2.5">
                                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            {{ $nilai->created_at->format('H:i') }} WIB
                                        </div>
                                        <div class="flex items-center gap-2.5 {{ $isLulus ? 'text-emerald-500' : 'text-rose-500' }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            {{ $nilai->jumlah_benar }} CORRECT
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Right Section: Data Visualization --}}
                            <div class="flex flex-col sm:flex-row items-center justify-between lg:justify-end gap-12 border-t lg:border-t-0 pt-10 lg:pt-0 border-slate-100 dark:border-slate-800">
                                <div class="flex items-center gap-12">
                                    <div class="text-left sm:text-right space-y-2">
                                        <span class="text-[10px] font-black text-slate-300 dark:text-slate-600 uppercase tracking-[0.3em] block leading-none">CERTIFICATION STATUS</span>
                                        <div class="flex items-center gap-3 lg:justify-end">
                                            <div class="w-2.5 h-2.5 rounded-full {{ $isLulus ? 'bg-emerald-500 animate-pulse' : 'bg-rose-500' }}"></div>
                                            <span class="text-sm font-black uppercase tracking-widest {{ $isLulus ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600' }}">
                                                {{ $isLulus ? 'Certified' : 'Incomplete' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="text-center relative">
                                        <div class="absolute inset-0 bg-indigo-500/10 blur-3xl rounded-full scale-150 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                        <span class="text-7xl font-black {{ $isLulus ? 'text-slate-900 dark:text-white' : 'text-slate-300 dark:text-slate-700' }} tracking-tighter leading-none relative">
                                            {{ number_format($nilai->skor, 0) }}
                                        </span>
                                        <span class="block text-[10px] font-black text-slate-300 dark:text-slate-600 uppercase tracking-widest mt-2">PERCENTILE</span>
                                    </div>
                                </div>

                                <div class="shrink-0">
                                    @php
                                        $canPreview = false;
                                        if ($modul) {
                                            $modulMaxRetakes = $modul->getSetting('max_retakes');
                                            $totalPercobaan = \App\Models\Nilai::where('user_id', Auth::id())->where('modul_id', $nilai->modul_id)->count();
                                            $canPreview = ($totalPercobaan >= $modulMaxRetakes) || ($modul->show_result);
                                        }
                                    @endphp
                                    
                                    @if($canPreview)
                                        <a href="{{ route('siswa.nilai.preview', $nilai->id) }}" class="btn-premium flex items-center justify-center w-20 h-20 text-white rounded-[2rem] shadow-2xl active:scale-90 transform group-hover:shadow-indigo-500/20">
                                            <svg class="w-10 h-10 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                                        </a>
                                    @else
                                        <div class="flex items-center justify-center w-20 h-20 bg-slate-50 dark:bg-slate-800/50 text-slate-200 dark:text-slate-700 rounded-[2rem] border border-slate-100 dark:border-slate-700/50 cursor-not-allowed group/tool relative transition-all">
                                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-6 px-6 py-3 bg-slate-900 text-white text-[10px] font-black rounded-[1.5rem] opacity-0 group-hover/tool:opacity-100 transition-all whitespace-nowrap pointer-events-none transform translate-y-4 group-hover/tool:translate-y-0 shadow-[0_20px_50px_rgba(0,0,0,0.3)] z-50">
                                                LOCKED: ACCESS REQUIRES MAX RETAKES
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

        {{-- Transcript Authentication Footer --}}
        <div class="mt-32 text-center pb-12 opacity-40">
            <div class="flex items-center justify-center gap-8 mb-6">
                <div class="w-20 h-px bg-gradient-to-r from-transparent to-slate-300 dark:to-slate-700"></div>
                <div class="flex gap-2">
                    <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                    <div class="w-2 h-2 rounded-full bg-purple-500"></div>
                </div>
                <div class="w-20 h-px bg-gradient-to-l from-transparent to-slate-300 dark:to-slate-700"></div>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.6em] leading-relaxed">
                DIGITALLY SIGNED & VERIFIED BY SMARTEXAM INFRASTRUCTURE
            </p>
        </div>
    </div>
</x-siswa-layout>
