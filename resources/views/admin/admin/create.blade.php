<x-admin-layout>
    <div class="relative min-h-screen pb-20 overflow-hidden">
        {{-- Aesthetic Background Elements --}}
        <div class="fixed top-0 left-0 -z-10 w-[600px] h-[600px] bg-blue-600/5 rounded-full blur-[120px]"></div>
        <div class="absolute inset-0 -z-10 opacity-[0.02]" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>

        <div class="max-w-5xl mx-auto px-6 pt-10">
            {{-- Back Button & Header --}}
            <div class="mb-12 flex flex-col md:flex-row md:items-center gap-8">
                <a href="{{ route('admin.admin.index') }}" 
                    class="group w-14 h-14 bg-white rounded-[1.5rem] flex items-center justify-center shadow-sm border border-slate-200 hover:bg-blue-600 hover:border-blue-600 transition-all duration-500">
                    <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div class="space-y-1">
                    <div class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">
                        <span class="text-blue-600">Personnel Enrollment</span>
                        <span class="text-slate-200">/</span>
                        <span>Security Level High</span>
                    </div>
                    <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Tambah <span class="text-blue-600">Administrator</span></h1>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                {{-- Left: The Main Form --}}
                <div class="lg:col-span-7">
                    <form action="{{ route('admin.admin.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="bg-white/80 backdrop-blur-xl rounded-[3rem] p-8 md:p-12 border border-white shadow-2xl shadow-blue-900/5 space-y-10 relative">
                            {{-- Decorative Pattern Inside Card --}}
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50/30 rounded-bl-[4rem] -mr-4 -mt-4 -z-10"></div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Nama Lengkap Personel</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-300 group-focus-within:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </div>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Alexander Graham" required
                                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 pl-12 pr-4 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 transition-all font-semibold text-sm">
                                </div>
                                @error('name') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Alamat Email Resmi</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-300 group-focus-within:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@smarexam.com" required
                                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 pl-12 pr-4 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 transition-all font-semibold text-sm">
                                </div>
                                @error('email') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Password</label>
                                    <x-password-input name="password" placeholder="••••••••" required />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Konfirmasi</label>
                                    <x-password-input name="password_confirmation" placeholder="••••••••" required />
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-[1.5rem] font-bold text-xs uppercase tracking-[0.2em] shadow-2xl shadow-blue-900/20 hover:bg-blue-600 transition-all active:scale-95 flex items-center justify-center gap-3 transform">
                                <span>Daftarkan Administrator</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Right: Visual Info & Instructions --}}
                <div class="lg:col-span-5 space-y-8">
                    <div class="bg-gradient-to-br from-slate-800 to-slate-950 rounded-[3rem] p-10 text-white relative overflow-hidden shadow-2xl">
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_-20%,#2563eb,transparent)] opacity-30"></div>
                        
                        <div class="relative z-10 space-y-8">
                            <div class="w-16 h-16 bg-white/10 rounded-[1.5rem] flex items-center justify-center border border-white/20 backdrop-blur-md shadow-xl">
                                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            </div>
                            
                            <div class="space-y-4">
                                <h3 class="text-2xl font-bold tracking-tight leading-tight">Protokol Keamanan <br>Level Tinggi</h3>
                                <p class="text-slate-400 text-sm font-medium leading-relaxed">Administrator yang didaftarkan akan memiliki kontrol penuh terhadap basis data soal, manajemen nilai, dan pengaturan sistem global.</p>
                            </div>

                            <div class="space-y-4 pt-4 border-t border-white/10">
                                <div class="flex items-center gap-4 group">
                                    <div class="w-2 h-2 rounded-full bg-blue-500 group-hover:scale-150 transition-transform"></div>
                                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Akses Kontrol Root</span>
                                </div>
                                <div class="flex items-center gap-4 group">
                                    <div class="w-2 h-2 rounded-full bg-indigo-500 group-hover:scale-150 transition-transform"></div>
                                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Audit Trail Logged</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-full blur-3xl -mr-10 -mt-10 group-hover:bg-blue-100 transition-colors"></div>
                        <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Kebijakan Privasi</h4>
                        <p class="text-xs font-medium text-slate-500 leading-relaxed italic">"SmartExam menjamin keamanan data pribadi personel. Gunakan email institusi untuk standar profesionalisme yang lebih baik."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>