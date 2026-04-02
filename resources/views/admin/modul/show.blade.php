<x-admin-layout>
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.modul.index') }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-blue-600 hover:border-blue-100 transition-all shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Review Modul: <span class="text-blue-600">{{ $modul->nama }}</span></h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">Oleh: {{ $modul->user->name }}</span>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.soal.create', ['modul_id' => $modul->id]) }}" class="inline-flex items-center gap-2 px-6 py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm shadow-xl hover:bg-blue-600 transition-all active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Tambah Soal Manual
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @forelse($soals as $soal)
            <div class="bg-white rounded-[2.5rem] border border-slate-200 p-8 shadow-sm hover:shadow-md transition-all">
                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[9px] font-black uppercase rounded-lg tracking-widest border border-blue-100">
                                #{{ $loop->iteration }}
                            </span>
                            <span class="px-3 py-1 {{ $soal->kesulitan == 'sulit' ? 'bg-rose-50 text-rose-600 border-rose-100' : ($soal->kesulitan == 'sedang' ? 'bg-amber-50 text-amber-600 border-amber-100' : 'bg-emerald-50 text-emerald-600 border-emerald-100') }} text-[9px] font-black uppercase rounded-lg tracking-widest border">
                                {{ $soal->kesulitan }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 leading-relaxed mb-6">{{ $soal->pertanyaan }}</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach(['a', 'b', 'c', 'd', 'e'] as $opt)
                                <div class="p-4 rounded-xl border {{ strtoupper($soal->jawaban_benar) == strtoupper($opt) ? 'bg-emerald-50 border-emerald-200' : 'bg-slate-50 border-slate-100' }} flex items-center gap-3">
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
                        <a href="{{ route('admin.soal.edit', $soal->id) }}" class="flex-1 lg:flex-none py-3 bg-white border border-slate-200 rounded-xl text-[10px] font-black text-slate-600 uppercase tracking-widest text-center hover:bg-slate-50 transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit
                        </a>
                        <button type="button" @click="confirmDeleteSoal('{{ route('admin.soal.destroy', $soal->id) }}')" class="flex-1 lg:flex-none py-3 bg-white border border-slate-200 rounded-xl text-rose-500 hover:bg-rose-50 hover:border-rose-100 transition-colors flex items-center justify-center gap-2 font-black text-[10px] uppercase tracking-widest">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-20 bg-white rounded-[3rem] border border-slate-200 border-dashed flex flex-col items-center justify-center text-center">
                <h3 class="text-lg font-black text-slate-800">Belum Ada Pertanyaan</h3>
                <p class="text-slate-400 text-sm font-medium">Modul ini belum memiliki butir soal.</p>
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
</x-admin-layout>
