<x-siswa-layout>
    <div class="relative min-h-screen pb-20">
        {{-- High-End Header Section --}}
        <div class="mb-8 md:mb-12 animate-slide-in">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 md:gap-8">
                <div class="space-y-3 md:space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-indigo-200">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <span class="text-[9px] md:text-[10px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-[0.4em]">Post-Assessment Review</span>
                    </div>
                    <h1 class="text-3xl md:text-6xl font-black text-slate-900 dark:text-white tracking-tighter leading-tight">
                        Analisis <span class="text-indigo-gradient">Jawaban</span>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 font-bold text-xs md:text-lg max-w-xl leading-relaxed">
                        Evaluasi mendalam untuk setiap parameter pertanyaan guna meningkatkan akurasi kognitif Anda.
                    </p>
                </div>
                
                <a href="{{ route('siswa.nilai.index') }}" class="group flex items-center justify-center gap-3 md:gap-4 px-6 md:px-8 py-3 md:py-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 rounded-2xl font-black text-[9px] md:text-[10px] uppercase tracking-[0.3em] hover:bg-slate-50 dark:hover:bg-slate-800 transition-all shadow-sm">
                    <svg class="w-3.5 h-3.5 md:w-4 md:h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Back to Ledger
                </a>
            </div>
        </div>

        {{-- Metrics Dashboard --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-6 mb-12 md:mb-16">
            <div class="card-pro p-6 md:p-8 rounded-[2rem] md:rounded-[3rem] flex items-center gap-6 md:gap-8 relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-indigo-500/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000"></div>
                <div class="w-12 h-12 md:w-16 md:h-16 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-2xl shadow-indigo-200">
                    <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <p class="text-[8px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Final Score</p>
                    <h4 class="text-3xl md:text-4xl font-black text-slate-800 dark:text-white leading-none">{{ number_format($nilai->skor, 0) }}</h4>
                </div>
            </div>
            <div class="card-pro p-6 md:p-8 rounded-[2rem] md:rounded-[3rem] flex items-center gap-6 md:gap-8 relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-500/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000"></div>
                <div class="w-12 h-12 md:w-16 md:h-16 rounded-2xl bg-emerald-500 flex items-center justify-center text-white shadow-2xl shadow-emerald-200">
                    <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                </div>
                <div>
                    <p class="text-[8px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Accuracy</p>
                    <h4 class="text-3xl md:text-4xl font-black text-slate-800 dark:text-white leading-none">{{ $nilai->jumlah_benar }} <span class="text-xs md:text-sm text-slate-300 dark:text-slate-600">/ {{ $soals->count() }}</span></h4>
                </div>
            </div>
            <div class="card-pro p-6 md:p-8 rounded-[2rem] md:rounded-[3rem] flex items-center gap-6 md:gap-8 relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-rose-500/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000"></div>
                <div class="w-12 h-12 md:w-16 md:h-16 rounded-2xl bg-rose-500 flex items-center justify-center text-white shadow-2xl shadow-rose-200">
                    <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </div>
                <div>
                    <p class="text-[8px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Anomalies</p>
                    <h4 class="text-3xl md:text-4xl font-black text-slate-800 dark:text-white leading-none">{{ $soals->count() - $nilai->jumlah_benar }}</h4>
                </div>
            </div>
        </div>

        {{-- Question Review Stream --}}
        <div class="space-y-6 md:space-y-8">
            @foreach($soals as $index => $soal)
                @php
                    $jawabanSiswa = $nilai->list_jawaban[$soal->id] ?? null;
                    $isCorrect = strtoupper($jawabanSiswa) === strtoupper($soal->jawaban_benar);
                @endphp
                <div class="card-pro group rounded-[2.5rem] md:rounded-[3.5rem] overflow-hidden transition-all duration-500 {{ $isCorrect ? 'hover:border-emerald-500/30' : 'hover:border-rose-500/30' }}">
                    <div class="p-6 md:p-12">
                        <div class="flex items-start justify-between gap-4 md:gap-6 mb-8 md:mb-10">
                            <div class="flex items-center gap-4 md:gap-6">
                                <span class="text-4xl md:text-5xl font-black {{ $isCorrect ? 'text-emerald-500/10 dark:text-emerald-500/5' : 'text-rose-500/10 dark:text-rose-500/5' }} select-none tracking-tighter">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <div class="px-4 md:px-5 py-1.5 md:py-2 rounded-xl md:rounded-2xl {{ $isCorrect ? 'bg-emerald-500/10 border border-emerald-500/20 text-emerald-600' : 'bg-rose-500/10 border border-rose-500/20 text-rose-600' }}">
                                    <span class="text-[8px] md:text-[10px] font-black uppercase tracking-[0.2em]">{{ $isCorrect ? 'Verified' : 'Invalid' }}</span>
                                </div>
                            </div>
                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl md:rounded-2xl flex items-center justify-center {{ $isCorrect ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white' }} shadow-xl">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="{{ $isCorrect ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12' }}" /></svg>
                            </div>
                        </div>

                        <h3 class="text-lg md:text-3xl font-bold text-slate-800 dark:text-white leading-snug mb-8 md:mb-10 tracking-tight">
                            {{ $soal->pertanyaan }}
                        </h3>

                        @if($soal->gambar)
                            <div class="mb-8 md:mb-10 rounded-2xl md:rounded-[2.5rem] overflow-hidden border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 inline-block p-2 shadow-inner">
                                <img src="{{ asset('storage/' . $soal->gambar) }}" class="max-h-60 md:max-h-80 w-auto rounded-xl md:rounded-2xl">
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                            @foreach(['A', 'B', 'C', 'D', 'E'] as $opsi)
                                @php 
                                    $opsiKey = 'opsi_' . strtolower($opsi);
                                    $isThisCorrect = $opsi === strtoupper($soal->jawaban_benar);
                                    $isThisStudentChoice = $opsi === strtoupper($jawabanSiswa);
                                @endphp
                                @if($soal->$opsiKey)
                                    <div class="relative p-5 md:p-8 rounded-[1.5rem] md:rounded-[2rem] border-2 transition-all duration-300 flex items-center gap-4 md:gap-6 overflow-hidden
                                        {{ $isThisCorrect ? 'border-emerald-500 bg-emerald-50 dark:bg-emerald-500/5' : ($isThisStudentChoice ? 'border-rose-500 bg-rose-50 dark:bg-rose-500/5' : 'border-slate-50 dark:border-slate-800 bg-white dark:bg-slate-900/40') }}">
                                        
                                        @if($isThisCorrect)
                                            <div class="absolute left-0 top-0 bottom-0 w-1 md:w-1.5 bg-emerald-500"></div>
                                        @elseif($isThisStudentChoice)
                                            <div class="absolute left-0 top-0 bottom-0 w-1 md:w-1.5 bg-rose-500"></div>
                                        @endif

                                        <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl flex items-center justify-center font-black text-sm md:text-lg shadow-sm transition-all
                                            {{ $isThisCorrect ? 'bg-emerald-500 text-white shadow-emerald-200' : ($isThisStudentChoice ? 'bg-rose-500 text-white shadow-rose-200' : 'bg-slate-100 dark:bg-slate-800 text-slate-400') }}">
                                            {{ $opsi }}
                                        </div>

                                        <span class="font-bold text-sm md:text-xl tracking-tight leading-snug flex-1 min-w-0 {{ $isCorrect ? ($isThisCorrect ? 'text-emerald-900 dark:text-emerald-400' : 'text-slate-600 dark:text-slate-400') : ($isThisCorrect ? 'text-emerald-900 dark:text-emerald-400' : ($isThisStudentChoice ? 'text-rose-900 dark:text-rose-400' : 'text-slate-600 dark:text-slate-400')) }}">
                                            {{ $soal->$opsiKey }}
                                        </span>

                                        @if($isThisCorrect)
                                            <div class="shrink-0 w-6 h-6 md:w-8 md:h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white shadow-lg">
                                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7" /></svg>
                                            </div>
                                        @elseif($isThisStudentChoice)
                                            <div class="shrink-0 w-6 h-6 md:w-8 md:h-8 rounded-full bg-rose-500 flex items-center justify-center text-white shadow-lg">
                                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M6 18L18 6M6 6l12 12" /></svg>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        @if(!$isCorrect)
                            <div class="mt-8 md:mt-10 p-6 md:p-8 bg-indigo-50 dark:bg-indigo-500/5 rounded-[2rem] md:rounded-[2.5rem] border border-indigo-100 dark:border-indigo-500/20 flex flex-col md:flex-row md:items-center gap-6 md:gap-8">
                                <div class="w-12 h-12 md:w-16 md:h-16 rounded-[1.2rem] md:rounded-[1.5rem] bg-white dark:bg-slate-900 flex items-center justify-center text-indigo-600 shadow-xl shadow-indigo-100 dark:shadow-none shrink-0">
                                    <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[8px] md:text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em]">Insight</p>
                                    <p class="text-xs md:text-base font-bold text-indigo-900 dark:text-indigo-300 leading-relaxed">
                                        Jawaban yang tepat adalah <span class="px-2 py-0.5 bg-indigo-600 text-white rounded-md text-[10px] md:text-xs mx-1">{{ strtoupper($soal->jawaban_benar) }}</span>. 
                                        Anda memilih {{ $jawabanSiswa ? strtoupper($jawabanSiswa) : 'NULL' }}.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Verification Footer --}}
        <div class="mt-20 md:mt-24 text-center opacity-30">
            <p class="text-[8px] md:text-[9px] font-black text-slate-400 uppercase tracking-[0.8em]">END OF ANALYSIS STREAM</p>
        </div>
    </div>
</x-siswa-layout>
