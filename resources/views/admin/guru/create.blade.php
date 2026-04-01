<x-admin-layout>
    <div class="relative min-h-screen pb-20 overflow-hidden">
        {{-- Background Accents --}}
        <div class="fixed top-0 left-0 -z-10 w-[600px] h-[600px] bg-blue-600/5 rounded-full blur-[120px]"></div>
        <div class="absolute inset-0 -z-10 opacity-[0.02]" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>

        <div class="max-w-5xl mx-auto px-6 pt-10">
            {{-- Back Button & Header --}}
            <div class="mb-12 flex flex-col md:flex-row md:items-center gap-8">
                <a href="{{ route('admin.guru.index') }}" 
                    class="group w-14 h-14 bg-white rounded-[1.5rem] flex items-center justify-center shadow-sm border border-slate-200 hover:bg-blue-600 hover:border-blue-600 transition-all duration-500">
                    <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div class="space-y-1">
                    <div class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">
                        <span class="text-blue-600">Faculty Enrollment</span>
                        <span class="text-slate-200">/</span>
                        <span>Instructor Registration</span>
                    </div>
                    <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Tambah <span class="text-blue-600">Guru Baru</span></h1>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                {{-- Left: The Main Form --}}
                <div class="lg:col-span-7">
                    <form action="{{ route('admin.guru.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="bg-white rounded-[3rem] p-8 md:p-12 border border-slate-100 shadow-2xl shadow-blue-900/5 space-y-8 relative">
                            {{-- Decorative Pattern --}}
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50/30 rounded-bl-[4rem] -mr-4 -mt-4 -z-10"></div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Nama Lengkap Pendidik</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-300 group-focus-within:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </div>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Dra. Siti Aminah" required
                                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 pl-12 pr-4 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 transition-all font-semibold text-sm">
                                </div>
                                @error('name') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Alamat Email Guru</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-300 group-focus-within:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="guru@smarexam.com" required
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

                            <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-[1.5rem] font-bold text-xs uppercase tracking-[0.2em] shadow-xl shadow-blue-900/20 hover:bg-blue-600 transition-all active:scale-95 flex items-center justify-center gap-3 transform">
                                <span>Simpan Data Pendidik</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Right: Visual Info --}}
                <div class="lg:col-span-5 space-y-8">
                    <div class="bg-blue-600 rounded-[3rem] p-10 text-white relative overflow-hidden shadow-2xl shadow-blue-200">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                        <div class="relative z-10 space-y-8">
                            <div class="w-16 h-16 bg-white/20 rounded-[1.5rem] flex items-center justify-center border border-white/30 backdrop-blur-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div class="space-y-4">
                                <h3 class="text-2xl font-bold tracking-tight">Otoritas Pengajar</h3>
                                <p class="text-blue-100 text-sm font-medium leading-relaxed">Guru memiliki wewenang untuk mengelola bank soal, memantau hasil ujian siswa, dan melakukan analisis performa kelas secara real-time.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-full blur-3xl -mr-10 -mt-10 group-hover:bg-blue-100 transition-colors"></div>
                        <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Informasi Akun</h4>
                        <p class="text-xs font-medium text-slate-500 leading-relaxed italic">"Pastikan alamat email yang didaftarkan benar karena akan digunakan sebagai identitas utama untuk manajemen konten akademik."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>