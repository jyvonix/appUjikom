<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50/50 border-b border-slate-100">
                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Identitas Siswa</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Waktu Selesai</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] text-center">Status Ujian</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] text-center">Analisis Jawaban</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] text-center">Hasil Akhir</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($nilais as $index => $nilai)
                @php $isLulus = $nilai->skor >= $kkm; @endphp
                <tr class="group hover:bg-indigo-50/30 transition-all duration-300">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white font-black shadow-lg shadow-indigo-100">
                                {{ strtoupper(substr($nilai->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-black text-slate-800 leading-none mb-1 group-hover:text-indigo-600 transition-colors">{{ $nilai->user->name }}</h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $nilai->user->username }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-slate-700">{{ $nilai->created_at->translatedFormat('d F Y') }}</span>
                            <span class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest mt-1">
                                Pukul {{ $nilai->created_at->format('H:i') }} WIB
                            </span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        @if($nilai->percobaan_ke == 1)
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-indigo-100">
                                Utama
                            </span>
                        @else
                            <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-amber-100">
                                Remedial {{ $nilai->percobaan_ke - 1 }}
                            </span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <div class="px-4 py-2 bg-emerald-50 rounded-xl text-emerald-600 flex items-center gap-2 border border-emerald-100">
                                <span class="text-sm font-black">{{ $nilai->jumlah_benar }}</span>
                                <span class="text-[9px] font-black uppercase tracking-widest opacity-70">Benar</span>
                            </div>
                            <div class="px-4 py-2 bg-rose-50 rounded-xl text-rose-600 flex items-center gap-2 border border-rose-100">
                                <span class="text-sm font-black">{{ \App\Models\Soal::count() - $nilai->jumlah_benar }}</span>
                                <span class="text-[9px] font-black uppercase tracking-widest opacity-70">Salah</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-3xl font-black {{ $isLulus ? 'text-indigo-600' : 'text-rose-600' }} tracking-tighter">{{ number_format($nilai->skor, 0) }}</span>
                            <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest mt-1 {{ $isLulus ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                {{ $isLulus ? 'LULUS' : 'REMEDIAL' }}
                            </span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <a href="{{ route('guru.nilai.show', $nilai->id) }}" class="p-3 bg-white border border-slate-100 text-indigo-500 rounded-xl hover:bg-indigo-50 hover:border-indigo-100 transition-all shadow-sm inline-block" title="Lihat Detail Jawaban">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 shadow-inner">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                            </div>
                            <h3 class="text-lg font-black text-slate-400 uppercase tracking-widest">Belum Ada Data Hasil Ujian</h3>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($nilais->hasPages())
    <div class="px-8 py-8 bg-slate-50/50 border-t border-slate-100 ajax-pagination">
        {{ $nilais->links() }}
    </div>
@endif
