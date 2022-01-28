{{-- Modal Body Tambah Data Karyawan/Lokasi --}}
<div class="p-2">
    <div class="form-group">
        <label for="id_barang">Id Barang</label>
        <input type="text" name="id_barang" id="id_barang" class="form-control">
    </div>
    <div class="form-group">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang" class="form-control">
    </div>
    <div class="form-group">
        <label for="id_lokasi">Lokasi Kerja</label>
        <select name="id_lokasi" id="id_lokasi" class="form-control">
            <option value="" selected>--Pilih Lokasi--</option>
            @foreach ($data as $item)
                <option value="{{ $item->id_lokasi }}">{{ $item->nama_lokasi }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="jml_barang">Jumlah Barang</label>
        <input type="text" name="jml_barang" id="jml_barang" class="form-control">
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" onclick="storeBarang()">Save</button>
    </div>
</div>
