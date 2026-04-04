<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModulController extends Controller
{
    public function index()
    {
        $moduls = Modul::where('user_id', Auth::id())->withCount('soals')->get();
        return view('guru.modul.index', compact('moduls'));
    }

    public function create()
    {
        return view('guru.modul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:moduls,nama',
            'deskripsi' => 'nullable|string',
            'jurusan' => 'required|string|in:RPL,MPLB',
            'waktu' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
            'kkm' => 'nullable|integer|min:0|max:100',
            'max_retakes' => 'nullable|integer|min:1',
            'point_per_question' => 'nullable|integer|min:0',
            'score_divisor' => 'nullable|numeric|min:0.01',
            'is_random' => 'nullable|boolean',
            'show_result' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['is_random'] = $request->has('is_random');
        $data['show_result'] = $request->has('show_result');

        Modul::create($data);

        return redirect()->route('guru.modul.index')->with('success', 'Modul ujian berhasil dibuat!');
    }

    public function show(Modul $modul)
    {
        if ($modul->user_id !== Auth::id()) {
            abort(403);
        }

        $soals = $modul->soals()->latest()->get();
        return view('guru.modul.show', compact('modul', 'soals'));
    }

    public function edit(Modul $modul)
    {
        if ($modul->user_id !== Auth::id()) {
            abort(403);
        }
        return view('guru.modul.edit', compact('modul'));
    }

    public function update(Request $request, Modul $modul)
    {
        if ($modul->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nama' => 'required|string|max:255|unique:moduls,nama,' . $modul->id,
            'deskripsi' => 'nullable|string',
            'jurusan' => 'required|string|in:RPL,MPLB',
            'waktu' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
            'kkm' => 'nullable|integer|min:0|max:100',
            'max_retakes' => 'nullable|integer|min:1',
            'point_per_question' => 'nullable|integer|min:0',
            'score_divisor' => 'nullable|numeric|min:0.01',
            'is_random' => 'nullable|boolean',
            'show_result' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['is_random'] = $request->has('is_random');
        $data['show_result'] = $request->has('show_result');

        $modul->update($data);

        return redirect()->route('guru.modul.index')->with('success', 'Modul ujian berhasil diperbarui!');
    }

    public function destroy(Modul $modul)
    {
        if ($modul->user_id !== Auth::id()) {
            abort(403);
        }
        $modul->delete();
        return redirect()->route('guru.modul.index')->with('success', 'Modul ujian berhasil dihapus!');
    }
}
