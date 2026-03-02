<x-admin-layout>
    <div class="relative min-h-screen pb-20 bg-slate-50/30">
        <!-- Background Accents - Premium Blue Theme -->
        <div class="fixed top-0 left-0 -z-10 w-[600px] h-[600px] bg-blue-600/5 rounded-full blur-[150px]"></div>
        <div class="fixed bottom-0 right-0 -z-10 w-[500px] h-[500px] bg-indigo-600/5 rounded-full blur-[120px]"></div>

        <!-- Header Section -->
        <div class="mb-16 px-4 sm:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-10">
                <div class="flex items-start gap-6 md:gap-10">
                    <a href="{{ route('admin.soal.index') }}" 
                        class="group w-16 h-16 md:w-20 md:h-20 bg-white rounded-[24px] md:rounded-[32px] flex items-center justify-center shadow-xl shadow-blue-200/50 border border-white hover:bg-blue-600 transition-all duration-500 hover:-translate-y-2">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-blue-600 group-hover:text-white transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <div>
                        <nav class="flex mb-4 text-[10px] font-black uppercase tracking-[0.4em] text-slate-400">
                            <span class="text-blue-600">Central Admin</span>
                            <span class="mx-3 text-slate-200">/</span>
                            <span>Asset Modification</span>
                        </nav>
                        <h1 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tighter leading-tight md:leading-none">
                            Update <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Entry.</span>
                        </h1>
                        <p class="text-slate-500 font-bold text-lg md:text-xl mt-4 md:mt-6 max-w-lg leading-relaxed italic">Memperbarui aset soal ID: #{{ $soal->id }} — Pastikan integritas data tetap terjaga.</p>
                    </div>
                </div>

                <div class="hidden lg:block relative group">
                    <div class="absolute inset-0 bg-blue-500 blur-2xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative w-24 h-24 bg-slate-900 rounded-[40px] p-5 shadow-2xl rotate-6 group-hover:rotate-0 transition-transform duration-700 flex items-center justify-center">
                         <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.soal.update', $soal) }}" method="POST" class="px-4 sm:px-8">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 md:gap-14">
                
                <!-- Left: Content Creator -->
                <div class="lg:col-span-8 space-y-10 md:space-y-14">
                    
                    <!-- Question Box -->
                    <div class="bg-white/90 backdrop-blur-3xl rounded-[40px] md:rounded-[60px] p-8 md:p-14 border border-white shadow-[0_40px_100px_-20px_rgba(37,99,235,0.08)] group">
                        <div class="flex items-center gap-6 mb-10 md:mb-14">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-[24px] flex items-center justify-center text-white shadow-xl shadow-blue-200 rotate-6 group-hover:rotate-0 transition-all duration-500">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight italic">Pertanyaan Utama</h3>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mt-1.5 flex items-center gap-2">
                                    <span class="w-3 h-0.5 bg-blue-600"></span> CORE CONTENT LOGIC
                                </p>
                            </div>
                        </div>

                        <div class="relative">
                            <textarea name="pertanyaan" rows="5" 
                                class="w-full px-8 md:px-12 py-10 md:py-14 bg-slate-50 border-2 border-slate-100 rounded-[30px] md:rounded-[48px] focus:bg-white focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 transition-all outline-none font-bold text-slate-800 text-2xl md:text-3xl placeholder:text-slate-200 shadow-inner resize-none leading-relaxed" 
                                placeholder="Tuliskan pertanyaan ujian di sini..." required>{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                            
                            <div class="absolute -top-4 left-12 md:left-16 px-6 py-2 bg-slate-900 border border-slate-800 rounded-full shadow-lg">
                                <span class="text-[9px] md:text-[10px] font-black text-blue-400 uppercase tracking-[0.4em]">Required Data Asset</span>
                            </div>
                        </div>
                        @error('pertanyaan') <p class="mt-8 ml-8 md:ml-12 text-rose-500 text-[10px] font-black uppercase tracking-widest flex items-center gap-3"><span class="w-2 h-2 bg-rose-500 rounded-full animate-pulse"></span> {{ $message }}</p> @enderror
                    </div>

                    <!-- Options Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">
                        <!-- Opsi A -->
                        <div class="group bg-white/80 backdrop-blur-3xl rounded-[40px] md:rounded-[48px] p-8 md:p-10 border border-white shadow-[0_24px_48px_-12px_rgba(0,0,0,0.05)] hover:shadow-[0_40px_80px_-15px_rgba(37,99,235,0.15)] hover:-translate-y-2 transition-all duration-700">
                            <div class="flex items-center gap-5 mb-8 md:mb-10">
                                <div class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-blue-600 to-indigo-500 rounded-[20px] md:rounded-[24px] flex items-center justify-center text-white font-black text-xl md:text-2xl shadow-xl shadow-blue-100 group-hover:scale-110 transition-transform">A</div>
                                <span class="text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-[0.3em]">Option Block</span>
                            </div>
                            <input type="text" name="opsi_a" value="{{ old('opsi_a', $soal->opsi_a) }}" class="w-full px-8 md:px-10 py-6 md:py-8 bg-slate-50 border-2 border-slate-100 rounded-[24px] md:rounded-[32px] focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all outline-none font-bold text-slate-700 shadow-inner text-lg" required>
                        </div>
                        <!-- Opsi B -->
                        <div class="group bg-white/80 backdrop-blur-3xl rounded-[40px] md:rounded-[48px] p-8 md:p-10 border border-white shadow-[0_24px_48px_-12px_rgba(0,0,0,0.05)] hover:shadow-[0_40px_80px_-15px_rgba(37,99,235,0.15)] hover:-translate-y-2 transition-all duration-700">
                            <div class="flex items-center gap-5 mb-8 md:mb-10">
                                <div class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-indigo-600 to-purple-500 rounded-[20px] md:rounded-[24px] flex items-center justify-center text-white font-black text-xl md:text-2xl shadow-xl shadow-blue-100 group-hover:scale-110 transition-transform">B</div>
                                <span class="text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-[0.3em]">Option Block</span>
                            </div>
                            <input type="text" name="opsi_b" value="{{ old('opsi_b', $soal->opsi_b) }}" class="w-full px-8 md:px-10 py-6 md:py-8 bg-slate-50 border-2 border-slate-100 rounded-[24px] md:rounded-[32px] focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all outline-none font-bold text-slate-700 shadow-inner text-lg" required>
                        </div>
                        <!-- Opsi C -->
                        <div class="group bg-white/80 backdrop-blur-3xl rounded-[40px] md:rounded-[48px] p-8 md:p-10 border border-white shadow-[0_24px_48px_-12px_rgba(0,0,0,0.05)] hover:shadow-[0_40px_80px_-15px_rgba(37,99,235,0.15)] hover:-translate-y-2 transition-all duration-700">
                            <div class="flex items-center gap-5 mb-8 md:mb-10">
                                <div class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-slate-700 to-slate-900 rounded-[20px] md:rounded-[24px] flex items-center justify-center text-white font-black text-xl md:text-2xl shadow-xl shadow-blue-100 group-hover:scale-110 transition-transform">C</div>
                                <span class="text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-[0.3em]">Option Block</span>
                            </div>
                            <input type="text" name="opsi_c" value="{{ old('opsi_c', $soal->opsi_c) }}" class="w-full px-8 md:px-10 py-6 md:py-8 bg-slate-50 border-2 border-slate-100 rounded-[24px] md:rounded-[32px] focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all outline-none font-bold text-slate-700 shadow-inner text-lg" required>
                        </div>
                        <!-- Opsi D -->
                        <div class="group bg-white/80 backdrop-blur-3xl rounded-[40px] md:rounded-[48px] p-8 md:p-10 border border-white shadow-[0_24px_48px_-12px_rgba(0,0,0,0.05)] hover:shadow-[0_40px_80px_-15px_rgba(37,99,235,0.15)] hover:-translate-y-2 transition-all duration-700">
                            <div class="flex items-center gap-5 mb-8 md:mb-10">
                                <div class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-sky-500 to-blue-600 rounded-[20px] md:rounded-[24px] flex items-center justify-center text-white font-black text-xl md:text-2xl shadow-xl shadow-blue-100 group-hover:scale-110 transition-transform">D</div>
                                <span class="text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-[0.3em]">Option Block</span>
                            </div>
                            <input type="text" name="opsi_d" value="{{ old('opsi_d', $soal->opsi_d) }}" class="w-full px-8 md:px-10 py-6 md:py-8 bg-slate-50 border-2 border-slate-100 rounded-[24px] md:rounded-[32px] focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all outline-none font-bold text-slate-700 shadow-inner text-lg" required>
                        </div>
                        <!-- Opsi E -->
                        <div class="group bg-white/80 backdrop-blur-3xl rounded-[40px] md:rounded-[48px] p-8 md:p-10 border border-white shadow-[0_24px_48px_-12px_rgba(0,0,0,0.05)] hover:shadow-[0_40px_80px_-15px_rgba(37,99,235,0.15)] hover:-translate-y-2 transition-all duration-700 md:col-span-2">
                            <div class="flex items-center gap-5 mb-8 md:mb-10">
                                <div class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-rose-500 to-pink-600 rounded-[20px] md:rounded-[24px] flex items-center justify-center text-white font-black text-xl md:text-2xl shadow-xl shadow-blue-100 group-hover:scale-110 transition-transform">E</div>
                                <span class="text-[10px] md:text-[11px] font-black text-slate-400 uppercase tracking-[0.3em]">Option Block</span>
                            </div>
                            <input type="text" name="opsi_e" value="{{ old('opsi_e', $soal->opsi_e) }}" class="w-full px-8 md:px-10 py-6 md:py-8 bg-slate-50 border-2 border-slate-100 rounded-[24px] md:rounded-[32px] focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all outline-none font-bold text-slate-700 shadow-inner text-lg" placeholder="Isi jawaban E..." required>
                        </div>
                    </div>
                </div>

                <!-- Right: Config Panel -->
                <div class="lg:col-span-4 space-y-12">
                    <div class="sticky top-10 space-y-12">
                        
                        <!-- Validation Card -->
                        <div class="bg-slate-900 rounded-[48px] md:rounded-[64px] p-10 md:p-14 shadow-[0_50px_100px_-20px_rgba(15,23,42,0.4)] relative overflow-hidden group/card border-t border-white/10">
                            <div class="absolute -top-20 -right-20 w-80 h-80 bg-blue-500/10 rounded-full blur-[80px] group-hover/card:bg-blue-500/20 transition-all duration-1000"></div>
                            
                            <div class="relative z-10 text-center">
                                <div class="mb-12">
                                    <div class="w-24 h-24 bg-gradient-to-tr from-blue-600 to-indigo-400 rounded-[32px] flex items-center justify-center text-white mx-auto mb-8 rotate-12 shadow-2xl shadow-blue-500/20 group-hover/card:rotate-0 transition-all duration-700 border border-white/20">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <h3 class="text-3xl font-black text-white tracking-tight">Kunci Jawaban</h3>
                                    <p class="text-slate-500 font-bold text-[10px] uppercase tracking-[0.4em] mt-4">Validation Protocol</p>
                                </div>

                                <div class="space-y-10">
                                    <div class="grid grid-cols-2 gap-4">
                                        @foreach(['A', 'B', 'C', 'D', 'E'] as $k)
                                        <label class="relative cursor-pointer group/opt {{ $k == 'E' ? 'col-span-2' : '' }}">
                                            <input type="radio" name="jawaban_benar" value="{{ $k }}" class="peer hidden" required {{ old('jawaban_benar', $soal->jawaban_benar) == $k ? 'checked' : '' }}>
                                            <div class="w-full py-7 rounded-[28px] bg-white/5 border-2 border-transparent text-center font-black text-slate-400 transition-all peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-400 peer-checked:shadow-[0_15px_30px_-10px_rgba(37,99,235,0.5)] group-hover/opt:bg-white/10 group-hover/opt:text-white text-xl">
                                                {{ $k }}
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>

                                    <div class="pt-10 space-y-6">
                                        <button type="submit" class="w-full py-8 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-[32px] font-black text-xl md:text-2xl shadow-[0_25px_50px_-12px_rgba(37,99,235,0.5)] hover:scale-[1.03] transition-all duration-500 border-t border-white/20 active:scale-95">
                                            Update Aset Soal
                                        </button>
                                        <a href="{{ route('admin.soal.index') }}" class="block w-full py-4 text-slate-500 font-black text-center text-[10px] uppercase tracking-[0.5em] hover:text-white transition-all group">
                                            <span class="opacity-50 group-hover:opacity-100">Batalkan Perubahan</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Deck -->
                        <div class="bg-white rounded-[40px] p-8 md:p-10 border border-slate-100 shadow-xl relative overflow-hidden group">
                            <div class="absolute inset-y-0 left-0 w-2 bg-amber-500"></div>
                            <div class="flex items-start gap-6 relative z-10">
                                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 shrink-0 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-[11px] font-black text-slate-800 uppercase tracking-widest leading-none mb-3">Lifecycle Info</h4>
                                    <div class="space-y-2 mt-4">
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter flex justify-between">Dibuat: <span class="text-slate-900">{{ $soal->created_at->format('d/m/Y') }}</span></p>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter flex justify-between">Terakhir: <span class="text-slate-900">{{ $soal->updated_at->diffForHumans() }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>
</x-admin-layout>
