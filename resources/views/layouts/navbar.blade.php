<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">CashControl</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('group-view') }}">Grup</a>
                </li>
            </ul>
            <div class="dropdown d-flex align-items-center">
                <a class="nav-link dropdown-toggle me-3 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Hi, {{ Auth::user()->name }}
                </a>
                <img src="{{asset('images/bluemoney.jpg')}}" alt="" width="40" height="40" class="rounded-circle dropdown-toggle" data-bs-toggle="dropdown" style="cursor: pointer">
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start me-3">
                    <form action="{{ route('proses-logout') }}" method="post">
                        @csrf
                        <li><button type="submit" class="dropdown-item" href="{{ route('proses-logout') }}">Logout</button></li>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</nav>
