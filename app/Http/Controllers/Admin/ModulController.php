<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\User;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function index()
    {
        $moduls = Modul::with('user')->withCount('soals')->get();
        return view('admin.modul.index', compact('moduls'));
    }

    public function create()
    {
        $gurus = User::where('role', 'guru')->get();
        return view('admin.modul.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:moduls,nama',
            'deskripsi' => 'nullable|string',
            'waktu' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
        ]);

        Modul::create($request->all());

        return redirect()->route('admin.modul.index')->with('success', 'Modul ujian berhasil dibuat!');
    }

    public function show(Modul $modul)
    {
        $soals = $modul->soals()->with('user')->latest()->get();
        return view('admin.modul.show', compact('modul', 'soals'));
    }

    public function edit(Modul $modul)
    {
        $gurus = User::where('role', 'guru')->get();
        return view('admin.modul.edit', compact('modul', 'gurus'));
    }

    public function update(Request $request, Modul $modul)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:moduls,nama,' . $modul->id,
            'deskripsi' => 'nullable|string',
            'waktu' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
        ]);

        $modul->update($request->all());

        return redirect()->route('admin.modul.index')->with('success', 'Modul ujian berhasil diperbarui!');
    }

    public function destroy(Modul $modul)
    {
        $modul->delete();
        return redirect()->route('admin.modul.index')->with('success', 'Modul ujian berhasil dihapus!');
    }
}
