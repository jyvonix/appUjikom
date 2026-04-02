<x-guru-layout>
    <div class="mb-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
        <div>
            <h2 class="text-4xl font-black text-slate-800 tracking-tight mb-2">Analisis <span class="text-indigo-600">Nilai Siswa</span></h2>
            <p class="text-slate-500 font-bold">Monitor performa dan hasil ujian siswa secara real-time.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center gap-4">
            {{-- Compact AJAX Search --}}
            <div class="relative w-full sm:w-80 group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-600 to-purple-400 rounded-2xl blur opacity-20 group-focus-within:opacity-40 transition duration-1000"></div>
                <div class="relative bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center px-4">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" id="ajax-search" 
                        placeholder="Cari siswa..." 
                        class="w-full px-4 py-3.5 bg-transparent border-none focus:ring-0 font-bold text-slate-700 text-sm placeholder:text-slate-300">
                    <div id="search-loader" class="hidden">
                        <div class="w-4 h-4 border-2 border-indigo-500/20 border-t-indigo-500 rounded-full animate-spin"></div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 bg-white p-1.5 rounded-2xl border border-slate-100 shadow-sm">
                <div class="px-5 py-2.5 bg-indigo-50 rounded-xl border border-indigo-100 text-center">
                    <span class="block text-[8px] font-black text-indigo-400 uppercase tracking-widest leading-none mb-1">Total</span>
                    <span class="text-lg font-black text-indigo-600 leading-none" id="total-records">{{ $nilais->total() }}</span>
                </div>
                <a href="{{ route('guru.nilai.export') }}" title="Ekspor Excel" class="h-12 w-12 bg-white border border-slate-200 text-emerald-600 rounded-xl flex items-center justify-center hover:bg-emerald-50 transition-all shadow-sm active:scale-95 transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </a>
                <a href="{{ route('guru.nilai.pdf') }}" title="Cetak PDF" class="h-12 w-12 bg-indigo-600 text-white rounded-xl flex items-center justify-center hover:bg-indigo-700 transition-all shadow-lg active:scale-95 transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                </a>
            </div>
        </div>
    </div>

    <div id="table-container" class="bg-white rounded-[3rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden min-h-[400px]">
        @include('guru.nilai.table')
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let searchTimer;
            const searchInput = $('#ajax-search');
            const loader = $('#search-loader');
            const container = $('#table-container');

            function performSearch() {
                const query = searchInput.val();
                loader.removeClass('hidden');

                $.ajax({
                    url: "{{ route('guru.nilai.index') }}",
                    type: "GET",
                    data: { 'search': query },
                    success: function(data) {
                        container.html(data);
                        loader.addClass('hidden');
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
</x-guru-layout>
