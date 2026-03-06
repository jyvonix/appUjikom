<x-guru-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8 bg-slate-50/50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section with Premium Look -->
            <div class="mb-10 flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div class="space-y-2">
                    <a href="{{ route('guru.soal.index') }}" 
                       class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700 transition-all group">
                        <div class="p-2 bg-blue-50 rounded-lg group-hover:bg-blue-100 transition-colors mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </div>
                        Kembali ke Bank Soal
                    </a>
                    <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">
                        Edit <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Materi Soal</span>
                    </h1>
                    <p class="text-slate-500 font-medium italic">Mengedit soal ID: #{{ $soal->id }} — Pastikan pembaruan sudah sesuai kurikulum.</p>
                </div>
                
                <div class="hidden md:block">
                    <div class="flex items-center gap-2 px-4 py-2 bg-amber-50 rounded-2xl shadow-sm border border-amber-100">
                        <span class="flex h-3 w-3 rounded-full bg-amber-500 animate-pulse"></span>
                        <span class="text-sm font-bold text-amber-800 uppercase tracking-wider">Editing Mode</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('guru.soal.update', $soal) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Main Card -->
                <div class="bg-white rounded-[2rem] shadow-xl shadow-blue-900/5 border border-slate-100 overflow-hidden">
                    
                    <!-- Section 1: Pertanyaan -->
                    <div class="p-8 md:p-10 border-b border-slate-50">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-slate-800">Konten Pertanyaan</h2>
                        </div>

                        <!-- Image Upload Area -->
                        <div class="mb-8 space-y-3">
                            <label class="block text-sm font-bold text-slate-700 ml-1 uppercase tracking-widest">Lampiran Gambar (Opsional)</label>
                            <div class="relative group">
                                <input type="file" name="gambar" id="gambar" class="hidden" accept="image/*" onchange="previewImage(event)">
                                <label for="gambar" class="flex flex-col items-center justify-center w-full min-h-[14rem] bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-blue-50 hover:border-blue-200 transition-all overflow-hidden">
                                    @if($soal->gambar)
                                        <div id="image-placeholder" class="hidden flex flex-col items-center justify-center py-6">
                                            <svg class="w-10 h-10 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Klik untuk ganti gambar</p>
                                        </div>
                                        <img id="image-preview" src="{{ asset('storage/' . $soal->gambar) }}" class="w-full h-full object-contain p-4 shadow-inner">
                                    @else
                                        <div id="image-placeholder" class="flex flex-col items-center justify-center py-6">
                                            <svg class="w-10 h-10 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Klik untuk unggah gambar</p>
                                        </div>
                                        <img id="image-preview" class="hidden w-full h-full object-contain p-4 shadow-inner">
                                    @endif
                                </label>
                            </div>
                            @error('gambar') <p class="mt-1 text-xs text-red-500 font-bold italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-3">
                            <label for="pertanyaan" class="block text-sm font-bold text-slate-700 ml-1">Deskripsi Soal <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <textarea name="pertanyaan" id="pertanyaan" rows="5" 
                                    class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all outline-none text-slate-700 text-lg leading-relaxed shadow-inner" 
                                    placeholder="Tuliskan pertanyaan ujian Anda secara detail di sini..." required>{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                                <div class="absolute bottom-4 right-4 text-slate-300 pointer-events-none group-focus-within:text-blue-200 transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"></path></svg>
                                </div>
                            </div>
                            @error('pertanyaan') <p class="mt-2 text-sm text-red-500 font-semibold flex items-center gap-1"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg> {{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Section 2: Pilihan Jawaban -->
                    <div class="p-8 md:p-10 bg-slate-50/50 border-b border-slate-50">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-600 text-white shadow-lg shadow-indigo-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-slate-800">Opsi Jawaban</h2>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mt-0.5">Multi Choice Selection</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Opsi A -->
                            <div class="space-y-3 group">
                                <label for="opsi_a" class="flex items-center justify-between px-1">
                                    <span class="text-sm font-bold text-slate-700 tracking-wide uppercase italic">Opsi A</span>
                                    <span class="h-px flex-1 bg-slate-200 mx-4 opacity-50 group-focus-within:bg-blue-300 group-focus-within:opacity-100 transition-all"></span>
                                    <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-black text-slate-500 group-focus-within:bg-blue-600 group-focus-within:text-white transition-all">1</div>
                                </label>
                                <input type="text" name="opsi_a" id="opsi_a" value="{{ old('opsi_a', $soal->opsi_a) }}" class="w-full px-5 py-4 bg-white border-2 border-slate-200 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all outline-none text-slate-700 font-medium shadow-sm group-hover:border-slate-300" required>
                            </div>
                            <!-- Opsi B -->
                            <div class="space-y-3 group">
                                <label for="opsi_b" class="flex items-center justify-between px-1">
                                    <span class="text-sm font-bold text-slate-700 tracking-wide uppercase italic">Opsi B</span>
                                    <span class="h-px flex-1 bg-slate-200 mx-4 opacity-50 group-focus-within:bg-blue-300 group-focus-within:opacity-100 transition-all"></span>
                                    <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-black text-slate-500 group-focus-within:bg-blue-600 group-focus-within:text-white transition-all">2</div>
                                </label>
                                <input type="text" name="opsi_b" id="opsi_b" value="{{ old('opsi_b', $soal->opsi_b) }}" class="w-full px-5 py-4 bg-white border-2 border-slate-200 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all outline-none text-slate-700 font-medium shadow-sm group-hover:border-slate-300" required>
                            </div>
                            <!-- Opsi C -->
                            <div class="space-y-3 group">
                                <label for="opsi_c" class="flex items-center justify-between px-1">
                                    <span class="text-sm font-bold text-slate-700 tracking-wide uppercase italic">Opsi C</span>
                                    <span class="h-px flex-1 bg-slate-200 mx-4 opacity-50 group-focus-within:bg-blue-300 group-focus-within:opacity-100 transition-all"></span>
                                    <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-black text-slate-500 group-focus-within:bg-blue-600 group-focus-within:text-white transition-all">3</div>
                                </label>
                                <input type="text" name="opsi_c" id="opsi_c" value="{{ old('opsi_c', $soal->opsi_c) }}" class="w-full px-5 py-4 bg-white border-2 border-slate-200 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all outline-none text-slate-700 font-medium shadow-sm group-hover:border-slate-300" required>
                            </div>
                            <!-- Opsi D -->
                            <div class="space-y-3 group">
                                <label for="opsi_d" class="flex items-center justify-between px-1">
                                    <span class="text-sm font-bold text-slate-700 tracking-wide uppercase italic">Opsi D</span>
                                    <span class="h-px flex-1 bg-slate-200 mx-4 opacity-50 group-focus-within:bg-blue-300 group-focus-within:opacity-100 transition-all"></span>
                                    <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-black text-slate-500 group-focus-within:bg-blue-600 group-focus-within:text-white transition-all">4</div>
                                </label>
                                <input type="text" name="opsi_d" id="opsi_d" value="{{ old('opsi_d', $soal->opsi_d) }}" class="w-full px-5 py-4 bg-white border-2 border-slate-200 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all outline-none text-slate-700 font-medium shadow-sm group-hover:border-slate-300" required>
                            </div>
                            <!-- Opsi E -->
                            <div class="space-y-3 group md:col-span-2">
                                <label for="opsi_e" class="flex items-center justify-between px-1">
                                    <span class="text-sm font-bold text-slate-700 tracking-wide uppercase italic">Opsi E</span>
                                    <span class="h-px flex-1 bg-slate-200 mx-4 opacity-50 group-focus-within:bg-blue-300 group-focus-within:opacity-100 transition-all"></span>
                                    <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-black text-slate-500 group-focus-within:bg-blue-600 group-focus-within:text-white transition-all">5</div>
                                </label>
                                <input type="text" name="opsi_e" id="opsi_e" value="{{ old('opsi_e', $soal->opsi_e) }}" class="w-full px-5 py-4 bg-white border-2 border-slate-200 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all outline-none text-slate-700 font-medium shadow-sm group-hover:border-slate-300" placeholder="Ketik pilihan jawaban E..." required>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Kunci Jawaban -->
                    <div class="p-8 md:p-10">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8 text-center md:text-left">
                            <div class="flex items-center gap-4 justify-center md:justify-start">
                                <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-500 text-white shadow-lg shadow-emerald-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-slate-800">Tentukan Kunci Jawaban</h2>
                            </div>
                            <div class="px-4 py-1.5 bg-emerald-50 text-emerald-700 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                                Required Selection
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 max-w-3xl mx-auto md:mx-0">
                            @foreach(['A', 'B', 'C', 'D', 'E'] as $k)
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="jawaban_benar" value="{{ $k }}" class="peer hidden" required {{ old('jawaban_benar', $soal->jawaban_benar) == $k ? 'checked' : '' }}>
                                <div class="flex flex-col items-center justify-center p-6 rounded-[1.5rem] border-2 border-slate-100 bg-white shadow-sm transition-all duration-300 peer-checked:border-blue-600 peer-checked:bg-blue-50/50 peer-checked:ring-4 peer-checked:ring-blue-500/10 group-hover:border-blue-200 group-hover:shadow-md">
                                    <span class="text-3xl font-black text-slate-300 transition-colors peer-checked:text-blue-600 group-hover:text-blue-400 mb-1 leading-none uppercase">{{ $k }}</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter peer-checked:text-blue-500">Pilih Opsi</span>
                                </div>
                                <!-- Premium Check Icon -->
                                <div class="absolute top-3 right-3 w-6 h-6 bg-blue-600 text-white rounded-lg flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-all duration-300 shadow-lg shadow-blue-200 -translate-y-2 peer-checked:translate-y-0 scale-50 peer-checked:scale-100 rotate-12 peer-checked:rotate-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        @error('jawaban_benar') <p class="mt-6 text-sm text-red-500 font-bold text-center md:text-left">{{ $message }}</p> @enderror
                    </div>
                    
                    <!-- Form Actions Footer -->
                    <div class="px-8 py-8 bg-slate-900 flex flex-col sm:flex-row items-center justify-between gap-6">
                        <div class="text-white/50 text-xs font-medium italic">
                            Semua perubahan akan langsung diterapkan pada database bank soal.
                        </div>
                        <div class="flex items-center gap-4 w-full sm:w-auto">
                            <a href="{{ route('guru.soal.index') }}" 
                               class="flex-1 sm:flex-none px-8 py-3.5 bg-white/5 text-white text-sm font-bold rounded-2xl hover:bg-white/10 transition-all border border-white/10 text-center">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="flex-1 sm:flex-none px-10 py-3.5 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm font-black rounded-2xl hover:from-blue-600 hover:to-indigo-700 transition-all shadow-xl shadow-blue-900/40 border border-blue-400/20 active:scale-95 flex items-center justify-center gap-2">
                                <span>Perbarui Bank Soal</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const preview = document.getElementById('image-preview');
                const placeholder = document.getElementById('image-placeholder');
                preview.src = reader.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    @endpush
</x-guru-layout>
