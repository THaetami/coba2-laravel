    <div class="justify-content-center mt-20 fixed-bottom bg-light">
        @auth
            <div class="row justify-content-center">
                <div class="col-lg mb-1 bg-white">
                    <div class="vstack gap-2">
                        <button type="button" class="btn btn-dark bg-black shadow-none" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">+ Tambah Sastra</button>
                    </div>
                </div>
            </div>
            <a href="#disini" class="text-decoration-none"><div class="card-footer text-primary text-center border-0 bg-white p-0">
                <i class="bi bi-shift-fill"></i> Back to top
            </div></a>
            @else
            <div class="card-footer text-white text-center border-0 bg-black">
                ©{{ date("Y") }} -
                <a class="text-decoration-none text-white" href="/">pengepulaksara.com</a> | <a href="#disini" class="text-decoration-none"><i class="bi bi-shift-fill"></i>{{ Request::is('/') ? ' Back to top' : '' }}</a>
            </div>
        @endauth
    </div>
