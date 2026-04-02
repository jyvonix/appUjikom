<!DOCTYPE html>
<html>
<head>
    <title>Laporan Nilai Ujian</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #4f46e5; padding-bottom: 20px; }
        .header h1 { margin: 0; color: #4f46e5; font-size: 24px; }
        .header p { margin: 5px 0 0; color: #666; }
        .info { margin-bottom: 20px; }
        .info table { width: 100%; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #f8fafc; color: #475569; font-weight: bold; text-align: left; padding: 12px; border: 1px solid #e2e8f0; }
        td { padding: 12px; border: 1px solid #e2e8f0; }
        .status-lulus { color: #059669; font-weight: bold; }
        .status-remedial { color: #dc2626; font-weight: bold; }
        .footer { text-align: right; margin-top: 50px; }
        .footer p { margin: 0; }
        .signature { margin-top: 60px; border-top: 1px solid #333; display: inline-block; width: 200px; text-align: center; padding-top: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>SMARTEXAM INTELLIGENCE</h1>
        <p>Laporan Hasil Evaluasi Kompetensi Siswa</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td style="border:none; padding:0; width: 15%;">Modul Ujian</td>
                <td style="border:none; padding:0;">: <strong>{{ $modul ? $modul->nama : 'Semua Modul' }}</strong></td>
                <td style="border:none; padding:0; text-align: right;">Tanggal Cetak: {{ date('d/m/Y H:i') }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama Siswa</th>
                <th>Username</th>
                @if(!$modul) <th>Modul</th> @endif
                <th style="text-align: center;">Benar</th>
                <th style="text-align: center;">Skor</th>
                <th style="text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilais as $index => $nilai)
                @php 
                    $kkm = $nilai->modul ? $nilai->modul->getSetting('kkm') : 75;
                    $isLulus = $nilai->skor >= $kkm;
                @endphp
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $nilai->user->name }}</td>
                    <td>{{ $nilai->user->username }}</td>
                    @if(!$modul) <td>{{ $nilai->modul->nama ?? 'N/A' }}</td> @endif
                    <td style="text-align: center;">{{ $nilai->jumlah_benar }}</td>
                    <td style="text-align: center;">{{ number_format($nilai->skor, 1) }}</td>
                    <td style="text-align: center;">
                        <span class="{{ $isLulus ? 'status-lulus' : 'status-remedial' }}">
                            {{ $isLulus ? 'LULUS' : 'REMEDIAL' }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>{{ date('d F Y') }}</p>
        <p>Guru Mata Pelajaran,</p>
        <div class="signature">
            {{ Auth::user()->name }}
        </div>
    </div>
</body>
</html>
