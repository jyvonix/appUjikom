<x-admin-layout>
    <div class="relative min-h-screen pb-20 overflow-hidden">
        {{-- High-End Decorative Background --}}
        <div class="fixed top-0 right-0 -z-10 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px] animate-pulse"></div>
        <div class="fixed -bottom-20 -left-20 -z-10 w-[400px] h-[400px] bg-indigo-600/10 rounded-full blur-[100px]"></div>
        <div class="absolute inset-0 -z-10 opacity-[0.03]" style="background-image: url('https://www.transparenttextures.com/patterns/circuit-board.png');"></div>

        <div class="max-w-7xl mx-auto px-6 pt-10 space-y-10">
            
            {{-- Professional Header --}}
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 bg-white/60 backdrop-blur-xl p-8 rounded-[2.5rem] border border-white shadow-2xl shadow-blue-900/5">
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-lg shadow-lg shadow-blue-200">Database Siswa</span>
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Student Management</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
                        Data <span class="text-blue-600">Peserta Didik</span>
                    </h1>
                    <p class="text-slate-500 font-medium text-sm max-w-xl">
                        Kelola data akademik, kredensial, dan status pengerjaan ujian peserta didik SmartExam.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                    {{-- Total Info Refined --}}
                    <div class="flex items-center gap-4 px-6 py-3 bg-slate-50 rounded-2xl border border-slate-100 shadow-inner">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-blue-600 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[18px] font-bold text-slate-800 leading-none">{{ $siswas->total() }}</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Siswa Aktif</span>
                        </div>
                    </div>

                    {{-- Add Button Refined --}}
                    <div class="flex items-center gap-2">
                        @if($siswas->total() > 0)
                        <form action="{{ route('admin.siswa.destroyAll') }}" method="POST" onsubmit="return confirm('PERINGATAN: Ini akan menghapus SELURUH data siswa! Lanjutkan?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center gap-3 px-6 py-4 bg-rose-100 text-rose-600 rounded-2xl font-bold text-xs uppercase tracking-[0.1em] hover:bg-rose-600 hover:text-white transition-all shadow-sm active:scale-95 transform">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Bersihkan Data
                            </button>
                        </form>
                        @endif

                        <a href="{{ route('admin.siswa.create') }}" class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold text-xs uppercase tracking-[0.1em] hover:bg-blue-600 transition-all shadow-xl shadow-slate-200 active:scale-95 transform">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Siswa
                        </a>
                    </div>
                </div>
            </div>

            {{-- Refined Search Bar & Filters --}}
            <div class="max-w-4xl">
                <form action="{{ route('admin.siswa.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                    <div class="relative group flex-1">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Cari nama, username atau email siswa..." 
                            class="block w-full pl-12 pr-6 py-4 bg-white border border-slate-200 rounded-[1.5rem] text-sm font-semibold text-slate-700 placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all shadow-sm">
                    </div>
                    
                    <div class="relative min-w-[200px]">
                        <select name="kelas_id" onchange="this.form.submit()" class="block w-full pl-6 pr-10 py-4 appearance-none bg-white border border-slate-200 rounded-[1.5rem] text-sm font-semibold text-slate-700 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all shadow-sm cursor-pointer">
                            <option value="">Semua Kelas</option>
                            @foreach($kelasses as $kelas)
                                <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Personnel Matrix Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($siswas as $siswa)
                <div class="group relative bg-white/80 backdrop-blur-sm rounded-[2rem] p-6 border border-slate-100 shadow-lg shadow-slate-200/40 hover:shadow-2xl hover:shadow-blue-300/30 hover:-translate-y-1 transition-all duration-300 flex flex-col">
                    {{-- Highly Visible User Icon --}}
                    <div class="relative mb-6 self-center">
                        <div class="absolute -inset-2 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full blur-xl opacity-0 group-hover:opacity-40 transition-opacity duration-500"></div>
                        <div class="relative w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl flex items-center justify-center text-white text-3xl font-extrabold shadow-xl shadow-blue-200/50 transform group-hover:scale-105 group-hover:rotate-3 transition-all duration-300 border-[3px] border-white">
                            {{ substr($siswa->name, 0, 1) }}
                            {{-- Status Ring --}}
                            <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-white rounded-full flex items-center justify-center shadow-md">
                                <div class="w-3.5 h-3.5 bg-emerald-500 rounded-full border-2 border-white shadow-inner"></div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center space-y-1.5 mb-6">
                        <h3 class="text-base font-bold text-slate-800 leading-tight group-hover:text-blue-600 transition-colors line-clamp-1 px-2" title="{{ $siswa->name }}">{{ $siswa->name }}</h3>
                        <p class="text-[11px] font-bold text-blue-600 uppercase tracking-widest bg-blue-50 py-1 px-3 rounded-full inline-block">{{ $siswa->username }}</p>
                        <p class="text-xs font-medium text-slate-500 italic truncate px-2 pt-1" title="{{ $siswa->email ?? 'no-email@smarexam.com' }}">{{ $siswa->email ?? 'no-email@smarexam.com' }}</p>
                    </div>

                    {{-- Meta & Action Footer --}}
                    <div class="mt-auto space-y-4">
                        <div class="bg-slate-50 rounded-xl border border-slate-200 p-4 space-y-3">
                            <div class="flex flex-col gap-1.5">
                                <div class="flex justify-between items-center">
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Jurusan & Kelas</p>
                                    @if($siswa->kelas)
                                    <span class="text-[9px] font-bold text-blue-700 bg-blue-100 px-2 py-0.5 rounded-md shadow-sm border border-blue-200">{{ $siswa->kelas->nama }}</span>
                                    @endif
                                </div>
                                <p class="text-[11px] font-bold text-slate-700 leading-tight line-clamp-2" title="{{ $siswa->jurusan->nama ?? '-' }}">{{ $siswa->jurusan->nama ?? '-' }}</p>
                            </div>
                            
                            <div class="w-full h-px bg-slate-200"></div>
                            
                            <div class="flex flex-col gap-1.5">
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Asesor</p>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-[10px] font-bold border border-indigo-200">
                                        {{ substr($siswa->asesor->name ?? '?', 0, 1) }}
                                    </div>
                                    <p class="text-xs font-bold {{ $siswa->asesor ? 'text-indigo-700' : 'text-slate-400' }} truncate flex-1" title="{{ $siswa->asesor->name ?? 'Belum Ada' }}">
                                        {{ $siswa->asesor->name ?? 'Belum Ada' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="flex-1 inline-flex items-center justify-center gap-2 py-2.5 bg-white border border-blue-200 text-blue-600 rounded-lg font-bold text-xs hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Hapus data siswa ini?');" class="flex-1">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-white border border-rose-200 text-rose-500 rounded-lg font-bold text-xs hover:bg-rose-500 hover:text-white transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-32 bg-white rounded-[3rem] border border-dashed border-slate-200 flex flex-col items-center justify-center text-center space-y-4">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <p class="text-slate-400 font-bold uppercase tracking-[0.3em] text-xs">Belum ada data siswa terdaftar</p>
                </div>
                @endforelse
            </div>

            {{-- Premium Pagination --}}
            <div class="pt-10">
                {{ $siswas->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>