<x-guest-layout>
    <div class="relative w-full max-w-lg mx-auto bg-white/60 backdrop-blur-2xl rounded-[2.5rem] shadow-[0_25px_80px_-20px_rgba(0,0,0,0.1)] border border-white/80 overflow-hidden animate-in fade-in zoom-in duration-700">
        
        <div class="p-8 md:p-12">
            <div class="flex flex-col items-center mb-8 text-center">
                <div class="p-4 bg-amber-50 rounded-2xl mb-6 text-amber-600">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Konfirmasi Sandi</h2>
                <p class="text-slate-500 font-medium mt-3 text-sm leading-relaxed px-4">
                    Ini adalah area aplikasi yang aman. Silakan konfirmasi kata sandi Anda sebelum melanjutkan.
                </p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Kata Sandi</label>
                    <x-password-input id="password" name="password" required
                        placeholder="••••••••"
                        leftIcon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>'
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-black rounded-2xl shadow-xl shadow-amber-200 transition-all transform active:scale-[0.98] uppercase tracking-[0.2em] text-xs">
                        Konfirmasi Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
