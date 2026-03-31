<x-guru-layout>
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-4xl font-extrabold text-slate-800 tracking-tight mb-2">Analisis <span class="text-indigo-600">Butir Soal</span></h2>
            <p class="text-slate-500 font-medium">Evaluasi performa soal berdasarkan tingkat kesulitan aktual dari jawaban siswa.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="px-4 py-2 bg-indigo-50 border border-indigo-100 rounded-xl">
                <span class="text-[10px] font-black text-indigo-400 uppercase tracking-widest block">Total Soal</span>
                <span class="text-xl font-black text-indigo-700">{{ count($statistik) }}</span>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        @foreach($statistik as $id => $data)
        <div class="bg-white rounded-[32px] border border-slate-200/60 p-8 shadow-sm hover:shadow-md transition-all">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Question Info -->
                <div class="lg:col-span-7">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 font-black text-slate-500">
                            #{{ $loop->iteration }}
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2 py-0.5 bg-indigo-100 text-indigo-600 text-[9px] font-black uppercase rounded-md tracking-wider">
                                    {{ $data['soal']->kategori ?? 'UMUM' }}
                                </span>
                                <span class="px-2 py-0.5 {{ $data['soal']->kesulitan == 'sulit' ? 'bg-rose-100 text-rose-600' : ($data['soal']->kesulitan == 'sedang' ? 'bg-amber-100 text-amber-600' : 'bg-emerald-100 text-emerald-600') }} text-[9px] font-black uppercase rounded-md tracking-wider">
                                    {{ $data['soal']->kesulitan }}
                                </span>
                            </div>
                            <p class="text-lg font-bold text-slate-800 leading-relaxed mb-4">
                                {{ $data['soal']->pertanyaan }}
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-xs">
                                @foreach(['A', 'B', 'C', 'D', 'E'] as $opt)
                                <div class="p-3 rounded-xl border {{ strtoupper($data['soal']->jawaban_benar) == $opt ? 'bg-emerald-50 border-emerald-200 text-emerald-700 font-black' : 'bg-slate-50 border-slate-100 text-slate-500 font-medium' }}">
                                    <span class="mr-2">{{ $opt }}.</span> {{ $data['soal']->{'opsi_'.strtolower($opt)} }}
                                    @if(strtoupper($data['soal']->jawaban_benar) == $opt)
                                        <svg class="w-3 h-3 inline ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Panel -->
                <div class="lg:col-span-5 bg-slate-50 rounded-3xl p-6 border border-slate-100 flex flex-col justify-between">
                    <div>
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6 text-center">Statistik Jawaban</h4>
                        
                        <div class="flex items-center justify-around mb-8">
                            <div class="text-center">
                                <span class="block text-2xl font-black text-emerald-600">{{ $data['total_benar'] }}</span>
                                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Benar</span>
                            </div>
                            <div class="w-px h-8 bg-slate-200"></div>
                            <div class="text-center">
                                <span class="block text-2xl font-black text-rose-600">{{ $data['total_salah'] }}</span>
                                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Salah</span>
                            </div>
                            <div class="w-px h-8 bg-slate-200"></div>
                            <div class="text-center">
                                <span class="block text-2xl font-black text-slate-700">{{ $data['total_dijawab'] }}</span>
                                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Total</span>
                            </div>
                        </div>

                        <!-- Mini Chart (Distribution) -->
                        <div class="space-y-3">
                            <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest block mb-2">Distribusi Pilihan</span>
                            @foreach(['A', 'B', 'C', 'D', 'E'] as $opt)
                            @php 
                                $percent = $data['total_dijawab'] > 0 ? ($data['distribusi'][$opt] / $data['total_dijawab']) * 100 : 0;
                                $isCorrect = strtoupper($data['soal']->jawaban_benar) == $opt;
                            @endphp
                            <div class="flex items-center gap-3">
                                <span class="text-[10px] font-black {{ $isCorrect ? 'text-emerald-600' : 'text-slate-500' }} w-3">{{ $opt }}</span>
                                <div class="flex-1 h-2 bg-slate-200 rounded-full overflow-hidden">
                                    <div class="h-full {{ $isCorrect ? 'bg-emerald-500' : 'bg-slate-400' }} rounded-full" style="width: {{ $percent }}%"></div>
                                </div>
                                <span class="text-[8px] font-black text-slate-500 w-8 text-right">{{ round($percent) }}%</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-slate-200">
                        <div class="flex justify-between items-center">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">Tingkat Kesulitan Aktual</span>
                            <span class="text-sm font-black {{ $data['tingkat_kesulitan_aktual'] > 70 ? 'text-rose-600' : ($data['tingkat_kesulitan_aktual'] > 40 ? 'text-amber-600' : 'text-emerald-600') }}">
                                {{ $data['tingkat_kesulitan_aktual'] }}% Gagal
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-guru-layout>
