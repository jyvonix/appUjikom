<x-admin-layout>
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.nilai.index') }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Preview Jawaban: <span class="text-indigo-600">{{ $nilai->user->name }}</span></h2>
                <p class="text-slate-500 font-medium text-sm">Modul: {{ $nilai->modul->nama }}</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="px-6 py-4 bg-white rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="text-right">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Skor Akhir</p>
                    <p class="text-2xl font-black {{ $nilai->skor >= $nilai->modul->getSetting('kkm') ? 'text-emerald-600' : 'text-rose-600' }} leading-none">{{ number_format($nilai->skor, 0) }}</p>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div class="text-right">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status</p>
                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $nilai->skor >= $nilai->modul->getSetting('kkm') ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                        {{ $nilai->skor >= $nilai->modul->getSetting('kkm') ? 'LULUS' : 'REMEDIAL' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @forelse($soals as $index => $soal)
            @php
                $jawabanSiswa = $nilai->list_jawaban[$soal->id] ?? null;
                $kunciJawaban = strtoupper($soal->jawaban_benar);
                $isCorrect = $jawabanSiswa && strtoupper($jawabanSiswa) === $kunciJawaban;
            @endphp
            <div class="bg-white rounded-[2.5rem] border {{ $isCorrect ? 'border-emerald-200 shadow-emerald-100' : 'border-rose-200 shadow-rose-100' }} p-8 shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 {{ $isCorrect ? 'bg-emerald-50' : 'bg-rose-50' }} rounded-bl-[100px] -z-0 opacity-50"></div>
                
                <div class="relative z-10 flex flex-col lg:flex-row gap-8">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-4 py-2 {{ $isCorrect ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white' }} text-[11px] font-black uppercase rounded-xl tracking-widest shadow-md">
                                Soal #{{ $index + 1 }}
                            </span>
                            @if($isCorrect)
                                <span class="flex items-center gap-1 text-[11px] font-black text-emerald-600 uppercase tracking-widest">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Benar
                                </span>
                            @else
                                <span class="flex items-center gap-1 text-[11px] font-black text-rose-600 uppercase tracking-widest">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Salah
                                </span>
                            @endif
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 leading-relaxed mb-6">{{ $soal->pertanyaan }}</h3>

                        @if($soal->gambar)
                            <div class="mb-6 rounded-2xl overflow-hidden border border-slate-100 w-full max-w-md">
                                <img src="{{ asset('storage/' . $soal->gambar) }}" alt="Gambar Soal" class="w-full h-auto object-cover p-2">
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach(['A', 'B', 'C', 'D', 'E'] as $opt)
                                @php
                                    $isPilihanSiswa = strtoupper($jawabanSiswa) === $opt;
                                    $isKunci = $kunciJawaban === $opt;
                                    
                                    $bgColor = 'bg-slate-50 border-slate-100 text-slate-600';
                                    $badgeColor = 'bg-white text-slate-400 border border-slate-200';
                                    
                                    if ($isKunci && $isPilihanSiswa) {
                                        $bgColor = 'bg-emerald-50 border-emerald-200 ring-2 ring-emerald-500/20 text-emerald-900';
                                        $badgeColor = 'bg-emerald-500 text-white border-emerald-500';
                                    } elseif ($isKunci && !$isPilihanSiswa) {
                                        $bgColor = 'bg-indigo-50 border-indigo-200 text-indigo-900';
                                        $badgeColor = 'bg-indigo-500 text-white border-indigo-500';
                                    } elseif (!$isKunci && $isPilihanSiswa) {
                                        $bgColor = 'bg-rose-50 border-rose-200 ring-2 ring-rose-500/20 text-rose-900';
                                        $badgeColor = 'bg-rose-500 text-white border-rose-500';
                                    }
                                @endphp
                                <div class="relative p-4 rounded-xl border {{ $bgColor }} flex items-center gap-3 transition-colors">
                                    <div class="w-8 h-8 shrink-0 rounded-lg flex items-center justify-center font-black text-[11px] {{ $badgeColor }}">
                                        {{ $opt }}
                                    </div>
                                    <span class="text-sm font-semibold">
                                        {{ $soal->{'opsi_'.strtolower($opt)} }}
                                    </span>
                                    
                                    @if($isKunci)
                                        <div class="absolute right-4 text-emerald-500" title="Kunci Jawaban">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    @elseif($isPilihanSiswa)
                                        <div class="absolute right-4 text-rose-500" title="Jawaban Siswa (Salah)">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-20 bg-white rounded-[3rem] border border-slate-200 border-dashed flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-lg font-black text-slate-800">Soal Tidak Ditemukan</h3>
                <p class="text-slate-400 text-sm font-medium">Modul ini mungkin tidak memiliki soal atau soal telah dihapus.</p>
            </div>
        @endforelse
    </div>
</x-admin-layout>
