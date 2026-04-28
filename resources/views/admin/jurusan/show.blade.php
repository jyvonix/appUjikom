<x-admin-layout>
    <div class="space-y-6">
        {{-- Header Section --}}
        <div class="bg-white rounded-[2rem] p-8 border border-blue-50 shadow-sm relative overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.jurusan.index') }}" class="p-3 bg-slate-50 hover:bg-slate-100 rounded-2xl transition-all">
                        <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </a>
                    <div>
                        <h2 class="text-3xl font-black text-slate-800 tracking-tight">{{ $jurusan->nama }}</h2>
                        <p class="text-slate-500 font-medium mt-1">Kelola data kelas untuk jurusan {{ $jurusan->kode }}</p>
                    </div>
                </div>
                <button onclick="document.getElementById('modal-add-kelas').showModal()" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold text-sm transition-all shadow-lg shadow-blue-100 flex items-center justify-center gap-2 group">
                    <svg class="w-5 h-5 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Kelas
                </button>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Nama Kelas</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Jumlah Siswa</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($kelas as $k)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 font-bold text-sm">
                                            {{ substr($k->nama, 0, 2) }}
                                        </div>
                                        <span class="font-bold text-slate-700">{{ $k->nama }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-sm text-slate-500 font-semibold">
                                    {{ $k->users_count ?? 0 }} Siswa
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <form action="{{ route('admin.jurusan.kelas.destroy', $k) }}" method="POST" id="delete-kelas-{{ $k->id }}">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="confirmDeleteKelas('{{ $k->id }}')" 
                                            class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-8 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        </div>
                                        <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">Belum ada data kelas</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Add Kelas --}}
    <dialog id="modal-add-kelas" class="modal bg-slate-900/40 backdrop-blur-sm rounded-[2rem] border-none p-0 overflow-hidden shadow-2xl">
        <div class="bg-white w-full max-w-md">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                <h3 class="text-xl font-black text-slate-800">Tambah Kelas</h3>
                <button onclick="this.closest('dialog').close()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form action="{{ route('admin.jurusan.kelas.store', $jurusan) }}" method="POST" class="p-8 space-y-4">
                @csrf
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest px-1">Nama Kelas</label>
                    <input type="text" name="nama" required placeholder="XII RPL 1" 
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg shadow-blue-100 mt-4">Simpan Kelas</button>
            </form>
        </div>
    </dialog>

    @push('scripts')
    <script>
        function confirmDeleteKelas(id) {
            Swal.fire({
                title: 'Hapus Kelas?',
                text: "Data siswa di kelas ini akan kehilangan referensi kelas!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-[2rem] border-0 shadow-2xl',
                    confirmButton: 'bg-rose-600 text-white px-6 py-3 rounded-2xl font-bold text-sm ml-3',
                    cancelButton: 'bg-slate-100 text-slate-400 px-6 py-3 rounded-2xl font-bold text-sm'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-kelas-${id}`).submit();
                }
            });
        }
    </script>
    @endpush
</x-admin-layout>
