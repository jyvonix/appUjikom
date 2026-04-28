<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::withCount('kelas')->get();
        return view('admin.jurusan.index', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:jurusans,nama',
            'kode' => 'required|unique:jurusans,kode',
        ]);

        Jurusan::create($request->all());

        return back()->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama' => 'required|unique:jurusans,nama,' . $jurusan->id,
            'kode' => 'required|unique:jurusans,kode,' . $jurusan->id,
        ]);

        $jurusan->update($request->all());

        return back()->with('success', 'Jurusan berhasil diperbarui');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return back()->with('success', 'Jurusan berhasil dihapus');
    }

    // Kelas Management within Jurusan
    public function show(Jurusan $jurusan)
    {
        $kelas = $jurusan->kelas;
        return view('admin.jurusan.show', compact('jurusan', 'kelas'));
    }

    public function storeKelas(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama' => 'required|unique:kelas,nama',
        ]);

        $jurusan->kelas()->create([
            'nama' => $request->nama,
        ]);

        return back()->with('success', 'Kelas berhasil ditambahkan');
    }

    public function destroyKelas(Kelas $kelas)
    {
        $kelas->delete();
        return back()->with('success', 'Kelas berhasil dihapus');
    }
}
