<x-guru-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-10 flex items-center gap-4">
            <a href="{{ route('guru.modul.index') }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Smart <span class="text-indigo-600">Bulk Import</span></h2>
                <p class="text-slate-500 font-medium text-sm">Salin teks dari Word atau PDF dan tempelkan di sini.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-7">
                <div class="bg-white rounded-[2.5rem] border border-slate-200 p-8 shadow-sm relative overflow-hidden">
                    <form action="{{ route('guru.soal.bulk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-8">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-1">Target Modul Ujian</label>
                            <select name="modul_id" required class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-6 text-slate-700 focus:bg-white focus:border-indigo-500 transition-all font-semibold text-sm">
                                <option value="">-- Pilih Modul --</option>
                                @foreach($moduls as $modul)
                                    <option value="{{ $modul->id }}" {{ $selected_modul_id == $modul->id ? 'selected' : '' }}>{{ $modul->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="space-y-4">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Unggah Dokumen (Word/PDF)</label>
                                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50 hover:bg-white hover:border-indigo-400 transition-all cursor-pointer group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-3 text-slate-300 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                        <p id="file-label" class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-indigo-600 transition-colors">Pilih File .docx / .pdf</p>
                                    </div>
                                    <input type="file" name="file" class="hidden" accept=".docx,.pdf" onchange="document.getElementById('file-label').textContent = this.files[0].name" />
                                </label>
                            </div>
                            <div class="flex flex-col justify-end">
                                <p class="text-[10px] font-medium text-slate-400 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                    <span class="text-indigo-600 font-black block mb-1">Catatan:</span>
                                    Gunakan fitur upload jika Anda ingin sistem mengekstrak teks secara otomatis dari file Word atau PDF. Pastikan format soal di dalam file sudah sesuai.
                                </p>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-1 text-center">Tempel Teks Soal Di Sini (Opsi Manual)</label>
                            <textarea name="raw_text" rows="10"
                                class="w-full px-6 py-8 bg-slate-900 border-none rounded-[2rem] focus:ring-8 focus:ring-indigo-500/10 transition-all outline-none font-mono text-indigo-300 text-sm placeholder:text-slate-700 shadow-inner resize-none leading-relaxed"
                                placeholder="Pilih file di atas ATAU tempel teks soal di sini..."></textarea>
                        </div>

                        <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all active:scale-95 flex items-center justify-center gap-3">
                            <span>Proses & Simpan Semua Soal</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-6">
                <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-xl">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-500/20 rounded-full blur-3xl"></div>
                    <h4 class="text-sm font-black uppercase tracking-widest mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Panduan Format
                    </h4>
                    <div class="space-y-4 text-[11px] font-medium text-slate-400 leading-relaxed">
                        <p>Sistem akan mendeteksi soal secara otomatis jika Anda mengikuti pola berikut:</p>
                        <ul class="space-y-3 list-disc ml-4">
                            <li>Setiap soal baru diawali dengan teks (bebas nomor atau tidak).</li>
                            <li>Pilihan jawaban wajib diawali <span class="text-indigo-400 font-bold">A., B., C.</span> dst.</li>
                            <li>Tentukan kunci jawaban dengan format <span class="text-emerald-400 font-bold">Kunci: A</span> di bawah pilihan soal.</li>
                            <li>Pisahkan antar soal dengan satu baris kosong.</li>
                        </ul>
                    </div>
                </div>

                <div class="bg-indigo-50 rounded-[2.5rem] p-8 border border-indigo-100">
                    <h4 class="text-xs font-black text-indigo-600 uppercase tracking-widest mb-4">Tips Cepat</h4>
                    <p class="text-[11px] font-bold text-indigo-400 leading-relaxed italic">
                        "Anda bisa langsung menyalin seluruh isi dokumen Word Anda (Ctrl+A, Ctrl+C) dan menempelkannya di sini. Sistem akan mencoba memisahkan pertanyaan dan jawabannya."
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guru-layout>
