<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Soal;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $nilai_terakhir = Nilai::where('user_id', $user->id)->latest()->first();
        $total_ujian = Nilai::where('user_id', $user->id)->count();
        $rata_rata = Nilai::where('user_id', $user->id)->avg('skor') ?? 0;
        
        $streak = $this->calculateStreak($user->id);

        return view('siswa.dashboard', compact('nilai_terakhir', 'total_ujian', 'rata_rata', 'streak'));
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

        // If the latest activity is not today or yesterday, the streak is broken
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
        $soals = Soal::all();
        $total_ujian = Nilai::where('user_id', Auth::id())->count();
        $max_retakes = \App\Models\Setting::get('max_retakes', 1);
        $kkm = \App\Models\Setting::get('kkm', 75);
        $sudah_mencapai_batas = $total_ujian >= $max_retakes;
        
        return view('siswa.soal.index', compact('soals', 'sudah_mencapai_batas', 'max_retakes', 'total_ujian', 'kkm'));
    }

    public function kerjakanUjian()
    {
        $soals = Soal::inRandomOrder()->get();
        $total_ujian = Nilai::where('user_id', Auth::id())->count();
        $max_retakes = \App\Models\Setting::get('max_retakes', 1);
        $duration = \App\Models\Setting::get('exam_duration', 60);

        if ($total_ujian >= $max_retakes) {
            return redirect()->route('siswa.soal.index')->with('error', 'Anda telah mencapai batas maksimal pengulangan ujian.');
        }
        
        if ($soals->isEmpty()) {
            return redirect()->route('siswa.soal.index')->with('error', 'Belum ada soal yang tersedia.');
        }

        return view('siswa.soal.kerjakan', compact('soals', 'duration'));
    }

    public function simpanUjian(Request $request)
    {
        $soals = Soal::all();
        $jumlah_benar = 0;
        $point_per_question = (float) \App\Models\Setting::get('point_per_question', 10);
        $score_divisor = (float) \App\Models\Setting::get('score_divisor', 1);
        $list_jawaban = [];

        foreach ($soals as $soal) {
            $jawaban_siswa = $request->input('jawaban_' . $soal->id);
            $list_jawaban[$soal->id] = $jawaban_siswa;
            
            if (strtoupper($jawaban_siswa) == strtoupper($soal->jawaban_benar)) {
                $jumlah_benar++;
            }
        }

        // Rumus: (Benar * Poin) / Pembagi
        $skor = ($jumlah_benar * $point_per_question) / ($score_divisor > 0 ? $score_divisor : 1);

        Nilai::create([
            'user_id' => Auth::id(),
            'jumlah_benar' => $jumlah_benar,
            'skor' => round($skor, 2),
            'list_jawaban' => $list_jawaban,
        ]);

        return redirect()->route('siswa.nilai.index')->with('success', 'Ujian telah selesai! Skor Anda: ' . round($skor, 2));
    }

    public function indexNilai()
    {
        $user = Auth::user();
        $nilais = Nilai::where('user_id', $user->id)->latest()->get();
        $kkm = \App\Models\Setting::get('kkm', 75);
        $total_ujian = Nilai::where('user_id', $user->id)->count();
        $max_retakes = \App\Models\Setting::get('max_retakes', 1);

        return view('siswa.nilai.index', compact('nilais', 'kkm', 'total_ujian', 'max_retakes'));
    }

    public function previewNilai($id)
    {
        $user = Auth::user();
        $total_ujian = Nilai::where('user_id', $user->id)->count();
        $max_retakes = \App\Models\Setting::get('max_retakes', 1);

        // Hanya boleh preview jika sudah mencapai batas maksimal percobaan
        if ($total_ujian < $max_retakes) {
            return redirect()->route('siswa.nilai.index')->with('error', 'Fitur review hanya tersedia setelah Anda menyelesaikan seluruh kesempatan ujian.');
        }

        $nilai = Nilai::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $soals = Soal::all();

        return view('siswa.nilai.preview', compact('nilai', 'soals'));
    }
}
