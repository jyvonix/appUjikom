<x-admin-layout>
    <div class="relative min-h-screen bg-slate-50/30 pb-20">
        <!-- Background Accents -->
        <div class="fixed top-0 left-0 -z-10 w-[500px] h-[500px] bg-blue-600/5 rounded-full blur-[120px]"></div>
        <div class="fixed bottom-0 right-0 -z-10 w-[400px] h-[400px] bg-indigo-600/5 rounded-full blur-[100px]"></div>

        <div class="max-w-[1600px] mx-auto px-4 sm:px-8 pt-10 space-y-8">
            
            <!-- Header Section (More Compact) -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white/40 backdrop-blur-md p-6 rounded-[2rem] border border-white shadow-sm">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-slate-900 tracking-tighter">Bank <span class="text-blue-600">Soal</span></h1>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Master Repository Asset</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 rounded-xl border border-blue-100 text-[10px] font-black uppercase tracking-widest">
                        Total: {{ $soals->total() }} Item
                    </div>
                    <a href="{{ route('admin.soal.create') }}" class="group inline-flex items-center gap-3 px-6 py-3.5 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-600 transition-all duration-300 shadow-xl shadow-slate-200 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                        Add New Asset
                    </a>
                </div>
            </div>

            <!-- Aesthetic Pill-Shaped Search Engine -->
            <div class="flex justify-center py-4">
                <div class="relative w-full max-w-4xl group">
                    <!-- Glow Effect -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full blur opacity-20 group-focus-within:opacity-40 transition duration-1000"></div>
                    
                    <form action="{{ route('admin.soal.index') }}" method="GET" class="relative flex items-center bg-white rounded-full p-2 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.1)] border border-slate-100">
                        <div class="flex-1 flex items-center">
                            <div class="pl-6 text-blue-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                placeholder="Search by question, author, or keywords..." 
                                class="w-full px-6 py-4 bg-transparent border-none focus:ring-0 font-bold text-slate-600 text-lg placeholder:text-slate-300">
                        </div>
                        <button type="submit" class="hidden md:flex items-center gap-2 px-8 py-4 bg-slate-900 text-white rounded-full font-black text-[10px] uppercase tracking-[0.2em] hover:bg-blue-600 transition-all shadow-lg active:scale-95">
                            Search Assets
                        </button>
                        <!-- Mobile Search Icon -->
                        <button type="submit" class="md:hidden p-4 bg-blue-600 text-white rounded-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Compact Data Table -->
            <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] border border-white shadow-[0_40px_100px_-20px_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-900/5 border-b border-slate-100">
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Identity</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Question Content</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Logic Key</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Author</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] text-center">Control</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($soals as $soal)
                            <tr class="group hover:bg-blue-50/30 transition-colors">
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center font-black text-slate-400 text-xs shadow-inner">
                                            {{ $loop->iteration + $soals->firstItem() - 1 }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-slate-700 font-bold line-clamp-2 max-w-2xl leading-relaxed italic group-hover:text-slate-900 transition-colors">
                                        "{{ $soal->pertanyaan }}"
                                    </p>
                                    <div class="flex gap-4 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        @foreach(['a','b','c','d','e'] as $o)
                                        @if($soal->{'opsi_'.$o})
                                        <span class="text-[9px] font-black {{ strtoupper($o) == $soal->jawaban_benar ? 'text-blue-600' : 'text-slate-300' }} uppercase tracking-tighter">
                                            {{ strtoupper($o) }}: {{ Str::limit($soal->{'opsi_'.$o}, 20) }}
                                        </span>
                                        @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-700 rounded-full border border-emerald-100 text-xs font-black">
                                        <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></div>
                                        KEY: {{ $soal->jawaban_benar }}
                                    </div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white text-[10px] font-black uppercase shadow-lg shadow-blue-100">
                                            {{ substr($soal->user->name, 0, 1) }}
                                        </div>
                                        <span class="text-xs font-black text-slate-600 tracking-wide uppercase">{{ $soal->user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.soal.edit', $soal) }}" class="p-3 bg-white border border-slate-100 text-slate-400 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm hover:shadow-lg hover:shadow-blue-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.soal.destroy', $soal) }}" method="POST" onsubmit="return confirm('Execute permanent deletion?');" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-3 bg-white border border-slate-100 text-slate-400 rounded-xl hover:bg-rose-600 hover:text-white transition-all shadow-sm hover:shadow-lg hover:shadow-rose-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-8 py-24 text-center">
                                    <div class="max-w-xs mx-auto space-y-4">
                                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto shadow-inner">
                                            <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em]">No Assets Found</h3>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Premium Pagination -->
            <div class="flex items-center justify-center pt-6">
                <div class="bg-white/80 backdrop-blur-md px-6 py-2 rounded-2xl border border-white shadow-sm">
                    {{ $soals->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
