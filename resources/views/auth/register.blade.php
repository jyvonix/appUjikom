<x-guest-layout>
    <div class="relative w-full max-w-5xl mx-auto flex flex-col md:flex-row bg-white/60 backdrop-blur-2xl rounded-[2.5rem] shadow-[0_25px_80px_-20px_rgba(0,0,0,0.1)] border border-white/80 overflow-hidden animate-in fade-in zoom-in duration-700">
        
        <!-- Left Side: Decorative & Info -->
        <div class="hidden md:flex md:w-5/12 bg-gradient-to-br from-indigo-600 via-indigo-700 to-blue-800 p-12 text-white flex-col justify-between relative overflow-hidden">
            <!-- Decorative Background Elements -->
            <div class="absolute top-0 left-0 -mt-10 -ml-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 -mb-20 -mr-20 w-60 h-60 bg-blue-400/20 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <div class="inline-flex items-center justify-center p-3 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 mb-6 group transition-transform hover:scale-105 duration-300">
                    <img src="{{ asset('storage/image/images.png') }}" alt="Logo SMK" class="w-10 h-10 object-contain drop-shadow-md">
                </div>
                <h1 class="text-3xl font-black leading-tight tracking-tight">
                    Bergabung ke <br>
                    <span class="text-indigo-200">Smart Exam</span>
                </h1>
                <p class="mt-4 text-indigo-100/80 text-sm font-medium leading-relaxed">
                    Daftarkan akun baru Anda untuk mulai menggunakan sistem portal akademik digital kami.
                </p>
            </div>

            <div class="relative z-10">
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="mt-1 w-5 h-5 rounded-full bg-indigo-500/20 flex items-center justify-center text-indigo-200 flex-shrink-0">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </div>
                        <p class="text-sm font-medium text-indigo-100">Akses semua fitur ujian</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="mt-1 w-5 h-5 rounded-full bg-indigo-500/20 flex items-center justify-center text-indigo-200 flex-shrink-0">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </div>
                        <p class="text-sm font-medium text-indigo-100">Pantau hasil belajar real-time</p>
                    </div>
                </div>
                <p class="mt-12 text-[9px] font-bold text-indigo-300/60 uppercase tracking-[0.2em]">© 2026 Smart Exam Portal</p>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="w-full md:w-7/12 p-8 md:p-12 lg:p-16 flex flex-col justify-center bg-white/40 overflow-y-auto max-h-[90vh] md:max-h-none">
            <!-- Mobile Logo -->
            <div class="flex md:hidden flex-col items-center mb-8">
                <img src="{{ asset('storage/image/images.png') }}" alt="Logo SMK" class="w-16 h-16 object-contain mb-4">
            </div>

            <div class="mb-8 text-center md:text-left">
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Daftar Akun</h2>
                <p class="text-slate-500 font-medium mt-1 text-sm">Lengkapi data diri Anda untuk memulai.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name Input -->
                <div class="space-y-1.5">
                    <label for="name" class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                    <div class="group relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full pl-12 pr-4 py-3.5 bg-slate-100/50 border-2 border-transparent rounded-2xl text-sm font-bold text-slate-700 placeholder:text-slate-400 focus:outline-none focus:bg-white focus:border-indigo-600/20 focus:ring-4 focus:ring-indigo-600/5 transition-all shadow-sm"
                            placeholder="Nama Lengkap Anda">
                    </div>
                    @error('name') <p class="text-[9px] text-rose-500 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Email Input -->
                <div class="space-y-1.5">
                    <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Email</label>
                    <div class="group relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" /></svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-12 pr-4 py-3.5 bg-slate-100/50 border-2 border-transparent rounded-2xl text-sm font-bold text-slate-700 placeholder:text-slate-400 focus:outline-none focus:bg-white focus:border-indigo-600/20 focus:ring-4 focus:ring-indigo-600/5 transition-all shadow-sm"
                            placeholder="nama@sekolah.id">
                    </div>
                    @error('email') <p class="text-[9px] text-rose-500 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Password Input -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="password" class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Kata Sandi</label>
                        <div class="group relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input id="password" type="password" name="password" required
                                class="w-full pl-12 pr-4 py-3.5 bg-slate-100/50 border-2 border-transparent rounded-2xl text-sm font-bold text-slate-700 focus:outline-none focus:bg-white focus:border-indigo-600/20 focus:ring-4 focus:ring-indigo-600/5 transition-all shadow-sm"
                                placeholder="••••••••">
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Konfirmasi</label>
                        <div class="group relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="w-full pl-12 pr-4 py-3.5 bg-slate-100/50 border-2 border-transparent rounded-2xl text-sm font-bold text-slate-700 focus:outline-none focus:bg-white focus:border-indigo-600/20 focus:ring-4 focus:ring-indigo-600/5 transition-all shadow-sm"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>
                @error('password') <p class="text-[9px] text-rose-500 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                
                <div class="pt-4">
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-black rounded-2xl shadow-xl shadow-indigo-200 transition-all transform active:scale-[0.98] uppercase tracking-[0.2em] text-xs">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
