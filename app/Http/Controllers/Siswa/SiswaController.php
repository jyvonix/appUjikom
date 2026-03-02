<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Soal;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $nilai_terakhir = Nilai::where('user_id', $user->id)->latest()->first();
        $total_ujian = Nilai::where('user_id', $user->id)->count();
        $rata_rata = Nilai::where('user_id', $user->id)->avg('skor') ?? 0;

        return view('siswa.dashboard', compact('nilai_terakhir', 'total_ujian', 'rata_rata'));
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
        $soals = Soal::all();
        $total_ujian = Nilai::where('user_id', Auth::id())->count();
        $max_retakes = \App\Models\Setting::get('max_retakes', 1);

        if ($total_ujian >= $max_retakes) {
            return redirect()->route('siswa.soal.index')->with('error', 'Anda telah mencapai batas maksimal pengulangan ujian.');
        }
        
        if ($soals->isEmpty()) {
            return redirect()->route('siswa.soal.index')->with('error', 'Belum ada soal yang tersedia.');
        }

        return view('siswa.soal.kerjakan', compact('soals'));
    }

    public function simpanUjian(Request $request)
    {
        $soals = Soal::all();
        $jumlah_benar = 0;
        $point_per_question = \App\Models\Setting::get('point_per_question', 10);

        foreach ($soals as $soal) {
            $jawaban_siswa = $request->input('jawaban_' . $soal->id);
            // Case-insensitive comparison or ensure both are uppercase
            if (strtoupper($jawaban_siswa) == strtoupper($soal->jawaban_benar)) {
                $jumlah_benar++;
            }
        }

        $skor = $jumlah_benar * $point_per_question;

        Nilai::create([
            'user_id' => Auth::id(),
            'jumlah_benar' => $jumlah_benar,
            'skor' => round($skor, 2),
        ]);

        return redirect()->route('siswa.nilai.index')->with('success', 'Ujian telah selesai! Skor Anda: ' . round($skor, 2));
    }

    public function indexNilai()
    {
        $nilais = Nilai::where('user_id', Auth::id())->latest()->get();
        return view('siswa.nilai.index', compact('nilais'));
    }
}
