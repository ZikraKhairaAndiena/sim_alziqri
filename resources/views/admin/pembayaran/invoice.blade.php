<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        table, th, td { border: 1px solid black; }
    </style>
</head>
<body>

<!-- Kop Surat -->
<div style="text-align: center; margin-bottom: 20px;">
    <img src="{{ public_path('img/kop.png') }}" style="width: 100%; max-width: 900px;">
</div>

<!-- Judul Invoice -->
<table style="width: 100%; margin-bottom: 20px; border: none;">
    <tr>
        <td style="border: none;">
            <h2 style="margin: 0;">INVOICE PEMBAYARAN</h2>
            <small>Tanggal: {{ date('d/m/Y', strtotime($pembayaran->created_at)) }}</small>
        </td>
        <td style="text-align: right; border: none;">
            <strong>ID Invoice:</strong> {{ $pembayaran->order_id }}<br>
            <span style="text-transform: uppercase;">{{ $pembayaran->status_bayar }}</span>
        </td>
    </tr>
</table>

<!-- Data Siswa -->
<h3 style="margin-bottom: 5px;">Data Siswa</h3>
<table>
    <tr>
        <td><strong>Nama Siswa</strong></td>
        <td>{{ $pembayaran->siswa->nama_siswa ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>NISN</strong></td>
        <td>{{ $pembayaran->siswa->nisn ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>Kelas</strong></td>
        <td>{{ $pembayaran->siswa->kelas->nama_kelas ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>Tahun Ajaran</strong></td>
        <td>{{ $pembayaran->siswa->ppdb->thn_ajaran->nama ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>Orang Tua</strong></td>
        <td>{{ $pembayaran->siswa->nama_wali ?? '-' }}</td>
    </tr>
</table>

<!-- Rincian Pembayaran -->
<h3 style="margin-top: 20px;">Rincian Pembayaran</h3>
<table>
    <tr>
        <th>Deskripsi</th>
        <th>Jumlah</th>
    </tr>
    <tr>
        <td>Total Tagihan</td>
        <td style="text-align: right;">Rp {{ number_format($total_tagihan, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td>Pembayaran SPP</td>
        <td style="text-align: right;">Rp {{ number_format($jumlah_bayar, 0, ',', '.') }}</td>
    </tr>

    <tr>
        <td>Sisa Tagihan</td>
        <td style="text-align: right;">Rp {{ number_format($sisa_tagihan, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td><strong>Total Dibayar</strong></td>
        <td style="text-align: right;"><strong>Rp {{ number_format($total_dibayar, 0, ',', '.') }}</strong></td>
    </tr>

</table>

<!-- Tanda Tangan Kepala Sekolah -->
<div style="width: 100%; margin-top: 50px;">
    <div style="float: right; text-align: center; margin-right: 50px;">
        <p>Padang, {{ date('d/m/Y', strtotime($pembayaran->created_at)) }}</p>
        <p>Kepala Sekolah</p>
        <img src="{{ public_path('img/ttd_kepsek.png') }}" style="width: 150px; height: auto; margin: 10px 0;">
        <br>
        <u><strong>{{ $kepsek->nama_guru ?? 'Nama Kepala Sekolah' }}</strong></u><br>
            NIP. {{ $kepsek->nip ?? '123456789' }}
    </div>
</div>

<div style="clear: both;"></div>

<p style="margin-top: 30px;">
    Terima kasih telah melakukan pembayaran.<br>
    Harap simpan invoice ini sebagai bukti pembayaran yang sah.
</p>

</body>
</html>
