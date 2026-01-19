@extends('admin.layouts.main')
@section('title', 'Edit Status Pendaftaran')
@section('content')
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark mb-0">Edit Status Pendaftaran</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.ppdb.update', $ppdb->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Diproses" {{ $ppdb->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Diterima" {{ $ppdb->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="Ditolak" {{ $ppdb->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.ppdb.index') }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
