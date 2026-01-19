@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title">Akses Ditangguhkan</h4>
                        <p class="card-text">
                            Anda belum dapat mengakses fitur ini karena status pendaftaran PPDB masih diproses atau belum
                            diterima.
                        </p>
                        <p>Silahkan tunggu hingga status PPDB Anda berubah menjadi <strong>Diterima</strong>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
