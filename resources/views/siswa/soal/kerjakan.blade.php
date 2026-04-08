<x-siswa-layout :hideNav="true">
    <div class="fixed inset-0 overflow-hidden font-sans bg-white dark:bg-[#020617] text-slate-900 dark:text-slate-100 transition-colors duration-500" 
         x-data="examEngine()" x-init="init()">
        
        {{-- High-End Ambient Background --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden opacity-40 dark:opacity-100">
            <div class="absolute top-[-10%] right-[-10%] w-[70vw] h-[70vw] bg-indigo-500/5 dark:bg-indigo-600/10 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[60vw] h-[60vw] bg-purple-500/5 dark:bg-purple-600/10 rounded-full blur-[100px] animate-pulse"></div>
        </div>

        <div class="relative z-10 h-full flex flex-col">
            {{-- Professional Ultra-Slim Header --}}
            <header class="h-14 md:h-18 flex items-center justify-between px-4 md:px-10 bg-white/80 dark:bg-slate-950/40 backdrop-blur-3xl border-b border-slate-100 dark:border-white/5 transition-all duration-500">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-indigo-600 rounded-lg md:rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-500/20">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div class="max-w-[120px] md:max-w-none">
                        <h1 class="text-[9px] md:text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500 leading-none truncate">{{ $modul->nama }}</h1>
                        <p class="text-[10px] md:text-sm font-bold text-slate-900 dark:text-white mt-0.5 tracking-tight">Active Exam</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 md:gap-8">
                    {{-- Timer with Dynamic Color --}}
                    <div class="flex flex-col items-end">
                        <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Chronometer</span>
                        <span class="text-sm md:text-xl font-black tabular-nums tracking-tighter" 
                              :class="timeLeft < 300 ? 'text-rose-500 animate-pulse' : 'text-slate-900 dark:text-white'"
                              x-text="formatTime(timeLeft)">--:--</span>
                    </div>

                    <div class="w-px h-6 bg-slate-100 dark:bg-white/10 hidden sm:block"></div>

                    <button @click="toggleTheme()" type="button" class="w-9 h-9 md:w-11 md:h-11 flex items-center justify-center rounded-xl bg-slate-50 dark:bg-white/5 text-slate-500 dark:text-slate-400 border border-slate-100 dark:border-white/5 transition-all active:scale-90">
                        <template x-if="theme === 'dark'"><svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg></template>
                        <template x-if="theme === 'light'"><svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg></template>
                    </button>
                </div>
            </header>

            {{-- Progress Line --}}
            <div class="h-0.5 w-full bg-slate-50 dark:bg-white/5 overflow-hidden">
                <div class="h-full bg-indigo-600 transition-all duration-700 ease-out shadow-[0_0_10px_rgba(79,70,229,0.5)]"
                     :style="`width: ${(answeredCount/{{ $soals->count() }})*100}%` "></div>
            </div>

            {{-- Main Question Workspace --}}
            <main class="flex-1 overflow-y-auto custom-scrollbar relative px-4 py-8 md:py-16 prevent-select" 
                  @contextmenu.prevent @copy.prevent @paste.prevent @mousedown.prevent>
                
                {{-- Anti-Screenshot/OCR Overlay --}}
                <div class="fixed inset-0 pointer-events-none z-[50] opacity-[0.03] select-none">
                    <div class="absolute inset-0 bg-[radial-gradient(#000_1px,transparent_1px)] [background-size:16px_16px]"></div>
                </div>

                <form id="ujian-form" action="{{ route('siswa.soal.simpan') }}" method="POST" class="max-w-2xl mx-auto pb-40 relative z-[60]">
                    @csrf
                    <input type="hidden" name="modul_id" value="{{ $modul->id }}">

                    <div class="relative">
                        @foreach($soals as $index => $soal)
                            <div class="space-y-8 md:space-y-12 animate-slide-up" x-show="currentIndex === {{ $index }}" x-cloak>
                                
                                {{-- Question Status Bar --}}
                                <div class="flex items-center justify-between">
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-3xl md:text-5xl font-black text-indigo-600 dark:text-indigo-400 tracking-tighter">{{ $index + 1 }}</span>
                                        <span class="text-[10px] md:text-xs font-bold text-slate-400 uppercase tracking-widest">/ {{ $soals->count() }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="px-2.5 py-1 rounded-lg bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5">
                                            <span class="text-[8px] md:text-[9px] font-black text-slate-400 uppercase tracking-widest">Secure Session</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Question & Media --}}
                                <div class="space-y-8 relative">
                                    <div class="absolute inset-0 bg-transparent z-[70] cursor-default" title="Secure Content"></div>
                                    
                                    <h2 class="text-lg md:text-2xl font-bold leading-relaxed tracking-tight text-slate-800 dark:text-slate-100 relative">
                                        <span class="relative">
                                            {{ $soal->pertanyaan }}
                                            <span class="absolute inset-0 blur-[100px] bg-white dark:bg-slate-950 opacity-10 pointer-events-none"></span>
                                        </span>
                                    </h2>

                                    @if($soal->gambar)
                                        <div class="rounded-2xl overflow-hidden border border-slate-100 dark:border-white/10 shadow-sm transition-transform max-w-lg mx-auto md:mx-0 relative">
                                            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500/5 to-transparent pointer-events-none"></div>
                                            <img src="{{ asset('storage/' . $soal->gambar) }}" class="w-full h-auto pointer-events-none" alt="Resource">
                                        </div>
                                    @endif

                                    {{-- Elegant Options Grid --}}
                                    <div class="grid grid-cols-1 gap-3 md:gap-4 relative z-[80]">
                                        @foreach(['a', 'b', 'c', 'd', 'e'] as $opt)
                                            @if($soal->{'opsi_'.$opt})
                                                <label class="group relative flex items-center p-4 md:p-6 rounded-2xl border transition-all duration-300 cursor-pointer overflow-hidden bg-white dark:bg-slate-900/40 border-slate-200 dark:border-white/5 hover:border-indigo-300 dark:hover:border-indigo-500/30 active:scale-[0.98]"
                                                       :class="answers['{{ $soal->id }}'] === '{{ strtoupper($opt) }}' ? 'border-indigo-500 ring-4 ring-indigo-500/5 dark:ring-indigo-500/10 bg-indigo-50/20 dark:bg-indigo-500/5' : ''">
                                                    
                                                    <input type="radio" name="jawaban_{{ $soal->id }}" value="{{ strtoupper($opt) }}" 
                                                           class="hidden peer"
                                                           x-model="answers['{{ $soal->id }}']"
                                                           @change="markAnswered({{ $index }}, '{{ $soal->id }}')">
                                                    
                                                    <div class="relative z-10 flex items-center gap-4 md:gap-6 w-full">
                                                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl flex items-center justify-center font-black text-xs md:text-lg border transition-all duration-300"
                                                             :class="answers['{{ $soal->id }}'] === '{{ strtoupper($opt) }}' 
                                                                ? 'bg-indigo-600 text-white border-indigo-500 scale-110 shadow-lg shadow-indigo-500/40' 
                                                                : 'bg-slate-50 dark:bg-white/5 border-slate-100 dark:border-white/10 text-slate-400 dark:text-slate-500'">
                                                            {{ strtoupper($opt) }}
                                                        </div>
                                                        <span class="text-sm md:text-lg font-semibold transition-colors tracking-tight flex-1"
                                                              :class="answers['{{ $soal->id }}'] === '{{ strtoupper($opt) }}' ? 'text-indigo-900 dark:text-white' : 'text-slate-600 dark:text-slate-300'">
                                                            {{ $soal->{'opsi_'.$opt} }}
                                                        </span>
                                                        <div class="shrink-0 opacity-0 transition-all transform scale-50"
                                                             :class="answers['{{ $soal->id }}'] === '{{ strtoupper($opt) }}' ? 'opacity-100 scale-100' : ''">
                                                            <div class="w-6 h-6 bg-indigo-600 rounded-full flex items-center justify-center text-white shadow-md">
                                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>
            </main>

            {{-- Smart Action Dock --}}
            <div class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[100] w-full max-w-md px-4">
                <div class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-2xl border border-slate-200 dark:border-white/10 rounded-[2rem] p-2 shadow-2xl flex items-center justify-between gap-2 transition-all duration-500">
                    <div class="flex items-center gap-1">
                        <button type="button" @click="prev()" :disabled="currentIndex === 0"
                                class="w-11 h-11 md:w-12 md:h-12 flex items-center justify-center rounded-2xl hover:bg-slate-100 dark:hover:bg-white/5 text-slate-500 dark:text-slate-300 disabled:opacity-20 transition-all active:scale-90">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button @click="showNav = true" type="button" class="px-4 h-11 md:h-12 flex items-center gap-2.5 rounded-2xl hover:bg-slate-100 dark:hover:bg-white/5 transition-all group border border-transparent hover:border-slate-200 dark:hover:border-white/10">
                            <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></div>
                            <span class="text-[10px] md:text-xs font-black text-slate-700 dark:text-slate-100 tracking-tighter uppercase" x-text="(currentIndex + 1) + ' / {{ $soals->count() }}'"></span>
                        </button>
                    </div>
                    <div class="flex items-center gap-2">
                        <template x-if="currentIndex < {{ $soals->count() - 1 }}">
                            <button type="button" @click="next()" 
                                    class="h-11 md:h-12 px-7 md:px-8 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-[1.2rem] font-black text-[10px] md:text-xs tracking-widest shadow-xl hover:translate-x-0.5 active:scale-95 transition-all uppercase">
                                NEXT
                            </button>
                        </template>
                        <template x-if="currentIndex === {{ $soals->count() - 1 }}">
                            <button type="button" @click="confirmFinish()" 
                                    class="h-11 md:h-12 px-7 md:px-8 bg-indigo-600 text-white rounded-[1.2rem] font-black text-[10px] md:text-xs tracking-widest shadow-xl shadow-indigo-500/20 hover:bg-indigo-500 active:scale-95 transition-all uppercase">
                                FINISH
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        {{-- Professional Bottom-Sheet Navigator --}}
        <div x-show="showNav" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-full"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-full"
             class="fixed inset-0 z-[200] flex items-end justify-center" x-cloak>
            
            <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-md" @click="showNav = false"></div>
            
            <div class="relative w-full max-w-xl bg-white dark:bg-slate-900 rounded-t-[2.5rem] shadow-2xl border-t border-slate-200 dark:border-white/10 p-6 md:p-10 overflow-hidden">
                {{-- Handle --}}
                <div class="w-12 h-1.5 bg-slate-200 dark:bg-slate-800 rounded-full mx-auto mb-6"></div>

                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="font-black text-xl dark:text-white tracking-tight">Question Grid</h3>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Jump to specific item</p>
                    </div>
                    <button @click="showNav = false" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 dark:bg-white/5 text-slate-400 hover:text-rose-500 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="grid grid-cols-5 sm:grid-cols-6 md:grid-cols-8 gap-3 max-h-[50vh] overflow-y-auto custom-scrollbar pb-10">
                    @foreach($soals as $index => $soal)
                        <button type="button" @click="currentIndex = {{ $index }}; showNav = false"
                                class="aspect-square rounded-xl md:rounded-2xl border flex items-center justify-center text-xs md:text-sm font-black transition-all transform active:scale-90"
                                :class="currentIndex === {{ $index }} 
                                    ? 'bg-indigo-600 border-indigo-500 text-white shadow-lg shadow-indigo-500/20 scale-105' 
                                    : (isAnswered({{ $index }}) 
                                        ? 'bg-indigo-50 dark:bg-indigo-500/10 border-indigo-200 dark:border-indigo-500/20 text-indigo-600 dark:text-indigo-400' 
                                        : 'bg-slate-50 dark:bg-white/5 border-slate-200 dark:border-white/5 text-slate-400 dark:text-slate-600')">
                            {{ $index + 1 }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        .prevent-select { -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-touch-callout: none; }
        .animate-slide-up { animation: slideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(79, 70, 229, 0.1); border-radius: 10px; }
        [x-cloak] { display: none !important; }
        .violation-flash { animation: flashRed 0.5s linear 2; }
        @keyframes flashRed { 0% { background: transparent; } 50% { background: rgba(225, 29, 72, 0.2); } 100% { background: transparent; } }
    </style>

    @push('scripts')
    <script>
        function examEngine() {
            return {
                currentIndex: 0,
                timeLeft: parseInt("{{ $duration }}") || 0,
                answeredList: new Array({{ $soals->count() }}).fill(false),
                answeredCount: 0,
                answers: {},
                theme: localStorage.getItem('color-theme') || 'light',
                tabSwitchCount: {{ $violationCount }},
                showNav: false,

                init() {
                    this.applyTheme();
                    this.startTimer();
                    this.preventTampering();
                    this.loadSavedProgress();
                    this.initAntiCheating();
                },

                applyTheme() {
                    const el = document.documentElement;
                    if (el) {
                        if (this.theme === 'dark') el.classList.add('dark');
                        else el.classList.remove('dark');
                    }
                },

                toggleTheme() {
                    this.theme = this.theme === 'dark' ? 'light' : 'dark';
                    localStorage.setItem('color-theme', this.theme);
                    this.applyTheme();
                },

                async logViolationOnServer() {
                    try {
                        const response = await fetch("{{ route('siswa.soal.violation') }}", {
                            method: "POST",
                            headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                            body: JSON.stringify({ modul_id: {{ $modul->id }} })
                        });
                        const data = await response.json();
                        this.tabSwitchCount = data.count;
                        this.handleViolationLevel();
                    } catch (e) { console.error("Logging failed", e); }
                },

                handleViolationLevel() {
                    document.body.classList.add('violation-flash');
                    setTimeout(() => document.body.classList.remove('violation-flash'), 1000);
                    if (this.tabSwitchCount >= 3) {
                        Swal.fire({
                            title: '<span class="text-rose-600">Security Interruption!</span>',
                            html: '<div class="text-sm font-medium text-slate-500 mt-2">Violation limit reached. Closing session.</div>',
                            icon: 'error',
                            confirmButtonText: 'Submit Assessment',
                            allowOutsideClick: false,
                            background: this.theme === 'dark' ? '#020617' : '#fff',
                            color: this.theme === 'dark' ? '#fff' : '#1e293b'
                        }).then(() => this.forceSubmit());
                    } else {
                        Swal.fire({
                            title: 'Security Alert!',
                            html: `<div class="text-sm font-medium text-slate-500 mt-2">Suspicious activity detected. Violation (${this.tabSwitchCount}/3) recorded.</div>`,
                            icon: 'warning',
                            confirmButtonText: 'Acknowledge',
                            background: this.theme === 'dark' ? '#020617' : '#fff'
                        });
                    }
                },

                initAntiCheating() {
                    document.addEventListener('visibilitychange', () => { if (document.hidden) this.logViolationOnServer(); });
                },

                startTimer() {
                    const timer = setInterval(() => {
                        if (this.timeLeft > 0) this.timeLeft--;
                        else { clearInterval(timer); this.forceSubmit(); }
                    }, 1000);
                },

                formatTime(s) {
                    const totalSeconds = Math.floor(Math.max(0, s));
                    const m = Math.floor(totalSeconds / 60);
                    const sec = totalSeconds % 60;
                    return `${m.toString().padStart(2, '0')}:${sec.toString().padStart(2, '0')}`;
                },

                markAnswered(idx, id) {
                    if (!this.answeredList[idx]) {
                        this.answeredList[idx] = true;
                        this.answeredCount = this.answeredList.filter(x => x).length;
                    }
                    this.saveProgress();
                },

                saveProgress() {
                    localStorage.setItem(`exam_progress_{{ Auth::id() }}_{{ $modul->id }}`, JSON.stringify({ answers: this.answers }));
                },

                loadSavedProgress() {
                    const saved = localStorage.getItem(`exam_progress_{{ Auth::id() }}_{{ $modul->id }}`);
                    if (saved) {
                        const data = JSON.parse(saved);
                        this.answers = data.answers;
                        @foreach($soals as $idx => $s)
                            if (this.answers["{{ $s->id }}"]) this.answeredList[{{ $idx }}] = true;
                        @endforeach
                        this.answeredCount = this.answeredList.filter(x => x).length;
                    }
                },

                isAnswered(idx) { return this.answeredList[idx]; },
                next() { if (this.currentIndex < {{ $soals->count() - 1 }}) this.currentIndex++; },
                prev() { if (this.currentIndex > 0) this.currentIndex--; },
                preventTampering() { window.history.pushState(null, null, window.location.href); window.onpopstate = () => window.history.go(1); },
                forceSubmit() { localStorage.removeItem(`exam_progress_{{ Auth::id() }}_{{ $modul->id }}`); document.getElementById('ujian-form').submit(); },

                confirmFinish() {
                    const unanswered = {{ $soals->count() }} - this.answeredCount;
                    if (unanswered > 0) {
                        Swal.fire({ title: 'Submission Blocked!', text: `You have ${unanswered} unanswered questions.`, icon: 'warning', confirmButtonText: 'Return', background: this.theme === 'dark' ? '#020617' : '#fff' });
                        return;
                    }
                    Swal.fire({ title: 'Finalize Assessment?', icon: 'question', showCancelButton: true, confirmButtonText: 'Confirm Submission', background: this.theme === 'dark' ? '#020617' : '#fff' }).then(r => { if (r.isConfirmed) this.forceSubmit(); });
                }
            }
        }
    </script>
    @endpush
</x-siswa-layout>
