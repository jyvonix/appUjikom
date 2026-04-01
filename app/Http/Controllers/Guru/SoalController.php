<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Soal;
use App\Models\Modul;
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
            'file' => 'required|mimes:xlsx,xls,csv',
            'modul_id' => 'nullable|exists:moduls,id'
        ]);

        Excel::import(new SoalImport($request->modul_id), $request->file('file'));

        return redirect()->back()->with('success', 'Data soal berhasil diimpor.');
    }

    public function bulkCreate(Request $request)
    {
        $selected_modul_id = $request->query('modul_id');
        $moduls = Modul::where('user_id', Auth::id())->where('is_active', true)->get();
        return view('guru.soal.bulk', compact('moduls', 'selected_modul_id'));
    }

    public function bulkStore(Request $request)
    {
        $request->validate([
            'modul_id' => 'required|exists:moduls,id',
            'raw_text' => 'required|string'
        ]);

        $text = $request->raw_text;
        // Logika sederhana untuk memisahkan soal berdasarkan baris baru dan pola A. B. C.
        $lines = explode("\n", $text);
        $current_soal = null;
        $count = 0;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            // Jika baris mengandung pola "1. " atau diakhiri "?" atau tidak diawali A-E, anggap sebagai pertanyaan
            if (!preg_match('/^[A-E][.\)]/i', $line)) {
                if ($current_soal) {
                    Soal::create($current_soal);
                    $count++;
                }
                $current_soal = [
                    'modul_id' => $request->modul_id,
                    'pertanyaan' => preg_replace('/^\d+[.\)]\s*/', '', $line),
                    'opsi_a' => '', 'opsi_b' => '', 'opsi_c' => '', 'opsi_d' => '', 'opsi_e' => '',
                    'jawaban_benar' => 'A',
                    'kesulitan' => 'sedang',
                    'user_id' => Auth::id()
                ];
            } else {
                // Ekstrak opsi
                if (preg_match('/^A[.\)]\s*(.*)/i', $line, $matches)) $current_soal['opsi_a'] = $matches[1];
                elseif (preg_match('/^B[.\)]\s*(.*)/i', $line, $matches)) $current_soal['opsi_b'] = $matches[1];
                elseif (preg_match('/^C[.\)]\s*(.*)/i', $line, $matches)) $current_soal['opsi_c'] = $matches[1];
                elseif (preg_match('/^D[.\)]\s*(.*)/i', $line, $matches)) $current_soal['opsi_d'] = $matches[1];
                elseif (preg_match('/^E[.\)]\s*(.*)/i', $line, $matches)) $current_soal['opsi_e'] = $matches[1];
                
                // Cek jika baris mengandung kunci jawaban (misal: *Kunci: A*)
                if (preg_match('/Kunci:\s*([A-E])/i', $line, $matches)) {
                    $current_soal['jawaban_benar'] = strtoupper($matches[1]);
                }
            }
        }

        if ($current_soal) {
            Soal::create($current_soal);
            $count++;
        }

        return redirect()->route('guru.modul.show', $request->modul_id)->with('success', "$count soal berhasil diimpor dari teks.");
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

    public function create(Request $request)
    {
        $selected_modul_id = $request->query('modul_id');
        $moduls = Modul::where('user_id', Auth::id())->where('is_active', true)->get();
        return view('guru.soal.create', compact('moduls', 'selected_modul_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'modul_id' => ['required', 'exists:moduls,id'],
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

        return redirect()->route('guru.soal.index')->with('success', 'Soal berhasil ditambahkan ke modul.');
    }

    public function edit(Soal $soal)
    {
        // Ensure guru can only edit their own questions
        if ($soal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $moduls = Modul::where('user_id', Auth::id())->get();
        return view('guru.soal.edit', compact('soal', 'moduls'));
    }

    public function update(Request $request, Soal $soal)
    {
        if ($soal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'modul_id' => ['required', 'exists:moduls,id'],
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
