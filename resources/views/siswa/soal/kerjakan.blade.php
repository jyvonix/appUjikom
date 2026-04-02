<x-siswa-layout :hideNav="true">
    <div class="fixed inset-0 overflow-hidden font-sans transition-colors duration-500" 
         :class="theme === 'light' ? 'bg-slate-50 text-slate-900' : 'bg-[#020617] text-slate-200'"
         x-data="examEngine()">
        {{-- High-End Immersive Background --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-[1000px] h-[1000px] bg-indigo-600/10 rounded-full blur-[150px] animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-[800px] h-[800px] bg-purple-600/5 rounded-full blur-[120px] animate-pulse"></div>
        </div>

        {{-- Main Interface Container --}}
        <div class="relative z-10 h-full flex flex-col">
            
            {{-- Pro Header --}}
            <header class="h-20 md:h-24 border-b px-6 md:px-12 flex items-center justify-between transition-colors duration-500"
                    :class="theme === 'light' ? 'bg-white/80 border-slate-200 backdrop-blur-2xl' : 'bg-slate-950/50 border-white/5 backdrop-blur-2xl'">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-2xl flex items-center justify-center shadow-2xl shadow-indigo-500/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-sm font-black uppercase tracking-[0.2em] leading-none mb-1" :class="theme === 'light' ? 'text-slate-900' : 'text-white'">{{ $modul->nama }}</h1>
                        <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Digital Intelligence Protocol</p>
                    </div>
                </div>

                {{-- Interactive Progress Ring & Timer --}}
                <div class="flex items-center gap-8">
                    {{-- Theme Toggle --}}
                    <button @click="toggleTheme()" type="button" class="w-10 h-10 flex items-center justify-center rounded-xl transition-all border"
                            :class="theme === 'light' ? 'bg-slate-100 border-slate-200 text-slate-600' : 'bg-white/5 border-white/5 text-slate-400 hover:text-indigo-500'">
                        <template x-if="theme === 'dark'">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                        </template>
                        <template x-if="theme === 'light'">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        </template>
                    </button>

                    <div class="h-12 w-px bg-slate-200 dark:bg-white/5"></div>

                    <div class="flex items-center gap-4 px-6 py-3 rounded-2xl border shadow-inner transition-colors duration-500"
                         :class="[timeLeft < 300 ? 'border-rose-500/30 bg-rose-500/5' : '', theme === 'light' ? 'bg-slate-100 border-slate-200' : 'bg-white/5 border-white/5']">
                        <div class="flex flex-col items-center">
                            <span class="text-[8px] font-black text-slate-500 uppercase tracking-widest mb-0.5">Chronometer</span>
                            <span class="text-2xl font-black tabular-nums tracking-tighter" 
                                  :class="[timeLeft < 300 ? 'text-rose-500 animate-pulse' : '', theme === 'light' && timeLeft >= 300 ? 'text-slate-900' : 'text-white']"
                                  x-text="formatTime(timeLeft)">--:--</span>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Main Examination Area --}}
            <main class="flex-1 overflow-y-auto custom-scrollbar px-6 py-12 md:px-12 lg:py-20" @contextmenu.prevent @copy.prevent @paste.prevent>
                <form id="ujian-form" action="{{ route('siswa.soal.simpan') }}" method="POST" class="max-w-5xl mx-auto h-full flex flex-col lg:flex-row gap-12">
                    @csrf
                    <input type="hidden" name="modul_id" value="{{ $modul->id }}">

                    {{-- Left: Question Content --}}
                    <div class="flex-1 space-y-12">
                        @foreach($soals as $index => $soal)
                            <div class="space-y-12 animate-enter" x-show="currentIndex === {{ $index }}" x-cloak>
                                {{-- Question Indicator --}}
                                <div class="flex items-center gap-6">
                                    <span class="text-6xl font-black select-none tracking-tighter transition-colors duration-500" :class="theme === 'light' ? 'text-slate-200' : 'text-white/5'">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-500/20 to-transparent"></div>
                                    <div class="px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-lg">
                                        <span class="text-[9px] font-black text-indigo-400 uppercase tracking-widest">Weight: Standard</span>
                                    </div>
                                </div>

                                {{-- Question Body --}}
                                <div class="space-y-10">
                                    <h2 class="text-2xl md:text-4xl font-bold leading-tight tracking-tight transition-colors duration-500" :class="theme === 'light' ? 'text-slate-800' : 'text-white'">
                                        {{ $soal->pertanyaan }}
                                    </h2>

                                    @if($soal->gambar)
                                        <div class="rounded-[3rem] overflow-hidden border border-white/10 shadow-2xl group cursor-zoom-in">
                                            <img src="{{ asset('storage/' . $soal->gambar) }}" class="w-full h-auto transition-transform duration-700 group-hover:scale-105" alt="Assessment Artifact">
                                        </div>
                                    @endif

                                    {{-- Options Architecture --}}
                                    <div class="grid grid-cols-1 gap-4">
                                        @foreach(['a', 'b', 'c', 'd', 'e'] as $opt)
                                            @if($soal->{'opsi_'.$opt})
                                                <label class="group relative flex items-center p-6 md:p-8 rounded-[2rem] border transition-all duration-300 cursor-pointer overflow-hidden"
                                                       :class="theme === 'light' ? 'bg-white border-slate-200 hover:bg-slate-50' : 'bg-slate-900/40 border-white/5 hover:bg-slate-800/40 hover:border-indigo-500/30'">
                                                    <input type="radio" name="jawaban_{{ $soal->id }}" value="{{ strtoupper($opt) }}" 
                                                           class="hidden peer"
                                                           x-model="answers['{{ $soal->id }}']"
                                                           @change="markAnswered({{ $index }}, '{{ $soal->id }}')">
                                                    
                                                    {{-- Active Indicator Gradient --}}
                                                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 via-purple-600/10 to-transparent opacity-0 peer-checked:opacity-100 transition-opacity duration-500"></div>
                                                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-indigo-500 transform -translate-x-full peer-checked:translate-x-0 transition-transform duration-500"></div>

                                                    <div class="relative z-10 flex items-center gap-8 w-full">
                                                        <div class="w-12 h-12 md:w-14 md:h-14 rounded-2xl flex items-center justify-center font-black text-lg border transition-all group-hover:scale-110"
                                                             :class="theme === 'light' ? 'bg-slate-100 border-slate-200 text-slate-400 peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-400' : 'bg-white/10 border-white/10 text-white peer-checked:bg-indigo-600 peer-checked:border-indigo-400 peer-checked:shadow-2xl peer-checked:shadow-indigo-500/40'">
                                                            {{ strtoupper($opt) }}
                                                        </div>
                                                        <span class="text-lg md:text-xl font-medium transition-colors tracking-tight leading-snug"
                                                              :class="[theme === 'light' ? 'text-slate-600 peer-checked:text-indigo-600' : 'text-slate-300 peer-checked:text-white']">
                                                            {{ $soal->{'opsi_'.$opt} }}
                                                        </span>
                                                        <div class="ml-auto opacity-0 peer-checked:opacity-100 transition-all transform scale-50 peer-checked:scale-100 duration-500">
                                                            <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center shadow-lg">
                                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
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

                    {{-- Right: Navigation Ecosystem --}}
                    <aside class="w-full lg:w-80 space-y-8">
                        <div class="border rounded-[3rem] p-8 md:p-10 sticky top-0 shadow-2xl transition-colors duration-500"
                             :class="theme === 'light' ? 'bg-white border-slate-200' : 'bg-slate-950/50 border-white/5 backdrop-blur-3xl'">
                            <div class="flex items-center justify-between mb-8 pb-6 border-b" :class="theme === 'light' ? 'border-slate-100' : 'border-white/5'">
                                <h4 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em]">Navigation Matrix</h4>
                                <div class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
                            </div>
                            
                            <div class="grid grid-cols-5 gap-3">
                                @foreach($soals as $index => $soal)
                                    <button type="button" @click="currentIndex = {{ $index }}"
                                            class="aspect-square rounded-xl border flex items-center justify-center text-[11px] font-black transition-all duration-300 transform"
                                            :class="currentIndex === {{ $index }} ? 'bg-indigo-600 border-indigo-400 text-white scale-110 z-20 shadow-[0_10px_30px_rgba(79,70,229,0.4)]' : (isAnswered({{ $index }}) ? 'bg-indigo-500/10 border-indigo-500/20 text-indigo-500' : 'bg-transparent border-slate-200 dark:border-white/5 text-slate-400 dark:text-slate-600 hover:border-indigo-500/20 hover:text-indigo-500')">
                                        {{ $index + 1 }}
                                    </button>
                                @endforeach
                            </div>

                            <div class="mt-10 pt-8 border-t space-y-4" :class="theme === 'light' ? 'border-slate-100' : 'border-white/5'">
                                <div class="flex items-center justify-between">
                                    <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Completion</span>
                                    <span class="text-[10px] font-black" :class="theme === 'light' ? 'text-slate-900' : 'text-white'" x-text="Math.round((answeredCount/{{ $soals->count() }})*100) + '%'">0%</span>
                                </div>
                                <div class="h-1.5 w-full bg-slate-900/5 dark:bg-slate-900/50 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-1000" 
                                         :style="`width: ${(answeredCount/{{ $soals->count() }})*100}%` "></div>
                                </div>
                            </div>

                            <button type="button" @click="confirmFinish()"
                                    class="w-full mt-10 py-5 bg-gradient-to-br from-emerald-600 to-teal-700 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] shadow-2xl shadow-emerald-900/20 transition-all hover:scale-[1.02] hover:shadow-emerald-500/20 active:scale-95">
                                Finalize Upload
                            </button>
                        </div>
                    </aside>
                </form>
            </main>

            {{-- Dynamic Control Dock --}}
            <footer class="h-24 md:h-32 border-t flex items-center px-6 md:px-12 transition-colors duration-500"
                    :class="theme === 'light' ? 'bg-white/90 border-slate-200 backdrop-blur-3xl' : 'bg-slate-950/80 border-white/5 backdrop-blur-3xl'">
                <div class="max-w-5xl mx-auto w-full flex items-center justify-between gap-10">
                    <button type="button" @click="prev()" :disabled="currentIndex === 0"
                            class="group flex items-center gap-4 px-8 py-4 bg-white/5 text-slate-400 rounded-2xl border border-white/5 font-black text-[10px] uppercase tracking-[0.3em] transition-all hover:bg-white/10 hover:text-white disabled:opacity-10"
                            :class="theme === 'light' ? 'bg-slate-100 border-slate-200 text-slate-500' : ''">
                        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
                        Backward
                    </button>

                    <div class="hidden md:flex flex-col items-center gap-2">
                        <div class="text-[10px] font-black uppercase tracking-[0.4em] mb-1" :class="theme === 'light' ? 'text-slate-400' : 'text-white'">Sector Navigation</div>
                        <div class="flex items-center gap-3">
                            <template x-for="i in {{ $soals->count() }}">
                                <div class="w-1.5 h-1.5 rounded-full transition-all duration-500"
                                     :class="currentIndex + 1 === i ? 'bg-indigo-500 scale-150 shadow-[0_0_10px_rgba(79,70,229,0.8)]' : (isAnswered(i-1) ? 'bg-indigo-500/30' : 'bg-slate-200 dark:bg-slate-800')"></div>
                            </template>
                        </div>
                    </div>

                    <button type="button" x-show="currentIndex < {{ $soals->count() - 1 }}" @click="next()"
                            class="group flex items-center gap-4 px-10 py-4 bg-indigo-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] shadow-2xl shadow-indigo-500/20 transition-all hover:bg-indigo-500 hover:scale-105 active:scale-95">
                        Forward Scan
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 5l7 7-7 7M5 5l7 7-7 7"/></svg>
                    </button>

                    <button type="button" x-show="currentIndex === {{ $soals->count() - 1 }}" @click="confirmFinish()"
                            class="group flex items-center gap-4 px-10 py-4 bg-emerald-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] shadow-2xl shadow-emerald-500/20 transition-all hover:bg-emerald-500 hover:scale-105">
                        Submit Payload
                        <svg class="w-4 h-4 animate-bounce-x" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </footer>
        </div>
    </div>

    <style>
        .animate-enter { animation: enterEffect 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
        @keyframes enterEffect { from { opacity: 0; transform: translateY(30px) scale(0.98); } to { opacity: 1; transform: translateY(0) scale(1); } }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(79, 70, 229, 0.1); border-radius: 10px; }
        .animate-bounce-x { animation: bounceX 1s infinite; }
        @keyframes bounceX { 0%, 100% { transform: translateX(0); } 50% { transform: translateX(5px); } }
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
                                    text: 'Anda telah meninggalkan tab ujian sebanyak 3 kali. Ujian akan dihentikan sekarang.',
                                    icon: 'error',
                                    confirmButtonText: 'Selesaikan Ujian',
                                    allowOutsideClick: false,
                                    background: this.theme === 'dark' ? '#0f172a' : '#fff',
                                    color: this.theme === 'dark' ? '#fff' : '#000',
                                }).then(() => {
                                    this.forceSubmit();
                                });
                            } else {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Peringatan Keamanan',
                                    text: `Jangan meninggalkan tab ujian! Pelanggaran ke-${this.tabSwitchCount}/3 tercatat.`,
                                    timer: 5000
                                });
                            }
                        }
                    });
                },

                startTimer() {
                    setInterval(() => {
                        if (this.timeLeft > 0) this.timeLeft--;
                        else this.forceSubmit();
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
                            if (this.answers["{{ $s->id }}"]) {
                                this.answeredList[{{ $idx }}] = true;
                            }
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
                        title: 'Confirm Submission?',
                        text: pending > 0 ? `Alert: ${pending} questions remain unanswered.` : "All questions have been securely documented.",
                        icon: 'warning',
                        background: this.theme === 'dark' ? '#0f172a' : '#fff',
                        color: this.theme === 'dark' ? '#fff' : '#000',
                        showCancelButton: true,
                        confirmButtonText: 'Submit Assessment',
                        confirmButtonColor: '#4f46e5',
                        cancelButtonColor: '#1e293b',
                        customClass: { popup: 'rounded-[2rem] border border-white/10 shadow-2xl' }
                    }).then(r => { if (r.isConfirmed) this.forceSubmit(); });
                }
            }
        }
    </script>
    @endpush
</x-siswa-layout>
