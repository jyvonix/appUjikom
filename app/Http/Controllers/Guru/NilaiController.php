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
        $query = Nilai::with(['user', 'modul']);
        
        if ($modul_id) {
            $query->where('modul_id', $modul_id);
        }

        $nilais = $query->latest()->get();
        $modul = $modul_id ? \App\Models\Modul::find($modul_id) : null;

        $pdf = Pdf::loadView('guru.nilai.pdf', compact('nilais', 'modul'));
        return $pdf->download('laporan-nilai-' . ($modul ? str_replace(' ', '-', strtolower($modul->nama)) : 'semua') . '.pdf');
    }

    public function index(Request $request)
    {
        $query = Nilai::with(['user', 'modul']);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $nilais = $query->latest()->paginate(10)->withQueryString();
        $kkm = \App\Models\Setting::get('kkm', 75);

        if ($request->ajax()) {
            return view('guru.nilai.table', compact('nilais', 'kkm'))->render();
        }

        return view('guru.nilai.index', compact('nilais', 'kkm'));
    }
}
