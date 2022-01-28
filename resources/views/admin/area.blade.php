@extends('admin/master');
<!-- Content Header (Page header) -->
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h2>Area Kerja</h2> --}}
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Area Kerja</h2>

                <div class="card-tools">

                    <button type="button" class="btn btn-success btn-sm" data-card-widget="" title="Collapse"
                        style="margin-right:30px " onclick="createArea()">
                        + Tambah
                    </button>
                </div>

            </div>
            <div class="card-body">
                <div>
                    <div class="row g-3">
                        <div class="col-auto">
                            <input type="text" id="search" class="form-control" placeholder="Cari..">

                        </div>
                    </div>
                    <div id="read" class="m-2">

                    </div>
                </div>


                {{-- Modal --}}
                <!-- Button trigger modal -->

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
                <!-- /.card-body -->
                <div class="card-footer">


                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->

    {{-- JQuery Script --}}
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            readArea();
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            // $(".mytable").fancyTable({
            //     pagination: false,
            //     paginationClass: "btn btn-light",
            //     paginationClassActive: "active",
            //     pagClosest: 3,
            //     perPage: 1,
            // });
        });

        function readArea() {
            $.get("{{ url('readArea') }}", {}, function(data, status) {
                $("#read").html(data);
            });

        }

        function createArea() {
            $.get("{{ url('createArea') }}", {}, function(data, status) {

                $('#modalLabel').html('Tambah Area')
                $("#page").html(data);
                $("#modalMaster").modal('show');
            });

        }

        // search data
        function searchArea() {
            var search = $("#search").val();
            $.ajax({
                type: "get",
                url: "{{ url('searchArea') }}",
                data: "search=" + search,

            });
        }

        // menyimpan data dari modal
        function storeArea() {
            var id_lokasi = $("#id_lokasi").val();
            var nama_lokasi = $("#nama_lokasi").val();
            $.ajax({
                type: "get",
                url: "{{ url('storeArea') }}",
                data: "id_lokasi=" + id_lokasi + "&&nama_lokasi=" + nama_lokasi,
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.errors, function(key, err_values) {

                            alert("Gagal Menyimpan  " + err_values);
                        });
                    } else {
                        $("#btn-close").click();
                        alert("Data Tersimpan");
                        readArea();
                    }

                }

            });
        }

        // Show Before Edit
        function showArea(id) {
            $.get("{{ url('showArea') }}/" + id, {}, function(data, status) {
                $('#modalLabel').html('Edit Area')
                $("#page").html(data);
                $("#modalMaster").modal('show');
            });

        }

        function updateArea(id) {
            var nama_lokasi = $("#nama_lokasi").val();
            $.ajax({
                type: "get",
                url: "{{ url('updateArea') }}/" + id,
                data: "nama_lokasi=" + nama_lokasi,
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.errors, function(key, err_values) {

                            alert("Gagal Menyimpan  " + err_values);
                        });
                    } else {
                        $("#btn-close").click();
                        alert("Data Berhasil di Update");
                        readArea();
                    }

                }

            });
        }

        function deleteArea(id) {
            var ya = confirm("Apakah anda yakin menghapus data dengan id " + id + " ?");
            if (ya) {
                $.ajax({
                    type: "get",
                    url: "{{ url('deleteArea') }}/" + id,
                    success: function(url) {
                        alert("Data Berhasil Dihapus");
                        readArea();
                    }

                });
                ("{{ url('area') }}");
            } else {
                alert("Data Gagal Dihapus");
                readArea();
            }
        }
    </script>

@endsection
