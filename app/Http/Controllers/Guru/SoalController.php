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
use Illuminate\Support\Str;

class SoalController extends Controller
{
    public function export(Request $request)
    {
        $modul_id = $request->query('modul_id');
        $fileName = 'bank-soal-guru' . ($modul_id ? '-modul-' . $modul_id : '') . '.xlsx';
        return Excel::download(new SoalExport(Auth::id(), $modul_id), $fileName);
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
            'raw_text' => 'nullable|string',
            'file' => 'nullable|mimes:docx,pdf|max:5120',
        ]);

        $text = $request->raw_text ?? '';

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();

            if ($extension === 'docx') {
                $text = $this->extractTextFromDocx($file->getRealPath());
            } elseif ($extension === 'pdf') {
                $text = $this->extractTextFromPdf($file->getRealPath());
            }
        }

        if (empty(trim($text))) {
            return redirect()->back()->with('error', 'Tidak ada teks yang ditemukan untuk diproses.');
        }

        $parsedSoals = $this->parseQuestionTextProfessional($text, $request->modul_id);
        
        if (empty($parsedSoals)) {
            return redirect()->back()->with('error', 'Gagal memproses soal. Pastikan format dokumen sesuai (Soal diawali nomor, Pilihan diawali a-e).');
        }

        foreach ($parsedSoals as $soalData) {
            Soal::create($soalData);
        }

        $count = count($parsedSoals);
        return redirect()->route('guru.modul.show', $request->modul_id)->with('success', "Sistem Cerdas berhasil mengimpor $count soal dengan akurasi tinggi.");
    }

    private function extractTextFromDocx($path)
    {
        $text = '';
        try {
            $phpWord = \PhpOffice\PhpWord\IOFactory::load($path);
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    $text .= $this->processDocxElement($element) . "\n";
                }
            }
        } catch (\Exception $e) {
            \Log::error("Docx Extraction Error: " . $e->getMessage());
        }
        return $text;
    }

    private function processDocxElement($element)
    {
        $text = '';
        if ($element instanceof \PhpOffice\PhpWord\Element\Table) {
            foreach ($element->getRows() as $row) {
                foreach ($row->getCells() as $cell) {
                    foreach ($cell->getElements() as $cellElement) {
                        $text .= $this->processDocxElement($cellElement);
                    }
                    $text .= " "; // Beri spasi antar sel
                }
                $text .= "\n"; // Newline antar baris tabel
            }
        } elseif ($element instanceof \PhpOffice\PhpWord\Element\TextRun || method_exists($element, 'getElements')) {
            foreach ($element->getElements() as $child) {
                $text .= $this->processDocxElement($child);
            }
        } elseif (method_exists($element, 'getText')) {
            $text .= $element->getText();
        } elseif ($element instanceof \PhpOffice\PhpWord\Element\TextBreak) {
            $text .= "\n";
        }
        return $text;
    }

    private function extractTextFromPdf($path)
    {
        try {
            $parser = new \Smalot\PdfParser\Parser();
            $pdf = $parser->parseFile($path);
            return $pdf->getText();
        } catch (\Exception $e) {
            \Log::error("PDF Extraction Error: " . $e->getMessage());
            return '';
        }
    }

    private function parseQuestionTextProfessional($text, $modul_id)
    {
        // 1. Normalisasi Total
        $text = str_replace(["\r\n", "\r"], "\n", $text);
        $text = preg_replace('/\x{00A0}+/u', ' ', $text);
        $text = preg_replace('/ +/', ' ', $text);

        // Pecah Opsi horizontal (A... B...) menjadi vertikal
        $text = preg_replace('/\s+([A-Ea-e][.\)])\s+/u', "\n$1 ", $text);
        
        // Bersihkan teks sampah administratif LSP agar tidak mengganggu
        $junkPatterns = [
            '/FR\.IA\.\d+[^ \n]*/i',
            '/Skema Sertifikasi[^ \n]*/i',
            '/Halaman \d+ dari \d+/i',
            '/Nama Asesi:[^ \n]*/i',
            '/Tanda Tangan:[^ \n]*/i',
            '/Jawab semua pertanyaan berikut:/i'
        ];
        $text = preg_replace($junkPatterns, '', $text);

        $lines = explode("\n", $text);
        $soals = [];
        $tempSoal = null;
        $activeSlot = null;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            // DETEKSI CALON NOMOR SOAL (Contoh: "1." atau "40.")
            if (preg_match('/^(\d+)[.\)]\s*(.*)/u', $line, $matches)) {
                $num = (int)$matches[1];
                $content = trim($matches[2]);

                // Jika ini soal baru (bukan bagian dari list 1-6 di soal 12)
                // Kita asumsikan soal baru jika nomornya > nomor terakhir yang tersimpan
                // ATAU jika ini adalah nomor 1 pertama kali
                if ($num == 1 || $num > count($soals) + 1 || ($tempSoal && $num == count($soals) + 1)) {
                    if ($tempSoal) {
                        // Sebelum simpan soal lama, pastikan dia valid (punya minimal 2 opsi)
                        if (!empty($tempSoal['opsi_a']) && !empty($tempSoal['opsi_b'])) {
                            $soals[] = $this->finalizeSoal($tempSoal);
                        } else if ($tempSoal) {
                            // Jika ternyata soal lama tidak punya opsi, berarti dia mungkin 
                            // bagian dari teks pertanyaan soal sebelumnya.
                            $prevIdx = count($soals) - 1;
                            if ($prevIdx >= 0) {
                                $soals[$prevIdx]['pertanyaan'] .= "\n" . $tempSoal['pertanyaan'];
                            }
                        }
                    }
                    
                    $tempSoal = $this->initSoalTemplate($modul_id, $content);
                    $activeSlot = 'pertanyaan';
                    continue;
                }
            }

            // DETEKSI OPSI (a. b. c. d. e.)
            if (preg_match('/^([a-e])[.\)]\s*(.*)/iu', $line, $matches)) {
                if ($tempSoal) {
                    $letter = strtolower($matches[1]);
                    $activeSlot = 'opsi_' . $letter;
                    $tempSoal[$activeSlot] = trim($matches[2]);
                    continue;
                }
            }

            // DETEKSI KUNCI JAWABAN
            if (preg_match('/^(Kunci|Jawaban|Ans)[:\s]+([A-E])/iu', $line, $matches)) {
                if ($tempSoal) {
                    $tempSoal['jawaban_benar'] = strtoupper($matches[2]);
                    $activeSlot = null;
                    continue;
                }
            }

            // JIKA TIDAK COCOK APAPUN, BERARTI LANJUTAN TEKS (APPEND)
            if ($tempSoal && $activeSlot) {
                if ($activeSlot === 'pertanyaan') {
                    $tempSoal['pertanyaan'] .= "\n" . $line;
                } else {
                    $tempSoal[$activeSlot] .= " " . $line;
                }
            }
        }

        // Simpan soal terakhir
        if ($tempSoal && !empty($tempSoal['opsi_a']) && !empty($tempSoal['opsi_b'])) {
            $soals[] = $this->finalizeSoal($tempSoal);
        }

        return $soals;
    }

    private function finalizeSoal($soal)
    {
        $soal['pertanyaan'] = trim($soal['pertanyaan']);
        $soal['opsi_a'] = Str::limit(trim($soal['opsi_a']), 250);
        $soal['opsi_b'] = Str::limit(trim($soal['opsi_b']), 250);
        $soal['opsi_c'] = Str::limit(trim($soal['opsi_c']), 250);
        $soal['opsi_d'] = Str::limit(trim($soal['opsi_d']), 250);
        $soal['opsi_e'] = Str::limit(trim($soal['opsi_e']), 250);
        return $soal;
    }

    private function initSoalTemplate($modul_id, $pertanyaan)
    {
        return [
            'modul_id' => $modul_id,
            'pertanyaan' => $pertanyaan,
            'opsi_a' => '', 'opsi_b' => '', 'opsi_c' => '', 'opsi_d' => '', 'opsi_e' => '',
            'jawaban_benar' => 'A',
            'kesulitan' => 'sedang',
            'user_id' => Auth::id()
        ];
    }

    public function index(Request $request)
    {
        $query = Soal::where('user_id', Auth::id());

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('pertanyaan', 'like', "%{$search}%");
        }

        if ($request->has('modul_id')) {
            $query->where('modul_id', $request->get('modul_id'));
        }

        $soals = $query->with('modul')->latest()->paginate(10)->withQueryString();
        $moduls = Modul::where('user_id', Auth::id())->get();

        return view('guru.soal.index', compact('soals', 'moduls'));
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

        return redirect()->route('guru.modul.show', $request->modul_id)->with('success', 'Soal berhasil ditambahkan ke modul.');
    }

    public function edit(Soal $soal)
    {
        if ((int) $soal->user_id !== (int) Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $moduls = Modul::where('user_id', Auth::id())->get();
        return view('guru.soal.edit', compact('soal', 'moduls'));
    }

    public function update(Request $request, Soal $soal)
    {
        if ((int) $soal->user_id !== (int) Auth::id()) {
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

        return redirect()->route('guru.modul.show', $soal->modul_id)->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Soal $soal)
    {
        if ((int) $soal->user_id !== (int) Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $modul_id = $soal->modul_id;
        if ($soal->gambar) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($soal->gambar);
        }
        $soal->delete();
        return redirect()->route('guru.modul.show', $modul_id)->with('success', 'Soal berhasil dihapus.');
    }

    public function kunciJawaban()
    {
        $soals = Soal::where('user_id', Auth::id())->get();
        return view('guru.soal.kunci_jawaban', compact('soals'));
    }

    public function show(Soal $soal)
    {
        if ((int) $soal->user_id !== (int) Auth::id()) {
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

}
