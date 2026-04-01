<x-admin-layout>
    <div class="max-w-3xl mx-auto">
        <div class="mb-10 flex items-center gap-4">
            <a href="{{ route('admin.modul.index') }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-blue-600 hover:border-blue-100 transition-all shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Buat <span class="text-blue-600">Modul Ujian</span></h2>
                <p class="text-slate-500 font-medium text-sm">Tentukan pengampu dan detail durasi modul ujian.</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-slate-200 p-10 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-blue-50 rounded-full blur-3xl -mr-20 -mt-20 opacity-50"></div>
            
            <form action="{{ route('admin.modul.store') }}" method="POST" class="relative z-10 space-y-8">
                @csrf

                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilih Guru Pengampu</label>
                    <select name="user_id" required
                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-6 text-slate-700 focus:bg-white focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 transition-all font-semibold text-sm">
                        <option value="">-- Pilih Guru --</option>
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->id }}" {{ old('user_id') == $guru->id ? 'selected' : '' }}>{{ $guru->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Mata Pelajaran / Modul</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Akuntansi Keuangan" required
                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-6 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 transition-all font-semibold text-sm">
                    @error('nama') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Deskripsi Modul</label>
                    <textarea name="deskripsi" rows="3" placeholder="Jelaskan cakupan materi modul ini..."
                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-6 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 transition-all font-semibold text-sm">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Durasi (Menit)</label>
                        <input type="number" name="waktu" value="{{ old('waktu', 60) }}" min="1" required
                            class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-6 text-slate-700 focus:bg-white focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 transition-all font-semibold text-sm">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Status Publikasi</label>
                        <select name="is_active" required
                            class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-6 text-slate-700 focus:bg-white focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 transition-all font-semibold text-sm">
                            <option value="1">Aktifkan & Publikasikan</option>
                            <option value="0">Simpan Sebagai Draft</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-[1.5rem] font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-slate-200 hover:bg-blue-600 transition-all active:scale-95 flex items-center justify-center gap-3">
                    <span>Daftarkan Modul Ujian</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
