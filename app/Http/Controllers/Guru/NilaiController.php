<?php

namespace App\Http\Controllers\Guru;

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
