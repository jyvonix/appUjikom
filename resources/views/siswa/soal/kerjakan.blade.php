<x-siswa-layout>
    <div class="max-w-4xl mx-auto pb-32">
        <!-- Breadcrumb & Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex text-sm font-bold text-slate-400 uppercase tracking-widest mb-2" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center">
                            <a href="{{ route('siswa.soal.index') }}" class="hover:text-blue-600 transition-colors">Ujian</a>
                            <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        </li>
                        <li class="text-blue-600">Pengerjaan</li>
                    </ol>
                </nav>
                <h2 class="text-4xl font-black text-slate-900 tracking-tighter">Ujian Berlangsung</h2>
            </div>
            <div class="bg-blue-600 text-white px-6 py-3 rounded-2xl shadow-lg shadow-blue-100 flex items-center space-x-3">
                <span class="text-sm font-black uppercase tracking-widest">{{ $soals->count() }} Pertanyaan</span>
            </div>
        </div>

        <form action="{{ route('siswa.soal.simpan') }}" method="POST" id="exam-form" class="space-y-8">
            @csrf
            @foreach($soals as $index => $soal)
                <div class="bg-white rounded-[2rem] border border-slate-200 card-shadow overflow-hidden">
                    <div class="p-8 md:p-10">
                        <div class="flex items-start space-x-6">
                            <span class="flex-shrink-0 w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 font-black text-xl">
                                {{ $index + 1 }}
                            </span>
                            <div class="flex-1 pt-2">
                                <h3 class="text-xl md:text-2xl font-bold text-slate-800 leading-snug mb-10">
                                    {{ $soal->pertanyaan }}
                                </h3>

                                <div class="grid grid-cols-1 gap-4">
                                    @foreach(['A', 'B', 'C', 'D', 'E'] as $opsi)
                                        @if($soal->{'opsi_' . strtolower($opsi)})
                                        <label class="group relative flex items-center p-6 bg-slate-50 border-2 border-transparent rounded-2xl cursor-pointer hover:bg-blue-50 hover:border-blue-200 transition-all">
                                            <input type="radio" name="jawaban_{{ $soal->id }}" value="{{ $opsi }}" class="hidden peer" required>
                                            
                                            <!-- Custom Radio Circle -->
                                            <div class="w-7 h-7 flex-shrink-0 border-2 border-slate-300 rounded-full flex items-center justify-center peer-checked:border-blue-600 peer-checked:bg-blue-600 transition-all">
                                                <div class="w-2.5 h-2.5 bg-white rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                            </div>
                                            
                                            <span class="ml-5 text-lg font-semibold text-slate-600 group-hover:text-blue-900 peer-checked:text-blue-900 transition-colors flex-1">
                                                <span class="text-xs font-black text-slate-400 mr-2 uppercase">{{ $opsi }}.</span>
                                                {{ $soal->{'opsi_' . strtolower($opsi)} }}
                                            </span>

                                            <!-- Visual Checkmark -->
                                            <svg class="w-6 h-6 text-blue-600 opacity-0 peer-checked:opacity-100 transition-opacity ml-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        </label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Footer Action: Tidak menghalangi konten terakhir -->
            <div class="pt-10 flex flex-col items-center">
                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menyelesaikan ujian?')" class="btn-blue text-white px-12 py-5 rounded-[2rem] font-black text-xl shadow-2xl shadow-blue-200 flex items-center space-x-3 w-full md:w-auto justify-center">
                    <span>SELESAIKAN UJIAN</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </button>
                <p class="text-slate-400 text-sm font-bold mt-6 uppercase tracking-widest">Pastikan semua soal telah terjawab</p>
            </div>
        </form>
    </div>
</x-siswa-layout>
