    <div class="justify-content-center mt-20 fixed-bottom bg-light">
        @auth
            <div class="row justify-content-center">
                <div class="col-lg mb-1 bg-white">
                    <div class="vstack gap-2">
                        <button type="button" class="btn btn-dark bg-black shadow-none" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">{{ Request::is('drakor') ? '+ Tambah Bacotan' : '+ Tambah Puisi' }}</button>
                    </div>
                </div>
            </div>
            <div class="card-footer text-dark text-center border-0 bg-white p-0">
                <a href="#disini" class="text-decoration-none"><i class="bi bi-shift-fill"></i> Kembali Keatas</a>
            </div>
            @else
            <div class="card-footer text-white text-center border-0 bg-black">
                ©{{ date("Y") }} Copyright:
                <a class="text-decoration-none text-white" href="https://pengepulaksara.com/">pengepulaksara.com</a> | <a href="#disini" class="text-decoration-none"><i class="bi bi-shift-fill"></i>{{ Request::is('/') ? 'Kembali Keatas' : '' }}</a>
            </div>
        @endauth
    </div>
