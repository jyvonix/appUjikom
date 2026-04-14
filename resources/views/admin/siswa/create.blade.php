<x-admin-layout>
    <div class="relative min-h-screen pb-20 overflow-hidden">
        {{-- Background Accents --}}
        <div class="fixed top-0 left-0 -z-10 w-[600px] h-[600px] bg-blue-600/5 rounded-full blur-[120px]"></div>
        <div class="absolute inset-0 -z-10 opacity-[0.02]" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>

        <div class="max-w-5xl mx-auto px-6 pt-10">
            {{-- Back Button & Header --}}
            <div class="mb-12 flex flex-col md:flex-row md:items-center gap-8">
                <a href="{{ route('admin.siswa.index') }}" 
                    class="group w-14 h-14 bg-white rounded-[1.5rem] flex items-center justify-center shadow-sm border border-slate-200 hover:bg-blue-600 hover:border-blue-600 transition-all duration-500">
                    <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div class="space-y-1">
                    <div class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">
                        <span class="text-blue-600">Student Enrollment</span>
                        <span class="text-slate-200">/</span>
                        <span>Academic Registration</span>
                    </div>
                    <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Registrasi <span class="text-blue-600">Siswa Baru</span></h1>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                {{-- Left: The Main Form --}}
                <div class="lg:col-span-7">
                    <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="bg-white rounded-[3rem] p-8 md:p-12 border border-slate-100 shadow-2xl shadow-blue-900/5 space-y-8 relative">
                            {{-- Decorative Pattern --}}
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50/30 rounded-bl-[4rem] -mr-4 -mt-4 -z-10"></div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Nama Lengkap Peserta Didik</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-300 group-focus-within:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </div>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap Siswa" required
                                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 pl-12 pr-4 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 transition-all font-semibold text-sm">
                                </div>
                                @error('name') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Username</label>
                                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" required
                                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-5 text-slate-700 focus:bg-white focus:border-blue-500 transition-all font-semibold text-sm">
                                    @error('username') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Email (Opsional)</label>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-5 text-slate-700 focus:bg-white focus:border-blue-500 transition-all font-semibold text-sm">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Jurusan</label>
                                    <select name="jurusan" required
                                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-5 text-slate-700 focus:bg-white focus:border-blue-500 transition-all font-semibold text-sm cursor-pointer">
                                        <option value="" disabled selected>Pilih Jurusan</option>
                                        <option value="RPL" {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                                        <option value="MPLB" {{ old('jurusan') == 'MPLB' ? 'selected' : '' }}>Manajemen Perkantoran & Layanan Bisnis (MPLB)</option>
                                    </select>
                                    @error('jurusan') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Pilih Asesor</label>
                                    <select name="asesor_id"
                                        class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-5 text-slate-700 focus:bg-white focus:border-blue-500 transition-all font-semibold text-sm cursor-pointer">
                                        <option value="" selected>Belum Ada Asesor</option>
                                        @foreach($gurus as $guru)
                                            <option value="{{ $guru->id }}" {{ old('asesor_id') == $guru->id ? 'selected' : '' }}>
                                                {{ $guru->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('asesor_id') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                                </div>
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
                                <span>Simpan Data Siswa</span>
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
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <div class="space-y-4">
                                <h3 class="text-2xl font-bold tracking-tight">Akun Peserta Didik</h3>
                                <p class="text-blue-100 text-sm font-medium leading-relaxed">Siswa yang terdaftar akan mendapatkan akses penuh ke panel ujian mandiri dan dapat memantau riwayat nilai akademik mereka secara personal.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-full blur-3xl -mr-10 -mt-10 group-hover:bg-blue-100 transition-colors"></div>
                        <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Informasi Akses</h4>
                        <p class="text-xs font-medium text-slate-500 leading-relaxed italic">"Gunakan username yang unik untuk setiap siswa. Password dapat diatur ulang oleh administrator jika siswa lupa kredensial mereka."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>