<div class="form-group" style="align-items: center">
    <label for="nik_karyawan" style="margin-top: 5pt;">NIK Karyawan</label>
    <input type="text" name="nik_karyawan" id="nik_karyawan" class="form-control" onkeyup="autofillKaryawanKembali()"
        style="text-align: center">
    <label for="nama_karyawan" style="margin-top: 5pt;">Nama Karyawan / Belum Kembali</label>
    <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" style="text-align: center"
        readonly>
    <label for="myTable" style="margin-top: 5pt;">Banyaknya Pinjam</label>
    <table class="table table-fluid table-hover table-striped mytable" id="myTable">
        <thead>
            <th width="80px">#</th>
            <th width="400px">Nama Barang</th>
            <th width="400px">Tanggal Pinjam</th>
            <th>Status</th>
        </thead>
        <tbody>

        </tbody>



    </table>
    <button type="submit" class="btn btn-primary form-control" onclick="updateKaryawanKembali()">Kembalikan</button>

</div>
{{-- <script src="assets/dist/js/3.5.1.jquery.min.js"></script> --}}
<script>
    // $(function() {
    //     $('#id_lokasi').on('change', function() {
    //         var id_lokasi = $(this).val();

    //         $.ajax({
    //             type: "get",
    //             dataType: "json",
    //             url: "{{ url('barangSearch') }}",
    //             data: {
    //                 'id_lokasi': id_lokasi
    //             },
    //             // Belum Clear
    //             success: function(response) {
    //                 $("input[name='barang[]']").prop("checked", false);

    //                 for (var i = 0; i < response.length; i++) {
    //                     var id_barang = response[i].id_barang;

    //                     $("input[id=" + id_barang + "]").val(response[i].id_barang).prop(
    //                         "checked",
    //                         true);
    //                     $("input[id=1]").val(1).prop(
    //                         "checked",
    //                         true);
    //                 }

    //             }
    //         });
    //     });


    // });

    function autofillKaryawanKembali() {
        var nik = $("#nik_karyawan").val();
        $.ajax({
            type: "get",
            dataType: "json",
            url: "{{ url('karyawanKembaliSearch') }}",
            data: {
                'nik': nik
            },
            success: function(response) {
                if (response == "") {
                    $('#myTable tr').not(':first').remove();
                } else {

                    $('#myTable tr').not(':first').remove();
                    var html = "";
                    for (var i = 0; i < response.length; i++) {
                        var a = i + 1;
                        html = '<tr>' +
                            '<th>         </th>' +
                            '<th>' + response[i].nama_barang + '</th>' +
                            '<th>' + response[i].tgl_pinjam + '</th>' +
                            '<th>Belum Dikembalikan</th>' +
                            '</tr>';
                        $('#myTable tr').first().after(html);
                    }
                    $("#nama_karyawan").val(response[0].nama_karyawan + ' / ' + i);
                }

            }
        });
    }

    function updateKaryawanKembali() {
        var nik_karyawan = $("#nik_karyawan").val();

        $.ajax({
            type: "get",
            dataType: "json",
            url: "{{ url('updateKaryawanKembali') }}",
            data: {
                nik: nik_karyawan,
            },
            success: function(response) {
                if (response.status == 240) {
                    alert(response.errors);
                    $("#modalMasterLarge").modal('hide');
                }
                if (response.status == 200) {
                    alert(response.errors);
                    $("#modalMasterLarge").modal('hide');
                }
            }

        });
    }
</script>
