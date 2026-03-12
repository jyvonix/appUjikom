<x-siswa-layout :hideNav="true">
    {{-- Super Pro Refined Styles --}}
    <style>
        body { 
            background-color: #fcfcfd !important; 
            -webkit-tap-highlight-color: transparent;
            letter-spacing: -0.01em;
        }
        
        .exam-shell { display: flex; flex-direction: column; min-height: 100vh; }

        .workspace-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(241, 245, 249, 1);
        }

        .question-card {
            background: #ffffff;
            border-radius: 1.5rem;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.02);
        }

        .option-item {
            transition: all 0.2s ease;
            border: 1px solid #f1f5f9;
            border-radius: 1rem;
        }

        .option-selected { border-color: #2563eb !important; background-color: #eff6ff !important; }

        .option-badge {
            width: 2.25rem; height: 2.25rem; border-radius: 0.75rem;
            background-color: #f8fafc; color: #64748b;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.8rem; border: 1px solid #f1f5f9;
        }

        .option-selected .option-badge { background-color: #2563eb !important; color: #ffffff !important; }

        .progress-track { height: 4px; background: #f1f5f9; border-radius: 100px; overflow: hidden; }
        .progress-thumb { background: #2563eb; transition: width 0.6s ease; }

        /* Navigator Specific Styles */
        .nav-dot-pro {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1.5px solid #f1f5f9;
            background: #ffffff;
            position: relative;
        }
        .nav-dot-pro:hover { border-color: #2563eb; color: #2563eb; transform: translateY(-2px); }
        .nav-dot-current { border-color: #2563eb !important; color: #2563eb !important; background: #eff6ff !important; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
        .nav-dot-answered { background: #2563eb !important; border-color: #2563eb !important; color: #ffffff !important; }
        
        .status-indicator { width: 8px; height: 8px; border-radius: 2px; }

        @keyframes slideInUp {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }
        .animate-drawer { animation: slideInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
    </style>

    <div class="exam-shell">
        <header class="fixed top-0 left-0 right-0 z-50 workspace-header">
            <div class="max-w-5xl mx-auto px-6 h-14 md:h-16 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="text-sm font-bold text-slate-900 tracking-tight uppercase">SmartExam</span>
                </div>

                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 px-3 py-1.5 bg-slate-50 rounded-lg border border-slate-100">
                        <span id="timer-display" class="font-bold text-slate-700 tabular-nums text-xs md:text-sm">00:00:00</span>
                    </div>
                    <button type="button" onclick="toggleNav()" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 active:scale-95 group">
                        <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                    </button>
                </div>
            </div>
        </header>

        <main class="flex-1 max-w-3xl mx-auto w-full pt-20 md:pt-28 pb-20 px-6">
            <form action="{{ route('siswa.soal.simpan') }}" method="POST" id="exam-form">
                @csrf
                @foreach($soals as $index => $soal)
                    <div id="question-wrapper-{{ $index }}" class="question-wrapper {{ $index === 0 ? '' : 'hidden' }}">
                        <div class="mb-8">
                            <div class="flex items-center justify-between text-[9px] font-bold uppercase tracking-widest mb-3">
                                <span class="text-blue-600">Pertanyaan {{ $index + 1 }} / {{ $soals->count() }}</span>
                                <span class="text-slate-400" id="global-progress-text">{{ round((($index + 1) / $soals->count()) * 100) }}%</span>
                            </div>
                            <div class="progress-track"><div class="progress-thumb h-full" style="width: {{ (($index + 1) / $soals->count()) * 100 }}%"></div></div>
                        </div>

                        <div class="question-card p-6 md:p-10 mb-8">
                            <h2 class="text-lg md:text-xl font-semibold text-slate-800 leading-relaxed mb-8">{{ $soal->pertanyaan }}</h2>
                            @if($soal->gambar)<div class="mb-8 rounded-xl overflow-hidden border border-slate-100 p-1 bg-slate-50"><img src="{{ asset('storage/' . $soal->gambar) }}" class="w-full h-auto rounded-lg"></div>@endif
                            <div class="grid grid-cols-1 gap-3">
                                @foreach(['A', 'B', 'C', 'D', 'E'] as $opsi)
                                    @php $opsiKey = 'opsi_' . strtolower($opsi); @endphp
                                    @if($soal->$opsiKey)
                                    <label class="option-item flex items-center p-4 cursor-pointer group">
                                        <input type="radio" name="jawaban_{{ $soal->id }}" value="{{ $opsi }}" onchange="handleSelection(this, {{ $index }})" class="hidden peer" required>
                                        <div class="option-badge group-hover:bg-blue-50 group-hover:text-blue-600">{{ $opsi }}</div>
                                        <span class="ml-4 text-sm md:text-[15px] font-medium text-slate-600 group-hover:text-slate-900 flex-1">{{ $soal->$opsiKey }}</span>
                                        <div class="ml-3 opacity-0 scale-50 transition-all peer-checked:opacity-100 peer-checked:scale-100 text-blue-600"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg></div>
                                    </label>
                                    @endif
                                @endforeach
                            </div>
                            <div class="mt-12 flex items-center justify-between gap-4 pt-8 border-t border-slate-50">
                                <button type="button" onclick="navigateQuestion('prev')" class="flex-1 sm:flex-none h-11 px-6 bg-slate-50 text-slate-500 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-slate-100 flex items-center justify-center gap-2">Sebelumnya</button>
                                @if($index < $soals->count() - 1)
                                    <button type="button" onclick="navigateQuestion('next')" class="flex-1 sm:flex-none h-11 px-10 bg-blue-600 text-white rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-blue-700 shadow-lg shadow-blue-100">Lanjut</button>
                                @else
                                    <button type="button" onclick="confirmFinish()" class="flex-1 sm:flex-none h-11 px-10 bg-emerald-600 text-white rounded-xl font-bold text-[10px] uppercase tracking-widest shadow-lg shadow-emerald-100">Selesai</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </form>
        </main>
    </div>

    {{-- The Masterpiece Navigator --}}
    <div id="nav-modal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-md transition-opacity" onclick="toggleNav()"></div>
        <div class="absolute inset-x-0 bottom-0 sm:inset-0 sm:flex sm:items-center sm:justify-center p-0 sm:p-6 pointer-events-none">
            <div class="relative w-full max-w-lg bg-white rounded-t-[3rem] sm:rounded-[2.5rem] shadow-[0_32px_64px_-12px_rgba(0,0,0,0.2)] overflow-hidden pointer-events-auto flex flex-col max-h-[90vh] sm:max-h-[80vh] border border-slate-100 animate-drawer sm:animate-in sm:zoom-in">
                
                {{-- Header Navigator --}}
                <div class="px-8 py-8 border-b border-slate-50 flex items-center justify-between shrink-0 bg-slate-50/30">
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-900 tracking-tight leading-none mb-2">NAVIGASI UJIAN</h3>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-1.5">
                                <span id="answered-count" class="text-blue-600 font-bold text-sm">0</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Terjawab</span>
                            </div>
                            <div class="w-1 h-1 bg-slate-200 rounded-full"></div>
                            <div class="flex items-center gap-1.5">
                                <span id="unanswered-count" class="text-slate-400 font-bold text-sm">{{ $soals->count() }}</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kosong</span>
                            </div>
                        </div>
                    </div>
                    <button onclick="toggleNav()" class="w-12 h-12 bg-white text-slate-400 rounded-2xl flex items-center justify-center hover:text-rose-500 transition-all border border-slate-100 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                
                {{-- Grid Navigator --}}
                <div class="flex-1 overflow-y-auto p-8 no-scrollbar">
                    <div class="grid grid-cols-5 md:grid-cols-6 gap-3.5">
                        @foreach($soals as $index => $soal)
                            <button type="button" 
                                id="nav-dot-{{ $index }}"
                                onclick="jumpToQuestion({{ $index }})"
                                class="nav-dot-pro aspect-square rounded-2xl flex flex-col items-center justify-center group">
                                <span class="text-xs font-extrabold transition-colors">{{ $index + 1 }}</span>
                                <div class="w-1 h-1 rounded-full bg-blue-600 mt-1 opacity-0 group-[.nav-dot-current]:opacity-100"></div>
                            </button>
                        @endforeach
                    </div>

                    {{-- Legend --}}
                    <div class="mt-10 flex items-center justify-center gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="status-indicator bg-blue-600"></div>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Selesai</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="status-indicator bg-blue-100 border border-blue-600"></div>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Aktif</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="status-indicator bg-white border border-slate-200"></div>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Kosong</span>
                        </div>
                    </div>
                </div>

                {{-- Footer Modal --}}
                <div class="p-8 bg-white border-t border-slate-50 shrink-0">
                    <button type="button" onclick="confirmFinish()" class="w-full py-5 bg-slate-900 text-white rounded-3xl font-bold text-[11px] uppercase tracking-[0.2em] shadow-xl hover:bg-blue-600 active:scale-95 transition-all transform group">
                        SUBMIT FINAL ASSESSMENT
                        <svg class="inline-block w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let currentIdx = 0; const totalSoals = {{ $soals->count() }}; let timeLeft = {{ $duration }} * 60;
        const examForm = document.getElementById('exam-form');

        function handleSelection(input, idx) {
            const wrapper = input.closest('.grid');
            wrapper.querySelectorAll('.option-item').forEach(el => el.classList.remove('option-selected'));
            input.closest('.option-item').classList.add('option-selected');
            
            const dot = document.getElementById(`nav-dot-${idx}`);
            dot.classList.add('nav-dot-answered');
            updateSummaryCounts();
        }

        function navigateQuestion(dir) {
            const nextIdx = dir === 'next' ? currentIdx + 1 : currentIdx - 1;
            if (nextIdx >= 0 && nextIdx < totalSoals) jumpToQuestion(nextIdx);
        }

        function jumpToQuestion(idx) {
            document.querySelectorAll('.question-wrapper').forEach(w => w.classList.add('hidden'));
            document.getElementById(`question-wrapper-${idx}`).classList.remove('hidden');
            
            document.querySelectorAll('.nav-dot-pro').forEach(d => d.classList.remove('nav-dot-current'));
            document.getElementById(`nav-dot-${idx}`).classList.add('nav-dot-current');
            
            currentIdx = idx;
            if(!document.getElementById('nav-modal').classList.contains('hidden')) toggleNav();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function updateSummaryCounts() {
            const answered = document.querySelectorAll('input[type="radio"]:checked').length;
            document.getElementById('answered-count').innerText = answered;
            document.getElementById('unanswered-count').innerText = totalSoals - answered;
        }

        function startTimer() {
            const display = document.getElementById('timer-display');
            const timer = setInterval(() => {
                if (timeLeft <= 0) { clearInterval(timer); examForm.submit(); return; }
                timeLeft--;
                const h = Math.floor(timeLeft / 3600), m = Math.floor((timeLeft % 3600) / 60), s = timeLeft % 60;
                display.innerText = `${h.toString().padStart(2,'0')}:${m.toString().padStart(2,'0')}:${s.toString().padStart(2,'0')}`;
                if (timeLeft < 300) display.classList.add('text-rose-600');
            }, 1000);
        }

        function confirmFinish() {
            const answered = document.querySelectorAll('input[type="radio"]:checked').length;
            Swal.fire({
                title: 'Konfirmasi Akhir',
                text: answered < totalSoals ? `Masih ada ${totalSoals - answered} soal kosong. Kirim sekarang?` : 'Kirim jawaban Anda sekarang?',
                icon: 'question', showCancelButton: true, confirmButtonText: 'YA, KIRIM', cancelButtonText: 'BATAL', confirmButtonColor: '#2563eb',
                customClass: { popup: 'rounded-[2rem]', confirmButton: 'rounded-xl font-bold text-xs px-8 py-4', cancelButton: 'rounded-xl font-bold text-xs px-8 py-4' }
            }).then((r) => { if (r.isConfirmed) examForm.submit(); });
        }

        function toggleNav() {
            const modal = document.getElementById('nav-modal');
            modal.classList.toggle('hidden');
            document.body.style.overflow = modal.classList.contains('hidden') ? 'auto' : 'hidden';
            if(!modal.classList.contains('hidden')) {
                document.getElementById(`nav-dot-${currentIdx}`).classList.add('nav-dot-current');
            }
        }

        document.addEventListener('DOMContentLoaded', () => { startTimer(); updateSummaryCounts(); });
    </script>
    @endpush
</x-siswa-layout>