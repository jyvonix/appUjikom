<x-guru-layout>
    <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-2">
            <h1 class="text-5xl font-extrabold text-slate-900 tracking-tighter leading-none">
                Overview <span class="text-sky-600">Teacher.</span>
            </h1>
            <p class="text-slate-500 font-black text-lg">Welcome, {{ auth()->user()->name }}!</p>
        </div>
        <div class="px-6 py-4 bg-white rounded-3xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-10 h-10 bg-sky-50 rounded-xl flex items-center justify-center text-sky-600 border border-sky-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div class="text-left">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Calendar</p>
                <p class="text-sm font-black text-slate-800">{{ now()->format('D, d M Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="glass-card group p-10 hover:border-sky-500 transition-all duration-500 relative overflow-hidden bg-white">
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="text-[11px] font-black text-sky-500 uppercase tracking-[0.2em] mb-4">Content Library</p>
                    <h3 class="text-6xl font-black text-slate-900 mb-2">{{ $stats['soal'] }}</h3>
                    <p class="text-slate-400 font-bold text-sm">Question Created</p>
                </div>
                <div class="w-16 h-16 bg-sky-50 rounded-2xl flex items-center justify-center text-sky-600 shadow-sm border border-sky-100 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
            </div>
        </div>

        <div class="glass-card group p-10 hover:border-indigo-500 transition-all duration-500 relative overflow-hidden bg-white">
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="text-[11px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-4">Submissions</p>
                    <h3 class="text-6xl font-black text-slate-900 mb-2">{{ $stats['total_nilai'] }}</h3>
                    <p class="text-slate-400 font-bold text-sm">Exam Participations</p>
                </div>
                <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 shadow-sm border border-indigo-100 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
            </div>
        </div>

        <div class="glass-card group p-10 hover:border-emerald-500 transition-all duration-500 relative overflow-hidden bg-white">
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="text-[11px] font-black text-emerald-500 uppercase tracking-[0.2em] mb-4">Analytics</p>
                    <h3 class="text-6xl font-black text-slate-900 mb-2">{{ $stats['siswa'] }}</h3>
                    <p class="text-slate-400 font-bold text-sm">Active Students</p>
                </div>
                <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm border border-emerald-100 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="glass-card p-12 bg-white">
        <h3 class="text-2xl font-black text-slate-800 tracking-tight mb-10">Quick Workflow</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <a href="{{ route('guru.soal.create') }}" class="group flex items-center p-8 bg-sky-50 rounded-3xl border border-sky-100 hover:bg-sky-500 transition-all duration-500">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-sky-600 mr-6 shadow-sm group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <div>
                    <h4 class="text-xl font-black text-slate-900 group-hover:text-white transition-colors">Create Assessment</h4>
                    <p class="text-slate-400 font-bold text-sm group-hover:text-sky-50 transition-colors italic">Compose new exam items</p>
                </div>
            </a>

            <a href="{{ route('guru.nilai.index') }}" class="group flex items-center p-8 bg-indigo-50 rounded-3xl border border-indigo-100 hover:bg-indigo-500 transition-all duration-500">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-indigo-600 mr-6 shadow-sm group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <div>
                    <h4 class="text-xl font-black text-slate-900 group-hover:text-white transition-colors">Grading Center</h4>
                    <p class="text-slate-400 font-bold text-sm group-hover:text-indigo-50 transition-colors italic">Evaluate student results</p>
                </div>
            </a>
        </div>
    </div>
</x-guru-layout>
