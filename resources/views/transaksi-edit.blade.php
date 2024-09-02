@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-4 mt-4 mb-3 fw-light">&laquo;
                    Kembali</a>
                <h1 class="text-black">{{ $halaman }}</h1>
                <p class="fs-5">{{ $halaman }}mu di sini</p>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-3">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        {{ $halaman }}
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <div>{{ $errors->first() }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('proses-edit-transaksi', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="" class="form-label">Nominal</label>
                                <div class="input-group">
                                    <div class="input-group-text">Rp.</div>
                                    <input type="number" class="form-control" name="nominal"
                                        value="{{ $data->nominal_transaksi }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tanggal</label>
                                <input type="datetime-local" class="form-control" name="tanggal"
                                    value="{{ $data->tanggal_transaksi }}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="" cols="30" rows="3" class="form-control">{{ $data->keterangan }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tipe</label>
                                <select class="form-select" aria-label="Default select example" name="tipe">
                                    <option value="Pemasukan" {{ ($data->tipe_transaksi == "Pemasukan") ? 'selected' : '' }}>Pemasukan</option>
                                    <option value="Pengeluaran" {{ ($data->tipe_transaksi == "Pengeluaran") ? 'selected' : '' }}>Pengeluaran</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
