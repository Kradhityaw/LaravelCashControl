@include('layouts.header')
<div
    style="background: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)) ,url('{{ asset('images/bluemoney.jpg') }}'); background-size: cover;">
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="row p-5 rounded border-dark-subtle"
            style="backdrop-filter: blur(3px); background: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3));">
            <div class="col d-flex justify-content-center flex-column">
                <h1 class="fs-1 text-white mb-3">Setup CashControl</h1>
                <p class="fs-5 text-white">Atur keuangan anda dengan mudah dan rapi, dengan CashControl seluruh masalah
                    keuangan
                    anda bisa
                    terselesaikan </p>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header fs-3 text-black fw-semibold">
                        Setup
                    </div>
                    <div class="card-body">
                        <form action="{{ route('process-setup', ) }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <div>{{ $errors->first() }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="" class="form-label">Nama</label>
                                <input type="text" id="email" class="form-control" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Saldo</label>
                                <input type="number" id="email" class="form-control" name="saldo">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-2 mb-3">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@include('layouts.footer')
