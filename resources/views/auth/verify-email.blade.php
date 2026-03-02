<x-guest-layout>
    <div class="relative w-full max-w-lg mx-auto bg-white/60 backdrop-blur-2xl rounded-[2.5rem] shadow-[0_25px_80px_-20px_rgba(0,0,0,0.1)] border border-white/80 overflow-hidden animate-in fade-in zoom-in duration-700">
        
        <div class="p-8 md:p-12">
            <div class="flex flex-col items-center mb-8 text-center">
                <div class="p-4 bg-indigo-50 rounded-2xl mb-6">
                    <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Verifikasi Email</h2>
                <p class="text-slate-500 font-medium mt-3 text-sm leading-relaxed px-4">
                    Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan.
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl">
                    <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest text-center">
                        Tautan verifikasi baru telah dikirim ke alamat email Anda.
                    </p>
                </div>
            @endif

            <div class="flex flex-col gap-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-black rounded-2xl shadow-xl shadow-indigo-200 transition-all transform active:scale-[0.98] uppercase tracking-[0.2em] text-xs">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="text-center">
                    @csrf
                    <button type="submit" class="text-[11px] font-bold text-slate-400 uppercase tracking-widest hover:text-rose-500 transition-colors">
                        Keluar / Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
