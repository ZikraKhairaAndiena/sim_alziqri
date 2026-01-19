@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark mb-0">Tambah Kehadiran</h4>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Form pilih kelas --}}
            <div class="card-body">
                <form method="GET" action="{{ route('admin.kehadiran.create') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="kelas_id" class="form-label">Pilih Kelas<span class="text-danger">*</span></label>
                            <select name="kelas_id" id="kelas_id"
                                class="form-select @error('kelas_id') is-invalid @enderror" required
                                onchange="this.form.submit()">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelass as $k)
                                    <option value="{{ $k->id }}"
                                        {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </form>

                @if (isset($siswas) && count($siswas) > 0)
                    {{-- Form input kehadiran --}}
                    <form method="POST" action="{{ route('admin.kehadiran.store') }}">
                        @csrf
                        <input type="hidden" name="kelas_id" value="{{ request('kelas_id') }}">

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal<span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" id="tanggal"
                                class="form-control @error('tanggal') is-invalid @enderror"
                                value="{{ old('tanggal', date('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Hadir</th>
                                        <th>Izin</th>
                                        <th>Sakit</th>
                                        <th>Alpha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $i => $siswa)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $siswa->nama_siswa }}</td>
                                            @php
                                                $oldStatus = old("status.{$siswa->id}", 'hadir');
                                            @endphp
                                            <td>
                                                <input type="radio" name="status[{{ $siswa->id }}]" value="hadir"
                                                    {{ $oldStatus == 'hadir' ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <input type="radio" name="status[{{ $siswa->id }}]" value="izin"
                                                    {{ $oldStatus == 'izin' ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <input type="radio" name="status[{{ $siswa->id }}]" value="sakit"
                                                    {{ $oldStatus == 'sakit' ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <input type="radio" name="status[{{ $siswa->id }}]" value="alpha"
                                                    {{ $oldStatus == 'alpha' ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3 d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.kehadiran.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Kehadiran</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
