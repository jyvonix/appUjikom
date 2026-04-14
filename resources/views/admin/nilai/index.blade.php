<x-admin-layout>
    <div class="mb-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
        <div>
            <h2 class="text-4xl font-black text-slate-800 tracking-tight mb-2">Laporan <span class="text-emerald-600">Nilai Siswa</span></h2>
            <p class="text-slate-500 font-bold">Rekapitulasi hasil ujian seluruh siswa secara real-time.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center gap-4">
            {{-- Modul Filter --}}
            <div class="relative w-full sm:w-64 group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-emerald-600 to-teal-400 rounded-2xl blur opacity-20 group-focus-within:opacity-40 transition duration-1000"></div>
                <div class="relative bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center px-4">
                    <select id="modul-filter" 
                        class="w-full py-3.5 bg-transparent border-none focus:ring-0 font-bold text-slate-700 text-sm">
                        <option value="">Semua Modul</option>
                        @foreach($moduls as $m)
                            <option value="{{ $m->id }}" {{ request('modul_id') == $m->id ? 'selected' : '' }}>{{ $m->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Compact AJAX Search --}}
            <div class="relative w-full sm:w-80 group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-emerald-600 to-teal-400 rounded-2xl blur opacity-20 group-focus-within:opacity-40 transition duration-1000"></div>
                <div class="relative bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center px-4">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" id="ajax-search" 
                        placeholder="Cari siswa..." 
                        class="w-full px-4 py-3.5 bg-transparent border-none focus:ring-0 font-bold text-slate-700 text-sm placeholder:text-slate-300">
                    <div id="search-loader" class="hidden">
                        <div class="w-4 h-4 border-2 border-emerald-500/20 border-t-emerald-500 rounded-full animate-spin"></div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 bg-white p-1.5 rounded-2xl border border-slate-100 shadow-sm">
                <div class="px-5 py-2.5 bg-emerald-50 rounded-xl border border-emerald-100 text-center">
                    <span class="block text-[8px] font-black text-emerald-400 uppercase tracking-widest leading-none mb-1">Total</span>
                    <span class="text-lg font-black text-emerald-600 leading-none" id="total-records">{{ $nilais->total() }}</span>
                </div>
                {{-- Excel --}}
                <a href="{{ route('admin.nilai.export', request()->query()) }}" id="btn-excel" class="h-12 w-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center hover:bg-emerald-700 transition-all shadow-lg active:scale-95 transform" title="Export Excel">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </a>
                {{-- PDF --}}
                <a href="{{ route('admin.nilai.pdf', request()->query()) }}" id="btn-pdf" class="h-12 w-12 bg-rose-600 text-white rounded-xl flex items-center justify-center hover:bg-rose-700 transition-all shadow-lg active:scale-95 transform" title="Export PDF">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 9h1.5m1.5 0H13m-4 4h1.5m1.5 0H13m-4 4h1.5m1.5 0H13" /></svg>
                </a>
                <button onclick="window.print()" class="h-12 w-12 bg-slate-900 text-white rounded-xl flex items-center justify-center hover:bg-emerald-600 transition-all shadow-lg active:scale-95 transform" title="Print View">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                </button>
            </div>
        </div>
    </div>

    <div id="table-container" class="bg-white rounded-[3rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden min-h-[400px]">
        @include('admin.nilai.table')
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let searchTimer;
            const searchInput = $('#ajax-search');
            const modulFilter = $('#modul-filter');
            const loader = $('#search-loader');
            const container = $('#table-container');
            const btnExcel = $('#btn-excel');
            const btnPdf = $('#btn-pdf');

            function updateExportLinks() {
                const query = searchInput.val();
                const modulId = modulFilter.val();
                
                let baseUrlExcel = "{{ route('admin.nilai.export') }}";
                let baseUrlPdf = "{{ route('admin.nilai.pdf') }}";
                
                let params = new URLSearchParams();
                if (query) params.append('search', query);
                if (modulId) params.append('modul_id', modulId);
                
                let queryString = params.toString();
                btnExcel.attr('href', baseUrlExcel + (queryString ? '?' + queryString : ''));
                btnPdf.attr('href', baseUrlPdf + (queryString ? '?' + queryString : ''));
            }

            function performSearch() {
                const query = searchInput.val();
                const modulId = modulFilter.val();
                loader.removeClass('hidden');

                updateExportLinks();

                $.ajax({
                    url: "{{ route('admin.nilai.index') }}",
                    type: "GET",
                    data: { 
                        'search': query,
                        'modul_id': modulId
                    },
                    success: function(data) {
                        container.html(data);
                        loader.addClass('hidden');
                        
                        // Update total count if returned in header or some other way, 
                        // for now let's just use the count from the returned table if available
                        const newTotal = $(data).find('#total-count-bridge').data('total');
                        if(newTotal !== undefined) $('#total-records').text(newTotal);
                    },
                    error: function() {
                        loader.addClass('hidden');
                    }
                });
            }

            searchInput.on('keyup', function() {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(performSearch, 500);
            });

            modulFilter.on('change', function() {
                performSearch();
            });

            $(document).on('click', '.ajax-pagination a', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                loader.removeClass('hidden');

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(data) {
                        container.html(data);
                        loader.addClass('hidden');
                        window.scrollTo({ top: container.offset().top - 100, behavior: 'smooth' });
                    }
                });
            });
        });

        function confirmDelete(btn) {
            Swal.fire({
                title: 'Hapus Data Nilai?',
                text: "Data hasil ujian ini akan dihapus secara permanen dari sistem.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'YA, HAPUS',
                cancelButtonText: 'BATAL',
                background: '#ffffff',
                customClass: {
                    popup: 'rounded-[2.5rem] p-10 shadow-2xl',
                    confirmButton: 'rounded-2xl px-8 py-4 font-black uppercase tracking-widest',
                    cancelButton: 'rounded-2xl px-8 py-4 font-black uppercase tracking-widest'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            })
        }
    </script>
    @endpush

    <style>
        @media print {
            .sidebar-container, button, form, .mb-10 .flex { display: none !important; }
            .main-content { margin: 0 !important; padding: 0 !important; }
            .bg-white { box-shadow: none !important; border: 1px solid #e2e8f0 !important; }
            tr { page-break-inside: avoid; }
        }
    </style>
</x-admin-layout>
