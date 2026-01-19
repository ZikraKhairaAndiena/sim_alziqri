<table border="1" cellspacing="0" cellpadding="4"
    style="border-collapse:collapse; width:100%; font-family:Calibri,Arial,sans-serif; font-size:11px; text-align:center;">

    @php
        $jumlahKolom = 2 + $tanggal->count() + 4;
    @endphp

    <tr>
        <th colspan="{{ $jumlahKolom }}" style="text-align:center; font-size:16px; font-weight:bold;">
            ABSENSI KELAS {{ $kehadirans->first()->first()->siswa->kelas->nama_kelas ?? '' }} -
            {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F') }} {{ $tahun }}
        </th>
    </tr>

    {{-- header --}}
    <tr style="background:#d9d9d9; font-weight:bold;">
        <th rowspan="2" style="width:35px;">No.</th>
        <th rowspan="2" style="width:220px; text-align:left;">Nama Siswa</th>
        <th colspan="{{ $tanggal->count() }}">TANGGAL</th>
        <th colspan="4">Jumlah</th>
    </tr>
    <tr style="background:#eeeeee; font-weight:bold;">
        @foreach ($tanggal as $t)
            <th style="width:22px;">{{ $t }}</th>
        @endforeach
        <th>H</th>
        <th>S</th>
        <th>I</th>
        <th>A</th>
    </tr>

    @php
        $totalH = $totalS = $totalI = $totalA = 0;
        $rekapPerTanggal = [];
        foreach ($tanggal as $t) {
            $rekapPerTanggal[$t] = ['H' => 0, 'S' => 0, 'I' => 0, 'A' => 0];
        }
    @endphp

    @foreach ($kehadirans as $siswaId => $data)
        @php
            $s = $data->first()->siswa;
            $countH = $countS = $countI = $countA = 0;
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td style="text-align:left; background:#e6e6e6;">{{ $s->nama_siswa }}</td>

            @foreach ($tanggal as $t)
                @php
                    $tgl = sprintf('%04d-%02d-%02d', $tahun, $bulan, $t);
                    $absen = optional($data->firstWhere('tanggal', $tgl))->status ?? '';
                    $absen = strtolower($absen); // biar aman

                    $bg = '';
                    $fc = '#000000';
                    switch ($absen) {
                        case 'hadir':
                            $absen = 'H';
                            $bg = '#92D050';
                            $countH++;
                            $totalH++;
                            $rekapPerTanggal[$t]['H']++;
                            break;
                        case 'sakit':
                            $absen = 'S';
                            $bg = '#00B0F0';
                            $countS++;
                            $totalS++;
                            $rekapPerTanggal[$t]['S']++;
                            break;
                        case 'izin':
                            $absen = 'I';
                            $bg = '#FFD966';
                            $countI++;
                            $totalI++;
                            $rekapPerTanggal[$t]['I']++;
                            break;
                        case 'alpha':
                            $absen = 'A';
                            $bg = '#FF0000';
                            $fc = '#FFFFFF';
                            $countA++;
                            $totalA++;
                            $rekapPerTanggal[$t]['A']++;
                            break;
                        default:
                            $absen = '';
                            $bg = '';
                            $fc = '#000000';
                            break;
                    }
                @endphp
                <td style="background: {{ $bg }}; color: {{ $fc }};">{{ $absen }}</td>
            @endforeach


            <td>{{ $countH }}</td>
            <td>{{ $countS }}</td>
            <td>{{ $countI }}</td>
            <td>{{ $countA }}</td>
        </tr>
    @endforeach

    {{-- baris JUMLAH --}}
    <tr style="font-weight:bold; background:#f2f2f2;">
        <td colspan="2">JUMLAH</td>
        @foreach ($tanggal as $t)
            @php
                $rek = $rekapPerTanggal[$t];
                $isi = $rek['H'] + $rek['S'] + $rek['I'] + $rek['A'];
            @endphp
            <td>{{ $isi }}</td>
        @endforeach
        <td>{{ $totalH }}</td>
        <td>{{ $totalS }}</td>
        <td>{{ $totalI }}</td>
        <td>{{ $totalA }}</td>
    </tr>
</table>
