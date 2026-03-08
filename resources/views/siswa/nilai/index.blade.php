<x-siswa-layout>
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-4xl font-black text-slate-800 tracking-tight mb-2">Riwayat <span class="text-indigo-600">Ujian</span></h2>
            <p class="text-slate-500 font-bold">Pantau perkembangan hasil belajar Anda di sini.</p>
        </div>
        
        <div class="flex items-center gap-4 bg-white p-2 rounded-3xl border border-slate-100 shadow-sm">
            <div class="px-6 py-3 bg-indigo-50 rounded-2xl border border-indigo-100 text-center">
                <span class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest leading-none mb-1">Total Ujian</span>
                <span class="text-xl font-black text-indigo-600 leading-none">{{ $nilais->count() }}</span>
            </div>
            <div class="px-6 py-3 bg-emerald-50 rounded-2xl border border-emerald-100 text-center">
                <span class="block text-[10px] font-black text-emerald-400 uppercase tracking-widest leading-none mb-1">Rata-rata Skor</span>
                <span class="text-xl font-black text-emerald-600 leading-none">{{ number_format($nilais->avg('skor') ?? 0, 1) }}</span>
            </div>
        </div>
    </div>

    @if($nilais->isEmpty())
        <div class="bg-white rounded-[3rem] p-20 text-center border-2 border-dashed border-slate-100">
            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            </div>
            <h3 class="text-xl font-black text-slate-400 uppercase tracking-widest">Belum Ada Riwayat</h3>
            <p class="text-slate-300 font-bold mt-2">Selesaikan ujian pertama Anda untuk melihat hasilnya di sini.</p>
            <a href="{{ route('siswa.soal.index') }}" class="inline-flex items-center gap-2 mt-8 px-8 py-4 bg-indigo-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all">
                Mulai Ujian Sekarang
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 gap-6">
            @foreach($nilais as $index => $nilai)
                @php $isLulus = $nilai->skor >= $kkm; @endphp
                <div class="group bg-white rounded-[2.5rem] p-2 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-100/50 hover:border-indigo-100 transition-all duration-500">
                    <div class="p-6 md:p-8 flex flex-col md:flex-row md:items-center justify-between gap-8">
                        
                        {{-- Info Dasar & Waktu --}}
                        <div class="flex items-center gap-6">
                            <div class="relative">
                                <div class="w-20 h-20 rounded-3xl {{ $isLulus ? 'bg-emerald-500' : 'bg-rose-500' }} flex flex-col items-center justify-center text-white shadow-xl {{ $isLulus ? 'shadow-emerald-100' : 'shadow-rose-100' }}">
                                    <span class="text-[9px] font-black uppercase tracking-widest leading-none mb-1">{{ $nilai->created_at->translatedFormat('M') }}</span>
                                    <span class="text-2xl font-black leading-none">{{ $nilai->created_at->format('d') }}</span>
                                </div>
                                @if($index === 0)
                                    <div class="absolute -top-2 -right-2 bg-amber-400 text-white text-[8px] font-black px-2 py-1 rounded-lg shadow-sm border-2 border-white uppercase tracking-tighter">Terbaru</div>
                                @endif
                            </div>
                            
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="text-xl font-black text-slate-800 tracking-tight">Hasil Ujian Smart Exam</h4>
                                    <span class="px-3 py-1 bg-slate-50 rounded-lg text-[8px] font-black text-slate-400 uppercase tracking-widest border border-slate-100">Batch #{{ $nilais->count() - $index }}</span>
                                </div>
                                <div class="flex items-center gap-4 text-slate-400">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        <span class="text-xs font-bold">{{ $nilai->created_at->format('H:i') }} WIB</span>
                                    </div>
                                    <div class="w-1 h-1 bg-slate-200 rounded-full"></div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        <span class="text-xs font-bold">{{ $nilai->jumlah_benar }} Jawaban Benar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Skor & Status --}}
                        <div class="flex flex-col md:flex-row items-center gap-6 md:gap-12">
                            <div class="text-center md:text-right">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Status Kelulusan</p>
                                <div class="inline-flex items-center gap-2 px-4 py-2 {{ $isLulus ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-rose-50 text-rose-600 border-rose-100' }} border rounded-2xl">
                                    <div class="w-2 h-2 rounded-full {{ $isLulus ? 'bg-emerald-500 animate-pulse' : 'bg-rose-500' }}"></div>
                                    <span class="text-[10px] font-black uppercase tracking-widest">{{ $isLulus ? 'LULUS' : 'REMEDIAL' }}</span>
                                </div>
                            </div>

                            <div class="text-center md:text-right min-w-[100px]">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Skor Akhir</p>
                                <div class="text-5xl font-black {{ $isLulus ? 'text-indigo-600' : 'text-slate-300' }} tracking-tighter leading-none">
                                    {{ number_format($nilai->skor, 0) }}
                                </div>
                            </div>

                            @if($total_ujian >= $max_retakes)
                                <a href="{{ route('siswa.nilai.preview', $nilai->id) }}" class="w-full md:w-auto px-8 py-4 bg-slate-900 text-white rounded-[1.5rem] font-black text-[10px] uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-xl shadow-slate-200 flex items-center justify-center gap-2 group-hover:scale-105 transform">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    Review Soal
                                </a>
                            @else
                                <div class="w-full md:w-auto px-8 py-4 bg-slate-100 text-slate-300 rounded-[1.5rem] font-black text-[10px] uppercase tracking-widest cursor-not-allowed flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    Review Terkunci
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        {{-- Kaki Halaman --}}
        <div class="mt-12 bg-white/50 backdrop-blur-sm rounded-[2.5rem] p-8 border border-slate-100 text-center">
            <p class="text-slate-400 font-bold text-xs leading-relaxed max-w-2xl mx-auto">
                Catatan: Fitur <span class="text-slate-800">"Review Soal"</span> hanya dapat diakses setelah Anda menyelesaikan seluruh kesempatan ujian yang diberikan oleh guru. Gunakan fitur tersebut untuk meninjau kesalahan dan mempelajari jawaban yang benar.
            </p>
        </div>
    @endif
</x-siswa-layout>
