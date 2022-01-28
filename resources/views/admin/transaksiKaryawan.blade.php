@extends('admin/master');
<!-- Content Header (Page header) -->
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- {{-- <h2>Judul</h2> --}} -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Transaksi Karyawan</h2>

                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="" title="Collapse"
                        style="margin-right:20px " onclick="reportTransaksiKaryawan()">
                        <span class="fas fa-download"></span> Report
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="" title="Collapse"
                        style="margin-right:30px " onclick="createTransaksiKaryawan()">
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
    <script src="assets/plugins/jquery-ui/jquery-ui.js"></script>
    <script>
        // // Datepicker
        // $(function() {
        //     $("#tgl_pinjam").datepicker();
        // });
        $(document).ready(function() {
            readTransaksiKaryawan();
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

        function readTransaksiKaryawan() {
            $.get("{{ url('readTransaksiKaryawan') }}", {}, function(data, status) {
                $("#read").html(data);
            });

        }

        function createTransaksiKaryawan() {
            $.get("{{ url('createTransaksiKaryawan') }}", {}, function(data, status) {

                $('#modalLabel').html('Tambah Karyawan')
                $("#page").html(data);
                $("#modalMaster").modal('show');
            });

        }

        // menyimpan data dari modal
        function storeTransaksiKaryawan() {
            var nik_karyawan = $("#nik_karyawan").val();
            var id_barang = $("#id_barang").val();
            $.ajax({
                type: "get",
                url: "{{ url('storeTransaksiKaryawan') }}",
                data: "nik_karyawan=" + nik_karyawan + "&&id_barang=" + id_barang,
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.errors, function(key, err_values) {
                            alert("Gagal Menyimpan  " + err_values);
                        });
                    } else {
                        $("#btn-close").click();
                        alert("Data Tersimpan");
                        readTransaksiKaryawan();
                    }

                }

            });
        }

        // Report Show
        function reportTransaksiKaryawan() {
            $.get("{{ url('showReportTransaksiKaryawan') }}/", {}, function(data, status) {
                $('#modalLabel').html('Download Report Karyawan')
                $("#page").html(data);
                $("#modalMaster").modal('show');
            });
        }

        function downloadTransaksiKaryawan() {
            var sejak = $("#sejak").val();
            window.location = "{{ URL::to('downloadTransaksiKaryawan') }}/" + sejak
        }


        // Show Before Edit
        function showTransaksiKaryawan(id) {
            $.get("{{ url('showTransaksiKaryawan') }}/" + id, {}, function(data, status) {
                $('#modalLabel').html('Edit Transaksi Karyawan')
                $("#page").html(data);
                $("#modalMaster").modal('show');
            });
            $("#tgl_pinjam").datepicker();
        }

        function updateTransaksiKaryawan(id) {
            var nik_karyawan = $("#nik_karyawan").val();
            var id_barang = $("#id_barang").val();
            var tgl_pinjam = $("#tgl_pinjam").val();
            var tgl_kembali = $("#tgl_kembali").val();
            $.ajax({
                type: "get",
                url: "{{ url('updateTransaksiKaryawan') }}/" + id,
                data: "nik_karyawan=" + nik_karyawan + "&&id_barang=" + id_barang + "&&tgl_pinjam=" +
                    tgl_pinjam + "&&tgl_kembali=" + tgl_kembali,
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.errors, function(key, err_values) {

                            alert("Gagal Menyimpan  " + err_values);
                        });
                    } else {
                        $("#btn-close").click();
                        alert("Data Berhasil di Update");
                        readTransaksiKaryawan();
                    }

                }

            });
        }

        function deleteTransaksiKaryawan(id, nama) {
            var ya = confirm("Apakah anda yakin menghapus data " + nama + " ?");
            if (ya) {
                $.ajax({
                    type: "get",
                    url: "{{ url('deleteTransaksiKaryawan') }}/" + id,
                    success: function(url) {
                        alert("Data Berhasil Dihapus");
                        readTransaksiKaryawan();
                    }

                });
            } else {
                alert("Data Gagal Dihapus");
                readTransaksiKaryawan();
            }
        }
    </script>

@endsection
