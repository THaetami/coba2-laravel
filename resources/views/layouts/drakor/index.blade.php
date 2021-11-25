<style>
        #trix-toolbar-1 {
            display : none;
        }
</style>
@extends('layouts.main')
@section('container')

    <div class="row justify-content-center">
        <div class="col-lg-6 mt-4 mb-1">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6 mt-4 mb-2">
            <form action="/drakor" method="get">
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-2 mt-0">
                    <input type="text" class="form-control" placeholder="Cari Postingan" name="search" value="{{ request('search') }}" id="search">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>



    <div class="row justify-content-center">
    @auth
        <div class="col-lg-6 mt- mb-2">
                <div class="vstack gap-2 mt-2 mb-2">
                    <button type="button" class="btn btn-primary" id="tambah" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">+ Tambah Bacotan</button>
                </div>
            <div class="modal fade m-0" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header m-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form  method="post" action="/drakor/posting" class="mb-3" enctype="multipart/form-data">
                                @csrf
                                <div class="card card-body p-1">
                                    <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                                    <trix-editor input="body" placeholder="Sok Mangga rek ngemeng naon??" required></trix-editor>
                                    @error('body')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
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

    <div class="row justify-content-center">
        <div class="col-lg-6 mt-4 mb-2">
            <h3>{{ $judul }}</h3>
        </div>
    </div>



    @if($posts->count())

        @foreach ($posts as $post)

        <div class="row justify-content-center mb-1">

            <div class="col-lg-6 mt-2 mb-2">
                <div class="card text-dark bg-light mb-3">

                    <div class="card-header m-0">
                        @if($post->author->image)
                            <img src="{{ asset('storage/upload/' . $post->author->image) }}" width="30" class="img-thumbnile rounded-circle"><a href="/drakor?author={{ $post->author->username }}" class="text-decoration-none text-black"> {{ $post->author->name }} | </a><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                        @else
                            <img src="{{ asset('storage/default/noImage.jpg') }}" width="30" class="img-thumbnile rounded-circle"><a href="/drakor?author={{ $post->author->username }}" class="text-decoration-none text-black"> {{ $post->author->name }} | </a><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>

                        @endif
                    </div>

                    <div class="kontainer lh-sm">
                        @auth
                        @if($post->author_id == auth()->user()->id)
                        <div class="nav-item dropdown mb-3 justify-content-center">
                            <a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle text-decoration-none">
                                <i class="bi bi-gear"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li class="nav-item bg-danger">
                                        <form action="/drakor/delete/{{ $post->romlah }}" method="post">
                                            @csrf
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')"><i class="bi bi-file-x"></i> <b>Delete</b></button>
                                        </form>
                                    </li>
                            </ul>
                        </div>
                        @endif
                        @endauth


                        {!! $post->body !!}

                    </div>

                    @auth
                    <form method="post" action="/drakor" class="mb-1" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating card card-body p-1">
                            <input type="hidden" name="drakor_id" value="{{ $post->id }}">
                            <textarea id="body_komentar" name="comentar" placeholder="Komentari disini" class="p-1"></textarea>
                            @error('comentar')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" id="submit" class="badge bg-primary border-0 m-1">Komentari</button>
                    </form>
                     @endauth

                    @if ($post->comentary_drakor->count())
                    <div class="card-footer mb-0 pt-3 pb-0 text-end">
                        <p>
                            <a class="badge btn-primary text-decoration-none mt-0 mb-0" type="submit" data-bs-toggle="collapse" href="#postingan{{ $post->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                {{ $post->comentary_drakor->count('drakor_id') }} Komentar
                            </a>
                        </p>
                        <div class="collapse text-start" id="postingan{{ $post->id }}">

                            @foreach ( $post->comentary_drakor as $coment)

                            <div class="card card-body mb-0 mt-2 p-2 border-bottom">
                                <p>
                                    @if($coment->author->image)
                                        <img src="{{ asset('storage/upload/' . $coment->author->image) }}" width="30" class="img-thumbnile rounded-circle"> <a href="/drakor?author={{ $coment->author->username }}" class="text-decoration-none text-primary">{{ $coment->komentator }}</a> <small class="text-muted">{{ $coment->created_at->diffForHumans() }}</small>
                                    @else
                                        <img src="{{ asset('storage/default/noImage.jpg') }}" width="30" class="img-thumbnile rounded-circle"> <a href="/drakor?author={{ $coment->author->username }}" class="text-decoration-none text-primary">{{ $coment->komentator }}</a> <small class="text-muted">{{ $coment->created_at->diffForHumans() }}</small>
                                    @endif
                                </p>
                                {{ $coment->comentar }}
                            </div>

                            @endforeach
                            <p>
                                <a class="badge btn-primary text-decoration-none mt-3 mb-0" data-bs-toggle="collapse" type="submit" href="#postingan{{ $post->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Tutup Komentar
                                </a>
                            </p>
                        </div>
                    </div>
                    @else
                    <div class="card-footer mb-0 pt-4 pb-4 text-end"></div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach




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


