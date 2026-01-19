@extends('admin.layouts.main')

@section('title', 'Tambah Kriteria Penilaian')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center fw-bold mb-4">Tambah Kriteria Penilaian</h2>

                        <form action="{{ route('admin.kriteria.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                                <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('admin.kriteria.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
