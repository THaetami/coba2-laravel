@extends('layouts.main')
@section('container')


    <div class="row justify-content-center">

        <div class="col-lg-8 mt-4 mb-2">
            <form action="/" method="get">
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}" id="search">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>


    <div class="row justify-content-center">
    @auth
        <div class="col-lg-8 mt-1 mb-2">
                <div class="vstack gap-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat"> Buat Puisi</button>
                </div>
            <div class="modal fade m-0" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header m-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form  method="post" action="/" class="mb-3" enctype="multipart/form-data">
                                @csrf
                                <div class="card card-body p-1">
                                    <input type="text" class="text-center border-0" name="title" id="title" placeholder="Tulis judul puisi disini.." value="{{ request('title') }}">
                                </div>
                                <div class="card card-body p-1">
                                    <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                                    <trix-editor input="body" placeholder="Tulis puisimu disini.."></trix-editor>
                                </div>
                                <div class="card card-body p-1"><button type="submit" class="badge bg-primary border-0 m-1">Posting</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
    </div>



    @if($posts->count())

        @foreach ($posts as $post)

        <div class="row justify-content-center">

            <div class="col-lg-8 mt-2 mb-2">
                <div class="card text-dark bg-light">

                    <div class="card-header m-0">
                        <img src="gambar/tatang.jpg" width="30" class="img-thumbnile rounded-circle"><a href="/?author={{ $post->author->username }}" class="text-decoration-none text-black"> {{ $post->author->name }} | </a><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                    </div>

                    <div class="kontainer lh-sm">
                        <h5 class="card-title text-center mb-4">{{ $post->title }}</h5>
                        {!! $post->body !!}
                    </div>

                    @auth
                    <form  method="post" action="/dashboard/posts" class="mb-1" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating card card-body p-1">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Comments</label>
                        </div>
                        <button type="submit" class="badge bg-primary border-0 m-1">Komentari</button>
                    </form>
                     @endauth

                    <div class="card-footer mb-0 pt-3 pb-0 text-end">
                        <p>
                            <a class="btn-sm btn-primary text-decoration-none mt-2" data-bs-toggle="collapse" href="#postingan{{ $post->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Lihat / Tutup Komentar
                            </a>
                        </p>
                        <div class="collapse text-start" id="postingan{{ $post->id }}">
                            <div class="card card-body mb-3 p-2">
                                <a href="#" class="text-decoration-none text-primary">{{ $post->author->name }}</a>
                                placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant
                            </div>
                            <p>
                                <a class="btn-sm btn-primary text-decoration-none mt-2" data-bs-toggle="collapse" href="#postingan{{ $post->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Lihat / Tutup Komentar
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



         @endforeach


            {{-- <div class="text-dark text-end bg-light">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat"> Buat Puisi</button>
            </div> --}}


    @else
        <p class="text-center fs-4">No Post Found</p>
    @endif


    <script>
        //menonaktifkan fungsi mengupload gambar pada trix editor
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault;
        });
    </script>

@endsection
