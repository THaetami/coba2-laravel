    <div class="collapse" id="navbarToggleExternalContent">
        <div class="nav justify-content-center bg-warning text-white">
            <a class="nav-link text-decoration-none text-white p-1" aria-current="page" href="#"><img src="gambar/tatang.jpg" width="50" class="img-thumbnile rounded-circle"></a>
        </div>
    </div>



    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <ul class="navbar-nav mt-2 sticky-xl-top">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">PUISI</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-decoration-none" data-bs-toggle="collapse" href="#navbarToggleExternalContent">AUTHOR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">DRAQOR</a>
            </li>
            @auth
            <li class="nav dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Welcome back, Hyung
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="nav">
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-in-right"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
            @else
            <li class="nav">
                <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="/login">LOGIN</a>
            </li>
            @endauth
        </ul>
    </nav> --}}









    <ul class="nav bg-light justify-content-center mt-2 sticky-xl-top">
        <li class="nav">
            <a class="nav-link {{ Request::is('/') ? 'text-dark' : '' }}" aria-current="page" href="/">PUISI</a>
        </li>
        <li class="nav">
            <a class="nav-link text-decoration-none" data-bs-toggle="collapse" href="#navbarToggleExternalContent">AUTHOR</a>
        </li>
        <li class="nav">
            <a class="nav-link {{ Request::is('/drakor') ? 'text-dark' : '' }}" href="/drakor">DRAQOR</a>
        </li>
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Welcome back, Hyung
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="nav-item">
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-in-right"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
            @else
            <li class="nav">
                <a class="nav-link {{ Request::is('login') ? 'text-dark' : '' }}" href="/login">LOGIN</a>
            </li>
            @endauth
    </ul>


