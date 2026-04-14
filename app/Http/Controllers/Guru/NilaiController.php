<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NilaiExport;
use Barryvdh\DomPDF\Facade\Pdf;

class NilaiController extends Controller
{
    public function export()
    {
        return Excel::download(new NilaiExport, 'laporan-nilai-guru.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $modul_id = $request->query('modul_id');
        $user = \Illuminate\Support\Facades\Auth::user();
        $guru_id = $user->id;
        $guru_jurusan = $user->jurusan;
        
        // Ambil nilai jika: Guru adalah asesor siswa OR Modul dibuat oleh guru OR Modul sesuai jurusan guru
        $query = Nilai::where(function($q) use ($guru_id, $guru_jurusan) {
            $q->whereHas('user', function($u) use ($guru_id) {
                $u->where('asesor_id', $guru_id);
            })
            ->orWhereHas('modul', function($m) use ($guru_id, $guru_jurusan) {
                $m->where('user_id', $guru_id)
                  ->orWhere('jurusan', $guru_jurusan);
            });
        })->with(['user', 'modul']);
        
        if ($modul_id) {
            $query->where('modul_id', $modul_id);
        }

        $nilais = $query->latest()->get();
        $modul = $modul_id ? \App\Models\Modul::where('id', $modul_id)->first() : null;

        $pdf = Pdf::loadView('guru.nilai.pdf', compact('nilais', 'modul'));
        return $pdf->download('laporan-nilai-' . ($modul ? str_replace(' ', '-', strtolower($modul->nama)) : 'semua') . '.pdf');
    }

    public function index(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $guru_id = $user->id;
        $guru_jurusan = $user->jurusan;
        
        // Ambil nilai jika: Guru adalah asesor siswa OR Modul dibuat oleh guru OR Modul sesuai jurusan guru
        $query = Nilai::where(function($q) use ($guru_id, $guru_jurusan) {
            $q->whereHas('user', function($u) use ($guru_id) {
                $u->where('asesor_id', $guru_id);
            })
            ->orWhereHas('modul', function($m) use ($guru_id, $guru_jurusan) {
                $m->where('user_id', $guru_id)
                  ->orWhere('jurusan', $guru_jurusan);
            });
        })->with(['user', 'modul']);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $nilais = $query->latest()->paginate(10)->withQueryString();
        $kkm = \App\Models\Setting::get('kkm', 75);

        // Jika request berasal dari AJAX (pencarian atau pagination)
        if ($request->ajax()) {
            return view('guru.nilai.table', compact('nilais', 'kkm'))->render();
        }

        return view('guru.nilai.index', compact('nilais', 'kkm'));
    }
}
