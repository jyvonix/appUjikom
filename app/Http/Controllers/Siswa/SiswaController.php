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

        return view('siswa.dashboard', compact('moduls', 'total_ujian', 'rata_rata', 'streak'));
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
        $modul = Modul::with('soals')->findOrFail($modul_id);

        // Cek apakah sudah pernah mengerjakan modul ini
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

        // Advanced Score Calculation
        $point_per_question = $modul->getSetting('point_per_question');
        $score_divisor = $modul->getSetting('score_divisor');

        if ($point_per_question > 0 && $score_divisor > 0) {
            $skor = ($jumlah_benar * $point_per_question) / $score_divisor;
        } else {
            // Default: (Benar / Total) * 100
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
