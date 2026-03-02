<x-admin-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">Peserta Didik</h1>
                <p class="mt-2 text-sm font-bold text-slate-400 uppercase tracking-widest">Database Siswa Aktif</p>
            </div>
            <a href="{{ route('admin.siswa.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-6 py-4 text-sm font-black text-white shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all sm:w-auto w-full uppercase tracking-widest">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                Tambah Siswa
            </a>
        </div>

        <!-- Search Bar -->
        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-6">
                <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
            </div>
            <form action="{{ route('admin.siswa.index') }}" method="GET">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari siswa..." 
                    class="block w-full rounded-[2rem] border-0 py-6 pl-16 pr-6 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-100 placeholder:text-slate-400 focus:ring-4 focus:ring-indigo-500/10 transition-all font-bold">
            </form>
        </div>

        <!-- Content Container -->
        <div class="overflow-hidden bg-white shadow-sm ring-1 ring-slate-100 rounded-[2.5rem]">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50/50 hidden sm:table-header-group">
                    <tr>
                        <th class="px-10 py-6 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Siswa</th>
                        <th class="px-10 py-6 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Email</th>
                        <th class="px-10 py-6 text-right text-[10px] font-black uppercase tracking-widest text-slate-400">Opsi</th>
                    </tr>
                </thead>
                <body class="divide-y divide-slate-100">
                    @forelse($siswas as $siswa)
                    <tr class="group hover:bg-slate-50 transition-colors flex flex-col sm:table-row p-6 sm:p-0">
                        <td class="px-0 sm:px-10 py-4 sm:py-6 sm:table-cell">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 flex-shrink-0 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-black">
                                    {{ substr($siswa->name, 0, 1) }}
                                </div>
                                <div class="font-black text-slate-900 truncate">{{ $siswa->name }}</div>
                            </div>
                        </td>
                        <td class="px-0 sm:px-10 py-2 sm:py-6 sm:table-cell">
                            <div class="text-sm font-bold text-slate-500 truncate">{{ $siswa->email }}</div>
                        </td>
                        <td class="px-0 sm:px-10 py-4 sm:py-6 sm:table-cell sm:text-right">
                            <div class="flex items-center sm:justify-end gap-3">
                                <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="rounded-xl bg-slate-100 p-3 text-slate-500 hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                </a>
                                <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="rounded-xl bg-slate-100 p-3 text-slate-500 hover:bg-rose-50 hover:text-rose-600 transition-all delete-btn">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.244 2.244 0 01-2.244 2.077H8.084a2.244 2.244 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-10 py-20 text-center">
                            <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Tidak ada data siswa</p>
                        </td>
                    </tr>
                    @endforelse
                </body>
            </table>
        </div>

        <div class="mt-8">
            {{ $siswas->links() }}
        </div>
    </div>
</x-admin-layout>
