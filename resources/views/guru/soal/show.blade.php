<x-guru-layout>
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('guru.soal.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Detail <span class="text-indigo-600">Butir Soal</span></h2>
            </div>
            <p class="text-slate-500 font-medium ml-13">Informasi lengkap dan riwayat pengerjaan soal oleh siswa.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left: Question Detail -->
        <div class="lg:col-span-7 space-y-8">
            <div class="bg-white rounded-[32px] border border-slate-200/60 p-10 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full blur-3xl -mr-16 -mt-16 opacity-50"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-8">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase rounded-lg tracking-widest border border-indigo-100">
                            {{ $soal->kategori ?? 'UMUM' }}
                        </span>
                        <span class="px-3 py-1 {{ $soal->kesulitan == 'sulit' ? 'bg-rose-50 text-rose-600 border-rose-100' : ($soal->kesulitan == 'sedang' ? 'bg-amber-50 text-amber-600 border-amber-100' : 'bg-emerald-50 text-emerald-600 border-emerald-100') }} text-[10px] font-black uppercase rounded-lg tracking-widest border">
                            {{ $soal->kesulitan }}
                        </span>
                    </div>

                    <h3 class="text-2xl font-bold text-slate-800 leading-relaxed mb-10">
                        {{ $soal->pertanyaan }}
                    </h3>

                    @if($soal->gambar)
                        <div class="mb-10 rounded-2xl overflow-hidden border border-slate-100">
                            <img src="{{ asset('storage/' . $soal->gambar) }}" alt="Gambar Soal" class="w-full object-contain max-h-[400px]">
                        </div>
                    @endif

                    <div class="space-y-4">
                        @foreach(['A', 'B', 'C', 'D', 'E'] as $opt)
                            <div class="group flex items-center p-5 rounded-2xl border transition-all {{ strtoupper($soal->jawaban_benar) == $opt ? 'bg-emerald-50 border-emerald-200 ring-4 ring-emerald-500/5' : 'bg-slate-50 border-slate-100' }}">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center font-black mr-4 {{ strtoupper($soal->jawaban_benar) == $opt ? 'bg-emerald-500 text-white' : 'bg-white text-slate-400 border border-slate-200' }}">
                                    {{ $opt }}
                                </div>
                                <div class="flex-1 font-semibold {{ strtoupper($soal->jawaban_benar) == $opt ? 'text-emerald-900' : 'text-slate-600' }}">
                                    {{ $soal->{'opsi_'.strtolower($opt)} }}
                                </div>
                                @if(strtoupper($soal->jawaban_benar) == $opt)
                                    <div class="bg-emerald-500 text-white p-1 rounded-full shadow-lg shadow-emerald-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Student Stats -->
        <div class="lg:col-span-5 space-y-8">
            <div class="bg-slate-900 rounded-[32px] p-8 text-white shadow-xl relative overflow-hidden">
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-indigo-500/10 rounded-full blur-3xl"></div>
                <h4 class="text-[10px] font-black text-indigo-300 uppercase tracking-widest mb-6">Riwayat Pengerjaan Siswa</h4>
                
                <div class="space-y-4 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                    @forelse($statistik_siswa as $siswa)
                        <div class="bg-white/5 border border-white/10 p-4 rounded-2xl flex items-center justify-between hover:bg-white/10 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-indigo-500/20 flex items-center justify-center font-bold text-indigo-300">
                                    {{ substr($siswa['nama'], 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold">{{ $siswa['nama'] }}</p>
                                    <p class="text-[10px] font-medium text-slate-400">{{ $siswa['waktu'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 text-right">
                                <div>
                                    <span class="block text-xs font-black {{ $siswa['is_correct'] ? 'text-emerald-400' : 'text-rose-400' }}">
                                        Pilihan: {{ $siswa['jawaban'] }}
                                    </span>
                                    <span class="text-[8px] font-black uppercase tracking-tighter opacity-50">
                                        {{ $siswa['is_correct'] ? 'TEPAT' : 'SALAH' }}
                                    </span>
                                </div>
                                <div class="w-2 h-2 rounded-full {{ $siswa['is_correct'] ? 'bg-emerald-400 shadow-[0_0_10px_rgba(52,211,153,0.5)]' : 'bg-rose-400 shadow-[0_0_10px_rgba(248,113,113,0.5)]' }}"></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4 border border-white/10">
                                <svg class="w-8 h-8 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p class="text-xs font-bold text-slate-400">Belum ada siswa yang mengerjakan soal ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-indigo-600 rounded-[32px] p-8 text-white shadow-xl shadow-indigo-200/50">
                <h4 class="text-[10px] font-black text-indigo-200 uppercase tracking-widest mb-4">Tips Analisis</h4>
                <p class="text-xs font-medium leading-relaxed opacity-90">
                    Jika tingkat kesalahan pada soal ini di atas 70%, pertimbangkan untuk meninjau kembali redaksi pertanyaan atau tingkat kesulitan materi yang diujikan.
                </p>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
    </style>
</x-guru-layout>
