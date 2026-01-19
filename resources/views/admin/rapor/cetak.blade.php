<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rapor - {{ $rapor->siswa->nama_siswa ?? '' }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .no-border td {
            border: none;
            padding: 3px;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .section-title {
            font-weight: bold;
            margin: 10px 0 5px;
        }

        .box-table td {
            border: 1px solid black;
            vertical-align: top;
            padding: 8px;
        }

        .foto {
            width: 100%;
            height: auto;
        }

        .ttd td {
            border: none;
            text-align: center;
            padding-top: 40px;
        }

        .refleksi {
            min-height: 80px;
            border: 1px solid black;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div style="text-align: center; margin-bottom: 10px;">
        <img src="{{ public_path('img/kop.png') }}" style="width: 100%; max-width: 900px;">
    </div>

    <div class="judul">
        LAPORAN PERKEMBANGAN ANAK <br>
        SEMESTER {{ $rapor->semester }} TAHUN AJARAN {{ $rapor->thnAjaran->nama ?? '-' }} <br>
        TK AL ZIQRI
    </div>

    <table class="no-border" style="margin-bottom: 10px;">
        <tr>
            <td style="width: 15%;"><strong>Nama</strong></td>
            <td style="width: 2%;">:</td>
            <td>{{ $rapor->siswa->nama_siswa ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Kelompok</strong></td>
            <td>:</td>
            <td>{{ $rapor->siswa->kelas->nama_kelas ?? '-' }}</td>
        </tr>
    </table>

    @foreach ($rapor->nilaiRapors as $nilai)
        <div class="section-title">{{ $loop->iteration }}. {{ $nilai->kriteria->nama_kriteria }}</div>
        <table class="box-table">
            <tr>
                <td style="width: 35%; text-align: center;">
                    @if ($nilai->foto)
                        <img src="{{ public_path('img/' . $nilai->foto) }}" class="foto">
                    @endif
                </td>
                <td style="width: 65%; text-align: justify;">
                    {!! nl2br(e($nilai->deskripsi)) !!}
                </td>
            </tr>
        </table>
    @endforeach

    <table class="ttd" style="margin-top: 20px; width: 100%;">
        <tr>
            <td style="text-align: center;">
                Mengetahui<br>
                Kepala TK
                <br><br><br><br>
                <strong>{{ $kepsek->nama_guru ?? '-' }}</strong><br>
                NIP. {{ $kepsek->nip ?? '-' }}
            </td>
            <td style="text-align: center;">
                Padang, {{ now()->format('d F Y') }}<br>
                Guru Kelompok
                <br><br><br><br>
                <strong>{{ $guruKelas->nama_guru ?? '-' }}</strong><br>
                NIP. {{ $guruKelas->nip ?? '-' }}
            </td>
        </tr>
    </table>

    <div style="margin-top: 20px;">
        <strong>Refleksi Orang Tua</strong>
        <div class="refleksi"></div>
        <p>Orang Tua/Wali Murid</p>
        <br><br>
        <p><strong>{{ $rapor->siswa->nama_wali }}</strong></p>
    </div>

</body>

</html>
