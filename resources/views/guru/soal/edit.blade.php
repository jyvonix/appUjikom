<x-guru-layout>
    <div class="relative min-h-screen pb-20 bg-slate-50/30">
        <!-- Background Accents (Subtle) -->
        <div class="fixed top-0 left-0 -z-10 w-[400px] h-[400px] bg-blue-600/5 rounded-full blur-[100px]"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 pt-10">
            <!-- Header Section (Compact) -->
            <div class="mb-10 flex items-center gap-6">
                <a href="{{ route('guru.modul.show', $soal->modul_id) }}" 
                    class="group w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-slate-200 hover:bg-blue-600 transition-all duration-300">
                    <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <nav class="flex mb-1 text-[8px] font-black uppercase tracking-[0.3em] text-slate-400">
                        <span class="text-blue-600">Pendidik</span>
                        <span class="mx-2 text-slate-200">/</span>
                        <span>Materi Ujian Modification</span>
                    </nav>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tighter">
                        Edit <span class="text-blue-600">Entry #{{ $soal->id }}</span>
                    </h1>
                </div>
            </div>

            <form action="{{ route('guru.soal.update', $soal) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    
                    <!-- Left: Content Creator -->
                    <div class="lg:col-span-8 space-y-8">
                        
                        <!-- Question Box -->
                        <div class="bg-white rounded-[2rem] p-8 border border-slate-200/60 shadow-sm">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shadow-inner shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </div>
                                <h3 class="text-lg font-black text-slate-800 tracking-tight italic">Konten Soal</h3>
                            </div>

                            <!-- Image Upload Area -->
                            <div class="mb-6">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 ml-1">Lampiran Gambar (Opsional)</label>
                                <div class="relative group/img">
                                    <input type="file" name="gambar" id="gambar" class="hidden" accept="image/*" onchange="previewImage(event)">
                                    <label for="gambar" class="flex flex-col items-center justify-center w-full min-h-[12rem] bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-blue-50 hover:border-blue-200 transition-all overflow-hidden group">
                                        @if($soal->gambar)
                                            <div id="image-placeholder" class="hidden flex flex-col items-center justify-center">
                                                <svg class="w-10 h-10 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                            <img id="image-preview" src="{{ asset('storage/' . $soal->gambar) }}" class="w-full h-full object-contain p-4">
                                        @else
                                            <div id="image-placeholder" class="flex flex-col items-center justify-center">
                                                <svg class="w-10 h-10 text-slate-300 mb-2 group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Klik untuk ganti</p>
                                            </div>
                                            <img id="image-preview" class="hidden w-full h-full object-contain p-4">
                                        @endif
                                    </label>
                                </div>
                                @error('gambar') <p class="mt-2 text-rose-500 text-[9px] font-black uppercase tracking-widest">{{ $message }}</p> @enderror
                            </div>

                            <div class="relative">
                                <textarea name="pertanyaan" rows="4" 
                                    class="w-full px-6 py-8 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all outline-none font-bold text-slate-800 text-lg placeholder:text-slate-300 shadow-inner resize-none leading-relaxed" 
                                    placeholder="Tuliskan pertanyaan ujian di sini..." required>{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                                
                                <div class="absolute -top-3 left-8 px-4 py-1 bg-slate-900 rounded-full shadow-lg">
                                    <span class="text-[8px] font-black text-blue-400 uppercase tracking-widest">Pertanyaan</span>
                                </div>
                            </div>
                        </div>

                        <!-- Options Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach(['a','b','c','d','e'] as $k)
                            <div class="group bg-white rounded-3xl p-6 border border-slate-200/60 shadow-sm hover:border-blue-200 transition-all duration-300">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 font-black text-lg shadow-inner group-hover:bg-blue-600 group-hover:text-white transition-all uppercase">
                                        {{ $k }}
                                    </div>
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Pilihan {{ strtoupper($k) }}</span>
                                </div>
                                <input type="text" name="opsi_{{ $k }}" value="{{ old('opsi_'.$k, $soal->{'opsi_'.$k}) }}" 
                                    class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all outline-none font-bold text-slate-700 shadow-inner text-sm" required>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Right: Config Panel -->
                    <div class="lg:col-span-4 space-y-8">
                        <div class="sticky top-6 space-y-8">
                            
                            <!-- Validation Card -->
                            <div class="bg-slate-900 rounded-[2.5rem] p-8 shadow-xl relative overflow-hidden border-t border-white/10">
                                <div class="relative z-10">
                                    <div class="text-center mb-8">
                                        <div class="w-16 h-16 bg-gradient-to-tr from-blue-600 to-indigo-400 rounded-2xl flex items-center justify-center text-white mx-auto mb-4 rotate-12 shadow-lg">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <h3 class="text-xl font-black text-white tracking-tight">Pengaturan Soal</h3>
                                        <p class="text-slate-500 font-bold text-[8px] uppercase tracking-widest mt-1">Config & Validation</p>
                                    </div>

                                    <div class="space-y-6 mb-8">
                                        <div>
                                            <label class="block text-[8px] font-black text-blue-400 uppercase tracking-[0.2em] mb-3 ml-1">Pilih Modul Ujian</label>
                                            <select name="modul_id" required class="w-full px-5 py-4 bg-white/5 border-2 border-white/10 rounded-xl focus:bg-white/10 focus:border-blue-500 transition-all outline-none font-black text-white text-xs appearance-none cursor-pointer group">
                                                @foreach($moduls as $modul)
                                                    <option value="{{ $modul->id }}" class="bg-slate-900" {{ old('modul_id', $soal->modul_id) == $modul->id ? 'selected' : '' }}>{{ $modul->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('modul_id') <p class="mt-1 text-rose-500 text-[8px] font-black uppercase">{{ $message }}</p> @enderror
                                        </div>

                                        <div>
                                            <label class="block text-[8px] font-black text-blue-400 uppercase tracking-[0.2em] mb-3 ml-1">Kategori (Label Tambahan)</label>
                                            <input type="text" name="kategori" value="{{ old('kategori', $soal->kategori) }}" 
                                                class="w-full px-5 py-4 bg-white/5 border-2 border-white/10 rounded-xl focus:bg-white/10 focus:border-blue-500 transition-all outline-none font-bold text-white text-xs placeholder:text-slate-600" 
                                                placeholder="Contoh: Logika, MTK, dll">
                                        </div>
                                        <div>
                                            <label class="block text-[8px] font-black text-blue-400 uppercase tracking-[0.2em] mb-3 ml-1">Tingkat Kesulitan</label>
                                            <select name="kesulitan" class="w-full px-5 py-4 bg-white/5 border-2 border-white/10 rounded-xl focus:bg-white/10 focus:border-blue-500 transition-all outline-none font-black text-white text-xs appearance-none cursor-pointer group">
                                                <option value="mudah" class="bg-slate-900 text-white font-bold" {{ old('kesulitan', $soal->kesulitan) == 'mudah' ? 'selected' : '' }}>MUDAH</option>
                                                <option value="sedang" class="bg-slate-900 text-white font-bold" {{ old('kesulitan', $soal->kesulitan) == 'sedang' ? 'selected' : '' }}>SEDANG</option>
                                                <option value="sulit" class="bg-slate-900 text-white font-bold" {{ old('kesulitan', $soal->kesulitan) == 'sulit' ? 'selected' : '' }}>SULIT</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-10 text-center">
                                        <label class="block text-[8px] font-black text-blue-400 uppercase tracking-[0.2em] mb-3 ml-1">Kunci Jawaban</label>
                                        <div class="grid grid-cols-5 gap-2">
                                            @foreach(['A', 'B', 'C', 'D', 'E'] as $k)
                                            <label class="relative cursor-pointer group/opt">
                                                <input type="radio" name="jawaban_benar" value="{{ $k }}" class="peer hidden" required {{ old('jawaban_benar', $soal->jawaban_benar) == $k ? 'checked' : '' }}>
                                                <div class="w-full py-4 rounded-xl bg-white/5 border-2 border-transparent text-center font-black text-slate-500 transition-all peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-400 text-xs">
                                                    {{ $k }}
                                                </div>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg hover:scale-[1.02] transition-all active:scale-95">
                                            Update Soal
                                        </button>
                                        <a href="{{ route('guru.modul.show', $soal->modul_id) }}" class="block w-full py-3 text-slate-500 font-black text-center text-[9px] uppercase tracking-widest hover:text-white transition-all">
                                            Batalkan
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Metadata Card -->
                            <div class="bg-white rounded-3xl p-6 border border-slate-200/60 shadow-sm">
                                <div class="space-y-3">
                                    <h4 class="text-[10px] font-black text-slate-800 uppercase tracking-widest mb-4">Metadata Info</h4>
                                    <div class="flex justify-between items-center pb-3 border-b border-slate-50">
                                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-wider">Dibuat</span>
                                        <span class="text-[10px] font-black text-slate-700">{{ $soal->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center pt-1">
                                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-wider">Update</span>
                                        <span class="text-[10px] font-black text-slate-700">{{ $soal->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>

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
