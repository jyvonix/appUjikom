<x-guest-layout>
    <div class="relative w-full max-w-lg mx-auto bg-white/60 backdrop-blur-2xl rounded-[2.5rem] shadow-[0_25px_80px_-20px_rgba(0,0,0,0.1)] border border-white/80 overflow-hidden animate-in fade-in zoom-in duration-700">
        
        <div class="p-8 md:p-12">
            <div class="flex flex-col items-center mb-10">
                <div class="p-4 bg-blue-50 rounded-2xl mb-6">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                </div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight text-center">Lupa Kata Sandi?</h2>
                <p class="text-slate-500 font-medium mt-3 text-center text-sm leading-relaxed px-4">
                    Jangan khawatir! Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
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
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex flex-col gap-4">
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black rounded-2xl shadow-xl shadow-blue-200 transition-all transform active:scale-[0.98] uppercase tracking-[0.2em] text-xs">
                        Kirim Tautan Reset
                    </button>
                    
                    <a href="{{ route('login') }}" class="text-center text-[11px] font-bold text-slate-400 uppercase tracking-widest hover:text-blue-600 transition-colors">
                        Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
