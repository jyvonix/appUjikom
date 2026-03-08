<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50/50 border-b border-slate-100">
                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Siswa</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Waktu Pengerjaan</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] text-center">Detail</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] text-center">Skor Akhir</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($nilais as $nilai)
                @php $isLulus = $nilai->skor >= $kkm; @endphp
                <tr class="group hover:bg-emerald-50/30 transition-all duration-300">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center text-white font-black shadow-lg">
                                {{ strtoupper(substr($nilai->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-black text-slate-800 leading-none mb-1 group-hover:text-emerald-600 transition-colors">{{ $nilai->user->name }}</h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $nilai->user->username }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-slate-700">{{ $nilai->created_at->translatedFormat('d F Y') }}</span>
                            <span class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest mt-1">
                                Pukul {{ $nilai->created_at->format('H:i') }} WIB
                            </span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <div class="inline-flex items-center gap-3 px-4 py-2 bg-slate-100 rounded-xl text-slate-500 group-hover:bg-white group-hover:shadow-sm transition-all">
                            <span class="text-sm font-black">{{ $nilai->jumlah_benar }}</span>
                            <span class="text-[9px] font-black uppercase tracking-widest opacity-50">Benar</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-3xl font-black {{ $isLulus ? 'text-emerald-600' : 'text-rose-600' }} tracking-tighter">{{ number_format($nilai->skor, 0) }}</span>
                            <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest mt-1 {{ $isLulus ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                {{ $isLulus ? 'LULUS' : 'REMEDIAL' }}
                            </span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <form action="{{ route('admin.nilai.destroy', $nilai->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete(this)" class="p-4 bg-white border border-slate-100 text-slate-300 rounded-2xl hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all shadow-sm hover:shadow-rose-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 shadow-inner">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                            </div>
                            <h3 class="text-lg font-black text-slate-400 uppercase tracking-widest">Tidak Ada Data</h3>
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
