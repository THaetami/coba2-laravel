    <div class="collapse" id="navbarToggleExternalContent">
        <div class="nav justify-content-center bg-danger text-white">
            <a class="nav-link text-decoration-none text-white p-1" aria-current="page" href="#"><img src="gambar/tatang.jpg" width="50" class="img-thumbnile rounded-circle"></a>
        </div>
    </div>


    <ul class="nav bg-black justify-content-center mt-0 sticky-xl-top">
        <li class="nav">
            <a class="nav-link {{ Request::is('/') ? 'text-danger' : '' }}" aria-current="page" href="/">SASTRA</a>
        </li>
        <li class="nav">
            <a class="nav-link text-decoration-none" data-bs-toggle="collapse" href="#navbarToggleExternalContent">ABOUT</a>
        </li>
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ strtoupper(auth()->user()->name) }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/myprofile"><i class="bi bi-person-circle"></i> My Profile</a></li>
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
                <a class="nav-link {{ Request::is('login') ? 'text-danger' : '' }}" href="/login">LOGIN</a>
            </li>
            @endauth
    </ul>


