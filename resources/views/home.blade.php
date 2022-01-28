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
                            <a class="nav-link" aria-current="page" href="#karyawan">Karyawan</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" aria-current="page" href="{{ url('kembali') }}">Kontraktor</a>
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
    <div class="container-fluid">
        <section class="jumbotron text-center" style="background-color: rgb(239, 246, 255)">
            <img src="/assets/dist/img/danoneLogo.png" alt="Aditiya" width="200" class="brand-image" />
            <h1 class="display-4">Digital Laundry</h1>
            <p class="lead">Transaction | Take and Store</p>
            <!-- Button trigger modal -->

        </section>
        <section id="karyawan">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-md-6 mb-3">
                        <h2>Karyawan Page</h1>
                            <p class="lead">Form Peminjaman</p>
                            <div class="card">
                                <div class="card-body">
                                    <div class="p2">
                                        {{-- <form method="POST" action="{{ url('transaksi') }}"> --}}


                                        {{-- </form> --}}

                                    </div>
                                </div>
                            </div>
                            {{-- @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <b>{{ $message }}</b>
                                </div>
                            @elseif ($message = Session::get('error'))
                                <div class="alert alert-danger">
                                    <b>{{ $message }}</b>
                                </div>
                            @endif --}}
                    </div>


        </section>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" id="karyawanPinjam" onclick="karyawanPinjam()">
            Pinjam Baju (Karyawan)
        </button>
        <button type="button" class="btn btn-primary" onclick="karyawanKembali()">
            Kembali Baju (Karyawan)
        </button>
        <button type="button" class="btn btn-primary" id="karyawanPinjam" onclick="kontraktorPinjam()">
            Pinjam Baju (Kontraktor)
        </button>
        <button type="button" class="btn btn-primary" onclick="kontraktorKembali()">
            Kembali Baju (Kontraktor)
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalMaster" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Modal Tittle</h5>
                        <button type="button" class="close" id="btn-close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="page">
                            {{-- Form Isi Modal --}}

                            {{-- End Form Isi Modal --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal --}}

        <!-- Modal Large -->
        <div class="modal fade" id="modalMasterLarge" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabelLarge">Modal Tittle</h5>
                        <button type="button" class="close" id="btn-close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="pageLarge">
                            {{-- Form Isi Modal --}}

                            {{-- End Form Isi Modal --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal Large --}}


        <!-- Galery End -->
        <!-- Button trigger modal -->
        <!-- Modal -->
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <script src="assets/plugins/select2/js/select2.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {

            });

            function karyawanPinjam() {
                $.get("{{ url('karyawanPinjam') }}", {}, function(data, status) {

                    $('#modalLabel').html('Pinjam Baju Karyawan')
                    $("#page").html(data);
                    $("#modalMaster").modal('show');
                });
            }


            function karyawanKembali() {
                $.get("{{ url('karyawanKembali') }}", {}, function(data, status) {

                    $('#modalLabelLarge').html('Kembalikan Baju Karyawan')
                    $("#pageLarge").html(data);
                    $("#modalMasterLarge").modal('show');
                });
            }

            function kontraktorPinjam() {
                $.get("{{ url('kontraktorPinjam') }}", {}, function(data, status) {

                    $('#modalLabel').html('Pinjam Baju Kontraktor')
                    $("#page").html(data);
                    $("#modalMaster").modal('show');
                });
            }

            function kontraktorKembali() {
                $.get("{{ url('kontraktorKembali') }}", {}, function(data, status) {

                    $('#modalLabelLarge').html('Form Kembali Kontraktor')
                    $("#pageLarge").html(data);
                    $("#modalMasterLarge").modal('show');
                });
            }
        </script>

    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="assets/dist/js/3.5.1.jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    </div>

</body>


</html>
