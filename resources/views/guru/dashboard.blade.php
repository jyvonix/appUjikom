<x-guru-layout>
    <div class="mb-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-800 tracking-tight leading-none mb-3">
                    Halo, <span class="text-indigo-600">{{ explode(' ', auth()->user()->name)[0] }}!</span> 👋
                </h1>
                <p class="text-slate-500 font-bold text-sm">Berikut adalah ringkasan aktivitas akademik Anda hari ini.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="p-4 bg-white rounded-[2rem] border border-slate-200 shadow-sm flex items-center gap-4 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 border border-indigo-100 shrink-0 shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu Sistem</p>
                        <p class="text-xs font-black text-slate-800">{{ now()->format('H:i') }} WIB</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <!-- Soal Card -->
        <div class="group relative bg-white p-8 rounded-[3rem] border border-slate-200 overflow-hidden hover:border-indigo-500 transition-all duration-500 shadow-sm hover:shadow-2xl hover:shadow-indigo-100">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-50 rounded-full blur-3xl opacity-50 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-xl shadow-indigo-200 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Total Bank Soal</p>
                <div class="flex items-end gap-3">
                    <h3 class="text-5xl font-black text-slate-900 leading-none tracking-tighter">{{ $stats['soal'] }}</h3>
                    <span class="text-xs font-black text-indigo-500 mb-1">Butir Soal</span>
                </div>
            </div>
        </div>

        <!-- Nilai Card -->
        <div class="group relative bg-white p-8 rounded-[3rem] border border-slate-200 overflow-hidden hover:border-blue-500 transition-all duration-500 shadow-sm hover:shadow-2xl hover:shadow-blue-100">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-50 rounded-full blur-3xl opacity-50 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-blue-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-xl shadow-blue-200 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Partisipasi Ujian</p>
                <div class="flex items-end gap-3">
                    <h3 class="text-5xl font-black text-slate-900 leading-none tracking-tighter">{{ $stats['total_nilai'] }}</h3>
                    <span class="text-xs font-black text-blue-500 mb-1">Respons</span>
                </div>
            </div>
        </div>

        <!-- Siswa Card -->
        <div class="group relative bg-white p-8 rounded-[3rem] border border-slate-200 overflow-hidden hover:border-emerald-500 transition-all duration-500 shadow-sm hover:shadow-2xl hover:shadow-emerald-100">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-50 rounded-full blur-3xl opacity-50 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-xl shadow-emerald-200 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Populasi Siswa</p>
                <div class="flex items-end gap-3">
                    <h3 class="text-5xl font-black text-slate-900 leading-none tracking-tighter">{{ $stats['siswa'] }}</h3>
                    <span class="text-xs font-black text-emerald-500 mb-1">Peserta</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Workflow Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Quick Actions -->
        <div class="lg:col-span-8 bg-white rounded-[3.5rem] border border-slate-200 p-10 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 p-8">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center border border-slate-100 border-dashed">
                    <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </div>
            
            <h3 class="text-2xl font-black text-slate-800 tracking-tight mb-2">Alur Kerja Cepat</h3>
            <p class="text-slate-500 font-bold text-sm mb-12">Pilih tindakan yang ingin Anda lakukan segera.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('guru.soal.create') }}" class="group p-8 rounded-[2.5rem] bg-indigo-50/50 border border-indigo-100 hover:bg-indigo-600 transition-all duration-500">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-indigo-600 mb-6 shadow-sm group-hover:scale-110 group-hover:rotate-6 transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 group-hover:text-white transition-colors mb-2">Tambah Butir Soal</h4>
                    <p class="text-xs font-bold text-indigo-400 group-hover:text-indigo-100 transition-colors">Susun pertanyaan baru untuk bank soal Anda.</p>
                </a>

                <a href="{{ route('guru.soal.analisis') }}" class="group p-8 rounded-[2.5rem] bg-slate-50 border border-slate-200 hover:bg-slate-900 transition-all duration-500">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-slate-900 mb-6 shadow-sm group-hover:scale-110 group-hover:-rotate-6 transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 group-hover:text-white transition-colors mb-2">Analisis Performa</h4>
                    <p class="text-xs font-bold text-slate-400 group-hover:text-slate-500 transition-colors">Lihat statistik kesulitan soal secara real-time.</p>
                </a>
            </div>
        </div>

        <!-- System Status -->
        <div class="lg:col-span-4 space-y-8">
            <div class="bg-indigo-600 rounded-[3rem] p-10 text-white relative overflow-hidden shadow-2xl shadow-indigo-200">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <h4 class="text-[10px] font-black text-indigo-200 uppercase tracking-[0.2em] mb-8">Informasi Panel</h4>
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center border border-white/30 backdrop-blur-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-black">Sistem Terverifikasi</p>
                                <p class="text-[9px] font-bold text-indigo-200">Enkripsi Data Aktif</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center border border-white/30 backdrop-blur-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-black">Performa Optimal</p>
                                <p class="text-[9px] font-bold text-indigo-200">Latency: 24ms</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-slate-200 p-8 shadow-sm">
                <h4 class="text-sm font-black text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    Panduan Singkat
                </h4>
                <div class="space-y-4">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 group hover:border-indigo-100 transition-colors">
                        <p class="text-[10px] font-black text-slate-800 leading-relaxed">Gunakan fitur <span class="text-indigo-600 italic">Import Excel</span> untuk menambahkan soal dalam jumlah banyak secara instan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guru-layout>
