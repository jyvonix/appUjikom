<x-admin-layout>
    <div class="space-y-8">
        <!-- Welcoming -->
        <div class="relative overflow-hidden rounded-[2.5rem] bg-slate-900 px-8 py-10 shadow-2xl sm:px-12 sm:py-16">
            <div class="relative z-10">
                <h2 class="text-3xl font-black tracking-tight text-white sm:text-4xl">Selamat Datang, <span class="text-blue-400">{{ Auth::user()->name }}</span></h2>
                <p class="mt-4 max-w-xl text-lg text-slate-300">Pantau perkembangan akademik dan kelola database sekolah dengan sistem administrasi premium.</p>
            </div>
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-blue-600/20 blur-3xl"></div>
        </div>

        <!-- Stats Grid (Responsive 1 to 3 columns) -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @php
                $stats_items = [
                    ['label' => 'Total Guru', 'val' => $stats['guru'], 'icon' => 'M4.26 10.174L2.858 14.51c-.135.415.211.815.648.815h16.988c.437 0 .783-.4.648-.815l-1.402-4.336c-.149-.46-.616-.763-1.1-.763H5.358c-.483 0-.95.303-1.1.763z M18 19.5v-3m-6 3v-3m-6 3v-3M21 15v3.75A2.25 2.25 0 0118.75 21H5.25A2.25 2.25 0 013 18.75V15', 'color' => 'blue'],
                    ['label' => 'Total Siswa', 'val' => $stats['siswa'], 'icon' => 'M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z', 'color' => 'indigo'],
                    ['label' => 'Total Admin', 'val' => $stats['admin'], 'icon' => 'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z', 'color' => 'slate']
                ];
            @endphp
            @foreach($stats_items as $item)
            <div class="rounded-[2rem] bg-white p-8 shadow-sm border border-slate-100 group hover:shadow-xl transition-all">
                <div class="flex items-center gap-6">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-{{ $item['color'] }}-50 text-{{ $item['color'] }}-600 group-hover:bg-{{ $item['color'] }}-600 group-hover:text-white transition-colors">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" /></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black uppercase tracking-widest text-slate-400">{{ $item['label'] }}</p>
                        <p class="text-3xl font-black text-slate-900 tracking-tighter">{{ number_format($item['val']) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Secondary Grid -->
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            <!-- Chart Section -->
            <div class="rounded-[2.5rem] bg-white p-8 shadow-sm border border-slate-100 sm:p-10">
                <h3 class="text-xl font-black text-slate-900">Aktivitas Sistem</h3>
                <div class="mt-8 flex h-48 items-end justify-between gap-2 sm:gap-4">
                    @foreach([40, 70, 45, 90, 65, 85, 50] as $h)
                    <div class="flex-1 rounded-t-xl bg-slate-50 relative overflow-hidden h-full group">
                        <div class="absolute bottom-0 left-0 right-0 bg-blue-600 transition-all duration-1000 group-hover:bg-blue-400" style="height: {{ $h }}%"></div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="rounded-[2.5rem] bg-blue-600 p-8 shadow-sm sm:p-10">
                <h3 class="text-xl font-black text-white">Akses Cepat</h3>
                <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <a href="{{ route('admin.soal.create') }}" class="flex flex-col gap-4 rounded-2xl bg-white/10 p-6 hover:bg-white/20 transition-all group">
                        <div class="h-10 w-10 rounded-xl bg-white flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M12 4v16m8-8H4" /></svg>
                        </div>
                        <span class="font-black text-white text-sm uppercase tracking-widest">Buat Soal</span>
                    </a>
                    <a href="{{ route('admin.siswa.create') }}" class="flex flex-col gap-4 rounded-2xl bg-white/10 p-6 hover:bg-white/20 transition-all group">
                        <div class="h-10 w-10 rounded-xl bg-white flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                        </div>
                        <span class="font-black text-white text-sm uppercase tracking-widest">Enroll Siswa</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
