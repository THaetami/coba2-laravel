@extends('layouts.main')
@section('container')

    <div class="row justify-content-center mb-0 mt-5" id="disini">
        <div class="col-lg-6 m-0">
            <img src="{{ asset('storage/default/pembatas.png') }}" class="img-fluid" alt="Responsive image">
        </div>
    </div>

    @if (session()->has('success'))
        <div class="row justify-content-center">
            <div class="col-lg-6 mt-2 mb-0">
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif


    <div class="row justify-content-center">
    @auth
        <div class="col-lg-6 mt-3 mb-0">
                <div class="vstack gap-2 mt-1 mb-1">
                    <button type="button" class="btn btn-dark bg-black shadow-none" id="tambah" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">+ Tambah Sastra</button>
                </div>
            <div class="modal fade m-0" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header m-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form  method="post" action="/posting" class="mb-3" enctype="multipart/form-data">
                                @csrf
                                <div class="card card-body p-1">
                                    <input type="text" class="text-center border-0 @error('title') is-invalid @enderror" name="title" id="title" placeholder="Tulis judul puisi disini.." value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="card card-body p-1">
                                    <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                                    <trix-editor input="body" placeholder="Tulis puisimu disini.." required></trix-editor>
                                    @error('body')
                                        <p class="text-danger m-0">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="card card-body p-1"><button type="submit" class="badge bg-black border-0 m-1">Posting</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
    </div>


    <div class="row justify-content-center" id="disin">
            <div class="col-lg-6 mt-2 mb-1">
            <form action="/" method="get">
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-2 mt-3">
                    <button class="btn btn-dark bg-black" type="submit"><i class="bi bi-search"></i></button>
                    <input type="text" class="form-control shadow-none border-dark" placeholder="{{ (request('author')) ? 'Cari judul atau penggalan sastra..' : 'Cari Penulis, Judul atau Penggalan sastra..' }}" name="search" value="{{ request('search') }}">
                </div>
            </form>
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-lg-6 mt-2 mb-2">
            @if (request('author'))
                <h3><a class="text-primary" role="button"><i class="bi bi-arrow-left-circle" onclick="goBack()"></i></a> {{ ucfirst(trans($judul)) }}</h3>
                <hr>
            @elseif (request('search'))
                <h3><a class="text-primary" href="/"><i class="bi bi-arrow-left-circle"></i></a> Hasil pencarian "{{ request('search') }}"</h3>
                <hr>
            @endif
        </div>
    </div>


    @if($posts->count())
        @foreach ($posts as $post)
            <div class="row justify-content-center">

                <div class="col-lg-6 mt-0 ">
                    <div class="card text-dark bg-light mb-1">

                        <div class="card-header m-0 bg-black">
                            @if($post->author->image)
                                <img src="{{ asset('storage/upload/' . $post->author->image) }}" width="30" class="img-thumbnile rounded-circle"><a href="/?author={{ $post->author->username }}" class="text-decoration-none text-white"> {{ ucwords(trans($post->author->name)) }} | </a><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            @else
                                <img src="{{ asset('storage/default/noImage.jpg') }}" width="30" class="img-thumbnile rounded-circle"><a href="/?author={{ $post->author->username }}" class="text-decoration-none text-white"> {{ ucwords(trans($post->author->name)) }} | </a><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            @endif
                        </div>


                        <div class="kontainer lh-sm">
                            @auth
                                @if($post->author_id == auth()->user()->id)
                                    <div class="nav-item dropdown">
                                        <a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="text-decoration-none">
                                            <i class="bi bi-gear"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <li class="nav-item bg-danger">
                                                    <form action="/delete/{{ $post->romlah }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Yakin dihapus?')"><i class="bi bi-file-x"></i> <b>Delete Puisi</b></button>
                                                    </form>
                                                </li>
                                        </ul>
                                    </div>
                                @endif
                            @endauth

                            @guest
                                <marquee direction="left" scrollamount="2" align="center" class="p-1">Silahkan login untuk berkomentar!!</marquee>
                            @endguest

                            {{-- <a href="/sastra/{{ $post->id }}" class="text-decoration-none text-dark"> --}}
                            <h5 class="card-title text-center mb-3 mx-3 text-decoration-none">{{ $post->title }}</h5>
                            {!! $post->body !!}
                            {{-- </a> --}}

                            @auth
                                <form method="post" action="/" class="mt-3" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-floating card card-body p-0">
                                        <input type="hidden" name="puisi_id" value="{{ $post->id }}">
                                        <input id="comentar{{ $post->id }}" type="hidden" name="comentar" required>
                                        <trix-editor input="comentar{{ $post->id }}" placeholder="Komentar disini.."></trix-editor>
                                        @error('comentar')
                                            <p class="text-danger m-0 mx-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="badge bg-black border-0 mt-2 mx-1">Kirim</button>
                                </form>
                            @endauth

                        </div>


                        @if ($post->comentary->count())
                            <div class="card-footer mb-0 pt-2 p-2 pb-0 text-end bg-light">
                                <p>
                                    <a class="badge btn-dark bg-black text-decoration-none mt-0 mb-0 shadow-none" type="submit" data-bs-toggle="collapse" href="#postingan{{ $post->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        {{ $post->comentary->count('puisi_id') }} Komentar
                                    </a>
                                </p>

                                <div class="collapse text-start" id="postingan{{ $post->id }}">

                                    @foreach ( $post->comentary as $coment)
                                        <div class="card card-body mb-0 mt-2 p-0">
                                            <span class="p-1 mb-1 border-bottom mx-1">
                                                @if($coment->author->image)
                                                    <img src="{{ asset('storage/upload/' . $coment->author->image) }}" width="30" class="img-thumbnile rounded-circle"> <a href="/?author={{ $coment->author->username }}" class="text-decoration-none text-primary">{{ ucwords(trans($coment->komentator)) }}</a> <small class="text-muted">{{ $coment->created_at->diffForHumans() }}</small>
                                                @else
                                                    <img src="{{ asset('storage/default/noImage.jpg') }}" width="30" class="img-thumbnile rounded-circle"> <a href="/?author={{ $coment->author->username }}" class="text-decoration-none text-primary">{{ ucwords(trans($coment->komentator)) }}</a> <small class="text-muted">{{ $coment->created_at->diffForHumans() }}</small>
                                                @endif
                                            </span>
                                            <span class="p-1 mx-1 mb-1 mt-1">
                                                {!! $coment->comentar !!}
                                            </span>
                                        </div>
                                    @endforeach

                                    <p>
                                        <a class="badge btn-dark bg-black text-decoration-none mt-2 mb-0 mx-1" data-bs-toggle="collapse" type="submit" href="#postingan{{ $post->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Tutup Komentar
                                        </a>
                                    </p>

                                </div>
                            </div>
                        @else
                            <div class="card-footer m-0 p-3"></div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row justify-content-center mb-4 mt-5">
            <div class="col-lg-4 m-2">
                <img src="{{ asset('storage/default/notfound.png') }}" class="img-fluid" alt="Responsive image">
            </div>
        </div>
    @endif


@endsection


