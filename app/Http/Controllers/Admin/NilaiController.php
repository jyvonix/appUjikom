<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $query = Nilai::with('user');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $nilais = $query->latest()->paginate(10)->withQueryString();
        $kkm = \App\Models\Setting::get('kkm', 75);

        return view('admin.nilai.index', compact('nilais', 'kkm'));
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect()->route('admin.nilai.index')->with('success', 'Data nilai berhasil dihapus.');
    }
}
