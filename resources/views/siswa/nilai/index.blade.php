<x-siswa-layout>
    {{-- Super Pro Header --}}
    <div class="mb-14 flex flex-col md:flex-row md:items-end justify-between gap-10">
        <div class="space-y-3">
            <div class="flex items-center gap-2 text-blue-600 font-bold text-[10px] uppercase tracking-[0.3em]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Performance Report
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Riwayat <span class="text-blue-600">Akademik</span></h2>
            <p class="text-slate-500 font-medium text-sm md:text-base max-w-xl">
                Dokumentasi digital hasil evaluasi kompetensi siswa dalam platform SmartExam Intelligence.
            </p>
        </div>
        
        {{-- Summary Stats Refined --}}
        <div class="flex items-center gap-2 bg-white p-1.5 rounded-2xl border border-slate-100 shadow-sm">
            <div class="px-6 py-3 bg-slate-50 rounded-xl text-center min-w-[100px]">
                <span class="block text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Rata-rata</span>
                <span class="text-xl font-extrabold text-slate-800 leading-none">{{ number_format($nilais->avg('skor') ?? 0, 1) }}</span>
            </div>
            <div class="px-6 py-3 bg-blue-600 rounded-xl text-center min-w-[100px] shadow-lg shadow-blue-100">
                <span class="block text-[9px] font-bold text-blue-100 uppercase tracking-widest mb-1">Sesi</span>
                <span class="text-xl font-extrabold text-white leading-none">{{ $nilais->count() }}</span>
            </div>
        </div>
    </div>

    @if($nilais->isEmpty())
        <div class="bg-white rounded-[2.5rem] p-20 text-center border border-slate-100">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2 uppercase tracking-widest">Arsip Kosong</h3>
            <p class="text-slate-400 font-medium text-sm max-w-xs mx-auto mb-8 text-center">Data histori pengerjaan Anda akan terarsip secara otomatis di sini.</p>
            <a href="{{ route('siswa.soal.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 text-white rounded-xl font-bold text-[11px] uppercase tracking-widest hover:bg-blue-700 transition-all active:scale-95 shadow-lg shadow-blue-100">
                Inisialisasi Ujian
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($nilais as $index => $nilai)
                @php $isLulus = $nilai->skor >= $kkm; @endphp
                <div class="bg-white rounded-3xl p-1.5 border border-slate-100 hover:border-blue-200 transition-all duration-300 group shadow-sm hover:shadow-md">
                    <div class="px-6 py-6 md:px-8 md:py-8 flex flex-col md:flex-row md:items-center justify-between gap-8">
                        
                        {{-- Left side --}}
                        <div class="flex items-center gap-6">
                            <div class="flex flex-col items-center justify-center w-16 h-16 rounded-2xl {{ $isLulus ? 'bg-blue-50 text-blue-600' : 'bg-rose-50 text-rose-600' }} shrink-0 border border-transparent">
                                <span class="text-[9px] font-bold uppercase tracking-widest mb-0.5 opacity-60">{{ $nilai->created_at->translatedFormat('M') }}</span>
                                <span class="text-2xl font-extrabold leading-none tracking-tighter">{{ $nilai->created_at->format('d') }}</span>
                            </div>
                            
                            <div class="space-y-1">
                                <h4 class="text-lg font-bold text-slate-800 leading-tight">Assessment Inteligensi #{{ $nilais->count() - $index }}</h4>
                                <div class="flex items-center gap-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        {{ $nilai->created_at->format('H:i') }}
                                    </span>
                                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                    <span class="flex items-center gap-1.5 {{ $isLulus ? 'text-emerald-500' : 'text-rose-500' }}">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                        {{ $nilai->jumlah_benar }} Benar
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Right side --}}
                        <div class="flex items-center justify-between md:justify-end gap-10 border-t md:border-t-0 pt-6 md:pt-0 border-slate-50">
                            <div class="text-left md:text-right space-y-1">
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.2em] block">Status Kelulusan</span>
                                <span class="text-[11px] font-extrabold uppercase tracking-widest {{ $isLulus ? 'text-blue-600' : 'text-rose-600' }}">
                                    {{ $isLulus ? 'Completed' : 'Remedial' }}
                                </span>
                            </div>

                            <div class="text-center min-w-[70px]">
                                <span class="text-4xl font-extrabold {{ $isLulus ? 'text-slate-900' : 'text-slate-300' }} tracking-tighter leading-none">
                                    {{ number_format($nilai->skor, 0) }}
                                </span>
                            </div>

                            <div class="shrink-0">
                                @if($total_ujian >= $max_retakes)
                                    <a href="{{ route('siswa.nilai.preview', $nilai->id) }}" class="inline-flex items-center justify-center w-11 h-11 bg-slate-900 text-white rounded-xl hover:bg-blue-600 transition-all shadow-lg active:scale-90 transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
                                    </a>
                                @else
                                    <div class="flex items-center justify-center w-11 h-11 bg-slate-50 text-slate-300 rounded-xl border border-slate-100 cursor-not-allowed">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Bottom Indicator --}}
    <div class="mt-12 text-center">
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.4em] leading-relaxed">
            Data Transkrip Terenkripsi &bull; SmartExam Security Protocol 
        </p>
    </div>
</x-siswa-layout>