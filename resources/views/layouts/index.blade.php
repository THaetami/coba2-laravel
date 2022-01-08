<style>
    #trix-toolbar-1 {
        display : inline;
    }

    trix-toolbar {
        display : none;
    }
</style>
@extends('layouts.main')
@section('container')

    <div class="row justify-content-center">
        <div class="col-lg-6 mt-4 mb-2">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        </div>
    </div>

    <div class="row justify-content-center">
        @auth
            <div class="col-lg-6 mt-2 mb-2">
        @else
            <div class="col-lg-6 mt-2 mb-4">
        @endauth
            <form action="/" method="get">
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-2 mt-0">
                    <button class="btn btn-dark bg-black" type="submit"><i class="bi bi-search" id="disini"></i></button>
                    <input type="text" class="form-control shadow-none" placeholder="Cari penulis, judul atau penggalan sastra.." name="search" value="{{ request('search') }}">
                </div>
            </form>
        </div>
    </div>



    <div class="row justify-content-center">
    @auth
        <div class="col-lg-6 mt- mb-2">
                <div class="vstack gap-2 mt-2 mb-2">
                    <button type="button" class="btn btn-dark bg-black shadow-none" id="tambah" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">+ Tambah Puisi</button>
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





        @if (request('author'))
            <div class="row justify-content-center">
                <div class="col-lg-6 mt-2 mb-2">
                    <h3><i class="bi bi-arrow-left-circle border-primary" onclick="goBack()"></i></a> {{ ucfirst(trans($judul)) }}</h3>
                    <hr>
                </div>
            </div>
        @endif




    @if($posts->count())
        @foreach ($posts as $post)
            <div class="row justify-content-center">

                <div class="col-lg-6 mt-0 ">
                    <div class="card text-dark bg-light mb-2">

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
                                        <a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle text-decoration-none">
                                            <i class="bi bi-gear"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <li class="nav-item bg-danger">
                                                    <form action="/delete/{{ $post->romlah }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')"><i class="bi bi-file-x"></i> <b>Delete Puisi</b></button>
                                                    </form>
                                                </li>
                                        </ul>
                                    </div>
                                @endif
                            @endauth

                            @guest
                                <marquee direction="left" scrollamount="2" align="center" class="p-1">Silahkan login untuk berkomentar!!</marquee>
                            @endguest

                            <a href="/sastra/{{ $post->id }}" class="text-decoration-none text-dark">
                            <h5 class="card-title text-center mb-3 mx-3 text-decoration-none">{{ $post->title }}</h5>
                            {!! $post->body !!}
                            </a>

                        </div>

                        @auth
                            <form method="post" action="/" class="mb-1" enctype="multipart/form-data">
                                @csrf
                                <div class="form-floating card card-body p-0 m-3 mt-0">
                                    <input type="hidden" name="puisi_id" value="{{ $post->id }}">
                                    <input id="comentar{{ $post->id }}" type="hidden" name="comentar" required>
                                    <trix-editor input="comentar{{ $post->id }}" placeholder="Komentar disini.."></trix-editor>
                                    @error('comentar')
                                        <p class="text-danger m-0 mx-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="badge bg-black border-0 mx-3 mb-2">Komentar</button>
                            </form>
                        @endauth


                        @if ($post->comentary->count())
                            <div class="card-footer mb-0 pt-3 pb-0 text-end bg-light">
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
                                        <a class="badge btn-dark bg-black text-decoration-none mt-3 mb-0" data-bs-toggle="collapse" type="submit" href="#postingan{{ $post->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
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
            <div class="col-lg-5 m-2">
                <img src="{{ asset('storage/default/notfound.png') }}" class="img-fluid" alt="Responsive image">
            </div>
        </div>
    @endif


    <script>

        //menonaktifkan fungsi mengupload gambar pada trix editor
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault;
        });

        function goBack() {
            window.history.back();
        }

        // $(function(){
        //     var Inputtext = $('.body_komentar'),
        //     Resize = $(document.createElement('div')),
        //     textbox = null;

        //     Inputtext.addClass('noscroll');
        //     Resize.addClass('resize');

        //     $(Inputtext).after(Resize);

        //     Inputtext.on('keyup', function(){
        //         textbox = $(this).val();
        //         textbox = textbox.replace(/\n/g, '<br>');
        //         Resize.html(textbox + '<br class="tinggi">');
        //         $(this).css('height', Resize.height());
        //     });
        // });

    </script>

@endsection


