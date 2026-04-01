<x-siswa-layout>
    <div class="mb-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-800 tracking-tight leading-none mb-3">
                    Halo, <span class="text-indigo-600">{{ explode(' ', auth()->user()->name)[0] }}!</span> 👋
                </h1>
                <p class="text-slate-500 font-bold text-sm">Pilih modul ujian yang ingin Anda kerjakan hari ini.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="px-6 py-3 bg-white rounded-2xl border border-slate-200 shadow-sm flex items-center gap-3">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sistem Aktif</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Overview Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="bg-indigo-600 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-xl shadow-indigo-200">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            <p class="text-[10px] font-black text-indigo-200 uppercase tracking-widest mb-2">Total Ujian Selesai</p>
            <h3 class="text-4xl font-black">{{ $total_ujian }}</h3>
        </div>
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Rata-rata Skor</p>
            <h3 class="text-4xl font-black text-slate-800">{{ round($rata_rata, 1) }}</h3>
        </div>
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-sm">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Learning Streak</p>
            <div class="flex items-center gap-3">
                <h3 class="text-4xl font-black text-slate-800">{{ $streak }}</h3>
                <span class="text-2xl">🔥</span>
            </div>
        </div>
    </div>

    <!-- Modul Ujian List -->
    <h2 class="text-2xl font-black text-slate-800 mb-8 flex items-center gap-3">
        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        Daftar Modul Ujian
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($moduls as $modul)
            <div class="group bg-white rounded-[3rem] border border-slate-200 p-8 shadow-sm hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-500 relative overflow-hidden flex flex-col">
                <div class="relative z-10 flex-1">
                    <div class="flex items-start justify-between mb-8">
                        <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500 shadow-inner">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[9px] font-black uppercase rounded-full tracking-widest">
                            {{ $modul->soals_count }} Soal
                        </span>
                    </div>

                    <h3 class="text-xl font-black text-slate-800 mb-3 group-hover:text-indigo-600 transition-colors">{{ $modul->nama }}</h3>
                    <p class="text-slate-400 text-xs font-medium leading-relaxed mb-8 line-clamp-3">
                        {{ $modul->deskripsi ?? 'Modul ujian kompetensi untuk mata pelajaran ' . $modul->nama . '.' }}
                    </p>

                    <div class="flex items-center gap-6 p-4 bg-slate-50 rounded-2xl mb-8">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-xs font-black text-slate-700">{{ $modul->waktu }} Menit</span>
                        </div>
                        <div class="w-px h-4 bg-slate-200"></div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-xs font-black text-slate-700">Tersertifikasi</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('siswa.soal.kerjakan', ['modul_id' => $modul->id]) }}" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl hover:bg-indigo-600 transition-all active:scale-95 flex items-center justify-center gap-3">
                    <span>Mulai Ujian</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        @empty
            <div class="col-span-full py-20 bg-white rounded-[3rem] border border-slate-200 border-dashed flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-lg font-black text-slate-800">Tidak Ada Modul Aktif</h3>
                <p class="text-slate-400 text-sm font-medium px-10">Saat ini belum ada modul ujian yang diaktifkan oleh pengajar.</p>
            </div>
        @endforelse
    </div>
</x-siswa-layout>
