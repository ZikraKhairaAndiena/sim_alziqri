@extends('admin.layouts.main')

@section('title', 'Edit Kriteria Penilaian')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center fw-bold mb-4">Edit Kriteria Penilaian</h2>

                        <form action="{{ route('admin.kriteria.update', $kriteria->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                                <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-control"
                                    value="{{ $kriteria->nama_kriteria }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control">{{ $kriteria->deskripsi }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('admin.kriteria.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
