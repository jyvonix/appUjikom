<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\SoalExport;
use App\Imports\SoalImport;
use Maatwebsite\Excel\Facades\Excel;

class SoalController extends Controller
{
    public function export()
    {
        return Excel::download(new SoalExport(), 'bank-soal-admin.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new SoalImport, $request->file('file'));

        return redirect()->back()->with('success', 'Soal berhasil diimport.');
    }
    public function index(Request $request)
    {
        $query = Soal::with('user');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('pertanyaan', 'like', "%{$search}%");
        }

        $soals = $query->oldest()->paginate(10)->withQueryString();

        return view('admin.soal.index', compact('soals'));
    }

    public function create()
    {
        return view('admin.soal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'opsi_a' => ['required', 'string'],
            'opsi_b' => ['required', 'string'],
            'opsi_c' => ['required', 'string'],
            'opsi_d' => ['required', 'string'],
            'opsi_e' => ['required', 'string'],
            'jawaban_benar' => ['required', 'in:A,B,C,D,E'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'kesulitan' => ['required', 'in:mudah,sedang,sulit'],
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('soal', 'public');
        }

        Soal::create($data);

        return redirect()->route('admin.soal.index')->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(Soal $soal)
    {
        return view('admin.soal.edit', compact('soal'));
    }

    public function update(Request $request, Soal $soal)
    {
        $request->validate([
            'pertanyaan' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'opsi_a' => ['required', 'string'],
            'opsi_b' => ['required', 'string'],
            'opsi_c' => ['required', 'string'],
            'opsi_d' => ['required', 'string'],
            'opsi_e' => ['required', 'string'],
            'jawaban_benar' => ['required', 'in:A,B,C,D,E'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'kesulitan' => ['required', 'in:mudah,sedang,sulit'],
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($soal->gambar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($soal->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('soal', 'public');
        }

        $soal->update($data);

        return redirect()->route('admin.soal.index')->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Soal $soal)
    {
        if ($soal->gambar) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($soal->gambar);
        }
        $soal->delete();

        return redirect()->route('admin.soal.index')->with('success', 'Soal berhasil dihapus.');
    }

    public function kunciJawaban()
    {
        $soals = Soal::all();
        return view('admin.soal.kunci_jawaban', compact('soals'));
    }
}
