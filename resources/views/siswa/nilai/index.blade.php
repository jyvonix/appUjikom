<x-siswa-layout>
    <div class="mb-10">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Riwayat Hasil Ujian</h2>
        <p class="text-slate-500 font-medium mt-1">Daftar pencapaian akademik Anda selama periode ini.</p>
    </div>

    <div class="max-w-5xl">
        @if($nilais->isEmpty())
            <div class="bg-white rounded-[2rem] p-20 text-center border border-slate-200 card-shadow">
                <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Data</h3>
                <p class="text-slate-500 font-medium mb-8">Selesaikan ujian pertama Anda untuk melihat statistik di sini.</p>
                <a href="{{ route('siswa.soal.index') }}" class="btn-blue text-white px-8 py-3.5 rounded-2xl font-bold inline-block">Mulai Ujian</a>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4">
                @foreach($nilais as $nilai)
                    <div class="bg-white rounded-3xl p-6 md:p-8 border border-slate-200 card-shadow flex flex-col md:flex-row items-center justify-between group hover:border-blue-200 transition-colors">
                        <div class="flex items-center space-x-6 mb-6 md:mb-0">
                            <div class="text-center bg-blue-50 px-5 py-3 rounded-2xl border border-blue-100 min-w-[80px]">
                                <span class="block text-[10px] font-black text-blue-400 uppercase tracking-widest leading-none">{{ $nilai->created_at->format('M') }}</span>
                                <span class="block text-2xl font-black text-blue-700 leading-tight mt-1">{{ $nilai->created_at->format('d') }}</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-extrabold text-slate-800 leading-tight">Ujian Selesai</h4>
                                <p class="text-sm font-bold text-slate-400 mt-0.5">{{ $nilai->created_at->format('H:i') }} WIB • {{ $nilai->jumlah_benar }} Benar</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-8">
                            <div class="text-center md:text-right">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status Kelulusan</p>
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $nilai->skor >= 75 ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ $nilai->skor >= 75 ? 'LULUS' : 'REMEDIAL' }}
                                </span>
                            </div>
                            <div class="w-px h-12 bg-slate-100 hidden md:block"></div>
                            <div class="text-center md:text-right min-w-[80px]">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Skor Akhir</p>
                                <div class="text-4xl font-black {{ $nilai->skor >= 75 ? 'text-blue-600' : 'text-slate-400' }} tracking-tighter">
                                    {{ number_format($nilai->skor, 0) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-siswa-layout>
