<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pendaftaran</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .kop { width: 100%; text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #000; padding: 8px; text-align: left; }
        .foto { margin-top: 20px; }
        .foto img { width: 120px; height: auto; margin-right: 15px; border: 1px solid #000; }
    </style>
</head>
<body>

    {{-- Kop Surat --}}
    <div class="kop">
        <img src="{{ public_path('img/kop.png') }}" style="width: 100%; height: auto;">
    </div>

    <div class="header">
        <h2>Formulir Pendaftaran Siswa Baru</h2>
        <p>TK Al-Ziqri</p>
        <hr>
    </div>

    {{-- Data Pendaftaran --}}
    <table class="table">
        <tr>
            <th>Tahun Ajaran</th>
            <td>{{ $ppdb->thn_ajaran->nama }}</td>
        </tr>
        <tr>
            <th>Nama Siswa</th>
            <td>{{ $ppdb->siswa->nama_siswa }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $ppdb->siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td>{{ $ppdb->siswa->tmp_lahir }}, {{ \Carbon\Carbon::parse($ppdb->siswa->tgl_lahir)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Agama</th>
            <td>{{ ucfirst($ppdb->siswa->agama) }}</td>
        </tr>
        <tr>
            <th>Suku Bangsa</th>
            <td>{{ $ppdb->siswa->suku_bangsa }}</td>
        </tr>
        <tr>
            <th>Anak Ke</th>
            <td>{{ $ppdb->siswa->anak_ke }}</td>
        </tr>
        <tr>
            <th>Jumlah Saudara Kandung</th>
            <td>{{ $ppdb->siswa->jmlh_saudara_kandung }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $ppdb->siswa->alamat }}</td>
        </tr>
        <tr>
            <th>Tempat Tinggal</th>
            <td>{{ ucfirst($ppdb->siswa->tmp_tinggal) }}</td>
        </tr>
        <tr>
            <th>No NIK</th>
            <td>{{ $ppdb->siswa->no_nik }}</td>
        </tr>
        <tr>
            <th>No KK</th>
            <td>{{ $ppdb->siswa->no_kk }}</td>
        </tr>
        <tr>
            <th>No Akte</th>
            <td>{{ $ppdb->siswa->no_akte }}</td>
        </tr>
        <tr>
            <th>Nama Wali</th>
            <td>{{ $ppdb->siswa->nama_wali }}</td>
        </tr>
        <tr>
            <th>No Telepon</th>
            <td>{{ $ppdb->siswa->no_telp }}</td>
        </tr>
        <tr>
            <th>Tanggal Daftar</th>
            <td>{{ \Carbon\Carbon::parse($ppdb->tgl_daftar)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Status Pendaftaran</th>
            <td><strong>{{ strtoupper($ppdb->status) }}</strong></td>
        </tr>
    </table>

    {{-- Foto Dokumen --}}
    <div class="foto">
        <p><strong>Dokumen Pendukung:</strong></p>
        @if($ppdb->siswa->foto)
            <div class="dokumen">
                <p>Foto Siswa:</p>
                <img src="{{ public_path('img/'.$ppdb->siswa->foto) }}" alt="Foto Siswa">
            </div>
        @endif
        @if($ppdb->siswa->foto_kk)
            <div class="dokumen">
                <p>Kartu Keluarga:</p>
                <img src="{{ public_path('img/'.$ppdb->siswa->foto_kk) }}" alt="Foto KK">
            </div>
        @endif
        @if($ppdb->siswa->foto_akte)
            <div class="dokumen">
                <p>Akte Kelahiran:</p>
                <img src="{{ public_path('img/'.$ppdb->siswa->foto_akte) }}" alt="Foto Akte">
            </div>
        @endif
    </div>

    {{-- Tanda Tangan Kepala Sekolah --}}
    <div style="width: 100%; margin-top: 60px;">
        <div style="float: right; text-align: center; margin-right: 50px;">
            <p>Padang, {{ now()->format('d/m/Y') }}</p>
            <p>Kepala Sekolah</p>
            <img src="{{ public_path('img/ttd_kepsek.png') }}" style="width: 150px; height: auto; margin: 10px 0;">
            <br>
            <u><strong>{{ $kepsek->nama_guru ?? 'Nama Kepala Sekolah' }}</strong></u><br>
            NIP. {{ $kepsek->nip ?? '123456789' }}
        </div>
    </div>

</body>
</html>


<style>
    .foto { margin-top: 20px; }
.foto .dokumen { margin-bottom: 25px; }
.foto img {
    width: 100%;   /* penuh selebar halaman */
    max-width: 500px; /* batas maksimal biar ga pecah */
    height: auto;
    border: 1px solid #000;
    display: block;
    margin-top: 10px;
}
</style>
