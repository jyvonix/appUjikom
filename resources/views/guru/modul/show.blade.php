<x-guru-layout>
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('guru.modul.index') }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Butir Soal: <span class="text-indigo-600">{{ $modul->nama }}</span></h2>
                <p class="text-slate-500 font-medium text-sm">Daftar pertanyaan ujian yang tersedia dalam modul ini.</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('guru.soal.bulk', ['modul_id' => $modul->id]) }}" class="inline-flex items-center gap-2 px-6 py-4 bg-indigo-50 text-indigo-600 rounded-2xl font-bold text-sm border border-indigo-100 hover:bg-indigo-100 transition-all active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Bulk Import (Word/PDF)
            </a>
            <button type="button" @click="showImportModal = true" class="inline-flex items-center gap-2 px-6 py-4 bg-emerald-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-emerald-100 hover:bg-emerald-700 transition-all active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Impor Excel
            </button>
            <a href="{{ route('guru.soal.create', ['modul_id' => $modul->id]) }}" class="inline-flex items-center gap-2 px-6 py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm shadow-xl hover:bg-indigo-600 transition-all active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Tambah Soal Manual
            </a>
        </div>
    </div>

    <!-- Import Modal -->
    <div x-show="showImportModal" 
         class="fixed inset-0 z-[150] flex items-center justify-center p-6"
         x-cloak>
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showImportModal = false"></div>
        <div class="relative w-full max-w-md bg-white rounded-[2.5rem] p-10 shadow-2xl overflow-hidden"
             x-show="showImportModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="absolute top-0 right-0 p-6">
                <button @click="showImportModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <div class="text-center mb-10">
                <div class="w-20 h-20 bg-emerald-50 rounded-[2rem] flex items-center justify-center text-emerald-600 mx-auto mb-6 shadow-inner">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight leading-none mb-2">Impor Soal Excel</h3>
                <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">Modul: {{ $modul->nama }}</p>
            </div>

            <form action="{{ route('guru.soal.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="modul_id" value="{{ $modul->id }}">
                
                <div class="mb-8">
                    <label class="block w-full cursor-pointer group">
                        <input type="file" name="file" class="hidden" required accept=".xlsx,.xls,.csv" onchange="document.getElementById('file-name').textContent = this.files[0].name">
                        <div class="p-8 bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl group-hover:bg-emerald-50 group-hover:border-emerald-200 transition-all text-center">
                            <svg class="w-10 h-10 text-slate-300 mx-auto mb-3 group-hover:text-emerald-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            <p id="file-name" class="text-xs font-black text-slate-400 uppercase tracking-widest group-hover:text-emerald-600 transition-colors">Pilih File Excel (.xlsx)</p>
                        </div>
                    </label>
                </div>

                <div class="space-y-3">
                    <button type="submit" class="w-full py-5 bg-emerald-600 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-emerald-100 hover:bg-emerald-700 transition-all active:scale-95">
                        Unggah & Proses Soal
                    </button>
                    <a href="{{ asset('template/template_soal.xlsx') }}" class="block text-center text-[10px] font-black text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">
                        Unduh Template Excel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @forelse($soals as $soal)
            <div class="bg-white rounded-[2.5rem] border border-slate-200 p-8 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Question Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[9px] font-black uppercase rounded-lg tracking-widest border border-indigo-100">
                                #{{ $loop->iteration }}
                            </span>
                            <span class="px-3 py-1 {{ $soal->kesulitan == 'sulit' ? 'bg-rose-50 text-rose-600 border-rose-100' : ($soal->kesulitan == 'sedang' ? 'bg-amber-50 text-amber-600 border-amber-100' : 'bg-emerald-50 text-emerald-600 border-emerald-100') }} text-[9px] font-black uppercase rounded-lg tracking-widest border">
                                {{ $soal->kesulitan }}
                            </span>
                            @if($soal->kategori)
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $soal->kategori }}</span>
                            @endif
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 leading-relaxed mb-6">{{ $soal->pertanyaan }}</h3>

                        @if($soal->gambar)
                            <div class="mb-6 rounded-2xl overflow-hidden border border-slate-100 w-full max-w-md">
                                <img src="{{ asset('storage/' . $soal->gambar) }}" alt="Gambar Soal" class="w-full h-auto object-cover p-2">
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach(['a', 'b', 'c', 'd', 'e'] as $opt)
                                <div class="p-4 rounded-xl border {{ strtoupper($soal->jawaban_benar) == strtoupper($opt) ? 'bg-emerald-50 border-emerald-200 ring-2 ring-emerald-500/10' : 'bg-slate-50 border-slate-100' }} flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-lg flex items-center justify-center font-black text-[10px] {{ strtoupper($soal->jawaban_benar) == strtoupper($opt) ? 'bg-emerald-500 text-white' : 'bg-white text-slate-400 border border-slate-200' }}">
                                        {{ strtoupper($opt) }}
                                    </div>
                                    <span class="text-sm font-semibold {{ strtoupper($soal->jawaban_benar) == strtoupper($opt) ? 'text-emerald-900' : 'text-slate-600' }}">
                                        {{ $soal->{'opsi_'.$opt} }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="lg:w-48 flex flex-row lg:flex-col gap-3 justify-end lg:justify-start">
                        <a href="{{ route('guru.soal.edit', $soal->id) }}" class="flex-1 lg:flex-none py-3 bg-white border border-slate-200 rounded-xl text-[10px] font-black text-slate-600 uppercase tracking-widest text-center hover:bg-slate-50 transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit
                        </a>
                        <button type="button" @click="confirmDeleteSoal('{{ route('guru.soal.destroy', $soal->id) }}')" class="flex-1 lg:flex-none py-3 bg-white border border-slate-200 rounded-xl text-rose-500 hover:bg-rose-50 hover:border-rose-100 transition-colors flex items-center justify-center gap-2 font-black text-[10px] uppercase tracking-widest">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-20 bg-white rounded-[3rem] border border-slate-200 border-dashed flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-lg font-black text-slate-800">Belum Ada Pertanyaan</h3>
                <p class="text-slate-400 text-sm font-medium px-10">Modul ini kosong. Silakan tambahkan butir soal baru.</p>
            </div>
        @endforelse
    </div>

    @push('scripts')
    <form id="delete-soal-form" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function confirmDeleteSoal(url) {
            Swal.fire({
                title: 'Hapus Soal?',
                text: "Data soal ini akan dihapus secara permanen dari modul!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#f43f5e',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-[2rem] border-none shadow-2xl',
                    title: 'text-2xl font-black text-slate-800',
                    htmlContainer: 'text-sm font-medium text-slate-500',
                    confirmButton: 'px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest',
                    cancelButton: 'px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-soal-form');
                    form.action = url;
                    form.submit();
                }
            })
        }
    </script>
    @endpush
</x-guru-layout>
