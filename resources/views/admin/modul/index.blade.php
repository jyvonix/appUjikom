<x-admin-layout>
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-4xl font-extrabold text-slate-800 tracking-tight mb-2">Manajemen <span class="text-blue-600">Modul Ujian</span></h2>
            <p class="text-slate-500 font-medium text-sm">Administrator dapat mengelola semua modul ujian dari seluruh pengajar.</p>
        </div>
        <a href="{{ route('admin.modul.create') }}" class="inline-flex items-center gap-2 px-6 py-4 bg-blue-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Buat Modul Baru
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($moduls as $modul)
            <div class="group bg-white rounded-[2.5rem] border border-slate-200 p-8 shadow-sm hover:shadow-2xl hover:shadow-blue-100 transition-all duration-500 relative overflow-hidden flex flex-col">
                <div class="absolute top-0 right-0 p-6">
                    <span class="px-3 py-1 {{ $modul->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} text-[9px] font-black uppercase rounded-lg tracking-widest border {{ $modul->is_active ? 'border-emerald-100' : 'border-rose-100' }}">
                        {{ $modul->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>

                <div class="relative z-10 flex-1">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>

                    <h3 class="text-xl font-black text-slate-800 mb-1 truncate">{{ $modul->nama }}</h3>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-5 h-5 rounded-md bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500 italic">G</div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $modul->user->name }}</span>
                    </div>
                    
                    <p class="text-slate-400 text-xs font-medium line-clamp-2 mb-6 h-8">
                        {{ $modul->deskripsi ?? 'Tidak ada deskripsi untuk modul ini.' }}
                    </p>

                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl mb-6">
                        <div class="text-center">
                            <span class="block text-sm font-black text-slate-800">{{ $modul->waktu }}</span>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Menit</span>
                        </div>
                        <div class="w-px h-6 bg-slate-200"></div>
                        <div class="text-center">
                            <span class="block text-sm font-black text-slate-800">{{ $modul->soals_count }}</span>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Soal</span>
                        </div>
                    </div>
                </div>

                    <div class="flex items-center gap-2 mb-6">
                        <a href="{{ route('admin.modul.show', $modul->id) }}" class="flex-1 py-4 bg-blue-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest text-center hover:bg-blue-700 shadow-lg shadow-blue-100 transition-all active:scale-[0.98]">
                            Kelola Butir Soal
                        </a>
                    </div>

                    <div class="flex items-center gap-2 relative z-10">
                        <a href="{{ route('admin.modul.edit', $modul->id) }}" class="flex-1 py-3 bg-white border border-slate-200 rounded-xl text-[10px] font-black text-slate-600 uppercase tracking-widest text-center hover:bg-slate-50 transition-colors">
                            Edit Modul
                        </a>
                    <button type="button" @click="confirmDelete('{{ route('admin.modul.destroy', $modul->id) }}')" class="p-3 bg-white border border-slate-200 rounded-xl text-rose-500 hover:bg-rose-50 hover:border-rose-100 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 bg-white rounded-[3rem] border border-slate-200 border-dashed flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-lg font-black text-slate-800">Belum Ada Modul</h3>
                <p class="text-slate-400 text-sm font-medium px-10">Data modul ujian dari semua guru akan muncul di sini.</p>
            </div>
        @endforelse
    </div>

    @push('scripts')
    <form id="delete-form" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Modul ini akan dihapus secara permanen dari sistem!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#f43f5e',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batalkan',
                customClass: {
                    popup: 'rounded-[2rem] border-none shadow-2xl',
                    title: 'text-2xl font-black text-slate-800',
                    htmlContainer: 'text-sm font-medium text-slate-500',
                    confirmButton: 'px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest',
                    cancelButton: 'px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form');
                    form.action = url;
                    form.submit();
                }
            })
        }
    </script>
    @endpush
</x-admin-layout>
