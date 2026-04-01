<?php

namespace App\Http\Controllers\Guru;

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
        return Excel::download(new SoalExport(Auth::id()), 'bank-soal-guru.xlsx');
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
        $query = Soal::where('user_id', Auth::id());

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('pertanyaan', 'like', "%{$search}%");
        }

        $soals = $query->oldest()->paginate(10)->withQueryString();

        return view('guru.soal.index', compact('soals'));
    }

    public function create()
    {
        return view('guru.soal.create');
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

        return redirect()->route('guru.soal.index')->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(Soal $soal)
    {
        // Ensure guru can only edit their own questions
        if ($soal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('guru.soal.edit', compact('soal'));
    }

    public function update(Request $request, Soal $soal)
    {
        if ($soal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

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

        return redirect()->route('guru.soal.index')->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Soal $soal)
    {
        if ($soal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        if ($soal->gambar) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($soal->gambar);
        }
        $soal->delete();
        return redirect()->route('guru.soal.index')->with('success', 'Soal berhasil dihapus.');
    }

    public function kunciJawaban()
    {
        $soals = Soal::where('user_id', Auth::id())->get();
        return view('guru.soal.kunci_jawaban', compact('soals'));
    }

    public function show(Soal $soal)
    {
        if ($soal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $nilais = \App\Models\Nilai::all();
        $statistik_siswa = [];

        foreach ($nilais as $nilai) {
            if (isset($nilai->list_jawaban[$soal->id])) {
                $statistik_siswa[] = [
                    'nama' => $nilai->user->name,
                    'username' => $nilai->user->username,
                    'jawaban' => strtoupper($nilai->list_jawaban[$soal->id]),
                    'is_correct' => strtoupper($nilai->list_jawaban[$soal->id]) == strtoupper($soal->jawaban_benar),
                    'waktu' => $nilai->created_at->diffForHumans()
                ];
            }
        }

        return view('guru.soal.show', compact('soal', 'statistik_siswa'));
    }

    public function analisis(Request $request)
    {
        $query = Soal::where('user_id', Auth::id());

        if ($request->has('kategori')) {
            $query->where('kategori', 'like', "%{$request->kategori}%");
        }

        if ($request->has('kesulitan')) {
            $query->where('kesulitan', $request->kesulitan);
        }

        $soals = $query->get();
        $nilais = \App\Models\Nilai::all();
        
        $statistik = [];

        foreach ($soals as $soal) {
            $total_dijawab = 0;
            $total_benar = 0;
            $total_salah = 0;
            $distribusi_jawaban = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0, 'E' => 0];

            foreach ($nilais as $nilai) {
                if (isset($nilai->list_jawaban[$soal->id])) {
                    $jawaban_siswa = strtoupper($nilai->list_jawaban[$soal->id]);
                    $total_dijawab++;
                    
                    if ($jawaban_siswa == strtoupper($soal->jawaban_benar)) {
                        $total_benar++;
                    } else {
                        $total_salah++;
                    }

                    if (isset($distribusi_jawaban[$jawaban_siswa])) {
                        $distribusi_jawaban[$jawaban_siswa]++;
                    }
                }
            }

            $statistik[$soal->id] = [
                'soal' => $soal,
                'total_dijawab' => $total_dijawab,
                'total_benar' => $total_benar,
                'total_salah' => $total_salah,
                'tingkat_kesulitan_aktual' => $total_dijawab > 0 ? round(($total_salah / $total_dijawab) * 100, 2) : 0,
                'distribusi' => $distribusi_jawaban
            ];
        }

        // Urutkan dari yang paling banyak salahnya (paling sulit) jika tidak ada filter urutan lain
        uasort($statistik, function($a, $b) {
            return $b['tingkat_kesulitan_aktual'] <=> $a['tingkat_kesulitan_aktual'];
        });

        $kategoris = Soal::where('user_id', Auth::id())->distinct()->pluck('kategori')->filter();

        return view('guru.soal.analisis', compact('statistik', 'kategoris'));
    }
}
