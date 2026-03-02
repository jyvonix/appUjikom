<x-siswa-layout>
    <!-- Header Section -->
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Dashboard Siswa</h1>
        <p class="text-slate-500 font-medium mt-1">Selamat datang kembali, <span class="text-blue-600 font-bold">{{ Auth::user()->name }}</span>. Pantau progres belajarmu di sini.</p>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <!-- Skor Terakhir -->
        <div class="bg-white rounded-3xl p-8 border border-slate-200 card-shadow relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10">
                <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Skor Terakhir</p>
                <h3 class="text-4xl font-black text-slate-900 mt-2">{{ $nilai_terakhir ? number_format($nilai_terakhir->skor, 0) : '0' }}</h3>
                <p class="text-xs font-semibold text-blue-500 mt-4 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Update Otomatis
                </p>
            </div>
        </div>

        <!-- Total Ujian -->
        <div class="bg-white rounded-3xl p-8 border border-slate-200 card-shadow relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10">
                <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Total Ujian</p>
                <h3 class="text-4xl font-black text-slate-900 mt-2">{{ $total_ujian }}</h3>
                <p class="text-xs font-semibold text-emerald-500 mt-4 flex items-center">Sesi Diselesaikan</p>
            </div>
        </div>

        <!-- Rata-rata Skor -->
        <div class="bg-white rounded-3xl p-8 border border-slate-200 card-shadow relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-purple-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
            <div class="relative z-10">
                <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-600 mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path></svg>
                </div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Rata-rata Skor</p>
                <h3 class="text-4xl font-black text-slate-900 mt-2">{{ number_format($rata_rata, 1) }}</h3>
                <p class="text-xs font-semibold text-purple-500 mt-4 flex items-center">Performa Akademik</p>
            </div>
        </div>
    </div>

    <!-- Actions Section -->
    <div class="bg-white rounded-[2rem] p-10 border border-slate-200 shadow-sm flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="max-w-xl">
            <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Mulai Ujian Hari Ini?</h3>
            <p class="text-slate-500 font-medium mt-2 leading-relaxed">Berlatih secara rutin adalah kunci kesuksesan. Pilih daftar soal yang tersedia dan uji kemampuanmu sekarang juga.</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
            <a href="{{ route('siswa.soal.index') }}" class="btn-blue text-white px-8 py-4 rounded-2xl font-bold text-center flex items-center justify-center group">
                Mulai Ujian Sekarang
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
            <a href="{{ route('siswa.nilai.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-8 py-4 rounded-2xl font-bold text-center transition-all border border-slate-200">
                Lihat Nilai
            </a>
        </div>
    </div>
</x-siswa-layout>
