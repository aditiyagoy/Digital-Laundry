@extends('admin/master');
<!-- Content Header (Page header) -->
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Karyawan</h2>

                <div class="card-tools">

                    <button type="button" class="btn btn-success btn-sm" data-card-widget="" title="Collapse"
                        style="margin-right:30px " onclick="createKaryawan()">
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
            readKaryawan();
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

        function readKaryawan() {
            $.get("{{ url('readKaryawan') }}", {}, function(data, status) {
                $("#read").html(data);
            });

        }

        function createKaryawan() {
            $.get("{{ url('createKaryawan') }}", {}, function(data, status) {

                $('#modalLabel').html('Tambah Karyawan')
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
        function storeKaryawan() {
            var nik_karyawan = $("#nik_karyawan").val();
            var nama_karyawan = $("#nama_karyawan").val();
            const id_lokasi = $("#id_lokasi").val();
            var ukuran = $("#ukuran").val();
            var grup = $("#grup").val();
            $.ajax({
                type: "get",
                url: "{{ url('storeKaryawan') }}",
                data: "nik_karyawan=" + nik_karyawan + "&&nama_karyawan=" + nama_karyawan + "&&id_lokasi=" +
                    id_lokasi + "&&ukuran=" + ukuran + "&&grup=" + grup + "&&status_peminjaman=0",
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.errors, function(key, err_values) {
                            alert("Gagal Menyimpan  " + err_values);
                        });
                    } else {
                        $("#btn-close").click();
                        alert("Data Tersimpan");
                        readKaryawan();
                    }

                }

            });
        }

        // Show Before Edit
        function showKaryawan(id) {
            $.get("{{ url('showKaryawan') }}/" + id, {}, function(data, status) {
                $('#modalLabel').html('Edit Karyawan')
                $("#page").html(data);
                $("#modalMaster").modal('show');
            });

        }

        function updateKaryawan(id) {
            var nik_karyawan = $("#nik_karyawan").val();
            var nama_karyawan = $("#nama_karyawan").val();
            var id_lokasi = $("#id_lokasi").val();
            var ukuran = $("#ukuran").val();
            var grup = $("#grup").val();

            $.ajax({
                type: "get",
                url: "{{ url('updateKaryawan') }}/" + id,
                data: "nik_karyawan=" + nik_karyawan + "&&nama_karyawan=" + nama_karyawan + "&&id_lokasi=" +
                    id_lokasi + "&&ukuran=" + ukuran + "&&grup=" + grup,
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.errors, function(key, err_values) {

                            alert("Gagal Menyimpan  " + err_values);
                        });
                    } else {
                        $("#btn-close").click();
                        alert("Data Berhasil di Update");
                        readKaryawan();
                    }

                }

            });
        }

        function deleteKaryawan(id, nama) {
            var ya = confirm("Apakah anda yakin menghapus data " + nama + " ?");
            if (ya) {
                $.ajax({
                    type: "get",
                    url: "{{ url('deleteKaryawan') }}/" + id,
                    success: function(url) {
                        alert("Data Berhasil Dihapus");
                        readKaryawan();
                    }

                });
            } else {
                alert("Data Gagal Dihapus");
                readKaryawan();
            }
        }
    </script>

@endsection
