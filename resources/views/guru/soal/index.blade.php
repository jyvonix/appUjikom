<x-guru-layout>
    <div class="relative min-h-screen bg-slate-50/30 pb-20">
        <!-- Background Accents - Matching Admin Theme -->
        <div class="fixed top-0 left-0 -z-10 w-[500px] h-[500px] bg-blue-600/5 rounded-full blur-[120px]"></div>
        <div class="fixed bottom-0 right-0 -z-10 w-[400px] h-[400px] bg-indigo-600/5 rounded-full blur-[100px]"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 pt-10 space-y-6">
            
            <!-- Header Section (Ultra Compact) -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-white/70 backdrop-blur-xl p-6 rounded-[2rem] border border-white shadow-sm">
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl flex items-center justify-center text-white shadow-md shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-2xl font-black text-slate-900 tracking-tighter leading-none">Bank <span class="text-blue-600">Soal Guru</span></h1>
                        <p class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] mt-1">Personal Repository</p>
                    </div>
                </div>

                <div class="flex items-center flex-wrap gap-2">
                    <!-- Utility Group -->
                    <div class="flex items-center p-1 bg-slate-100/50 rounded-xl border border-slate-200/30">
                        <button onclick="document.getElementById('importFile').click()" class="px-3 py-1.5 text-slate-500 hover:text-amber-600 hover:bg-white rounded-lg transition-all font-black text-[9px] uppercase tracking-wider">
                            Import
                        </button>
                        <div class="w-px h-3 bg-slate-200 mx-0.5"></div>
                        <a href="{{ route('guru.soal.export') }}" class="px-3 py-1.5 text-slate-500 hover:text-emerald-600 hover:bg-white rounded-lg transition-all font-black text-[9px] uppercase tracking-wider">
                            Export
                        </a>
                    </div>

                    <a href="{{ route('guru.soal.kunci') }}" class="px-4 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-black text-[9px] uppercase tracking-wider hover:border-blue-200 hover:text-blue-600 transition-all shadow-sm">
                        Kunci
                    </a>

                    <a href="{{ route('guru.soal.create') }}" class="px-4 py-2.5 bg-slate-900 text-white rounded-xl font-black text-[9px] uppercase tracking-wider hover:bg-blue-600 transition-all shadow-md">
                        Add New
                    </a>
                </div>
            </div>

            <!-- Aesthetic Search Engine (Compact Width) -->
            <div class="flex justify-center py-2">
                <div class="relative w-full max-w-2xl group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full blur opacity-10 group-focus-within:opacity-20 transition"></div>
                    <form id="searchForm" action="{{ route('guru.soal.index') }}" method="GET" class="relative flex items-center bg-white rounded-full p-1.5 shadow-sm border border-slate-100">
                        <div class="flex-1 flex items-center">
                            <div class="pl-4 text-blue-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" id="searchInput" name="search" value="{{ request('search') }}" 
                                placeholder="Cari materi..." 
                                class="w-full px-4 py-2 bg-transparent border-none focus:ring-0 font-bold text-slate-600 text-sm placeholder:text-slate-300"
                                autocomplete="off">
                        </div>
                        
                        <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-slate-50 text-slate-400 rounded-full font-black text-[8px] uppercase tracking-wider border border-slate-100 shrink-0">
                            <span>Real-time</span>
                            <div id="searchLoader" class="w-3 h-3 border-2 border-blue-500/20 border-t-blue-500 rounded-full animate-spin opacity-0 transition-opacity"></div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Compact Data Table (Optimized Performance) -->
            <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-sm overflow-hidden transform-gpu">
                <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-slate-200">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">ID</th>
                                <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Pertanyaan</th>
                                <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Kunci Jawaban</th>
                                <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                                <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($soals as $soal)
                            <tr class="group hover:bg-blue-50/40 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center font-black text-slate-400 text-[10px] shadow-inner">
                                        {{ $loop->iteration + $soals->firstItem() - 1 }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-slate-700 font-bold line-clamp-1 max-w-md text-sm italic group-hover:text-slate-900 transition-colors">
                                        "{{ $soal->pertanyaan }}"
                                    </p>
                                    <div class="flex gap-3 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        @foreach(['a','b','c','d','e'] as $o)
                                        @if($soal->{'opsi_'.$o})
                                        <span class="text-[8px] font-black {{ strtoupper($o) == $soal->jawaban_benar ? 'text-blue-600' : 'text-slate-300' }} uppercase tracking-tighter">
                                            {{ strtoupper($o) }}: {{ Str::limit($soal->{'opsi_'.$o}, 15) }}
                                        </span>
                                        @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full border border-emerald-100 text-[10px] font-black">
                                        <div class="w-1 h-1 bg-emerald-500 rounded-full"></div>
                                        KUNCI: {{ $soal->jawaban_benar }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                                        <div class="w-1.5 h-1.5 rounded-full bg-blue-400"></div>
                                        Verified
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="{{ route('guru.soal.edit', $soal) }}" class="p-2 bg-white border border-slate-100 text-slate-400 rounded-lg hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        <form id="delete-form-{{ $soal->id }}" action="{{ route('guru.soal.destroy', $soal) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="button" onclick="confirmDeletion({{ $soal->id }})" class="p-2 bg-white border border-slate-100 text-slate-400 rounded-lg hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <h3 class="text-[9px] font-black text-slate-300 uppercase tracking-widest">No Assets Found</h3>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-center pt-6">
                <div class="bg-white/80 backdrop-blur-md px-6 py-2 rounded-2xl border border-white shadow-sm">
                    {{ $soals->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Real-time Search with Debounce (Guru Specific)
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        const searchLoader = document.getElementById('searchLoader');
        let timeout = null;

        searchInput.addEventListener('input', function() {
            searchLoader.classList.remove('opacity-0');
            searchLoader.classList.add('opacity-100');
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                searchForm.submit();
            }, 600);
        });

        // Maintain Focus after reload
        if (window.location.search.includes('search=')) {
            const val = searchInput.value;
            searchInput.value = '';
            searchInput.focus();
            searchInput.value = val;
        }

        // Deletion Confirmation
        function confirmDeletion(id) {
            Swal.fire({
                title: 'Konfirmasi Penghapusan?',
                text: "Data soal akan dihapus secara permanen dari basis data guru.",
                icon: 'warning',
                showCancelButton: true,
                background: '#ffffff',
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: '<span class="px-4 font-black text-white">YA, HAPUS PERMANEN</span>',
                cancelButtonText: '<span class="px-4 font-black text-slate-500">BATALKAN</span>',
                customClass: {
                    popup: 'rounded-[3rem] p-10 shadow-2xl border-none',
                    title: 'text-2xl font-black text-slate-800 uppercase tracking-tight',
                    confirmButton: 'rounded-2xl py-4 shadow-xl shadow-rose-200',
                    cancelButton: 'rounded-2xl py-4'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
    @endpush
</x-guru-layout>
