<x-guest-layout>
    <div class="min-h-screen w-full flex items-center justify-center p-6 relative overflow-hidden bg-slate-50">
        <!-- Soft Background Decorative Elements -->
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-indigo-100/50 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-blue-100/50 rounded-full blur-[100px]"></div>

        <!-- Main Card -->
        <div class="relative w-full max-w-[420px] z-10">
            <!-- Compact Premium White Glass Card -->
            <div class="backdrop-blur-[20px] bg-white/80 border border-white/50 rounded-[2.5rem] p-8 lg:p-10 shadow-[0_30px_80px_-15px_rgba(79,70,229,0.1)] overflow-hidden">
                
                <!-- Logo & Header -->
                <div class="flex flex-col items-center mb-10">
                    <div class="w-16 h-16 rounded-2xl bg-white p-1 mb-5 shadow-lg shadow-indigo-100 border border-slate-50">
                        <img src="{{ asset('storage/image/images.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight text-center">Smart <span class="text-indigo-600">Exam</span></h1>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em] mt-2">Portal Akademik</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-xs text-center" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Username Field -->
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-3">Username</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within:text-indigo-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <input id="username" type="text" name="username" :value="old('username')" required autofocus
                                class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border border-slate-100 rounded-2xl text-sm font-bold text-slate-700 placeholder:text-slate-300 focus:outline-none focus:bg-white focus:border-indigo-600/30 focus:ring-4 focus:ring-indigo-600/5 transition-all"
                                placeholder="Masukkan username">
                        </div>
                        @error('username') <p class="text-[9px] text-rose-500 font-bold mt-1 ml-3">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-3">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within:text-indigo-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input id="password" type="password" name="password" required
                                class="w-full pl-12 pr-12 py-4 bg-slate-50/50 border border-slate-100 rounded-2xl text-sm font-bold text-slate-700 placeholder:text-slate-300 focus:outline-none focus:bg-white focus:border-indigo-600/30 focus:ring-4 focus:ring-indigo-600/5 transition-all"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-5 flex items-center text-slate-300 hover:text-indigo-600 transition-colors">
                                <svg id="eye-open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <svg id="eye-closed" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057-5.064-7 9.542-7 1.274 4.057 5.064 7 9.542 7 .847 2.702 2.532 5.02 4.675 6.675M9.88 9.88l4.24 4.24M3 3l18 18" /></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <div class="pt-3">
                        <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-lg shadow-indigo-100 transition-all transform active:scale-[0.98] uppercase tracking-[0.2em] text-[11px]">
                            Masuk Sekarang
                        </button>
                    </div>
                </form>

                <!-- Footer / Register Link -->
                <div class="mt-8 text-center pt-6 border-t border-slate-50">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Belum punya akun?</p>
                    <a href="{{ route('register') }}" class="text-xs font-black text-indigo-600 hover:text-indigo-800 transition-colors uppercase tracking-widest">
                        Daftar Akun Siswa
                    </a>
                </div>
            </div>

            <!-- Bottom Note -->
            <p class="mt-8 text-center text-slate-300 text-[8px] font-black uppercase tracking-[0.4em]">Smart Exam • Academic Portal v2.0</p>
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
