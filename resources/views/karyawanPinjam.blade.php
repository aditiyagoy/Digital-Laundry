<div class="form-group">
    <label for="nik_karyawan" style="margin-top: 5pt;">NIK Karyawan</label>
    <input type="text" name="nik_karyawan" id="nik_karyawan" class="form-control" onkeyup="autofillKaryawan()">
    <label for="nama_karyawan" style="margin-top: 5pt;">Nama
        Karyawan</label>
    <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" readonly>
    <label for="id_lokasi">Lokasi Kerja</label>
    <select name="id_lokasi" id="id_lokasi" class="form-control">
        <option value="" selected>--Pilih Lokasi--</option>
        @foreach ($lokasi as $item)
            <option value="{{ $item->id_lokasi }}">{{ $item->nama_lokasi }}</option>
        @endforeach
    </select>
    <label for="barang" style="margin-top: 5pt;">Seragam</label>
    @foreach ($barang as $barang)
        <div class="form-check">
            <input type="checkbox" name="barang[]" id="{{ $barang['id_barang'] }}" class="form-check-input"
                value="{{ $barang['id_barang'] }}">
            <label class="form-check-label" for="a">{{ $barang['nama_barang'] }}</label>

        </div>
    @endforeach
    <label for="" style="margin-top: 5pt;"></label>
    <button type="submit" class="btn btn-primary form-control" onclick="storeKaryawanPinjam()">Pinjam</button>

</div>
{{-- <script src="assets/dist/js/3.5.1.jquery.min.js"></script> --}}
<script>
    $(function() {
        $('#id_lokasi').on('change', function() {
            var id_lokasi = $(this).val();

            $.ajax({
                type: "get",
                dataType: "json",
                url: "{{ url('barangSearch') }}",
                data: {
                    'id_lokasi': id_lokasi
                },
                // Belum Clear
                success: function(response) {
                    $("input[name='barang[]']").prop("checked", false);

                    for (var i = 0; i < response.length; i++) {
                        var id_barang = response[i].id_barang;

                        $("input[id=" + id_barang + "]").val(response[i].id_barang).prop(
                            "checked",
                            true);
                        $("input[id=1]").val(1).prop(
                            "checked",
                            true);
                    }

                }
            });
        });
        $("#nik_karyawan").keypress(function(e) {
            if (e.which == 13) {

            }
        });


    });

    function autofillKaryawan() {
        var nik = $("#nik_karyawan").val();
        $.ajax({
            type: "get",
            dataType: "json",
            url: "{{ url('karyawanSearch') }}",
            data: {
                'nik': nik
            },
            success: function(response) {
                $("#nama_karyawan").val(response.nama_karyawan);
                $("#id_lokasi").val(response.id_lokasi).change();

            }
        });
    }

    function storeKaryawanPinjam() {
        var nik_karyawan = $("#nik_karyawan").val();
        var nik = [];
        var val = [];
        var data = [];
        $(':checkbox:checked').each(function(i) {
            val[i] = $(this).val();
            // nik[i] = nik_karyawan;
            data[i] = {
                nik: $("#nik_karyawan").val(),
                id_barang: $(this).val(),
            };
        });
        $.ajax({
            type: "get",
            dataType: "json",
            url: "{{ url('storePinjamKaryawan') }}",
            data: {
                data: JSON.stringify(data),
            },
            success: function(response) {
                if (response.status == 240) {
                    alert(response.errors);
                    $("#modalMaster").modal('hide');
                }
                if (response.status == 200) {
                    alert(response.errors);
                    $("#modalMaster").modal('hide');
                }
            }

        });
    }
</script>
