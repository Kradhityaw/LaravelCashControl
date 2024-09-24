@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col">
                <h1 class="mt-4 text-black">Dashboard</h1>
                <p class="fs-5">Disini tempatmu mengatur keuanganmu</p>
            </div>
            <div class="col d-flex justify-content-end">
                <div class="dropdown-center">
                    <button class="btn btn-outline-primary dropdown-toggle px-4" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Tambah Transaksi
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/transaksiViewCreate/pemasukan">Pemasukan</a></li>
                        <li><a class="dropdown-item" href="/transaksiViewCreate/pengeluaran">Pengeluaran</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center">
                                <p class="mb-1">Saldo</p>
                                <h4 class="mb-0" id="saldo"></h4>
                            </div>
                            <div class="col text-center">
                                <p class="mb-1">Pemasukan</p>
                                <h4 class="mb-0" id="pemasukan"></h4>
                            </div>
                            <div class="col text-center">
                                <p class="mb-1">Pengeluaran</p>
                                <h4 class="mb-0" id="pengeluaran"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-2">
            <div class="col">
                @if (session('pesan'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div>{{ session('pesan') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Data Transaksi
                    </div>
                    <div class="card-body table-responsive">

                        <div class="row">
                            <div class="col-3">
                                <div class="d-flex align-items-center">
                                    <label for="customFilter" class="me-0 mb-0 w-100">Tipe Transaksi :</label>
                                    <select id="customFilter" class="form-select form-select-sm"
                                        aria-label="Default select example">
                                        <option value="">Semua</option>
                                        <option value="Pemasukan">Pemasukan</option>
                                        <option value="Pengeluaran">Pengeluaran</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <table class="table table-striped align-middle table-bordered" id="tableDashboard">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Tanggal Transaksi</th>
                                        <th scope="col">Nominal Transaksi</th>
                                        <th scope="col">Tipe Transaksi</th>
                                        <th scope="col">Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->tanggal_transaksi }}</td>
                                            <td>{{ 'Rp ' . number_format($item->nominal_transaksi, 0, ',', '.') }}</td>
                                            <td>{{ $item->tipe_transaksi }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td class="mx-auto">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('edit-transaksi', $item->id) }}"
                                                        class="btn btn-primary px-4 btn-sm">Edit</a>
                                                    <form action="{{ route('proses-delete-transaksi', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="button" class="btn btn-danger px-4 btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#{{ $item->id }}">
                                                            Hapus
                                                        </button>

                                                        <div class="modal fade" id="{{ $item->id }}" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="exampleModalLabel">
                                                                            Konfirmasi Penghapusan</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Apakah kamu yakin mau menghapus transaksi ini?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Yakin</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let saldo = @json($saldo);
        let pemasukan = @json($pemasukan);
        let pengeluaran = @json($pengeluaran);
    </script>
@endsection
