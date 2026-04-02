<x-siswa-layout :hideNav="true">
    <div class="fixed inset-0 overflow-hidden font-sans transition-colors duration-500" 
         :class="theme === 'light' ? 'bg-[#f8fafc] text-slate-900' : 'bg-[#020617] text-white'"
         x-data="examEngine()">
        
        {{-- High-End Immersive Background --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-[-10%] right-[-10%] w-[70vw] h-[70vw] bg-indigo-600/10 rounded-full blur-[120px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[60vw] h-[60vw] bg-purple-600/5 rounded-full blur-[100px] animate-pulse"></div>
        </div>

        {{-- Main Interface --}}
        <div class="relative z-10 h-full flex flex-col">
            
            {{-- Elite Header --}}
            <header class="h-16 md:h-24 border-b flex items-center justify-between px-4 md:px-12 transition-all duration-500"
                    :class="theme === 'light' ? 'bg-white/70 border-slate-200 backdrop-blur-3xl' : 'bg-slate-950/40 border-white/5 backdrop-blur-3xl'">
                
                <div class="flex items-center gap-3 md:gap-6">
                    <div class="w-10 h-10 md:w-14 md:h-14 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-2xl flex items-center justify-center shadow-2xl shadow-indigo-500/20 transform hover:rotate-6 transition-transform">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div class="max-w-[150px] md:max-w-none truncate">
                        <h1 class="text-xs md:text-lg font-black uppercase tracking-widest leading-none mb-1" :class="theme === 'light' ? 'text-slate-900' : 'text-white'">{{ $modul->nama }}</h1>
                        <div class="flex items-center gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                            <p class="text-[8px] md:text-[10px] font-bold text-slate-500 uppercase tracking-widest">Live Secure Session</p>
                        </div>
                    </div>
                </div>

                {{-- Center Timer (Desktop) --}}
                <div class="hidden lg:flex items-center gap-4 px-8 py-3 rounded-2xl border shadow-inner transition-all duration-500"
                     :class="[timeLeft < 300 ? 'border-rose-500/30 bg-rose-500/5' : '', theme === 'light' ? 'bg-slate-50 border-slate-200' : 'bg-white/5 border-white/5']">
                    <div class="flex flex-col items-center">
                        <span class="text-[8px] font-black text-slate-500 uppercase tracking-widest mb-0.5">Chronometer</span>
                        <span class="text-2xl font-black tabular-nums tracking-tighter" 
                              :class="[timeLeft < 300 ? 'text-rose-500 animate-pulse' : '', theme === 'light' && timeLeft >= 300 ? 'text-slate-900' : 'text-white']"
                              x-text="formatTime(timeLeft)">--:--</span>
                    </div>
                </div>

                {{-- Right Actions --}}
                <div class="flex items-center gap-3 md:gap-6">
                    {{-- Mobile Timer --}}
                    <div class="lg:hidden flex flex-col items-end">
                        <span class="text-[7px] font-black text-slate-500 uppercase">Remaining</span>
                        <span class="text-sm font-black tabular-nums" :class="timeLeft < 300 ? 'text-rose-500' : (theme === 'light' ? 'text-slate-900' : 'text-white')" x-text="formatTime(timeLeft)"></span>
                    </div>

                    <button @click="toggleTheme()" type="button" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-2xl transition-all border shadow-sm"
                            :class="theme === 'light' ? 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50' : 'bg-slate-900 border-white/10 text-slate-400 hover:text-indigo-400'">
                        <template x-if="theme === 'dark'">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                        </template>
                        <template x-if="theme === 'light'">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        </template>
                    </button>
                </div>
            </header>

            {{-- Progress Bar (Top) --}}
            <div class="h-1 w-full bg-transparent relative">
                <div class="h-full bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-1000 ease-out shadow-[0_0_15px_rgba(79,70,229,0.5)]"
                     :style="`width: ${(answeredCount/{{ $soals->count() }})*100}%` "></div>
            </div>

            {{-- Main Content --}}
            <main class="flex-1 overflow-y-auto custom-scrollbar px-4 py-8 md:px-12 lg:py-16" @contextmenu.prevent @copy.prevent @paste.prevent>
                <form id="ujian-form" action="{{ route('siswa.soal.simpan') }}" method="POST" class="max-w-4xl mx-auto h-full">
                    @csrf
                    <input type="hidden" name="modul_id" value="{{ $modul->id }}">

                    <div class="relative min-h-[60vh] flex flex-col justify-center">
                        @foreach($soals as $index => $soal)
                            <div class="space-y-8 md:space-y-12 animate-enter" x-show="currentIndex === {{ $index }}" x-cloak>
                                
                                {{-- Question Meta --}}
                                <div class="flex items-center gap-4">
                                    <span class="text-5xl md:text-8xl font-black select-none tracking-tighter transition-colors duration-500" :class="theme === 'light' ? 'text-indigo-100' : 'text-white/5'">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-500/20 to-transparent"></div>
                                    <div class="px-4 py-2 rounded-2xl border transition-colors duration-500" :class="theme === 'light' ? 'bg-indigo-50 border-indigo-100 text-indigo-600' : 'bg-indigo-500/10 border-indigo-500/20 text-indigo-400'">
                                        <span class="text-[9px] md:text-[11px] font-black uppercase tracking-widest">Question Segment</span>
                                    </div>
                                </div>

                                {{-- Question Card --}}
                                <div class="card-pro rounded-[3rem] p-8 md:p-16 shadow-2xl relative overflow-hidden transition-all duration-500"
                                     :class="theme === 'light' ? 'bg-white border-slate-100' : 'bg-slate-900/40 border-white/5'">
                                    
                                    <div class="relative z-10 space-y-10 md:space-y-12">
                                        <h2 class="text-xl md:text-4xl font-bold leading-tight tracking-tight transition-colors duration-500" :class="theme === 'light' ? 'text-slate-800' : 'text-white'">
                                            {{ $soal->pertanyaan }}
                                        </h2>

                                        @if($soal->gambar)
                                            <div class="rounded-3xl overflow-hidden border border-white/10 shadow-2xl group max-w-2xl mx-auto">
                                                <img src="{{ asset('storage/' . $soal->gambar) }}" class="w-full h-auto transition-transform duration-700 hover:scale-105" alt="Evidence">
                                            </div>
                                        @endif

                                        {{-- Options Architecture --}}
                                        <div class="grid grid-cols-1 gap-4">
                                            @foreach(['a', 'b', 'c', 'd', 'e'] as $opt)
                                                @if($soal->{'opsi_'.$opt})
                                                    <label class="group relative flex items-center p-6 md:p-8 rounded-[2rem] border transition-all duration-300 cursor-pointer overflow-hidden"
                                                           :class="theme === 'light' ? 'bg-[#fcfdfe] border-slate-200 hover:border-indigo-300' : 'bg-slate-950/40 border-white/10 hover:border-indigo-500/30'">
                                                        <input type="radio" name="jawaban_{{ $soal->id }}" value="{{ strtoupper($opt) }}" 
                                                               class="hidden peer"
                                                               x-model="answers['{{ $soal->id }}']"
                                                               @change="markAnswered({{ $index }}, '{{ $soal->id }}')">
                                                        
                                                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 via-purple-600/10 to-transparent opacity-0 peer-checked:opacity-100 transition-opacity duration-500"></div>
                                                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-indigo-600 transform -translate-x-full peer-checked:translate-x-0 transition-transform duration-500"></div>

                                                        <div class="relative z-10 flex items-center gap-6 md:gap-8 w-full">
                                                            <div class="w-12 h-12 md:w-16 md:h-16 rounded-2xl md:rounded-[1.5rem] flex items-center justify-center font-black text-lg md:text-2xl border transition-all group-hover:scale-110"
                                                                 :class="theme === 'light' ? 'bg-slate-100 border-slate-200 text-slate-400 peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-400' : 'bg-white/10 border-white/10 text-white peer-checked:bg-indigo-600 peer-checked:border-indigo-400 peer-checked:shadow-2xl shadow-indigo-500/40'">
                                                                {{ strtoupper($opt) }}
                                                            </div>
                                                            <span class="text-base md:text-2xl font-medium transition-colors tracking-tight leading-snug flex-1"
                                                                  :class="[theme === 'light' ? 'text-slate-600 peer-checked:text-indigo-600' : 'text-slate-300 peer-checked:text-white']">
                                                                {{ $soal->{'opsi_'.$opt} }}
                                                            </span>
                                                            <div class="shrink-0 opacity-0 peer-checked:opacity-100 transition-all transform scale-50 peer-checked:scale-100 duration-500">
                                                                <div class="w-8 h-8 md:w-10 md:h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white shadow-lg shadow-indigo-500/40">
                                                                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>
            </main>

            {{-- Pro Navigation Dock --}}
            <footer class="h-24 md:h-32 border-t flex items-center px-4 md:px-12 transition-all duration-500"
                    :class="theme === 'light' ? 'bg-white/80 border-slate-200 backdrop-blur-3xl' : 'bg-slate-950/80 border-white/5 backdrop-blur-3xl'">
                <div class="max-w-5xl mx-auto w-full flex items-center justify-between gap-4 md:gap-10">
                    
                    {{-- Navigation Matrix Trigger --}}
                    <button @click="showNav = true" type="button" class="group flex items-center gap-3 px-6 md:px-8 py-4 bg-slate-900 dark:bg-white/5 text-white rounded-2xl transition-all hover:scale-105 active:scale-95 shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                        <span class="hidden sm:inline font-black text-[10px] uppercase tracking-widest">Question Grid</span>
                    </button>

                    {{-- Center Navigation --}}
                    <div class="flex items-center gap-2 md:gap-4">
                        <button type="button" @click="prev()" :disabled="currentIndex === 0"
                                class="w-12 h-12 md:w-16 md:h-16 flex items-center justify-center rounded-2xl border transition-all disabled:opacity-10"
                                :class="theme === 'light' ? 'bg-slate-100 border-slate-200 text-slate-600 hover:bg-slate-200' : 'bg-white/5 border-white/10 text-white hover:bg-white/10'">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                        </button>

                        <div class="px-6 py-3 rounded-2xl hidden md:flex items-baseline gap-2 border transition-all"
                             :class="theme === 'light' ? 'bg-slate-50 border-slate-200' : 'bg-white/5 border-white/10'">
                            <span class="text-xl font-black" :class="theme === 'light' ? 'text-slate-900' : 'text-white'" x-text="currentIndex + 1"></span>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">/ {{ $soals->count() }}</span>
                        </div>

                        <button type="button" x-show="currentIndex < {{ $soals->count() - 1 }}" @click="next()"
                                class="w-12 h-12 md:w-16 md:h-16 flex items-center justify-center rounded-2xl bg-indigo-600 border border-indigo-500 text-white shadow-xl shadow-indigo-500/20 hover:bg-indigo-500 transition-all active:scale-90">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                        </button>

                        <button type="button" x-show="currentIndex === {{ $soals->count() - 1 }}" @click="confirmFinish()"
                                class="h-12 md:h-16 px-6 md:px-8 bg-emerald-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-emerald-500/20 transition-all hover:bg-emerald-500 active:scale-95">
                            Submit
                        </button>
                    </div>

                    {{-- Completion Tracker (Desktop) --}}
                    <div class="hidden lg:flex flex-col items-end">
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-1">Completion Status</span>
                        <h4 class="text-xl font-black" :class="theme === 'light' ? 'text-slate-900' : 'text-white'" x-text="Math.round((answeredCount/{{ $soals->count() }})*100) + '%'"></h4>
                    </div>
                </div>
            </footer>
        </div>

        {{-- Question Grid Pop-up (Elite Modal) --}}
        <div x-show="showNav" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 z-[200] flex items-center justify-center p-4 md:p-10" x-cloak>
            
            <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-md" @click="showNav = false"></div>
            
            <div class="relative w-full max-w-2xl bg-white dark:bg-slate-900 rounded-[3.5rem] shadow-2xl border dark:border-white/10 p-8 md:p-12 overflow-hidden transition-colors duration-500">
                {{-- Modal Header --}}
                <div class="flex items-center justify-between mb-10 pb-6 border-b dark:border-white/5">
                    <div>
                        <h3 class="text-2xl font-black dark:text-white tracking-tight">Question <span class="text-indigo-600">Matrix</span></h3>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Jump to any question segment</p>
                    </div>
                    <button @click="showNav = false" class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-white/5 flex items-center justify-center text-slate-400 hover:text-rose-500 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- Grid --}}
                <div class="grid grid-cols-5 md:grid-cols-8 gap-3 md:gap-4 max-h-[50vh] overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($soals as $index => $soal)
                        <button type="button" @click="currentIndex = {{ $index }}; showNav = false"
                                class="aspect-square rounded-xl md:rounded-2xl border flex items-center justify-center text-xs md:text-sm font-black transition-all duration-300 transform active:scale-90"
                                :class="currentIndex === {{ $index }} 
                                    ? 'bg-indigo-600 border-indigo-400 text-white scale-110 shadow-xl shadow-indigo-500/20' 
                                    : (isAnswered({{ $index }}) 
                                        ? (theme === 'light' ? 'bg-indigo-50 border-indigo-200 text-indigo-600' : 'bg-indigo-500/10 border-indigo-500/20 text-indigo-400') 
                                        : (theme === 'light' ? 'bg-slate-50 border-slate-200 text-slate-400' : 'bg-white/5 border-white/5 text-slate-600'))">
                            {{ $index + 1 }}
                        </button>
                    @endforeach
                </div>

                {{-- Legend --}}
                <div class="mt-10 pt-8 border-t dark:border-white/5 grid grid-cols-3 gap-4">
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-indigo-600"></div>
                        <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Active</span>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-indigo-100 dark:bg-indigo-500/20"></div>
                        <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Answered</span>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-slate-100 dark:bg-white/5"></div>
                        <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Pending</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-enter { animation: enterEffect 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
        @keyframes enterEffect { from { opacity: 0; transform: scale(0.95) translateY(30px); } to { opacity: 1; transform: scale(1) translateY(0); } }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(79, 70, 229, 0.1); border-radius: 10px; }
        [x-cloak] { display: none !important; }
    </style>

    @push('scripts')
    <script>
        function examEngine() {
            return {
                currentIndex: 0,
                timeLeft: {{ $duration * 60 }},
                answeredList: new Array({{ $soals->count() }}).fill(false),
                answeredCount: 0,
                answers: {},
                theme: localStorage.getItem('color-theme') || 'dark',
                tabSwitchCount: 0,
                showNav: false,

                init() {
                    this.startTimer();
                    this.preventTampering();
                    this.loadSavedProgress();
                    this.initAntiCheating();
                },

                toggleTheme() {
                    this.theme = this.theme === 'dark' ? 'light' : 'dark';
                    localStorage.setItem('color-theme', this.theme);
                    if (this.theme === 'dark') document.documentElement.classList.add('dark');
                    else document.documentElement.classList.remove('dark');
                },

                initAntiCheating() {
                    document.addEventListener('visibilitychange', () => {
                        if (document.hidden) {
                            this.tabSwitchCount++;
                            if (this.tabSwitchCount >= 3) {
                                Swal.fire({
                                    title: 'Keamanan Dilanggar!',
                                    text: 'Anda telah meninggalkan tab ujian sebanyak 3 kali. Ujian dihentikan otomatis.',
                                    icon: 'error',
                                    confirmButtonText: 'Submit Ujian',
                                    allowOutsideClick: false,
                                    background: this.theme === 'dark' ? '#0f172a' : '#fff',
                                    color: this.theme === 'dark' ? '#fff' : '#000',
                                    customClass: { popup: 'rounded-[2.5rem]' }
                                }).then(() => { this.forceSubmit(); });
                            } else {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Security Alert',
                                    text: `Pelanggaran ke-${this.tabSwitchCount}/3 tercatat!`,
                                });
                            }
                        }
                    });
                },

                startTimer() {
                    const timer = setInterval(() => {
                        if (this.timeLeft > 0) this.timeLeft--;
                        else { clearInterval(timer); this.forceSubmit(); }
                    }, 1000);
                },

                formatTime(s) {
                    const m = Math.floor(s / 60);
                    const sec = s % 60;
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
                    const progress = {
                        answers: this.answers,
                        modulId: {{ $modul->id }},
                        userId: {{ Auth::id() }}
                    };
                    localStorage.setItem(`exam_progress_${progress.userId}_${progress.modulId}`, JSON.stringify(progress));
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

                preventTampering() {
                    window.history.pushState(null, null, window.location.href);
                    window.onpopstate = () => window.history.go(1);
                },

                forceSubmit() {
                    localStorage.removeItem(`exam_progress_{{ Auth::id() }}_{{ $modul->id }}`);
                    document.getElementById('ujian-form').submit();
                },

                confirmFinish() {
                    const pending = {{ $soals->count() }} - this.answeredCount;
                    Swal.fire({
                        title: 'Finalize Assessment?',
                        text: pending > 0 ? `Attention: ${pending} questions remain unanswered.` : "All parameters have been verified.",
                        icon: 'question',
                        background: this.theme === 'dark' ? '#0f172a' : '#fff',
                        color: this.theme === 'dark' ? '#fff' : '#000',
                        showCancelButton: true,
                        confirmButtonText: 'Submit Final Payload',
                        confirmButtonColor: '#4f46e5',
                        cancelButtonColor: '#64748b',
                        customClass: { popup: 'rounded-[3rem] border border-white/10' }
                    }).then(r => { if (r.isConfirmed) this.forceSubmit(); });
                }
            }
        }
    </script>
    @endpush
</x-siswa-layout>
