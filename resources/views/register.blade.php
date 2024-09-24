@include('layouts.header')
<div
    style="background: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)) ,url('{{ asset('images/bluemoney.jpg') }}'); background-size: cover;">
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="row p-5 rounded border-dark-subtle"
            style="backdrop-filter: blur(3px); background: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3));">
            <div class="col d-flex justify-content-center flex-column">
                <h1 class="fs-1 text-white mb-3">Daftar CashControl</h1>
                <p class="fs-5 text-white">Atur keuangan anda dengan mudah dan rapi, dengan CashControl seluruh masalah
                    keuangan
                    anda bisa
                    terselesaikan </p>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header fs-3 text-black fw-semibold">
                        Register
                    </div>
                    <div class="card-body">
                        <form action="{{ route('process-register') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <div>{{ $errors->first() }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-2 mb-3">Login</button>
                            <label for="">Sudah Punya akun? <a href="{{ route('login') }}">Masuk sekarang!</a></label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@include('layouts.footer')
