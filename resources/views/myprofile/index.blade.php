<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Profile</title>

    <link href="/css/style.css" rel="stylesheet">

    <link href="/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">



</head>
<body>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-3">
            <div class="pt-0 pb-1 mb-3 mt-0 border-bottom border-dark">
                <a href="/" class="text-decoration-none btn btn-dark bg-black mb-1"><span data-feather="arrow-left"></span> Back</a>
                <h1 class="h2 text-center">Update Profile</h1>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-4 mt-3">
                    @if($author->image)
                        <img src="{{ asset('storage/upload/' . $author->image) }}" width="150" class="img-thumbnile rounded-circle" class="user_picture">
                    @else
                        <img src="{{ asset('storage/default/noImage.jpg') }}" width="150" class="img-thumbnile rounded-circle">
                    @endif

                </div>
            </div>
            <input type="file" name="image" id="image" class="border-dark form-control mt-3 mb-2">




            <form  method="post" action="/myprofile" class="mb-5 mt-4" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="border-dark form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $author->name) }}" autofocus>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="border-dark form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $author->email) }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Ganti Password</label>
                    <input type="password" class="border-dark form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="tulis password baru disini...">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark mb-5 mt-3 bg-black" onclick="return confirm('Lanjutkan update data akun?')">Update Profile</button>
            </form>
        </div>
    </div>
</div>





<div class="justify-content-center mt-0 fixed-bottom bg-light mt-1">
    <div class="card-footer text-center border-0">
        ©{{ date("Y") }} -
        <a class="text-decoration-none text-dark" href="https://pengepulaksara.com/">pengepulaksara.com</a>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>

<script>
    $('#image').ijaboCropTool({
        priview:'.user_picture',
        processUrl:'{{ route("crop") }}',
        withCSRF:['_token', '{{ csrf_token() }}'],

        onSuccess:function(message, element, status) {
                alert(message);
        },
        onError:function(message, element, status) {
                alert(message);
        }
    });








// function process() {
//         // console.log("cek");
//     const file = document.querySelector('#upload').files[0];

//     if (!file) return;

//     const reader = new FileReader();

//     reader.readAsDataURL(file);



//     reader.onload = function (event) {
//         const imgElement = document.createElement("img");
//         imgElement.src = event.target.result;
//         // document.querySelector("#input").src = event.target.result;

//         imgElement.onload = function (e) {
//             const canvas = document.createElement("canvas");
//             const MAX_WIDTH = 100;
//             const MAX_HEIGHT = 160;

//             const scaleSize = MAX_WIDTH / e.target.width;
//             canvas.width = MAX_WIDTH;
//             canvas.height = e.target.height * scaleSize;
//             // e.target.height * scaleSize

//             const ctx = canvas.getContext("2d");

//             ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);

//             const srcEncoded = ctx.canvas.toDataURL(e.target, "image/jpeg");

//             document.querySelector("#output").src = srcEncoded;
//         };
//     };
// }

</script>


</body>
</html>












