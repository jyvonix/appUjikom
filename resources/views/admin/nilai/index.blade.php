<x-admin-layout>
    <div class="relative min-h-screen pb-20">
        <!-- Dynamic Background -->
        <div class="fixed top-0 right-0 -z-10 w-[700px] h-[700px] bg-emerald-400/5 rounded-full blur-[150px]"></div>
        <div class="fixed bottom-0 left-0 -z-10 w-[600px] h-[600px] bg-teal-400/5 rounded-full blur-[120px]"></div>

        <!-- Header Section -->
        <div class="mb-16">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-10">
                <div>
                    <nav class="flex mb-4 text-[10px] font-black uppercase tracking-[0.4em] text-slate-400">
                        <span class="text-emerald-600">Administrator</span>
                        <span class="mx-3 text-slate-200">/</span>
                        <span>Global Analytics</span>
                    </nav>
                    <h1 class="text-7xl font-black text-slate-900 tracking-tighter leading-none">
                        Student <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-400">Performance.</span>
                    </h1>
                    <p class="text-slate-400 font-bold text-xl mt-6 max-w-2xl">High-level overview of examination results across all academic departments.</p>
                </div>

                <div class="flex items-center gap-6">
                    <div class="bg-white p-6 rounded-[32px] shadow-2xl shadow-emerald-100/50 border border-white flex items-center gap-6 group hover:scale-105 transition-all">
                        <div class="w-16 h-16 bg-emerald-50 rounded-[20px] flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500 shadow-inner">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-1">Global Records</p>
                            <p class="text-3xl font-black text-slate-800 leading-none">{{ $nilais->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Data Container -->
        <div class="bg-white/60 backdrop-blur-3xl rounded-[64px] border border-white shadow-[0_40px_100px_-20px_rgba(0,0,0,0.05)] overflow-hidden">
            
            <!-- Filter Bar -->
            <div class="p-12 border-b border-white/50 flex flex-col lg:flex-row lg:items-center justify-between gap-10 bg-white/30">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-emerald-600 rounded-[24px] flex items-center justify-center text-white shadow-2xl shadow-emerald-200 rotate-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight leading-none mb-2">Result Ledger</h3>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.3em] flex items-center gap-2">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                            Live Repository
                        </p>
                    </div>
                </div>

                <form action="{{ route('admin.nilai.index') }}" method="GET" class="relative w-full lg:w-[500px]">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Search student identity..." 
                        class="w-full pl-16 pr-10 py-7 bg-white/80 border-2 border-slate-50 rounded-[40px] focus:bg-white focus:border-emerald-500 focus:ring-8 focus:ring-emerald-500/5 transition-all outline-none font-bold text-slate-800 placeholder:text-slate-300 shadow-sm">
                    <div class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
            </div>

            <!-- Enhanced Table -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-slate-50/40">
                            <th class="px-12 py-10 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.4em]">Rank</th>
                            <th class="px-12 py-10 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.4em]">Candidate Info</th>
                            <th class="px-12 py-10 text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.4em]">Score Metric</th>
                            <th class="px-12 py-10 text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.4em]">Metrics</th>
                            <th class="px-12 py-10 text-right text-[10px] font-black text-slate-400 uppercase tracking-[0.4em]">Operations</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($nilais as $nilai)
                        <tr class="group hover:bg-emerald-50/30 transition-all duration-500">
                            <td class="px-12 py-12">
                                <span class="text-5xl font-black text-slate-200/60 group-hover:text-emerald-200 transition-colors leading-none">
                                    #{{ ($nilais->currentPage() - 1) * $nilais->perPage() + $loop->iteration }}
                                </span>
                            </td>
                            <td class="px-12 py-12">
                                <div class="flex items-center gap-8">
                                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-[28px] flex items-center justify-center text-white font-black text-2xl shadow-2xl shadow-emerald-200 group-hover:rotate-6 transition-transform">
                                        {{ strtoupper(substr($nilai->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h4 class="text-2xl font-black text-slate-800 leading-none mb-3 group-hover:text-emerald-600 transition-colors">{{ $nilai->user->name }}</h4>
                                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest leading-none">Registered: {{ $nilai->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-12 py-12">
                                <div class="flex justify-center">
                                    <div class="relative w-24 h-24">
                                        <svg class="w-full h-full transform -rotate-90">
                                            <circle cx="48" cy="48" r="42" stroke="currentColor" stroke-width="6" fill="transparent" class="text-slate-100" />
                                            <circle cx="48" cy="48" r="42" stroke="currentColor" stroke-width="10" fill="transparent" 
                                                stroke-dasharray="263.76" 
                                                stroke-dashoffset="{{ 263.76 - (263.76 * $nilai->skor / 100) }}" 
                                                class="{{ $nilai->skor >= $kkm ? 'text-emerald-500' : 'text-rose-500' }} transition-all duration-1000 ease-out" 
                                                stroke-linecap="round" />
                                        </svg>
                                        <div class="absolute inset-0 flex flex-col items-center justify-center leading-none">
                                            <span class="text-3xl font-black text-slate-800">{{ number_format($nilai->skor) }}</span>
                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1">Score</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-12 py-12 text-center">
                                <div class="inline-flex items-center gap-3 px-6 py-3 bg-slate-50 rounded-2xl border border-slate-100 group-hover:bg-white transition-colors">
                                    <span class="text-xl font-black text-slate-700">{{ $nilai->jumlah_benar }}</span>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Correct</span>
                                </div>
                            </td>
                            <td class="px-12 py-12">
                                <div class="flex justify-end gap-3">
                                    <form action="{{ route('admin.nilai.destroy', $nilai->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="p-5 bg-slate-50 text-slate-400 rounded-3xl hover:bg-rose-50 hover:text-rose-600 hover:scale-110 transition-all delete-btn shadow-sm">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-12 py-48 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-48 h-48 bg-slate-50 rounded-[70px] flex items-center justify-center text-slate-100 mb-10 border-8 border-white shadow-inner">
                                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <h3 class="text-4xl font-black text-slate-300 tracking-tighter">Zero Records</h3>
                                    <p class="text-slate-400 font-bold mt-4">The global analytics repository is currently empty.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Pagination -->
            @if($nilais->hasPages())
            <div class="px-12 py-12 bg-slate-50/50 border-t border-white/50">
                {{ $nilais->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Script for Delete Confirmation -->
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                Swal.fire({
                    title: 'Authorize Deletion?',
                    text: "This action will permanently remove the student's result from the global repository.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#f43f5e',
                    confirmButtonText: 'Yes, Delete Asset',
                    cancelButtonText: 'Cancel',
                    background: '#ffffff',
                    borderRadius: '32px',
                    customClass: {
                        title: 'font-black tracking-tight text-slate-800',
                        htmlContainer: 'font-bold text-slate-500',
                        confirmButton: 'rounded-2xl font-black uppercase tracking-widest py-4 px-8',
                        cancelButton: 'rounded-2xl font-black uppercase tracking-widest py-4 px-8'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form').submit();
                    }
                })
            });
        });
    </script>
</x-admin-layout>
