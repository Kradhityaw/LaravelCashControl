@extends('layouts.master')

@section('content')
    <div class="container">

        <div class="row d-flex align-items-center">
            <div class="col">
                <h1 class="mt-4 text-black">Grup</h1>
                <p class="fs-5">Gabungkan keluarga atau kerabat di grup untuk mengatur keuangan bersama</p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Anggota Grup
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped align-middle table-bordered" id="tableDashboard">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Saldo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->users as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        @foreach ($item->roles as $rol)
                                            <td>{{ $rol->role }}</td>
                                        @endforeach
                                        <td>{{ 'Rp ' . number_format($item->saldo, 0, ',', '.') }}</td>
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
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Konfirmasi Penghapusan</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
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
@endsection
