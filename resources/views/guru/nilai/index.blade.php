<x-guru-layout>
    <!-- Background Elements -->
    <div class="fixed top-0 right-0 -z-10 w-[500px] h-[500px] bg-blue-400/5 rounded-full blur-[120px]"></div>
    <div class="fixed bottom-0 left-0 -z-10 w-[500px] h-[500px] bg-indigo-400/5 rounded-full blur-[120px]"></div>

    <div class="mb-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-50 rounded-full border border-emerald-100 mb-4">
                    <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-[9px] font-black text-emerald-600 uppercase tracking-widest">Real-time Data Sync</span>
                </div>
                <h1 class="text-6xl font-black text-slate-900 tracking-tighter leading-none mb-4">
                    Exam <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Analytics.</span>
                </h1>
                <p class="text-slate-400 font-bold text-lg max-w-xl">Monitor student performance and gain deep insights into academic progress.</p>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="bg-white p-4 rounded-3xl shadow-xl shadow-slate-100 border border-slate-50 flex items-center gap-4 group hover:scale-105 transition-all cursor-default">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Total Examinees</p>
                        <p class="text-2xl font-black text-slate-800 leading-none">{{ $nilais->total() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Dashboard Container -->
    <div class="bg-white/40 backdrop-blur-3xl rounded-[48px] border border-white shadow-[0_40px_80px_-15px_rgba(0,0,0,0.05)] overflow-hidden">
        
        <!-- Toolbar -->
        <div class="p-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8 border-b border-white/50">
            <div class="flex items-center gap-6">
                <div class="w-16 h-16 bg-gradient-to-br from-slate-800 to-slate-900 rounded-[24px] flex items-center justify-center text-white shadow-2xl shadow-slate-200">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <div>
                    <h3 class="font-black text-slate-800 text-3xl tracking-tight leading-none mb-2">Performance Board</h3>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em]">Academic Session 2025/2026</p>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('guru.nilai.index') }}" method="GET" class="relative w-full lg:w-[450px]">
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Search student by name or ID..." 
                    class="w-full pl-16 pr-8 py-6 bg-white border-2 border-slate-100 rounded-[32px] focus:bg-white focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 transition-all outline-none font-bold text-slate-800 placeholder:text-slate-300 shadow-sm">
                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                @if(request('search'))
                    <a href="{{ route('guru.nilai.index') }}" class="absolute right-6 top-1/2 -translate-y-1/2 text-rose-500 hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </a>
                @endif
            </form>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-10 py-8 text-left">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Position</span>
                        </th>
                        <th class="px-10 py-8 text-left">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Student Identity</span>
                        </th>
                        <th class="px-10 py-8 text-center">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Score visualization</span>
                        </th>
                        <th class="px-10 py-8 text-right">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Submission Log</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($nilais as $nilai)
                    <tr class="group hover:bg-blue-50/50 transition-all duration-500">
                        <td class="px-10 py-10">
                            <div class="relative inline-flex items-center justify-center">
                                <span class="text-4xl font-black text-slate-200/60 group-hover:text-blue-100 transition-colors">#{{ ($nilais->currentPage() - 1) * $nilais->perPage() + $loop->iteration }}</span>
                            </div>
                        </td>
                        <td class="px-10 py-10">
                            <div class="flex items-center gap-6">
                                <div class="relative">
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-[24px] flex items-center justify-center text-white font-black text-xl shadow-xl shadow-blue-200 group-hover:rotate-6 transition-transform">
                                        {{ strtoupper(substr($nilai->user->name, 0, 1)) }}{{ strtoupper(substr(strrchr($nilai->user->name, ' ') ?: '', 1, 1)) ?: strtoupper(substr($nilai->user->name, 1, 1)) }}
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-emerald-500 border-4 border-white rounded-full"></div>
                                </div>
                                <div>
                                    <h4 class="text-xl font-black text-slate-800 leading-none mb-2 group-hover:text-blue-600 transition-colors">{{ $nilai->user->name }}</h4>
                                    <div class="flex items-center gap-3">
                                        <span class="px-2 py-0.5 bg-slate-100 rounded text-[9px] font-black text-slate-500 uppercase tracking-widest">ID:{{ $nilai->user->id }}</span>
                                        <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                        <span class="text-[10px] font-bold text-slate-500">Regular Student</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-10">
                            <div class="flex flex-col items-center gap-3">
                                <div class="relative w-20 h-20">
                                    <svg class="w-full h-full transform -rotate-90">
                                        <circle cx="40" cy="40" r="34" stroke="currentColor" stroke-width="6" fill="transparent" class="text-slate-100" />
                                        <circle cx="40" cy="40" r="34" stroke="currentColor" stroke-width="8" fill="transparent" 
                                            stroke-dasharray="213.6" 
                                            stroke-dashoffset="{{ 213.6 - (213.6 * $nilai->skor / 100) }}" 
                                            class="{{ $nilai->skor >= $kkm ? 'text-emerald-500' : ($nilai->skor >= ($kkm - 15) ? 'text-amber-500' : 'text-rose-500') }} transition-all duration-1000 ease-out" 
                                            stroke-linecap="round" />
                                    </svg>
                                    <div class="absolute inset-0 flex flex-col items-center justify-center leading-none">
                                        <span class="text-xl font-black text-slate-800">{{ number_format($nilai->skor) }}</span>
                                        <span class="text-[8px] font-black text-slate-400 uppercase">Pts</span>
                                    </div>
                                </div>
                                <span class="px-3 py-1 {{ $nilai->skor >= $kkm ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} rounded-full text-[9px] font-black uppercase tracking-widest">
                                    {{ $nilai->skor >= $kkm ? 'Pass' : 'Review' }}
                                </span>
                            </div>
                        </td>
                        <td class="px-10 py-10 text-right">
                            <div class="space-y-1">
                                <p class="text-slate-800 font-black text-base">{{ $nilai->created_at->format('M d, Y') }}</p>
                                <div class="flex items-center justify-end gap-2">
                                    <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ $nilai->created_at->format('h:i A') }}</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-10 py-40">
                            <div class="flex flex-col items-center text-center">
                                <div class="w-40 h-40 bg-slate-50 rounded-[60px] flex items-center justify-center text-slate-200 mb-8 border-8 border-white shadow-inner relative overflow-hidden group">
                                    <div class="absolute inset-0 bg-blue-500/5 scale-0 group-hover:scale-100 transition-transform duration-700 rounded-full"></div>
                                    <svg class="w-20 h-20 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="text-4xl font-black text-slate-300 tracking-tight mb-2">No Records Found</h3>
                                <p class="text-slate-400 font-bold max-w-sm">We couldn't find any examination results matching your current criteria.</p>
                                <a href="{{ route('guru.nilai.index') }}" class="mt-8 px-8 py-4 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 transition-all shadow-xl shadow-slate-200">Reset Search Filters</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($nilais->hasPages())
        <div class="px-10 py-10 bg-slate-50/50 border-t border-white/50">
            {{ $nilais->links() }}
        </div>
        @endif
    </div>

    <!-- Additional Analytics Insight -->
    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-blue-600 rounded-[40px] p-8 text-white shadow-2xl shadow-blue-200 relative overflow-hidden group">
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all"></div>
            <h4 class="text-[10px] font-black uppercase tracking-[0.3em] opacity-60 mb-6">Expert Insight</h4>
            <p class="text-lg font-bold leading-relaxed">"The average score is trending upwards by 12% compared to the previous semester."</p>
        </div>
        <div class="col-span-2 bg-white rounded-[40px] p-8 border border-slate-100 shadow-xl shadow-slate-50 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <h5 class="text-xl font-black text-slate-800">Quick Export</h5>
                    <p class="text-xs text-slate-400 font-bold">Generate PDF report for this session</p>
                </div>
            </div>
            <button class="px-8 py-4 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-600 transition-all">Download Report</button>
        </div>
    </div>
</x-guru-layout>
