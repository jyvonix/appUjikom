<x-admin-layout>
    <div class="relative min-h-screen pb-20 overflow-hidden">
        {{-- Background Accents --}}
        <div class="fixed top-0 right-0 -z-10 w-[600px] h-[600px] bg-indigo-600/5 rounded-full blur-[120px]"></div>
        <div class="absolute inset-0 -z-10 opacity-[0.02]" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>

        <div class="max-w-5xl mx-auto px-6 pt-10">
            {{-- Back Button & Header --}}
            <div class="mb-12 flex flex-col md:flex-row md:items-center gap-8">
                <a href="{{ route('admin.guru.index') }}" 
                    class="group w-14 h-14 bg-white rounded-[1.5rem] flex items-center justify-center shadow-sm border border-slate-200 hover:bg-blue-600 hover:border-blue-600 transition-all duration-500">
                    <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div class="space-y-1">
                    <div class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">
                        <span class="text-blue-600">Faculty Modification</span>
                        <span class="text-slate-200">/</span>
                        <span>Instructor ID: #{{ $guru->id }}</span>
                    </div>
                    <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Update <span class="text-blue-600">Profil Guru</span></h1>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                {{-- Left: The Main Form --}}
                <div class="lg:col-span-7">
                    <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="bg-white/80 backdrop-blur-xl rounded-[3rem] p-8 md:p-12 border border-white shadow-2xl shadow-blue-900/5 space-y-10 relative">
                            {{-- Decorative Pattern --}}
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50/30 rounded-bl-[4rem] -mr-4 -mt-4 -z-10"></div>

                            <div class="flex items-center gap-6 p-6 bg-blue-50/50 rounded-[2rem] border border-blue-100">
                                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-indigo-600 to-blue-600 flex items-center justify-center text-white font-extrabold text-3xl shadow-xl shadow-blue-100 border-4 border-white">
                                    {{ substr($guru->name, 0, 1) }}
                                </div>
                                <div class="space-y-1">
                                    <h3 class="text-xl font-bold text-slate-800 tracking-tight">{{ $guru->name }}</h3>
                                    <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-blue-100/50 px-2 py-0.5 rounded w-fit">Senior Educator</p>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Nama Lengkap Guru</label>
                                <input type="text" name="name" value="{{ old('name', $guru->name) }}" required
                                    class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-6 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 transition-all font-semibold text-sm">
                                @error('name') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Email Aktif</label>
                                <input type="email" name="email" value="{{ old('email', $guru->email) }}" required
                                    class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 py-4.5 px-6 text-slate-700 placeholder:text-slate-300 focus:bg-white focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 transition-all font-semibold text-sm">
                                @error('email') <p class="text-[10px] font-bold text-rose-500 mt-2 ml-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="relative py-4 text-center">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                    <div class="w-full border-t border-slate-100"></div>
                                </div>
                                <span class="relative bg-white px-4 text-[9px] font-bold text-slate-300 uppercase tracking-[0.4em]">Credential Context</span>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Update Password Baru</label>
                                <x-password-input name="password" placeholder="Biarkan kosong jika tidak diubah" />
                                <p class="text-[10px] font-medium text-slate-400 italic mt-2">*Kosongkan jika tidak ada pembaruan kredensial.</p>
                            </div>


                            <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-[1.5rem] font-bold text-xs uppercase tracking-[0.2em] shadow-xl shadow-blue-900/20 hover:bg-blue-600 transition-all active:scale-95 flex items-center justify-center gap-3 transform">
                                <span>Perbarui Data Pendidik</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Right: Meta & Lifecycle --}}
                <div class="lg:col-span-5 space-y-8">
                    <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-xl space-y-10 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full blur-3xl -mr-16 -mt-16 group-hover:bg-blue-100 transition-colors"></div>
                        
                        <div>
                            <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em] mb-8 flex items-center gap-2">
                                <span class="w-1 h-1 bg-blue-600 rounded-full"></span>
                                Account Lifecycle
                            </h4>
                            <div class="space-y-8">
                                <div class="flex items-center gap-5">
                                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-blue-600 shrink-0 border border-slate-100">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-300 uppercase tracking-widest">Terdaftar Sejak</p>
                                        <p class="text-base font-bold text-slate-700 tracking-tight">{{ $guru->created_at->translatedFormat('d F Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-5">
                                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-indigo-600 shrink-0 border border-slate-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-300 uppercase tracking-widest">Update Terakhir</p>
                                        <p class="text-base font-bold text-slate-700 tracking-tight">{{ $guru->updated_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-slate-50">
                            <div class="flex items-center gap-4 px-5 py-4 bg-blue-50 text-blue-600 rounded-2xl border border-blue-100">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-[10px] font-bold uppercase tracking-wide leading-relaxed italic">Validasi akses diperlukan untuk perubahan data tenaga pendidik.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-[3rem] p-10 text-white shadow-2xl shadow-blue-300 relative overflow-hidden">
                        <div class="absolute bottom-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl -mb-16 -mr-16"></div>
                        <h4 class="text-sm font-bold uppercase tracking-widest mb-4 opacity-60">Security Integrity</h4>
                        <p class="text-sm font-medium leading-relaxed italic">"Setiap perubahan profil guru akan berdampak pada hak akses pengelolaan modul ujian dan laporan nilai siswa."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>