<x-guest-layout>
    <div class="w-full max-w-[480px] relative">
        {{-- Register Card --}}
        <div class="glass-card rounded-[2.5rem] p-8 md:p-12 relative overflow-hidden">
            {{-- Header --}}
            <div class="flex flex-col items-center mb-10 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-50 rounded-full border border-blue-100 mb-6">
                    <span class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.2em]">Student Registration</span>
                </div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Buat <span class="text-blue-600">Akun Baru</span></h1>
                <p class="text-slate-500 font-medium text-sm mt-3">Lengkapi informasi di bawah untuk mendapatkan akses penuh ke platform SmartExam.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Full Name --}}
                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Nama Lengkap</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus
                            class="block w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-semibold text-slate-700 placeholder:text-slate-300 input-focus transition-all"
                            placeholder="Nama Sesuai Identitas">
                    </div>
                    @error('name') <p class="text-[10px] font-bold text-rose-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                {{-- Username --}}
                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Username</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        </div>
                        <input id="username" type="text" name="username" :value="old('username')" required
                            class="block w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-semibold text-slate-700 placeholder:text-slate-300 input-focus transition-all"
                            placeholder="ID Unik Login">
                    </div>
                    @error('username') <p class="text-[10px] font-bold text-rose-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Email (Opsional)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <input id="email" type="email" name="email" :value="old('email')"
                            class="block w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-semibold text-slate-700 placeholder:text-slate-300 input-focus transition-all"
                            placeholder="Alamat Email Aktif">
                    </div>
                    @error('email') <p class="text-[10px] font-bold text-rose-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                {{-- Jurusan --}}
                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Jurusan</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <select id="jurusan" name="jurusan" required
                            class="block w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-semibold text-slate-700 placeholder:text-slate-300 input-focus transition-all appearance-none cursor-pointer">
                            <option value="" disabled selected>Pilih Jurusan Anda</option>
                            <option value="RPL" {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                            <option value="MPLB" {{ old('jurusan') == 'MPLB' ? 'selected' : '' }}>Manajemen Perkantoran & Layanan Bisnis (MPLB)</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                    @error('jurusan') <p class="text-[10px] font-bold text-rose-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                {{-- Passwords --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Password</label>
                        <x-password-input id="password" name="password" required placeholder="••••••••" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Konfirmasi</label>
                        <x-password-input id="password_confirmation" name="password_confirmation" required placeholder="••••••••" />
                    </div>
                </div>
                @error('password') <p class="text-[10px] font-bold text-rose-500 mt-1 ml-1">{{ $message }}</p> @enderror

                {{-- Action --}}
                <div class="pt-6">
                    <button type="submit" class="btn-brand w-full py-5 text-white font-bold rounded-2xl transition-all active:scale-95 text-xs uppercase tracking-[0.2em]">
                        Daftarkan Akun Baru
                    </button>
                </div>
            </form>

            {{-- Footer --}}
            <div class="mt-10 pt-8 border-t border-slate-100 flex flex-col items-center gap-4 text-center">
                <p class="text-[11px] font-semibold text-slate-400">Sudah terdaftar dalam sistem?</p>
                <a href="{{ route('login') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition-all uppercase tracking-widest flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 17l-5-5m0 0l5-5m-5 5h12" /></svg>
                    Kembali Ke Login
                </a>
            </div>
        </div>

        {{-- Note --}}
        <p class="mt-10 text-center text-slate-400 text-[9px] font-bold uppercase tracking-[0.4em] opacity-60">SmartExam Intelligence &bull; Secured Account Creation</p>
    </div>
</x-guest-layout>
