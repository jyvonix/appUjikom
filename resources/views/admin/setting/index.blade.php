<x-admin-layout>
    <div class="mb-10">
        <h2 class="text-4xl font-extrabold text-slate-800 tracking-tight mb-2">Pengaturan <span class="text-blue-600">Sistem</span></h2>
        <p class="text-slate-500 font-medium">Konfigurasi parameter utama ujian dan standar penilaian.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white/80 backdrop-blur-xl rounded-[40px] border border-white/60 p-10 shadow-2xl shadow-blue-100/50">
            <div class="flex items-center gap-6 mb-10">
                <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800">Parameter Ujian</h3>
                    <p class="text-sm text-slate-500 font-semibold uppercase tracking-widest">Global Configuration</p>
                </div>
            </div>

            <form action="{{ route('admin.setting.update') }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <div>
                    <label for="kkm" class="block text-sm font-extrabold text-slate-700 uppercase tracking-wider mb-3 ml-1">Nilai KKM (Kriteria Ketuntasan Minimal)</label>
                    <div class="relative group">
                        <input type="number" name="kkm" id="kkm" value="{{ $settings['kkm'] }}" 
                            class="block w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-slate-800 font-bold focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all group-hover:bg-white"
                            placeholder="Contoh: 75">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-6 pointer-events-none text-slate-400 font-black">/ 100</div>
                    </div>
                    @error('kkm')
                        <p class="mt-2 text-sm text-red-600 font-bold ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="max_retakes" class="block text-sm font-extrabold text-slate-700 uppercase tracking-wider mb-3 ml-1">Maksimal Mengulangi Ujian</label>
                    <div class="relative group">
                        <input type="number" name="max_retakes" id="max_retakes" value="{{ $settings['max_retakes'] }}" 
                            class="block w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-slate-800 font-bold focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all group-hover:bg-white"
                            placeholder="Contoh: 3">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-6 pointer-events-none text-slate-400 font-black">KALI</div>
                    </div>
                    @error('max_retakes')
                        <p class="mt-2 text-sm text-red-600 font-bold ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="point_per_question" class="block text-sm font-extrabold text-slate-700 uppercase tracking-wider mb-3 ml-1">Poin Per 1 Soal Benar</label>
                    <div class="relative group">
                        <input type="number" step="any" name="point_per_question" id="point_per_question" value="{{ $settings['point_per_question'] }}" 
                            class="block w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-slate-800 font-bold focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all group-hover:bg-white"
                            placeholder="Contoh: 3.4">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-6 pointer-events-none text-slate-400 font-black">POIN</div>
                    </div>
                    @error('point_per_question')
                        <p class="mt-2 text-sm text-red-600 font-bold ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="exam_duration" class="block text-sm font-extrabold text-slate-700 uppercase tracking-wider mb-3 ml-1">Durasi Waktu Ujian</label>
                    <div class="relative group">
                        <input type="number" name="exam_duration" id="exam_duration" value="{{ $settings['exam_duration'] }}" 
                            class="block w-full px-6 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-slate-800 font-bold focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all group-hover:bg-white"
                            placeholder="Contoh: 60">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-6 pointer-events-none text-slate-400 font-black">MENIT</div>
                    </div>
                    @error('exam_duration')
                        <p class="mt-2 text-sm text-red-600 font-bold ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-5 bg-slate-900 hover:bg-blue-600 text-white rounded-3xl font-black uppercase tracking-[0.2em] shadow-xl shadow-blue-100 transition-all transform hover:-translate-y-1 active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <div class="hidden md:block">
            <div class="bg-blue-600 rounded-[40px] p-10 text-white relative overflow-hidden h-full flex flex-col justify-between">
                <div class="relative z-10">
                    <h4 class="text-3xl font-black mb-6">Informasi <br>Pengaturan</h4>
                    <ul class="space-y-6">
                        <li class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="font-black text-sm">1</span>
                            </div>
                            <p class="font-bold text-blue-50 leading-relaxed">Nilai KKM digunakan sebagai standar kelulusan otomatis pada laporan nilai siswa.</p>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="font-black text-sm">2</span>
                            </div>
                            <p class="font-bold text-blue-50 leading-relaxed">Maksimal Mengulangi menentukan berapa kali siswa diizinkan mencoba kembali ujian yang sama.</p>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="font-black text-sm">3</span>
                            </div>
                            <p class="font-bold text-blue-50 leading-relaxed">Durasi Waktu Ujian akan membatasi waktu pengerjaan siswa dengan sistem penyerahan otomatis.</p>
                        </li>
                    </ul>
                </div>

                <div class="relative z-10 mt-10">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                        <p class="text-[10px] font-black uppercase tracking-widest text-blue-200 mb-2">Tips</p>
                        <p class="text-sm font-bold italic text-white/80 leading-relaxed">"Pastikan standar nilai KKM sudah sesuai dengan kurikulum yang berlaku saat ini."</p>
                    </div>
                </div>

                <!-- Abstract decorations -->
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-60 h-60 bg-white/10 rounded-full blur-3xl"></div>
            </div>
        </div>
    </div>
</x-admin-layout>
