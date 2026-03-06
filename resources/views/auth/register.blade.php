<x-guest-layout>
    <div class="min-h-screen w-full flex items-center justify-center p-6 relative overflow-hidden bg-slate-50">
        <!-- Soft Background Decorative Elements -->
        <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-indigo-100/50 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-blue-100/50 rounded-full blur-[100px]"></div>

        <!-- Main Card -->
        <div class="relative w-full max-w-[440px] z-10">
            <!-- Compact Premium White Glass Card -->
            <div class="backdrop-blur-[20px] bg-white/80 border border-white/50 rounded-[2.5rem] p-8 lg:p-10 shadow-[0_30px_80px_-15px_rgba(79,70,229,0.1)] overflow-hidden">
                
                <!-- Header -->
                <div class="flex flex-col items-center mb-8">
                    <div class="inline-flex items-center justify-center px-5 py-1.5 bg-indigo-50 rounded-full border border-indigo-100 mb-5">
                        <span class="text-[9px] font-black text-indigo-600 uppercase tracking-[0.25em]">Student Register</span>
                    </div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight text-center">Registrasi Siswa</h1>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name Field -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-3">Nama Lengkap</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus
                            class="w-full px-5 py-4 bg-slate-50/50 border border-slate-100 rounded-2xl text-sm font-bold text-slate-700 placeholder:text-slate-300 focus:outline-none focus:bg-white focus:border-indigo-600/30 focus:ring-4 focus:ring-indigo-600/5 transition-all"
                            placeholder="Nama sesuai identitas">
                        @error('name') <p class="text-[9px] text-rose-500 font-bold mt-1 ml-3">{{ $message }}</p> @enderror
                    </div>

                    <!-- Username Field -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-3">Username</label>
                        <input id="username" type="text" name="username" :value="old('username')" required
                            class="w-full px-5 py-4 bg-slate-50/50 border border-slate-100 rounded-2xl text-sm font-bold text-slate-700 placeholder:text-slate-300 focus:outline-none focus:bg-white focus:border-indigo-600/30 focus:ring-4 focus:ring-indigo-600/5 transition-all"
                            placeholder="Username login">
                        @error('username') <p class="text-[9px] text-rose-500 font-bold mt-1 ml-3">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-3">Password</label>
                            <input id="password" type="password" name="password" required
                                class="w-full px-5 py-4 bg-slate-50/50 border border-slate-100 rounded-2xl text-sm font-bold text-slate-700 placeholder:text-slate-300 focus:outline-none focus:bg-white focus:border-indigo-600/30 focus:ring-4 focus:ring-indigo-600/5 transition-all"
                                placeholder="••••••••">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-3">Konfirmasi</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="w-full px-5 py-4 bg-slate-50/50 border border-slate-100 rounded-2xl text-sm font-bold text-slate-700 placeholder:text-slate-300 focus:outline-none focus:bg-white focus:border-indigo-600/30 focus:ring-4 focus:ring-indigo-600/5 transition-all"
                                placeholder="••••••••">
                        </div>
                    </div>
                    @error('password') <p class="text-[9px] text-rose-500 font-bold mt-1 ml-3">{{ $message }}</p> @enderror

                    <!-- Register Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-lg shadow-indigo-100 transition-all transform active:scale-[0.98] uppercase tracking-[0.2em] text-[11px]">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                <!-- Footer -->
                <div class="mt-8 text-center pt-6 border-t border-slate-50">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Sudah punya akun?</p>
                    <a href="{{ route('login') }}" class="text-xs font-black text-indigo-600 hover:text-indigo-800 transition-colors uppercase tracking-widest">
                        Kembali ke Login
                    </a>
                </div>
            </div>

            <!-- Bottom Note -->
            <p class="mt-8 text-center text-slate-300 text-[8px] font-black uppercase tracking-[0.4em]">Integrated Secure Registration • v2.0</p>
        </div>
    </div>
</x-guest-layout>
