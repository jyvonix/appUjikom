<x-admin-layout>
    <div class="space-y-6">
        {{-- Header Section --}}
        <div class="bg-white rounded-[2rem] p-8 border border-blue-50 shadow-sm relative overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tracking-tight">Data Jurusan</h2>
                    <p class="text-slate-500 font-medium mt-1">Kelola data program keahlian sekolah</p>
                </div>
                <button onclick="document.getElementById('modal-add-jurusan').showModal()" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold text-sm transition-all shadow-lg shadow-blue-100 flex items-center justify-center gap-2 group">
                    <svg class="w-5 h-5 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Jurusan
                </button>
            </div>
            <div class="absolute top-0 right-0 -mt-8 -mr-8 w-48 h-48 bg-blue-50 rounded-full blur-3xl opacity-50"></div>
        </div>

        {{-- Grid Jurusan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($jurusans as $jurusan)
                <div class="group bg-white rounded-[2rem] p-6 border border-slate-100 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-50 transition-all duration-300 relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 font-black text-lg">
                                {{ $jurusan->kode }}
                            </div>
                            <div class="flex gap-2">
                                <button onclick="editJurusan('{{ $jurusan->id }}', '{{ $jurusan->nama }}', '{{ $jurusan->kode }}')" 
                                    class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <form action="{{ route('admin.jurusan.destroy', $jurusan) }}" method="POST" id="delete-jurusan-{{ $jurusan->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDeleteJurusan('{{ $jurusan->id }}')" 
                                        class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <h3 class="text-lg font-bold text-slate-800 line-clamp-1">{{ $jurusan->nama }}</h3>
                        <p class="text-slate-400 text-sm font-medium mt-1">Kode: {{ $jurusan->kode }}</p>

                        <div class="mt-6 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="px-3 py-1 bg-slate-100 rounded-lg text-slate-600 text-[10px] font-black uppercase tracking-wider">
                                    {{ $jurusan->kelas_count }} Kelas
                                </div>
                            </div>
                            <a href="{{ route('admin.jurusan.show', $jurusan) }}" 
                                class="text-blue-600 text-sm font-bold flex items-center gap-1 hover:gap-2 transition-all">
                                Detail Kelas
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Modal Add --}}
    <dialog id="modal-add-jurusan" class="modal bg-slate-900/40 backdrop-blur-sm rounded-[2rem] border-none p-0 overflow-hidden shadow-2xl">
        <div class="bg-white w-full max-w-md">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                <h3 class="text-xl font-black text-slate-800">Tambah Jurusan</h3>
                <button onclick="this.closest('dialog').close()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form action="{{ route('admin.jurusan.store') }}" method="POST" class="p-8 space-y-4">
                @csrf
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest px-1">Nama Jurusan</label>
                    <input type="text" name="nama" required placeholder="Rekayasa Perangkat Lunak" 
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest px-1">Kode Jurusan</label>
                    <input type="text" name="kode" required placeholder="RPL" 
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg shadow-blue-100 mt-4">Simpan Jurusan</button>
            </form>
        </div>
    </dialog>

    {{-- Modal Edit --}}
    <dialog id="modal-edit-jurusan" class="modal bg-slate-900/40 backdrop-blur-sm rounded-[2rem] border-none p-0 overflow-hidden shadow-2xl">
        <div class="bg-white w-full max-w-md">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                <h3 class="text-xl font-black text-slate-800">Edit Jurusan</h3>
                <button onclick="this.closest('dialog').close()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form id="form-edit-jurusan" method="POST" class="p-8 space-y-4">
                @csrf @method('PUT')
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest px-1">Nama Jurusan</label>
                    <input type="text" name="nama" id="edit-nama" required 
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest px-1">Kode Jurusan</label>
                    <input type="text" name="kode" id="edit-kode" required 
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-medium focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg shadow-blue-100 mt-4">Simpan Perubahan</button>
            </form>
        </div>
    </dialog>

    @push('scripts')
    <script>
        function editJurusan(id, nama, kode) {
            const modal = document.getElementById('modal-edit-jurusan');
            const form = document.getElementById('form-edit-jurusan');
            form.action = `/admin/jurusan/${id}`;
            document.getElementById('edit-nama').value = nama;
            document.getElementById('edit-kode').value = kode;
            modal.showModal();
        }

        function confirmDeleteJurusan(id) {
            Swal.fire({
                title: 'Hapus Jurusan?',
                text: "Semua data kelas dan siswa dalam jurusan ini akan terdampak!",
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
                    document.getElementById(`delete-jurusan-${id}`).submit();
                }
            });
        }
    </script>
    @endpush
</x-admin-layout>
