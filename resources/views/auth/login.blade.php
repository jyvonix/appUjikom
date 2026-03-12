<x-guest-layout>
    <div class="w-full max-w-[440px] relative">
        {{-- Login Card --}}
        <div class="glass-card rounded-[2.5rem] p-8 md:p-12 relative overflow-hidden">
            {{-- Header --}}
            <div class="flex flex-col items-center mb-10 text-center">
                <div class="w-16 h-16 rounded-2xl bg-white p-1.5 mb-6 shadow-xl shadow-blue-100 border border-blue-50">
                    <img src="{{ asset('storage/image/images.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight leading-none">Smart<span class="text-blue-600">Exam</span></h1>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em] mt-3">Intelligence Access</p>
            </div>

            {{-- Session Status --}}
            <x-auth-session-status class="mb-6 text-xs text-center font-semibold text-emerald-600" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Username --}}
                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Username</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <input id="username" type="text" name="username" :value="old('username')" required autofocus
                            class="block w-full pl-12 pr-5 py-4.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-semibold text-slate-700 placeholder:text-slate-300 input-focus transition-all"
                            placeholder="ID Akun Anda">
                    </div>
                    @error('username') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                {{-- Password --}}
                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">Kredensial Keamanan</label>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <input id="password" type="password" name="password" required
                            class="block w-full pl-12 pr-12 py-4.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-semibold text-slate-700 placeholder:text-slate-300 input-focus transition-all"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-5 flex items-center text-slate-300 hover:text-blue-600 transition-colors">
                            <svg id="eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            <svg id="eye-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 4.057 5.064 7 9.542 7 .847 2.702 2.532 5.02 4.675 6.675M9.88 9.88l4.24 4.24M3 3l18 18" /></svg>
                        </button>
                    </div>
                </div>

                {{-- Action --}}
                <div class="pt-4">
                    <button type="submit" class="btn-brand w-full py-5 text-white font-bold rounded-2xl transition-all active:scale-95 text-xs uppercase tracking-[0.2em]">
                        Otentikasi Akun
                    </button>
                </div>
            </form>

            {{-- Footer --}}
            <div class="mt-10 pt-8 border-t border-slate-100 flex flex-col items-center gap-4 text-center">
                <p class="text-[11px] font-semibold text-slate-400">Belum memiliki otorisasi akses?</p>
                <a href="{{ route('register') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition-all uppercase tracking-widest flex items-center gap-2">
                    Daftar Sebagai Siswa
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                </a>
            </div>
        </div>

        {{-- Note --}}
        <p class="mt-10 text-center text-slate-400 text-[9px] font-bold uppercase tracking-[0.4em] opacity-60">SmartExam Intelligence &bull; Secure Protocol v2.0</p>
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
