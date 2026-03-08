<x-guru-layout>
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-4xl font-black text-slate-800 tracking-tight mb-2">Kunci <span class="text-indigo-600">Jawaban</span></h2>
            <p class="text-slate-500 font-bold">Daftar kunci jawaban soal yang Anda buat.</p>
        </div>
        <div class="flex gap-4">
            <button onclick="window.print()" class="px-6 py-3 bg-white border-2 border-slate-100 text-slate-500 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-50 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                Cetak Kunci
            </button>
            <a href="{{ route('guru.soal.index') }}" class="px-6 py-3 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg active:scale-95 transform"> Kembali ke Bank Soal</a>
        </div>
    </div>

    @if($soals->isEmpty())
        <div class="bg-white rounded-[3rem] p-20 text-center border-2 border-dashed border-slate-100">
            <h3 class="text-xl font-black text-slate-400 uppercase tracking-widest">Belum Ada Soal</h3>
            <p class="text-slate-300 font-bold mt-2">Buat soal terlebih dahulu untuk melihat kunci jawaban.</p>
        </div>
    @else
        <div class="space-y-6 print:space-y-4">
            @foreach($soals as $index => $soal)
                <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm print:shadow-none print:border-slate-200">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <span class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-black shadow-lg">
                                {{ $index + 1 }}
                            </span>
                            <span class="text-[11px] font-black text-slate-400 uppercase tracking-[0.3em]">Pertanyaan</span>
                        </div>
                        <div class="px-4 py-2 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-xl flex items-center gap-2">
                            <span class="text-[10px] font-black uppercase tracking-widest">Kunci:</span>
                            <span class="text-lg font-black">{{ $soal->jawaban_benar }}</span>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 leading-relaxed mb-6">
                        {{ $soal->pertanyaan }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach(['A', 'B', 'C', 'D', 'E'] as $opsi)
                            @php 
                                $opsiKey = 'opsi_' . strtolower($opsi);
                                $isCorrect = $opsi === strtoupper($soal->jawaban_benar);
                            @endphp
                            @if($soal->$opsiKey)
                                <div class="p-4 rounded-xl border {{ $isCorrect ? 'border-emerald-500 bg-emerald-50' : 'border-slate-50 bg-slate-50/30' }} flex items-center gap-3">
                                    <div class="w-6 h-6 rounded flex items-center justify-center font-black text-[10px] {{ $isCorrect ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-400' }}">
                                        {{ $opsi }}
                                    </div>
                                    <span class="text-sm font-bold {{ $isCorrect ? 'text-emerald-900' : 'text-slate-500' }}">
                                        {{ $soal->$opsiKey }}
                                    </span>
                                    @if($isCorrect)
                                        <svg class="w-4 h-4 text-emerald-600 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <style>
        @media print {
            body { background: white !important; }
            .sidebar-container, .mb-10 .flex, .main-content { margin: 0 !important; padding: 0 !important; }
            .sidebar-container { display: none !important; }
            .main-content { margin-left: 0 !important; }
            button, a { display: none !important; }
        }
    </style>
</x-guru-layout>
