@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-4 mt-4 mb-3 fw-light">&laquo; Kembali</a>
                <h1 class="text-black">Tambah {{ $halaman }}</h1>
                <p class="fs-5">Masukkan {{ $halaman }}mu di sini</p>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-3">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Tambah {{ $halaman }}
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <div>{{ $errors->first() }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('proses-tambah-transaksi', $type) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Nominal</label>
                                <div class="input-group">
                                    <div class="input-group-text">Rp.</div>
                                    <input type="number" class="form-control" name="nominal">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tanggal</label>
                                <input type="datetime-local" class="form-control" name="tanggal">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
