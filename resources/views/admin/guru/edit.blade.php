<x-admin-layout>
    <div class="mb-12">
        <a href="{{ route('admin.guru.index') }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-[0.2em] text-slate-400 hover:text-blue-600 transition-all mb-6 group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-5xl font-black text-slate-900 tracking-tight leading-tight">Perbarui <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-blue-500">Profil Guru</span></h1>
    </div>

    <div class="grid lg:grid-cols-12 gap-12">
        <div class="lg:col-span-7">
            <div class="bg-white rounded-[40px] p-10 lg:p-14 shadow-2xl shadow-blue-100/50 border border-slate-50 relative overflow-hidden">
                <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" class="space-y-10 relative z-10">
                    @csrf
                    @method('PATCH')
                    
                    <div class="space-y-8">
                        <div class="flex items-center gap-6 p-6 bg-blue-50/50 rounded-[32px] border border-blue-100">
                            <div class="w-20 h-20 rounded-[28px] bg-gradient-to-br from-blue-600 to-blue-400 flex items-center justify-center text-white font-black text-3xl shadow-xl shadow-blue-100">
                                {{ substr($guru->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-800">{{ $guru->name }}</h3>
                                <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest">Update Data Terakhir</p>
                            </div>
                        </div>

                        <div class="group">
                            <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 ml-2">Nama Lengkap & Gelar</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $guru->name) }}" required
                                class="w-full px-8 py-6 bg-slate-50 border-none rounded-[24px] focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700">
                        </div>

                        <div class="group">
                            <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 ml-2">Email Institusi</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $guru->email) }}" required
                                class="w-full px-8 py-6 bg-slate-50 border-none rounded-[24px] focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700">
                        </div>

                        <div class="p-6 bg-blue-50 rounded-[32px] border border-blue-100 flex gap-4 italic text-xs font-medium text-blue-700">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Kosongkan kolom password jika tidak ingin mengubah kredensial akses.
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="group">
                                <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 ml-2">Password Baru</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" placeholder="••••••••"
                                        class="w-full px-8 py-6 bg-slate-50 border-none rounded-[24px] focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700">
                                    <button type="button" onclick="togglePassword('password', this)" class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 hover:text-blue-600 transition-colors">
                                        <svg class="w-6 h-6 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <svg class="w-6 h-6 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 4.057 5.064 7 9.542 7 .847 2.702 2.532 5.02 4.675 6.675M9.88 9.88l4.24 4.24M3 3l18 18"></path></svg>
                                    </button>
                                </div>
                            </div>
                            <div class="group">
                                <label for="password_confirmation" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 ml-2">Konfirmasi</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                                        class="w-full px-8 py-6 bg-slate-50 border-none rounded-[24px] focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-slate-700">
                                    <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 hover:text-blue-600 transition-colors">
                                        <svg class="w-6 h-6 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <svg class="w-6 h-6 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 4.057 5.064 7 9.542 7 .847 2.702 2.532 5.02 4.675 6.675M9.88 9.88l4.24 4.24M3 3l18 18"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full py-6 bg-slate-900 text-white rounded-[24px] font-black text-lg shadow-2xl shadow-blue-100 hover:bg-blue-600 hover:-translate-y-1 transition-all duration-500">
                            Perbarui Data Guru
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Meta Section -->
        <div class="lg:col-span-5 space-y-8">
            <div class="bg-white rounded-[40px] p-10 border border-slate-50 shadow-sm space-y-10">
                <div>
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Aktivitas Akun</h4>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-800 uppercase tracking-widest">Dibuat Pada</p>
                                <p class="text-slate-500 text-sm font-bold mt-1">{{ $guru->created_at->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-slate-50">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Tindakan Bahaya</h4>
                    <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="flex items-center gap-3 text-rose-500 font-black text-xs uppercase tracking-widest hover:text-rose-700 transition-colors delete-btn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus Permanen Akun Ini
                        </button>
                    </form>
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
