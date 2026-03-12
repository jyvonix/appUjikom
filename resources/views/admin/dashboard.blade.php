<x-admin-layout>
    <div class="relative min-h-screen pb-20">
        <!-- Professional Subtle Accents -->
        <div class="fixed top-0 right-0 -z-10 w-[600px] h-[600px] bg-blue-600/[0.03] rounded-full blur-[120px]"></div>
        <div class="fixed bottom-0 left-0 -z-10 w-[400px] h-[400px] bg-indigo-600/[0.03] rounded-full blur-[100px]"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-10 space-y-8">
            
            <!-- Sleek Professional Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white border border-slate-200/60 p-6 rounded-3xl shadow-sm">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white shadow-lg shrink-0">
                        <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight leading-none">Command <span class="text-blue-600">Console.</span></h1>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em] mt-2 flex items-center gap-2">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span> System Operational Status: Nominal
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-4 pl-4 md:border-l border-slate-100">
                    <div class="text-right hidden sm:block">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1 italic">Welcome back,</p>
                        <h3 class="text-lg font-black text-slate-800 tracking-tight leading-none">{{ Auth::user()->name }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-slate-100 border border-slate-200 rounded-xl flex items-center justify-center font-black text-slate-600 shadow-inner">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </div>

            <!-- High-Impact Metrics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach([
                    ['label' => 'Total Educators', 'val' => $stats['guru'], 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'blue', 'prefix' => 'EDU'],
                    ['label' => 'Total Enrollment', 'val' => $stats['siswa'], 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'color' => 'indigo', 'prefix' => 'STU'],
                    ['label' => 'Control Personnel', 'val' => $stats['admin'], 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'color' => 'slate', 'prefix' => 'ADM']
                ] as $item)
                <div class="group relative bg-white border border-slate-200/60 rounded-3xl p-8 shadow-sm hover:shadow-2xl hover:shadow-{{ $item['color'] }}-900/5 transition-all duration-500 overflow-hidden">
                    <!-- Subtle Decorative Background -->
                    <div class="absolute top-0 right-0 p-4 opacity-[0.03] group-hover:opacity-[0.08] transition-opacity">
                        <span class="text-6xl font-black text-slate-900 tracking-tighter">{{ $item['prefix'] }}</span>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-10">
                            <div class="relative">
                                <div class="absolute -inset-2 bg-{{ $item['color'] }}-500/20 rounded-full blur-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <div class="relative w-14 h-14 bg-{{ $item['color'] }}-50 border border-{{ $item['color'] }}-100 rounded-2xl flex items-center justify-center text-{{ $item['color'] }}-600 group-hover:bg-{{ $item['color'] }}-600 group-hover:text-white transition-all duration-500 shadow-sm">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path></svg>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <div class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-full flex items-center gap-2">
                                    <div class="w-1 h-1 bg-{{ $item['color'] }}-500 rounded-full animate-pulse"></div>
                                    <span class="text-[7px] font-black text-slate-400 uppercase tracking-widest italic">Encrypted Data</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-5xl font-black text-slate-900 tracking-tighter">{{ number_format($item['val']) }}</h3>
                                <span class="text-[10px] font-black text-{{ $item['color'] }}-500 uppercase tracking-widest">Units</span>
                            </div>
                            <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.3em] leading-none">{{ $item['label'] }}</p>
                        </div>

                        <div class="mt-8 flex items-center gap-2">
                            <div class="h-1 w-12 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-{{ $item['color'] }}-500 w-2/3 group-hover:w-full transition-all duration-1000"></div>
                            </div>
                            <span class="text-[8px] font-black text-slate-300 uppercase tracking-widest">System Integrity Verified</span>
                        </div>
                    </div>

                    <!-- Tech-Grid Accent -->
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-{{ $item['color'] }}-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
                @endforeach
            </div>

            <!-- Primary Data Visualization -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                <!-- System Engagement - Precision Chart -->
                <div class="lg:col-span-8 bg-white border border-slate-200/60 rounded-3xl p-8 shadow-sm">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">System Engagement</h3>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Activity metrics per temporal node</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[8px] font-black uppercase tracking-wider border border-blue-100">Live Feedback</div>
                        </div>
                    </div>

                    <div class="flex items-end justify-between gap-3 h-56 px-2">
                        @foreach([30, 55, 40, 85, 60, 75, 45, 90, 65, 80, 35, 70] as $h)
                        <div class="flex-1 group/bar relative h-full flex flex-col justify-end">
                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[8px] font-black px-2 py-1 rounded opacity-0 group-hover/bar:opacity-100 transition-opacity z-10 whitespace-nowrap">{{ $h }}% Load</div>
                            <div class="w-full bg-slate-50 rounded-t-lg h-full relative overflow-hidden">
                                <div class="absolute bottom-0 left-0 right-0 bg-blue-600/80 transition-all duration-700 group-hover:bg-blue-600" style="height: {{ $h }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 flex justify-between text-[8px] font-black text-slate-300 uppercase tracking-[0.2em] border-t border-slate-50 pt-4">
                        <span>Cycle Start: 00:00</span>
                        <span>Cycle End: 23:59</span>
                    </div>
                </div>

                <!-- Navigation Hub - Structured Actions -->
                <div class="lg:col-span-4 bg-slate-900 rounded-3xl p-8 shadow-xl text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/10 rounded-full blur-3xl -mr-16 -mt-16"></div>
                    
                    <div class="relative z-10 space-y-8 h-full flex flex-col">
                        <div>
                            <h3 class="text-xl font-black tracking-tight italic">Operations Hub.</h3>
                            <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-1 italic">Authorized Shortcuts</p>
                        </div>

                        <div class="flex-1 flex flex-col gap-3">
                            <a href="{{ route('admin.soal.create') }}" class="group flex items-center justify-between p-5 bg-white/5 border border-white/5 rounded-2xl hover:bg-blue-600 hover:border-blue-400 transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-white transition-all group-hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                    <span class="font-black text-[11px] uppercase tracking-widest">Build Asset</span>
                                </div>
                                <svg class="w-4 h-4 text-white/20 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                            </a>

                            <a href="{{ route('admin.siswa.create') }}" class="group flex items-center justify-between p-5 bg-white/5 border border-white/5 rounded-2xl hover:bg-indigo-600 hover:border-indigo-400 transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-white transition-all group-hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                    </div>
                                    <span class="font-black text-[11px] uppercase tracking-widest">Enroll Student</span>
                                </div>
                                <svg class="w-4 h-4 text-white/20 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                            </a>

                            <a href="{{ route('admin.setting.index') }}" class="group flex items-center justify-between p-5 bg-white/5 border border-white/5 rounded-2xl hover:bg-slate-700 transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-white transition-all group-hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                                    </div>
                                    <span class="font-black text-[11px] uppercase tracking-widest">Configuration</span>
                                </div>
                                <svg class="w-4 h-4 text-white/20 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>