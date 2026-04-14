<!DOCTYPE html>
<html>
<head>
    <title>Laporan Nilai Ujian - Admin</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #4f46e5; padding-bottom: 20px; }
        .header h1 { margin: 0; color: #4f46e5; font-size: 22px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; color: #666; font-size: 14px; }
        .info { margin-bottom: 20px; }
        .info table { width: 100%; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #f8fafc; color: #475569; font-weight: bold; text-align: left; padding: 10px; border: 1px solid #e2e8f0; text-transform: uppercase; font-size: 10px; }
        td { padding: 10px; border: 1px solid #e2e8f0; }
        .text-center { text-align: center; }
        .status-lulus { color: #059669; font-weight: bold; }
        .status-remedial { color: #dc2626; font-weight: bold; }
        .footer { text-align: right; margin-top: 50px; }
        .footer p { margin: 0; }
        .signature { margin-top: 60px; border-top: 1px solid #333; display: inline-block; width: 200px; text-align: center; padding-top: 5px; font-weight: bold; }
        .badge { padding: 2px 6px; border-radius: 4px; font-size: 9px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>SMARTEXAM INTELLIGENCE</h1>
        <p>Laporan Rekapitulasi Hasil Ujian Nasional (ADMIN PANEL)</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td style="border:none; padding:0; width: 15%;">Modul Ujian</td>
                <td style="border:none; padding:0;">: <strong>{{ $modul ? $modul->nama : 'SEMUA MODUL' }}</strong></td>
                <td style="border:none; padding:0; text-align: right;">Tanggal Cetak: {{ date('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td style="border:none; padding:0;">Otoritas</td>
                <td style="border:none; padding:0;">: Administrator Sistem</td>
                <td style="border:none; padding:0;"></td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 30px;">No</th>
                <th>Siswa</th>
                <th>Username</th>
                @if(!$modul) <th>Modul</th> @endif
                <th class="text-center">Benar</th>
                <th class="text-center">Skor</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilais as $index => $nilai)
                @php 
                    $kkm = $nilai->modul ? $nilai->modul->getSetting('kkm') : 75;
                    $isLulus = $nilai->skor >= $kkm;
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $nilai->user->name }}</strong><br>
                        <small style="color: #666;">{{ $nilai->user->email }}</small>
                    </td>
                    <td>{{ $nilai->user->username }}</td>
                    @if(!$modul) <td>{{ $nilai->modul->nama ?? 'N/A' }}</td> @endif
                    <td class="text-center">{{ $nilai->jumlah_benar }}</td>
                    <td class="text-center" style="font-weight: bold;">{{ number_format($nilai->skor, 1) }}</td>
                    <td class="text-center">
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
        <p>Administrator Sistem,</p>
        <div class="signature">
            {{ Auth::user()->name }}
        </div>
    </div>
</body>
</html>