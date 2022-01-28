@extends('admin/master');
<!-- Content Header (Page header) -->
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h2>Judul</h2> --}}
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Barang</h2>

                <div class="card-tools">

                    <button type="button" class="btn btn-success btn-sm" data-card-widget="" title="Collapse"
                        style="margin-right:30px " onclick="createBarang()">
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
            readBarang();
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

        function readBarang() {
            $.get("{{ url('readBarang') }}", {}, function(data, status) {
                $("#read").html(data);
            });

        }

        function createBarang() {
            $.get("{{ url('createBarang') }}", {}, function(data, status) {

                $('#modalLabel').html('Tambah Barang')
                $("#page").html(data);
                $("#modalMaster").modal('show');
            });

        }

        // menyimpan data dari modal
        function storeBarang() {
            var id_barang = $("#id_barang").val();
            var nama_barang = $("#nama_barang").val();
            const id_lokasi = $("#id_lokasi").val();
            var jml_barang = $("#jml_barang").val();
            $.ajax({
                type: "get",
                url: "{{ url('storeBarang') }}",
                data: "id_barang=" + id_barang + "&&nama_barang=" + nama_barang + "&&id_lokasi=" +
                    id_lokasi + "&&jml_barang=" + jml_barang,
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.errors, function(key, err_values) {
                            alert("Gagal Menyimpan  " + err_values);
                        });
                    } else {
                        $("#btn-close").click();
                        alert("Data Tersimpan");
                        readBarang();
                    }

                }

            });
        }

        // Show Before Edit
        function showBarang(id) {
            $.get("{{ url('showBarang') }}/" + id, {}, function(data, status) {
                $('#modalLabel').html('Edit Barang')
                $("#page").html(data);
                $("#modalMaster").modal('show');
            });

        }

        function updateBarang(id) {
            var id_barang = $("#id_barang").val();
            var nama_barang = $("#nama_barang").val();
            var id_lokasi = $("#id_lokasi").val();
            var jml_barang = $("#jml_barang").val();
            $.ajax({
                type: "get",
                url: "{{ url('updateBarang') }}/" + id,
                data: "id_barang=" + id_barang + "&&nama_barang=" + nama_barang + "&&id_lokasi=" +
                    id_lokasi + "&&jml_barang=" + jml_barang,
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.errors, function(key, err_values) {

                            alert("Gagal Menyimpan  " + err_values);
                        });
                    } else {
                        $("#btn-close").click();
                        alert("Data Berhasil di Update");
                        readBarang();
                    }

                }

            });
        }

        function deleteBarang(id, nama) {
            var ya = confirm("Apakah anda yakin menghapus data " + nama + " ?");
            if (ya) {
                $.ajax({
                    type: "get",
                    url: "{{ url('deleteBarang') }}/" + id,
                    success: function(url) {
                        alert("Data Berhasil Dihapus");
                        readBarang();
                    }

                });
            } else {
                alert("Data Gagal Dihapus");
                readBarang();
            }
        }
    </script>

@endsection
