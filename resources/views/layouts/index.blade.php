@extends('layouts.main')
@section('container')


    <div class="row justify-content-center">
        <div class="col-lg-7 mt-4 mb-2">
            <form action="/" method="get">
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}" id="search">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    {{-- <div class="row justify-content-center">
            <h5 class="col-lg-7 mt-4 mb-2">Puisi Karya {{ $title }}</h5>
    </div> --}}

    @if($posts->count())

        @foreach ($posts as $post)

        <div class="row justify-content-center">

            <div class="col-lg-7 mt-2 mb-2">
                <div class="card text-dark bg-light">
                    <div class="card-header m-0">
                        <img src="gambar/tatang.jpg" width="30" class="img-thumbnile rounded-circle"><a href="/?author={{ $post->author->username }}" class="text-decoration-none text-black"> {{ $post->author->name }} | </a><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="kontainer lh-sm">
                        <h5 class="card-title text-center mb-4">{{ $post->title }}</h5>
                        {!! $post->body !!}
                    </div>
                    <div class="card-footer mb-0 pt-3 pb-0 text-end">
                        <p>
                            <a class="btn-sm btn-primary text-decoration-none mt-2" data-bs-toggle="collapse" href="#postingan{{ $post->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Lihat Komentar
                            </a>
                        </p>
                        <div class="collapse text-start" id="postingan{{ $post->id }}">
                            <div class="card card-body mb-3 p-2">
                                <a href="#" class="text-decoration-none text-primary">{{ $post->author->name }}</a>
                                placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant
                            </div>
                            <p>
                                <a class="btn-sm btn-primary text-decoration-none mt-2" data-bs-toggle="collapse" href="#postingan{{ $post->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Tutup Komentar
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         @endforeach

    @else
        <p class="text-center fs-4">No Post Found</p>
    @endif


@endsection
