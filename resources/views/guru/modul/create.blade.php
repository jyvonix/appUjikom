<x-guru-layout>
    <div class="max-w-3xl mx-auto">
        <div class="mb-10 flex items-center gap-4">
            <a href="{{ route('guru.modul.index') }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Buat <span class="text-indigo-600">Modul Ujian</span></h2>
                <p class="text-slate-500 font-medium text-sm">Tentukan mata pelajaran dan durasi waktu ujian.</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-slate-200 p-10 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-indigo-50 rounded-full blur-3xl -mr-20 -mt-20 opacity-50"></div>
            
            <form action="{{ route('guru.modul.store') }}" method="POST" class="relative z-10 space-y-8">
                @csrf

                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Mata Pelajaran / Modul</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Pemrograman Dasar" required
                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-6 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-indigo-500 focus:ring-8 focus:ring-indigo-500/5 transition-all font-semibold text-sm">
                    @error('nama') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="3" placeholder="Jelaskan isi modul ini..."
                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-6 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-indigo-500 focus:ring-8 focus:ring-indigo-500/5 transition-all font-semibold text-sm">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Target Jurusan</label>
                        <select name="jurusan" required
                            class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4 px-6 text-slate-700 focus:bg-white focus:border-indigo-500 transition-all font-semibold text-sm cursor-pointer">
                            <option value="" disabled selected>Pilih Jurusan</option>
                            <option value="RPL" {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                            <option value="MPLB" {{ old('jurusan') == 'MPLB' ? 'selected' : '' }}>Manajemen Perkantoran & Layanan Bisnis (MPLB)</option>
                        </select>
                        @error('jurusan') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Durasi Waktu (Menit)</label>
                        <div class="relative">
                            <input type="number" name="waktu" value="{{ old('waktu', 60) }}" min="1" required
                                class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4 px-6 text-slate-700 focus:bg-white focus:border-indigo-500 transition-all font-semibold text-sm">
                            <span class="absolute right-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-slate-400 uppercase">Menit</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Status Aktivitas</label>
                    <select name="is_active" required
                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4 px-6 text-slate-700 focus:bg-white focus:border-indigo-500 transition-all font-semibold text-sm">
                        <option value="1">Aktifkan Sekarang</option>
                        <option value="0">Simpan Sebagai Draft</option>
                    </select>
                </div>

                <div class="pt-6 border-t border-slate-100">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-6 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Pengaturan Lanjutan (Opsional)
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">KKM Modul</label>
                            <input type="number" name="kkm" value="{{ old('kkm') }}" placeholder="Default: Global"
                                class="block w-full rounded-xl border border-slate-200 bg-slate-50/30 py-3.5 px-5 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-indigo-500 transition-all font-semibold text-xs">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Maksimal Remedial</label>
                            <input type="number" name="max_retakes" value="{{ old('max_retakes') }}" placeholder="Default: Global"
                                class="block w-full rounded-xl border border-slate-200 bg-slate-50/30 py-3.5 px-5 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-indigo-500 transition-all font-semibold text-xs">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Poin per Soal</label>
                            <input type="number" name="point_per_question" value="{{ old('point_per_question') }}" placeholder="Default: Global"
                                class="block w-full rounded-xl border border-slate-200 bg-slate-50/30 py-3.5 px-5 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-indigo-500 transition-all font-semibold text-xs">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pembagi Skor</label>
                            <input type="number" step="0.01" name="score_divisor" value="{{ old('score_divisor') }}" placeholder="Default: Global"
                                class="block w-full rounded-xl border border-slate-200 bg-slate-50/30 py-3.5 px-5 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-indigo-500 transition-all font-semibold text-xs">
                        </div>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-6">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="is_random" value="1" {{ old('is_random') ? 'checked' : '' }} class="w-5 h-5 rounded-lg border-slate-200 text-indigo-600 focus:ring-indigo-500 transition-all">
                            <span class="text-xs font-bold text-slate-600 group-hover:text-indigo-600 transition-colors">Acak Urutan Soal</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="show_result" value="1" {{ old('show_result', true) ? 'checked' : '' }} class="w-5 h-5 rounded-lg border-slate-200 text-indigo-600 focus:ring-indigo-500 transition-all">
                            <span class="text-xs font-bold text-slate-600 group-hover:text-indigo-600 transition-colors">Tampilkan Hasil Langsung</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-[1.5rem] font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-slate-200 hover:bg-indigo-600 transition-all active:scale-95 flex items-center justify-center gap-3">
                    <span>Simpan Modul Ujian</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>
        </div>
    </div>
</x-guru-layout>
