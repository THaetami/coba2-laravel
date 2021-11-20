    <div class="justify-content-center mt-10 fixed-bottom bg-light mt-1">
        @auth
        <div class="row justify-content-center">
            <div class="col-lg mt-0 mb-1 bg-white">
                <div class="vstack gap-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">{{ Request::is('drakor') ? '+ Tambah Bacotan' : '+ Tambah Puisi' }}</button>
                </div>
            </div>
        </div>
        <div class="card-footer text-dark text-center border-0">
            <a href="#tambah" class="text-decoration-none"><i class="bi bi-shift-fill"></i> Kembali Keatas</a>
        </div>
        @else
        <div class="card-footer text-dark text-center border-0">
            ©{{ date("Y") }} Copyright:
            <a class="text-decoration-none text-dark" href="https://tatang/portofolio.com/">tatang.portofolio.com</a> | <a href="#search" class="text-decoration-none"><i class="bi bi-shift-fill"></i> Kembali Keatas</a>
        </div>
        @endauth
    </div>
