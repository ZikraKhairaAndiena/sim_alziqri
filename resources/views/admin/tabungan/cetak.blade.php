<div style="text-align: center; margin-bottom: 20px;">
    <img src="{{ public_path('img/kop.png') }}" style="width: 100%; max-width: 900px;">
</div>

<h3 style="text-align:center; margin-bottom:20px;">
    Riwayat Tabungan <br> {{ $siswa->nama_siswa }}
</h3>

<table border="1" cellspacing="0" cellpadding="6" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tabungans as $i => $tabungan)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ date('d/m/Y', strtotime($tabungan->tanggal)) }}</td>
                <td>Rp {{ number_format($tabungan->jumlah,0,',','.') }}</td>
                <td>{{ $tabungan->ket }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align:center;">Belum ada data tabungan</td>
            </tr>
        @endforelse
    </tbody>

    @if($tabungans->count() > 0)
    <tfoot>
        <tr>
            <td colspan="2" style="text-align:center;"><strong>Total</strong></td>
            <td colspan="2"><strong>Rp {{ number_format($tabungans->sum('jumlah'),0,',','.') }}</strong></td>
        </tr>
    </tfoot>
    @endif
</table>

{{-- Tanda Tangan Kepala Sekolah --}}
<div style="width: 100%; margin-top: 50px;">
    <div style="float: right; text-align: center; margin-right: 50px;">
        <p>Padang, {{ date('d/m/Y') }}</p>
        <p>Kepala Sekolah</p>
        <img src="{{ public_path('img/ttd_kepsek.png') }}" style="width: 150px; height: auto; margin: 10px 0;">
        <br>
        <u><strong>{{ $kepsek->nama_guru ?? 'Nama Kepala Sekolah' }}</strong></u><br>
        NIP. {{ $kepsek->nip ?? '-' }}
    </div>
</div>
