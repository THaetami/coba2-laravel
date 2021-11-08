
@include('layouts.head')

<body>

    @include('layouts.navbar')

    <div class="container mb-5">
        @yield('container')
    </div>

    @include('layouts.footer')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
