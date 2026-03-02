<x-admin-layout>
    <div class="mb-12">
        <a href="{{ route('admin.siswa.index') }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-[0.2em] text-slate-400 hover:text-indigo-600 transition-all mb-6 group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-5xl font-black text-slate-900 tracking-tight leading-tight">Registrasi <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-indigo-500">Siswa Baru</span></h1>
    </div>

    <div class="grid lg:grid-cols-12 gap-12">
        <div class="lg:col-span-7">
            <div class="bg-white rounded-[40px] p-10 lg:p-14 shadow-2xl shadow-indigo-100/50 border border-slate-50 relative overflow-hidden">
                <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-10 relative z-10">
                    @csrf
                    <div class="space-y-8">
                        <div class="group">
                            <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 ml-2">Nama Lengkap Siswa</label>
                            <div class="relative">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Contoh: Ahmad Fauzi" required
                                    class="w-full px-8 py-6 bg-slate-50 border-none rounded-[24px] focus:ring-4 focus:ring-indigo-500/10 transition-all font-bold text-slate-700 placeholder-slate-300">
                                <div class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-200 group-focus-within:text-indigo-500 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 ml-2">Email Siswa</label>
                            <div class="relative">
                                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="siswa@sekolah.id" required
                                    class="w-full px-8 py-6 bg-slate-50 border-none rounded-[24px] focus:ring-4 focus:ring-indigo-500/10 transition-all font-bold text-slate-700 placeholder-slate-300">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="group">
                                <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 ml-2">Password</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" placeholder="••••••••" required
                                        class="w-full px-8 py-6 bg-slate-50 border-none rounded-[24px] focus:ring-4 focus:ring-indigo-500/10 transition-all font-bold text-slate-700 placeholder-slate-300">
                                    <button type="button" onclick="togglePassword('password', this)" class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 hover:text-indigo-600 transition-colors">
                                        <svg class="w-6 h-6 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <svg class="w-6 h-6 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 4.057 5.064 7 9.542 7 .847 2.702 2.532 5.02 4.675 6.675M9.88 9.88l4.24 4.24M3 3l18 18"></path></svg>
                                    </button>
                                </div>
                            </div>
                            <div class="group">
                                <label for="password_confirmation" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 ml-2">Konfirmasi</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" required
                                        class="w-full px-8 py-6 bg-slate-50 border-none rounded-[24px] focus:ring-4 focus:ring-indigo-500/10 transition-all font-bold text-slate-700 placeholder-slate-300">
                                    <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 hover:text-indigo-600 transition-colors">
                                        <svg class="w-6 h-6 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <svg class="w-6 h-6 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 4.057 5.064 7 9.542 7 .847 2.702 2.532 5.02 4.675 6.675M9.88 9.88l4.24 4.24M3 3l18 18"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full py-6 bg-indigo-600 text-white rounded-[24px] font-black text-lg shadow-2xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all duration-500">
                            Simpan Data Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-5 space-y-8">
            <div class="bg-indigo-600 rounded-[40px] p-10 text-white shadow-2xl shadow-indigo-200">
                <h3 class="text-2xl font-black mb-6">Informasi Siswa</h3>
                <p class="text-indigo-100 text-sm font-medium leading-relaxed mb-6">Siswa yang terdaftar dapat mengakses panel ujian dan mengerjakan soal yang tersedia.</p>
                <div class="w-20 h-20 bg-white/10 rounded-3xl flex items-center justify-center">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const eyeOpen = btn.querySelector('.eye-open');
            const eyeClosed = btn.querySelector('.eye-closed');
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>
    @endpush
</x-admin-layout>
