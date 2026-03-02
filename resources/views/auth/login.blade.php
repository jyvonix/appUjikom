<x-guest-layout>
    <div class="relative w-full max-w-5xl mx-auto flex flex-col md:flex-row bg-white/60 backdrop-blur-2xl rounded-[2.5rem] shadow-[0_25px_80px_-20px_rgba(0,0,0,0.1)] border border-white/80 overflow-hidden animate-in fade-in zoom-in duration-700">
        
        <!-- Left Side: Decorative & Info (Hidden on small screens) -->
        <div class="hidden md:flex md:w-5/12 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 p-12 text-white flex-col justify-between relative overflow-hidden">
            <!-- Decorative Background Elements -->
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-60 h-60 bg-blue-400/20 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <div class="inline-flex items-center justify-center p-3 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 mb-6 group transition-transform hover:scale-105 duration-300">
                    <img src="{{ asset('storage/image/images.png') }}" alt="Logo SMK" class="w-10 h-10 object-contain drop-shadow-md">
                </div>
                <h1 class="text-3xl font-black leading-tight tracking-tight">
                    Smart Exam <br>
                    <span class="text-blue-200">Academic Portal</span>
                </h1>
                <p class="mt-4 text-blue-100/80 text-sm font-medium leading-relaxed">
                    Sistem ujian berbasis digital masa kini. Masuk untuk mengakses materi, ujian, dan hasil belajar Anda.
                </p>
            </div>

            <div class="relative z-10">
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-3 bg-white/5 p-4 rounded-2xl border border-white/10">
                        <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-blue-300">Keamanan</p>
                            <p class="text-xs font-semibold">Data terenkripsi aman</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-white/5 p-4 rounded-2xl border border-white/10">
                        <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-blue-300">Performa</p>
                            <p class="text-xs font-semibold">Cepat & Responsif</p>
                        </div>
                    </div>
                </div>
                <p class="mt-8 text-[9px] font-bold text-blue-300/60 uppercase tracking-[0.2em]">© 2026 Smart Exam Premium Edition</p>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full md:w-7/12 p-8 md:p-16 flex flex-col justify-center bg-white/40">
            <!-- Mobile Logo (Visible only on small screens) -->
            <div class="flex md:hidden flex-col items-center mb-8">
                <img src="{{ asset('storage/image/images.png') }}" alt="Logo SMK" class="w-16 h-16 object-contain mb-4">
                <h1 class="text-2xl font-black text-slate-900 tracking-tighter">SMART <span class="text-blue-600">EXAM</span></h1>
            </div>

            <div class="mb-10 text-center md:text-left">
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Selamat Datang</h2>
                <p class="text-slate-500 font-medium mt-2">Silakan masuk untuk melanjutkan ke sistem.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Input -->
                <div class="space-y-2">
                    <label for="email" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Email</label>
                    <div class="group relative transition-all duration-300">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" /></svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-12 pr-4 py-4 bg-slate-100/50 border-2 border-transparent rounded-2xl text-sm font-bold text-slate-700 placeholder:text-slate-400 focus:outline-none focus:bg-white focus:border-blue-600/20 focus:ring-4 focus:ring-blue-600/5 transition-all shadow-sm"
                            placeholder="nama@sekolah.id">
                    </div>
                    @error('email') <p class="text-[10px] text-rose-500 font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Password Input -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                        <label for="password" class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Kata Sandi</label>
                        <a href="#" class="text-[11px] font-bold text-blue-600 hover:text-blue-700 transition-colors">Lupa Password?</a>
                    </div>
                    <div class="group relative transition-all duration-300">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <input id="password" type="password" name="password" required
                            class="w-full pl-12 pr-12 py-4 bg-slate-100/50 border-2 border-transparent rounded-2xl text-sm font-bold text-slate-700 placeholder:text-slate-400 focus:outline-none focus:bg-white focus:border-blue-600/20 focus:ring-4 focus:ring-blue-600/5 transition-all shadow-sm"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-blue-600 transition-colors">
                            <svg id="eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            <svg id="eye-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 4.057 5.064 7 9.542 7 .847 2.702 2.532 5.02 4.675 6.675M9.88 9.88l4.24 4.24M3 3l18 18" /></svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Extra -->
                <div class="flex items-center justify-between px-1">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="sr-only peer">
                        <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-600/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-[11px] font-black text-slate-500 uppercase tracking-widest">Ingat Saya</span>
                    </label>
                </div>
                
                <!-- Action Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black rounded-2xl shadow-xl shadow-blue-200 transition-all transform active:scale-[0.98] uppercase tracking-[0.2em] text-xs">
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-12 text-center">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                    Kesulitan masuk? <a href="#" class="text-blue-600 hover:underline">Hubungi Admin</a>
                </p>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const open = document.getElementById('eye-open');
            const closed = document.getElementById('eye-closed');
            if (input.type === 'password') {
                input.type = 'text';
                open.classList.add('hidden');
                closed.classList.remove('hidden');
            } else {
                input.type = 'password';
                open.classList.remove('hidden');
                closed.classList.add('hidden');
            }
        }
    </script>
    @endpush
</x-guest-layout>
