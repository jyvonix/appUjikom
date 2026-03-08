<x-siswa-layout>
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight mb-2">Review <span class="text-indigo-600">Hasil Ujian</span></h2>
            <p class="text-slate-500 font-bold text-sm">Analisis jawaban Anda untuk belajar lebih baik.</p>
        </div>
        <a href="{{ route('siswa.nilai.index') }}" class="px-6 py-3 bg-white border-2 border-slate-100 text-slate-500 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-50 transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm flex items-center gap-6">
            <div class="w-14 h-14 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Skor Akhir</p>
                <h4 class="text-3xl font-black text-slate-800 leading-none">{{ number_format($nilai->skor, 0) }}</h4>
            </div>
        </div>
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm flex items-center gap-6">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Benar</p>
                <h4 class="text-3xl font-black text-slate-800 leading-none">{{ $nilai->jumlah_benar }} <span class="text-sm text-slate-300">/ {{ $soals->count() }}</span></h4>
            </div>
        </div>
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm flex items-center gap-6">
            <div class="w-14 h-14 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Salah</p>
                <h4 class="text-3xl font-black text-slate-800 leading-none">{{ $soals->count() - $nilai->jumlah_benar }}</h4>
            </div>
        </div>
    </div>

    <div class="space-y-8">
        @foreach($soals as $index => $soal)
            @php
                $jawabanSiswa = $nilai->list_jawaban[$soal->id] ?? null;
                $isCorrect = strtoupper($jawabanSiswa) === strtoupper($soal->jawaban_benar);
            @endphp
            <div class="bg-white rounded-[2.5rem] border {{ $isCorrect ? 'border-emerald-100' : 'border-rose-100' }} overflow-hidden shadow-sm">
                <div class="p-8 md:p-12">
                    <div class="flex items-start justify-between gap-4 mb-8">
                        <div class="flex items-center gap-4">
                            <span class="w-10 h-10 rounded-xl {{ $isCorrect ? 'bg-emerald-500' : 'bg-rose-500' }} text-white flex items-center justify-center font-black shadow-lg">
                                {{ $index + 1 }}
                            </span>
                            <span class="text-[11px] font-black text-slate-400 uppercase tracking-[0.3em]">Pertanyaan</span>
                        </div>
                        <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $isCorrect ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                            {{ $isCorrect ? 'BENAR' : 'SALAH' }}
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-slate-800 leading-relaxed mb-8">
                        {{ $soal->pertanyaan }}
                    </h3>

                    @if($soal->gambar)
                        <div class="mb-8 rounded-3xl overflow-hidden border border-slate-100 bg-slate-50 inline-block p-2">
                            <img src="{{ asset('storage/' . $soal->gambar) }}" class="max-h-60 w-auto rounded-2xl">
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach(['A', 'B', 'C', 'D', 'E'] as $opsi)
                            @php 
                                $opsiKey = 'opsi_' . strtolower($opsi);
                                $isThisCorrect = $opsi === strtoupper($soal->jawaban_benar);
                                $isThisStudentChoice = $opsi === strtoupper($jawabanSiswa);
                            @endphp
                            @if($soal->$opsiKey)
                                <div class="p-5 rounded-2xl border-2 transition-all flex items-center gap-4
                                    {{ $isThisCorrect ? 'border-emerald-500 bg-emerald-50' : ($isThisStudentChoice ? 'border-rose-500 bg-rose-50' : 'border-slate-50 bg-white') }}">
                                    
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center font-black text-xs
                                        {{ $isThisCorrect ? 'bg-emerald-500 text-white' : ($isThisStudentChoice ? 'bg-rose-500 text-white' : 'bg-slate-100 text-slate-400') }}">
                                        {{ $opsi }}
                                    </div>

                                    <span class="font-bold text-sm {{ $isThisCorrect ? 'text-emerald-900' : ($isThisStudentChoice ? 'text-rose-900' : 'text-slate-600') }}">
                                        {{ $soal->$opsiKey }}
                                    </span>

                                    @if($isThisCorrect)
                                        <svg class="w-5 h-5 text-emerald-600 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                    @elseif($isThisStudentChoice)
                                        <svg class="w-5 h-5 text-rose-600 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>

                    @if(!$isCorrect)
                        <div class="mt-8 p-4 bg-indigo-50 rounded-2xl border border-indigo-100 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-indigo-600 shadow-sm flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <p class="text-xs font-bold text-indigo-700 leading-relaxed">
                                Jawaban yang benar adalah <span class="px-2 py-0.5 bg-indigo-600 text-white rounded-md text-[10px]">{{ strtoupper($soal->jawaban_benar) }}</span>. 
                                Anda memilih {{ $jawabanSiswa ? strtoupper($jawabanSiswa) : 'Tidak Menjawab' }}.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-siswa-layout>
