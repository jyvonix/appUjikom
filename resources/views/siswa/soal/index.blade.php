<x-siswa-layout>
    <div class="max-w-4xl mx-auto">
        {{-- Refined Minimalist Header --}}
        <div class="mb-10 space-y-3">
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.2em] px-3 py-1 bg-blue-50 rounded-md border border-blue-100">Config</span>
                <div class="h-px flex-1 bg-slate-100"></div>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">
                Persiapan <span class="text-blue-600">Sesi Ujian</span>
            </h2>
            <p class="text-slate-500 font-medium text-sm md:text-base max-w-xl">
                Tinjau parameter instrumen di bawah ini sebelum menginisialisasi sesi pengerjaan Anda.
            </p>
        </div>

        {{-- Main Config Card --}}
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden relative">
            <div class="p-6 md:p-12">
                {{-- Stats Grid - Fully Responsive --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-6 mb-12">
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-center transition-all hover:bg-white hover:border-blue-200 group">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 group-hover:text-blue-600 transition-colors">Total Soal</span>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-slate-800">{{ $soals->count() }}</span>
                            <span class="text-xs font-semibold text-slate-400">Items</span>
                        </div>
                    </div>

                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-center transition-all hover:bg-white hover:border-blue-200 group">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 group-hover:text-blue-600 transition-colors">Ambang Batas</span>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-slate-800">{{ $kkm }}</span>
                            <span class="text-xs font-semibold text-slate-400">Pts</span>
                        </div>
                    </div>

                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-center transition-all hover:bg-white hover:border-blue-200 group">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 group-hover:text-blue-600 transition-colors">Kesempatan</span>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-slate-800">{{ $max_retakes - $total_ujian }}</span>
                            <span class="text-xs font-semibold text-slate-400">Left</span>
                        </div>
                    </div>
                </div>

                {{-- Protocol Section --}}
                <div class="space-y-8">
                    <div class="flex items-center gap-4">
                        <span class="text-[10px] font-bold text-slate-900 uppercase tracking-widest">Aturan Pengerjaan</span>
                        <div class="h-px flex-1 bg-slate-100"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @php
                            $protocols = [
                                'Analisis pertanyaan secara mendalam sebelum melakukan input jawaban.',
                                'Pilihlah opsi yang memiliki tingkat akurasi paling tinggi.',
                                'Pastikan kestabilan jaringan internet tetap terjaga secara optimal.',
                                'Skor akan diakumulasi secara otomatis setelah sesi berakhir.'
                            ];
                        @endphp
                        @foreach($protocols as $i => $text)
                            <div class="flex gap-4 p-4 rounded-xl border border-transparent hover:border-slate-50 hover:bg-slate-50/50 transition-all">
                                <span class="w-6 h-6 rounded-md bg-blue-600 text-white flex items-center justify-center text-[10px] font-bold shrink-0">{{ $i + 1 }}</span>
                                <p class="text-[13px] font-medium text-slate-500 leading-relaxed">{{ $text }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Action Area --}}
                <div class="mt-12 pt-10 border-t border-slate-50">
                    @if($soals->isEmpty())
                        <div class="text-center p-6 bg-amber-50 border border-amber-100 rounded-2xl">
                            <p class="text-[13px] font-bold text-amber-700">Instrumen penilaian belum tersedia.</p>
                        </div>
                    @elseif($sudah_mencapai_batas)
                        <div class="flex flex-col items-center text-center space-y-3 p-8 bg-rose-50 border border-rose-100 rounded-[2rem]">
                            <div class="w-10 h-10 bg-rose-100 rounded-full flex items-center justify-center text-rose-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <h4 class="text-lg font-bold text-slate-900">Batas Maksimal Tercapai</h4>
                            <p class="text-[13px] font-medium text-slate-500 max-w-xs">Anda telah menyelesaikan seluruh kesempatan ujian yang diizinkan sistem.</p>
                        </div>
                    @else
                        <div class="flex flex-col items-center gap-6">
                            <a href="{{ route('siswa.soal.kerjakan') }}" class="w-full sm:w-auto px-16 py-5 bg-blue-600 text-white rounded-2xl font-bold text-[13px] uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl shadow-blue-100 active:scale-95 transform text-center">
                                Inisialisasi Sesi Ujian
                            </a>
                            <div class="flex items-center gap-2 opacity-40">
                                <svg class="w-3 h-3 text-slate-900" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.9L10 1.55l7.834 3.35a1 1 0 01.666.945V14a5 5 0 01-5 5H6.5a5 5 0 01-5-5V5.845a1 1 0 01.666-.945zM10 15a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                                <span class="text-[9px] font-bold text-slate-900 uppercase tracking-widest">Secure Assessment Protocol</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-siswa-layout>