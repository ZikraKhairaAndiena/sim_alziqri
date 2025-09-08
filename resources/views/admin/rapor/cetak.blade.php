<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rapor - {{ $rapor->siswa->nama_siswa ?? '' }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; line-height: 1.5; }
        table { border-collapse: collapse; width: 100%; }
        .no-border td { border: none; padding: 3px; }
        .judul { text-align: center; font-weight: bold; margin-bottom: 10px; }
        .section-title { font-weight: bold; margin: 10px 0 5px; }
        .box-table td { border: 1px solid black; vertical-align: top; padding: 8px; }
        .foto { width: 100%; height: auto; }
        .ttd td { border: none; text-align: center; padding-top: 40px; }
        .refleksi { min-height: 80px; border: 1px solid black; margin-top: 10px; }
    </style>
</head>
<body>

<!-- Kop Surat -->
<div style="text-align: center; margin-bottom: 10px;">
    <img src="{{ public_path('img/kop.png') }}" style="width: 100%; max-width: 900px;">
</div>

<!-- Judul -->
<div class="judul">
    LAPORAN PERKEMBANGAN ANAK <br>
    SEMESTER {{ $rapor->semester }} TAHUN AJARAN {{ $rapor->thnAjaran->nama ?? '-' }} <br>
    TK AL ZIQRI
</div>

<!-- Data Siswa -->
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

<!-- 1. Agama -->
<div class="section-title">1. Perkembangan Nilai Agama dan Budi Pekerti</div>
<table class="box-table">
    <tr>
        <td style="width: 35%; text-align: center;">
            <img src="{{ public_path('img/' . $rapor->foto_agama) }}" class="foto">
        </td>
        <td style="width: 65%; text-align: justify;">
            {!! nl2br(e($rapor->agama)) !!}
        </td>
    </tr>
</table>

<!-- 2. Jati Diri -->
<div class="section-title">2. Jati Diri</div>
<table class="box-table">
    <tr>
        <td style="width: 35%; text-align: center;">
            <img src="{{ public_path('img/' . $rapor->foto_jati_diri) }}" class="foto">
        </td>
        <td style="width: 65%; text-align: justify;">
            {!! nl2br(e($rapor->jati_diri)) !!}
        </td>
    </tr>
</table>

<!-- 3. Literasi -->
<div class="section-title">3. Dasar-dasar Literasi</div>
<table class="box-table">
    <tr>
        <td style="width: 35%; text-align: center;">
            <img src="{{ public_path('img/' . $rapor->foto_literasi) }}" class="foto">
        </td>
        <td style="width: 65%; text-align: justify;">
            {!! nl2br(e($rapor->literasi)) !!}
        </td>
    </tr>
</table>

<!-- 4. STEAM -->
<div class="section-title">4. STEAM</div>
<table class="box-table">
    <tr>
        <td style="width: 35%; text-align: center;">
            <img src="{{ public_path('img/' . $rapor->foto_steam) }}" class="foto">
        </td>
        <td style="width: 65%; text-align: justify;">
            {!! nl2br(e($rapor->steam)) !!}
        </td>
    </tr>
</table>

<!-- Tanda Tangan -->
<table class="ttd" style="margin-top: 20px; width: 100%;">
    <tr>
        <td style="text-align: center;">
            Mengetahui<br>
            Kepala TK
            <br><br>
            {{-- <img src="{{ public_path('img/ttd_kepsek.png') }}" style="width: 100px; height: auto; margin: 10px 0;"> --}}
            <br><br>
            <strong>{{ $kepsek->nama_guru ?? '-' }}</strong><br>
            NIP. {{ $kepsek->nip ?? '-' }}
        </td>
        <td style="text-align: center;">
            Padang, {{ now()->format('d F Y') }}<br>
            Guru Kelompok
            <br><br>
            {{-- <img src="{{ public_path('img/ttd_guru.png') }}" style="width: 100px; height: auto; margin: 10px 0;"> --}}
            <br><br>
            <strong>{{ $guruKelas->nama_guru ?? '-' }}</strong><br>
            NIP. {{ $guruKelas->nip ?? '-' }}
        </td>
    </tr>
</table>

<!-- Refleksi -->
<div style="margin-top: 20px;">
    <strong>Refleksi Orang Tua</strong>
    <div class="refleksi"></div>
    <p>Orang Tua/Wali Murid</p>
    <br><br>
    <p><strong>{{ $rapor->siswa->nama_wali}}</strong></p>
</div>

</body>
</html>
