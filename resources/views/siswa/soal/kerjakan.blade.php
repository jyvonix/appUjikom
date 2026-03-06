<x-siswa-layout :hideNav="true">
    {{-- Force Hide Topbar --}}
    <style>
        nav.header-blur { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .perfect-circle { aspect-ratio: 1/1; }
    </style>

    {{-- Header Ujian - Ultra Minimalist --}}
    <div class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 h-16 flex items-center shadow-sm">
        <div class="max-w-5xl mx-auto w-full px-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-black text-slate-900 leading-none uppercase tracking-tight">Smart Exam</span>
                    <span class="text-[9px] font-bold text-indigo-500 uppercase tracking-widest mt-1">Ujian Aktif</span>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100" id="question-counter">Soal 1 / {{ $soals->count() }}</span>
                <button type="button" onclick="toggleNav()" class="w-10 h-10 flex items-center justify-center bg-slate-900 text-white rounded-xl hover:bg-indigo-600 transition-all shadow-xl active:scale-90 transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Progress Line --}}
    <div class="fixed top-16 left-0 right-0 h-[2px] bg-slate-50 z-50">
        <div id="progress-bar" class="h-full bg-indigo-600 transition-all duration-700" style="width: 0%"></div>
    </div>

    <div class="max-w-3xl mx-auto pt-28 pb-32 px-4 md:px-0">
        <form action="{{ route('siswa.soal.simpan') }}" method="POST" id="exam-form">
            @csrf
            
            <div class="relative min-h-[450px]">
                @foreach($soals as $index => $soal)
                    <div id="question-wrapper-{{ $index }}" class="question-wrapper {{ $index === 0 ? '' : 'hidden' }} animate-in fade-in duration-300">
                        
                        {{-- Question Header --}}
                        <div class="mb-8 flex items-center gap-4">
                            <span class="text-[11px] font-black text-slate-400 uppercase tracking-[0.4em]">Pertanyaan</span>
                            <div class="h-px flex-1 bg-slate-100"></div>
                            <span class="text-2xl font-black text-slate-200">#{{ $index + 1 }}</span>
                        </div>

                        {{-- Question Content --}}
                        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-[0_20px_60px_-20px_rgba(0,0,0,0.05)] overflow-hidden mb-10">
                            <div class="p-8 md:p-14">
                                <div class="space-y-10">
                                    <h3 class="text-xl md:text-2xl font-bold text-slate-800 leading-[1.6] tracking-tight">
                                        {{ $soal->pertanyaan }}
                                    </h3>

                                    @if($soal->gambar)
                                        <div class="rounded-3xl overflow-hidden border-2 border-slate-50 shadow-inner bg-slate-50 flex justify-center p-2">
                                            <img src="{{ asset('storage/' . $soal->gambar) }}" class="max-w-full h-auto rounded-2xl shadow-sm">
                                        </div>
                                    @endif

                                    {{-- Options - HIGH FEEDBACK --}}
                                    <div class="grid grid-cols-1 gap-4 pt-4">
                                        @foreach(['A', 'B', 'C', 'D', 'E'] as $opsi)
                                            @php $opsiKey = 'opsi_' . strtolower($opsi); @endphp
                                            @if($soal->$opsiKey)
                                            <label class="group relative flex items-center p-6 border-2 border-slate-100 rounded-3xl cursor-pointer transition-all duration-300 active:scale-[0.98] transform bg-white overflow-hidden">
                                                <input type="radio" name="jawaban_{{ $soal->id }}" value="{{ $opsi }}" 
                                                    onchange="markAnswered({{ $index }})" class="hidden peer" required>
                                                
                                                {{-- Background fill on check --}}
                                                <div class="absolute inset-0 bg-indigo-600 opacity-0 peer-checked:opacity-100 transition-all duration-300"></div>

                                                {{-- Perfect Circle Icon --}}
                                                <div class="relative z-10 w-12 h-12 flex-shrink-0 perfect-circle border-2 border-slate-100 bg-slate-50 rounded-full flex items-center justify-center font-black text-slate-400 transition-all duration-300 peer-checked:border-white/30 peer-checked:bg-white/20 peer-checked:text-white group-hover:border-indigo-200">
                                                    <span class="peer-checked:hidden">{{ $opsi }}</span>
                                                    <svg class="hidden peer-checked:block w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                                
                                                <span class="relative z-10 ml-6 text-base md:text-lg font-bold text-slate-600 peer-checked:text-white transition-colors duration-300 flex-1 leading-snug">
                                                    {{ $soal->$opsiKey }}
                                                </span>
                                            </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Nav Buttons - Pill Style --}}
                        <div class="flex items-center justify-between gap-4 mt-12">
                            @if($index > 0)
                                <button type="button" onclick="showQuestion({{ $index - 1 }})" class="h-16 flex-1 md:flex-none md:px-12 bg-white border-2 border-slate-100 text-slate-500 rounded-full font-black text-xs uppercase tracking-widest shadow-sm hover:bg-slate-50 transition-all flex items-center justify-center gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
                                    Kembali
                                </button>
                            @else
                                <div class="flex-1 md:w-40"></div>
                            @endif

                            @if($index < $soals->count() - 1)
                                <button type="button" onclick="showQuestion({{ $index + 1 }})" class="h-16 flex-1 md:flex-none md:px-16 bg-indigo-600 text-white rounded-full font-black text-xs uppercase tracking-widest shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all flex items-center justify-center gap-3 active:scale-95 transform">
                                    Lanjut
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                                </button>
                            @else
                                <button type="submit" onclick="return confirm('Selesaikan ujian sekarang?')" class="h-16 flex-1 md:flex-none md:px-16 bg-emerald-600 text-white rounded-full font-black text-xs uppercase tracking-widest shadow-xl shadow-emerald-100 hover:bg-emerald-700 transition-all flex items-center justify-center gap-3 active:scale-95 transform">
                                    Selesai
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>

    {{-- MODAL NAVIGASI - RE-DESIGNED FOR SCROLLING & STYLE --}}
    <div id="nav-modal" class="fixed inset-0 z-[100] hidden">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-md transition-opacity" onclick="toggleNav()"></div>
        
        {{-- Modal Content - Center Scrollable --}}
        <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
            <div class="relative w-full max-w-sm bg-white rounded-[3rem] shadow-2xl overflow-hidden pointer-events-auto flex flex-col max-h-[90vh] animate-in zoom-in duration-300 border border-white">
                <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50 flex-shrink-0">
                    <div class="flex flex-col">
                        <h3 class="text-xl font-black text-slate-900 tracking-tight uppercase leading-none mb-1">Navigasi</h3>
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Progress Pengerjaan</span>
                    </div>
                    <button onclick="toggleNav()" class="w-10 h-10 bg-white text-slate-400 rounded-xl flex items-center justify-center hover:text-rose-600 transition-all shadow-sm border border-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                {{-- Scrollable Grid Container --}}
                <div class="flex-1 overflow-y-auto p-8 no-scrollbar">
                    <div class="grid grid-cols-5 gap-3">
                        @foreach($soals as $index => $soal)
                            <button type="button" 
                                id="nav-btn-{{ $index }}"
                                onclick="jumpToQuestion({{ $index }})"
                                class="nav-dot perfect-circle w-full rounded-2xl border-2 border-slate-100 bg-white flex items-center justify-center font-black text-sm transition-all hover:border-indigo-600 hover:text-indigo-600 hover:scale-105 transform active:scale-90">
                                {{ $index + 1 }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="p-8 bg-slate-50 border-t border-slate-100 flex-shrink-0">
                    <div class="flex items-center justify-center gap-6 mb-6">
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 rounded-full bg-indigo-600 shadow-md shadow-indigo-100"></div>
                            <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Terjawab</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 rounded-full bg-white border-2 border-slate-200"></div>
                            <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Kosong</span>
                        </div>
                    </div>
                    <button type="button" onclick="document.getElementById('exam-form').submit()" class="w-full py-5 bg-slate-900 text-white rounded-[1.5rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-black transition-all shadow-xl shadow-slate-200 active:scale-95 transform">
                        Kirim Semua Jawaban
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let currentQuestionIndex = 0;
        const totalSoals = {{ $soals->count() }};

        function showQuestion(index) {
            document.querySelectorAll('.question-wrapper').forEach(wrapper => {
                wrapper.classList.add('hidden');
            });
            
            const target = document.getElementById(`question-wrapper-${index}`);
            if (target) {
                target.classList.remove('hidden');
            }
            
            document.getElementById('question-counter').innerText = `Soal ${index + 1} / ${totalSoals}`;
            const progress = ((index + 1) / totalSoals) * 100;
            document.getElementById('progress-bar').style.width = `${progress}%`;
            
            const pText = document.getElementById('progress-text');
            if(pText) pText.innerText = `${Math.round(progress)}%`;

            document.querySelectorAll('.nav-dot').forEach((btn, i) => {
                btn.classList.remove('ring-4', 'ring-indigo-100', 'border-indigo-600');
                if (i === index) {
                    btn.classList.add('border-indigo-600');
                    if (!btn.classList.contains('bg-indigo-600')) {
                        btn.classList.add('ring-4', 'ring-indigo-100');
                    }
                }
            });

            currentQuestionIndex = index;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function jumpToQuestion(index) {
            showQuestion(index);
            toggleNav();
        }

        function toggleNav() {
            const modal = document.getElementById('nav-modal');
            modal.classList.toggle('hidden');
            document.body.style.overflow = modal.classList.contains('hidden') ? 'auto' : 'hidden';
        }

        function markAnswered(index) {
            const btn = document.getElementById(`nav-btn-${index}`);
            btn.classList.add('bg-indigo-600', 'text-white', 'border-indigo-600', 'shadow-lg', 'shadow-indigo-100');
            btn.classList.remove('border-slate-100', 'bg-white');
        }

        document.addEventListener('DOMContentLoaded', () => {
            showQuestion(0);
        });
    </script>
    @endpush
</x-siswa-layout>
