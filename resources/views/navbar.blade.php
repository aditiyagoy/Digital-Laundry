<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Icons -->

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"> --}}

    <!-- Bootstrap CSS -->
    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery -->
    <script src="assets/plugins/popper/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    {{-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
        integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>

    <script src="assets/plugins/popper/popper.min.js"></script>
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <title>Digital Laundry</title>
</head>

<body id="home">
    <!--css-->
    {{-- <link rel="stylesheet" href="style.css" /> --}}
    <!--Navbar -->
    <nav class="shadow navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: rgba(2, 49, 204, 0.87)">
        <div class="container">
            <a class="navbar-brand" href="#home">Digital Laundry</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="w-100">
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item active">
                            <a class="nav-link" aria-current="page" href="{{ url('/') }}">Pinjam</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" aria-current="page" href="{{ url('kembali') }}">Kembalikan</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('admin') }}">Admin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div></div>
    <div class="container">
        @yield('content')
    </div>

</body>


</html>
