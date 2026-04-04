<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Soal;
use App\Models\Nilai;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $moduls = Modul::where('is_active', true)->withCount('soals')->get();
        $total_ujian = Nilai::where('user_id', $user->id)->count();
        $rata_rata = Nilai::where('user_id', $user->id)->avg('skor') ?? 0;
        
        $streak = $this->calculateStreak($user->id);
        $rank = $this->calculateRank($rata_rata, $total_ujian);
        $productivity = $this->calculateProductivity($user->id);
        $quote = $this->getRandomQuote();

        return view('siswa.dashboard', compact('moduls', 'total_ujian', 'rata_rata', 'streak', 'rank', 'productivity', 'quote'));
    }

    private function calculateRank($avg, $total)
    {
        if ($total == 0) {
            return [
                'title' => 'Beginner', 
                'desc' => 'Ready to Start',
                'icon' => '<svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>'
            ];
        }
        
        if ($avg >= 90) {
            return [
                'title' => 'Elite Level', 
                'desc' => 'Grandmaster Intelligence',
                'icon' => '<svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>'
            ];
        }
        
        if ($avg >= 80) {
            return [
                'title' => 'Master Level', 
                'desc' => 'Digital Intelligence',
                'icon' => '<svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>'
            ];
        }
        
        if ($avg >= 70) {
            return [
                'title' => 'Scholar', 
                'desc' => 'Consistent Learner',
                'icon' => '<svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>'
            ];
        }
        
        return [
            'title' => 'Apprentice', 
            'desc' => 'Growing Intelligence',
            'icon' => '<svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>'
        ];
    }

    private function calculateProductivity($userId)
    {
        $hours = Nilai::where('user_id', $userId)
            ->selectRaw('HOUR(created_at) as hour')
            ->pluck('hour')
            ->toArray();

        if (empty($hours)) return 'Ready to Analyze';

        $counts = array_count_values($hours);
        arsort($counts);
        $topHour = array_key_first($counts);

        if ($topHour >= 5 && $topHour <= 11) return 'Morning Spirit';
        if ($topHour >= 12 && $topHour <= 16) return 'Afternoon Focus';
        if ($topHour >= 17 && $topHour <= 20) return 'Evening Calm';
        return 'Night Owl';
    }

    private function getRandomQuote()
    {
        $quotes = [
            "Kecerdasan tanpa ambisi adalah burung tanpa sayap.",
            "Pendidikan adalah senjata paling ampuh untuk mengubah dunia.",
            "Kegagalan adalah guru terbaik jika Anda belajar darinya.",
            "Jangan berhenti belajar karena hidup tidak berhenti mengajar.",
            "Masa depan adalah milik mereka yang percaya pada keindahan mimpi.",
            "Fokus pada progres, bukan kesempurnaan.",
            "Disiplin adalah jembatan antara tujuan dan pencapaian."
        ];
        return $quotes[array_rand($quotes)];
    }

    private function calculateStreak($userId)
    {
        $dates = Nilai::where('user_id', $userId)
            ->selectRaw('DATE(created_at) as date')
            ->distinct()
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->toArray();

        if (empty($dates)) {
            return 0;
        }

        $streak = 0;
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $latestDate = Carbon::parse($dates[0]);

        if (!$latestDate->equalTo($today) && !$latestDate->equalTo($yesterday)) {
            return 0;
        }

        $currentDate = $latestDate;
        foreach ($dates as $date) {
            $dateObj = Carbon::parse($date);
            if ($dateObj->equalTo($currentDate)) {
                $streak++;
                $currentDate->subDay();
            } else {
                break;
            }
        }
        return $streak;
    }

    public function indexSoal()
    {
        $moduls = Modul::where('is_active', true)->withCount('soals')->get();
        return view('siswa.soal.index', compact('moduls'));
    }

    public function kerjakanUjian(Request $request)
    {
        $modul_id = $request->query('modul_id');
        $user = Auth::user();
        $modul = Modul::where('id', $modul_id)
            ->where('jurusan', $user->jurusan)
            ->with('soals')
            ->firstOrFail();

        $max_retakes = $modul->getSetting('max_retakes');
        $total_percobaan = Nilai::where('user_id', Auth::id())->where('modul_id', $modul_id)->count();

        if ($total_percobaan >= $max_retakes) {
            return redirect()->route('siswa.dashboard')->with('error', 'Anda telah mencapai batas maksimal pengerjaan (' . $max_retakes . 'x) untuk modul ' . $modul->nama);
        }
        
        $query = $modul->soals();
        if ($modul->is_random) {
            $query->inRandomOrder();
        }
        $soals = $query->get();
        
        if ($soals->isEmpty()) {
            return redirect()->route('siswa.dashboard')->with('error', 'Modul ini belum memiliki soal.');
        }

        $duration = $modul->waktu;

        return view('siswa.soal.kerjakan', compact('soals', 'modul', 'duration'));
    }

    public function simpanUjian(Request $request)
    {
        $modul_id = $request->input('modul_id');
        $modul = Modul::findOrFail($modul_id);
        $soals = $modul->soals;
        
        $jumlah_benar = 0;
        $list_jawaban = [];
        $total_soal = $soals->count();

        if ($total_soal === 0) {
            return redirect()->route('siswa.dashboard')->with('error', 'Tidak ada soal dalam modul ini.');
        }

        foreach ($soals as $soal) {
            $jawaban_siswa = $request->input('jawaban_' . $soal->id);
            $list_jawaban[$soal->id] = $jawaban_siswa;
            
            if (strtoupper($jawaban_siswa) == strtoupper($soal->jawaban_benar)) {
                $jumlah_benar++;
            }
        }

        $point_per_question = $modul->getSetting('point_per_question');
        $score_divisor = $modul->getSetting('score_divisor');

        if ($point_per_question > 0 && $score_divisor > 0) {
            $skor = ($jumlah_benar * $point_per_question) / $score_divisor;
        } else {
            $skor = ($jumlah_benar / $total_soal) * 100;
        }

        Nilai::create([
            'user_id' => Auth::id(),
            'modul_id' => $modul_id,
            'jumlah_benar' => $jumlah_benar,
            'skor' => round($skor, 2),
            'list_jawaban' => $list_jawaban,
        ]);

        $message = 'Ujian ' . $modul->nama . ' telah selesai! Skor Anda: ' . round($skor, 2);
        if ($modul->show_result) {
            return redirect()->route('siswa.nilai.index')->with('success', $message);
        } else {
            return redirect()->route('siswa.dashboard')->with('success', 'Ujian selesai. Hasil akan diumumkan kemudian.');
        }
    }

    public function indexNilai()
    {
        $user = Auth::user();
        $nilais = Nilai::where('user_id', $user->id)
            ->with(['modul' => function($query) {
                $query->withCount('soals');
            }])
            ->latest()
            ->get();

        return view('siswa.nilai.index', compact('nilais'));
    }

    public function previewNilai($id)
    {
        $nilai = Nilai::where('id', $id)->where('user_id', Auth::id())->with('modul')->firstOrFail();
        $soals = Soal::where('modul_id', $nilai->modul_id)->get();

        return view('siswa.nilai.preview', compact('nilai', 'soals'));
    }
}
