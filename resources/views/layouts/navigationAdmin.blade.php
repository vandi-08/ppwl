<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme">
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <span class="fw-bold fs-4">Admin Dashboard</span>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    {{ Auth::user()->name }}
                </a>
            </li>

            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger btn-sm">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
