@extends('admin.layouts.main')

@section('title', 'Detail Informasi')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4 class="fw-bold text-dark mb-0">Detail Informasi</h4>
            </div>
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">

                            {{-- Foto Informasi --}}
                            <div class="text-center">
                                @if ($informasi->gambar)
                                    <img src="{{ asset('img/' . $informasi->gambar) }}" alt="Foto {{ $informasi->judul }}"
                                        class="img-thumbnail mb-3" style="max-width: 300px;">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="Default Foto"
                                        class="img-thumbnail mb-3" style="max-width: 300px;">
                                @endif
                            </div>

                            {{-- Data Informasi --}}
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Judul Informasi</th>
                                        <td>{{ $informasi->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Isi Informasi</th>
                                        <td>
                                            <div style="max-width: 600px; white-space: pre-line;">
                                                {!! nl2br(e($informasi->content)) !!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Kegiatan</th>
                                        <td>{{ \Carbon\Carbon::parse($informasi->tanggal)->format('d-m-Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.informasi.index') }}" class="btn btn-secondary mt-3">
                                    <i class="bx bx-arrow-back me-1"></i> Kembali
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
