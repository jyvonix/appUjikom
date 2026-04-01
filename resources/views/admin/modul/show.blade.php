<x-admin-layout>
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.modul.index') }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-blue-600 hover:border-blue-100 transition-all shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Review Modul: <span class="text-blue-600">{{ $modul->nama }}</span></h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">Oleh: {{ $modul->user->name }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @forelse($soals as $soal)
            <div class="bg-white rounded-[2.5rem] border border-slate-200 p-8 shadow-sm hover:shadow-md transition-all">
                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[9px] font-black uppercase rounded-lg tracking-widest border border-blue-100">
                                #{{ $loop->iteration }}
                            </span>
                            <span class="px-3 py-1 {{ $soal->kesulitan == 'sulit' ? 'bg-rose-50 text-rose-600 border-rose-100' : ($soal->kesulitan == 'sedang' ? 'bg-amber-50 text-amber-600 border-amber-100' : 'bg-emerald-50 text-emerald-600 border-emerald-100') }} text-[9px] font-black uppercase rounded-lg tracking-widest border">
                                {{ $soal->kesulitan }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 leading-relaxed mb-6">{{ $soal->pertanyaan }}</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach(['a', 'b', 'c', 'd', 'e'] as $opt)
                                <div class="p-4 rounded-xl border {{ strtoupper($soal->jawaban_benar) == strtoupper($opt) ? 'bg-emerald-50 border-emerald-200' : 'bg-slate-50 border-slate-100' }} flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-lg flex items-center justify-center font-black text-[10px] {{ strtoupper($soal->jawaban_benar) == strtoupper($opt) ? 'bg-emerald-500 text-white' : 'bg-white text-slate-400 border border-slate-200' }}">
                                        {{ strtoupper($opt) }}
                                    </div>
                                    <span class="text-sm font-semibold {{ strtoupper($soal->jawaban_benar) == strtoupper($opt) ? 'text-emerald-900' : 'text-slate-600' }}">
                                        {{ $soal->{'opsi_'.$opt} }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-20 bg-white rounded-[3rem] border border-slate-200 border-dashed flex flex-col items-center justify-center text-center">
                <h3 class="text-lg font-black text-slate-800">Belum Ada Pertanyaan</h3>
                <p class="text-slate-400 text-sm font-medium">Modul ini belum memiliki butir soal.</p>
            </div>
        @endforelse
    </div>
</x-admin-layout>
