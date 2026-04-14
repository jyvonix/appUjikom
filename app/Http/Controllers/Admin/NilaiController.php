<?php

namespace App\Http\Controllers\Admin;

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
        return Excel::download(new NilaiExport, 'laporan-nilai-admin.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $modul_id = $request->query('modul_id');
        
        $query = Nilai::with(['user', 'modul']);

        if ($modul_id) {
            $query->where('modul_id', $modul_id);
        }

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $nilais = $query->latest()->get();
        $modul = $modul_id ? \App\Models\Modul::where('id', $modul_id)->first() : null;

        $pdf = Pdf::loadView('admin.nilai.pdf', compact('nilais', 'modul'));
        return $pdf->download('laporan-nilai-admin-' . ($modul ? str_replace(' ', '-', strtolower($modul->nama)) : 'semua') . '.pdf');
    }

    public function index(Request $request)
    {
        $modul_id = $request->query('modul_id');
        $query = Nilai::with(['user', 'modul']);

        if ($modul_id) {
            $query->where('modul_id', $modul_id);
        }

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $nilais = $query->latest()->paginate(10)->withQueryString();
        $moduls = \App\Models\Modul::all();
        $kkm = \App\Models\Setting::get('kkm', 75);

        if ($request->ajax()) {
            return view('admin.nilai.table', compact('nilais', 'kkm'))->render();
        }

        return view('admin.nilai.index', compact('nilais', 'moduls', 'kkm'));
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect()->route('admin.nilai.index')->with('success', 'Data nilai berhasil dihapus.');
    }
}
