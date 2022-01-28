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
                <h2 class="card-title">Transaksi Kontraktor</h2>

                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="" title="Collapse"
                        style="margin-right:20px " onclick="reportTransaksiKontraktor()">
                        <span class="fas fa-download"></span> Report
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="" title="Collapse"
                        style="margin-right:30px " onclick="createTransaksiKontraktor()">
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
            readTransaksiKontraktor();
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        function readTransaksiKontraktor() {
            $.get("{{ url('readTransaksiKontraktor') }}", {}, function(data, status) {
                $("#read").html(data);
            });

        }
        // Report Show
        function reportTransaksiKontraktor() {
            $.get("{{ url('showReportTransaksiKontraktor') }}/", {}, function(data, status) {
                $('#modalLabel').html('Download Report Transaksi Kontraktor')
                $("#page").html(data);
                $("#modalMaster").modal('show');
            });
        }

        function downloadTransaksiKontraktor() {
            var sejak = $("#sejak").val();
            window.location = "{{ URL::to('downloadTransaksiKontraktor') }}/" + sejak
        }

        function createTransaksiKontraktor() {
            $.get("{{ url('createTransaksiKontraktor') }}", {}, function(data, status) {

                $('#modalLabel').html('Tambah Transaksi Kontraktor')
                $("#page").html(data);
                $("#modalMaster").modal('show');
            });

        }

        // menyimpan data dari modal
        function storeTransaksiKontraktor() {
            var nama_kontraktor = $("#nama_kontraktor").val();
            var perusahaan = $("#perusahaan").val();
            var penanggung_jawab = $("#penanggung_jawab").val();
            var id_barang = $("#id_barang").val();
            $.ajax({
                type: "get",
                url: "{{ url('storeTransaksiKontraktor') }}",
                data: "nama_kontraktor=" + nama_kontraktor + "&&perusahaan=" + perusahaan + "&&penanggung_jawab=" +
                    penanggung_jawab + "&&id_barang=" + id_barang,
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.errors, function(key, err_values) {
                            alert("Gagal Menyimpan  " + err_values);
                        });
                    } else {
                        $("#btn-close").click();
                        alert("Data Tersimpan");
                        readTransaksiKontraktor();
                    }

                }

            });
        }



        // Show Before Edit
        function showTransaksiKontraktor(id) {
            $.get("{{ url('showTransaksiKontraktor') }}/" + id, {}, function(data, status) {
                $('#modalLabel').html('Edit Transaksi Kontraktor')
                $("#page").html(data);
                $("#modalMaster").modal('show');
            });
        }

        function updateTransaksiKontraktor(id) {
            var nama_kontraktor = $("#nama_kontraktor").val();
            var perusahaan = $("#perusahaan").val();
            var penanggung_jawab = $("#penanggung_jawab").val();
            var id_barang = $("#id_barang").val();
            var tgl_pinjam = $("#tgl_pinjam").val();
            var tgl_kembali = $("#tgl_kembali").val();
            $.ajax({
                type: "get",
                url: "{{ url('updateTransaksiKontraktor') }}/" + id,
                data: "nama_kontraktor=" + nama_kontraktor + "&&perusahaan=" + perusahaan + "&&penanggung_jawab=" +
                    penanggung_jawab + "&&id_barang=" + id_barang + "&&tgl_pinjam=" + tgl_pinjam +
                    "&&tgl_kembali=" + tgl_kembali,
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.errors, function(key, err_values) {

                            alert("Gagal Menyimpan  " + err_values);
                        });
                    } else {
                        $("#btn-close").click();
                        alert("Data Berhasil di Update");
                        readTransaksiKontraktor();
                    }

                }

            });
        }

        function deleteTransaksiKontraktor(id, nama) {
            var ya = confirm("Apakah anda yakin menghapus data " + nama + " ?");
            if (ya) {
                $.ajax({
                    type: "get",
                    url: "{{ url('deleteTransaksiKontraktor') }}/" + id,
                    success: function(url) {
                        alert("Data Berhasil Dihapus");
                        readTransaksiKontraktor();
                    }

                });
            } else {
                alert("Data Gagal Dihapus");
                readTransaksiKontraktor();
            }
        }
    </script>

@endsection
